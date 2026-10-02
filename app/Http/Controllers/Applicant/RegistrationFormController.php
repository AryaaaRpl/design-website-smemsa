<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\Registration;
use App\Models\RegistrationDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * 5 fase pendaftaran online. Fase hanya bisa dibuka berurutan, dan semua terkunci setelah dikirim.
 */
class RegistrationFormController extends Controller
{
    /** Kunci URL => [judul, nomor langkah alur]. */
    public const PHASES = [
        'jalur' => ['Pilih Jalur', 1],
        'data-diri' => ['Isi Data Diri', 2],
        'formulir' => ['Formulir', 3],
        'berkas' => ['Unggah Berkas', 4],
        'jurusan' => ['Pilih Jurusan', 5],
    ];

    /** Buka fase yang sedang dikerjakan. */
    public function index(Request $request): RedirectResponse
    {
        $step = min($this->registration($request)->currentStep(), 5);

        return redirect()->route('pendaftar.phase', array_keys(self::PHASES)[$step - 1]);
    }

    public function show(Request $request, string $phase): View|RedirectResponse
    {
        $registration = $this->registration($request);

        if ($redirect = $this->guard($registration, $phase)) {
            return $redirect;
        }

        return view('pendaftar.registration', [
            'phase' => $phase,
            'phases' => self::PHASES,
            'majors' => $phase === 'jurusan' ? Major::active()->ordered()->get() : collect(),
            'documents' => $registration->documents()->get()->keyBy('type'),
        ]);
    }

    public function update(Request $request, string $phase): RedirectResponse
    {
        $registration = $this->registration($request);

        if ($redirect = $this->guard($registration, $phase)) {
            return $redirect;
        }

        if ($registration->isSubmitted()) {
            return back()->with('success', 'Pendaftaran sudah dikirim dan dikunci. Hubungi panitia untuk perubahan data.');
        }

        if ($phase === 'berkas') {
            $this->storeDocuments($request, $registration);
        } else {
            $registration->update($this->validatePhase($request, $phase, $registration));
        }

        // Lanjut ke fase berikutnya (atau tetap di fase terakhir).
        $keys = array_keys(self::PHASES);
        $next = $keys[min(array_search($phase, $keys) + 1, count($keys) - 1)];

        return redirect()->route('pendaftar.phase', $phase === 'berkas' && ! $registration->hasAllDocuments() ? 'berkas' : $next)
            ->with('success', self::PHASES[$phase][0].' berhasil disimpan.');
    }

    /** Kirim pendaftaran: semua fase harus lengkap. */
    public function submit(Request $request): RedirectResponse
    {
        $registration = $this->registration($request);

        if ($registration->currentStep() < 6) {
            return back()->with('success', 'Lengkapi semua fase pendaftaran terlebih dahulu.');
        }

        $registration->update(['submitted_at' => $registration->submitted_at ?? now()]);

        return redirect()->route('pendaftar.dashboard')->with('success', 'Pendaftaran berhasil dikirim. Pantau hasilnya di menu Pengumuman.');
    }

    /** Lihat berkas milik sendiri (disk privat). */
    public function document(Request $request, RegistrationDocument $document): StreamedResponse
    {
        abort_unless($document->registration_id === $this->registration($request)->id, 404);

        return Storage::disk('local')->response($document->path, $document->original_name);
    }

    private function registration(Request $request): Registration
    {
        return $request->attributes->get('registration');
    }

    /** Fase tidak dikenal = 404; fase yang belum terbuka dialihkan ke fase saat ini. */
    private function guard(Registration $registration, string $phase): ?RedirectResponse
    {
        abort_unless(isset(self::PHASES[$phase]), 404);

        if (self::PHASES[$phase][1] > $registration->currentStep()) {
            return redirect()->route('pendaftar.registration');
        }

        return null;
    }

    private function validatePhase(Request $request, string $phase, Registration $registration): array
    {
        $phone = ['required', 'regex:/^(\+62|62|0)8[0-9]{7,12}$/'];
        $parent = fn (string $key) => [
            "{$key}_name" => ['required', 'string', 'max:100'],
            "{$key}_status" => ['required', Rule::in(Registration::PARENT_STATUSES)],
            "{$key}_job" => ['required', 'string', 'max:100'],
            "{$key}_phone" => ['nullable', 'regex:/^(\+62|62|0)8[0-9]{7,12}$/'],
        ];

        $rules = match ($phase) {
            'jalur' => ['pathway' => ['required', Rule::in(Registration::PATHWAYS)]],
            'data-diri' => [
                'name' => ['required', 'string', 'max:100'],
                'gender' => ['required', Rule::in(Registration::GENDERS)],
                'birth_place' => ['required', 'string', 'max:100'],
                'birth_date' => ['required', 'date', 'before:today', 'after:1990-01-01'],
                'religion' => ['required', Rule::in(Registration::RELIGIONS)],
                'nisn' => ['required', 'digits:10'],
                'nik' => ['required', 'digits:16', Rule::unique('registrations', 'nik')->ignore($registration->id)],
                'kk_number' => ['required', 'digits:16'],
                'phone' => $phone,
                'shirt_size' => ['required', Rule::in(Registration::SHIRT_SIZES)],
            ],
            'formulir' => [
                'school_origin' => ['required', 'string', 'max:150'],
                ...$parent('father'),
                ...$parent('mother'),
                'guardian_name' => ['required', 'string', 'max:100'],
                'guardian_job' => ['required', 'string', 'max:100'],
                'guardian_phone' => $phone,
                'guardian_relation' => ['required', Rule::in(Registration::GUARDIAN_RELATIONS)],
                'residence_status' => ['required', Rule::in(Registration::RESIDENCES)],
                'address' => ['required', 'string', 'max:500'],
            ],
            'jurusan' => ['major_id' => ['required', Rule::exists('majors', 'id')->where('is_active', true)]],
        };

        return $request->validate($rules, [
            'regex' => 'Nomor HP tidak valid. Contoh: 081234567890.',
            'nisn.digits' => 'NISN harus 10 digit angka.',
            'nik.digits' => 'NIK harus 16 digit angka.',
            'nik.unique' => 'NIK ini sudah terdaftar.',
            'kk_number.digits' => 'Nomor KK harus 16 digit angka.',
        ], [
            'pathway' => 'jalur', 'name' => 'nama lengkap', 'gender' => 'jenis kelamin',
            'birth_place' => 'tempat lahir', 'birth_date' => 'tanggal lahir', 'religion' => 'agama',
            'kk_number' => 'nomor KK', 'phone' => 'nomor HP', 'shirt_size' => 'ukuran baju',
            'school_origin' => 'nama SMP/MTs', 'address' => 'alamat', 'residence_status' => 'status tempat tinggal',
            'father_name' => 'nama ayah', 'father_status' => 'status ayah', 'father_job' => 'pekerjaan ayah', 'father_phone' => 'HP ayah',
            'mother_name' => 'nama ibu', 'mother_status' => 'status ibu', 'mother_job' => 'pekerjaan ibu', 'mother_phone' => 'HP ibu',
            'guardian_name' => 'nama wali', 'guardian_job' => 'pekerjaan wali', 'guardian_phone' => 'HP wali',
            'guardian_relation' => 'hubungan wali', 'major_id' => 'jurusan',
        ]);
    }

    /** Simpan berkas yang diunggah (boleh sebagian dulu); berkas lama dengan jenis sama diganti. */
    private function storeDocuments(Request $request, Registration $registration): void
    {
        $documents = $registration->requiredDocuments();
        $files = $request->validate(
            collect($documents)->mapWithKeys(fn ($label, $type) => [$type => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048']])->all(),
            ['mimes' => ':attribute harus PDF/JPG/PNG.', 'max' => ':attribute maksimal 2 MB.'],
            $documents,
        );

        foreach (array_filter($files) as $type => $file) {
            $old = $registration->documents()->where('type', $type)->first();
            $path = $file->store("registrations/{$registration->id}", 'local');

            if ($old) {
                Storage::disk('local')->delete($old->path);
                $old->update(['path' => $path, 'original_name' => $file->getClientOriginalName()]);
            } else {
                $registration->documents()->create(['type' => $type, 'path' => $path, 'original_name' => $file->getClientOriginalName()]);
            }
        }
    }
}
