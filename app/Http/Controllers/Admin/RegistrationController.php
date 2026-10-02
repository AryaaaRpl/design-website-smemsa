<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RegistrationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegistrationRequest;
use App\Models\Major;
use App\Models\Registration;
use App\Models\RegistrationDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Data pendaftar SPMB. Status di sini yang dilihat pendaftar di halaman Pengumuman.
 */
class RegistrationController extends Controller
{
    public function index(Request $request): View
    {
        $activeStatus = RegistrationStatus::tryFrom((string) $request->query('status'));
        $search = trim((string) $request->query('search'));

        $registrations = Registration::query()
            ->with('major')
            ->when($activeStatus, fn ($query) => $query->ofStatus($activeStatus))
            ->when($search !== '', fn ($query) => $query->where(fn ($query) => $query
                ->where('registration_number', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('school_origin', 'like', "%{$search}%")))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $statusCounts = Registration::query()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.registrations.index', [
            'registrations' => $registrations,
            'statuses' => RegistrationStatus::cases(),
            'statusCounts' => $statusCounts,
            'activeStatus' => $activeStatus,
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        return $this->form('admin.registrations.create', new Registration);
    }

    public function store(RegistrationRequest $request): RedirectResponse
    {
        $registration = Registration::create($request->validated());

        return redirect()->route('admin.registrations.index')
            ->with('success', "Pendaftar {$registration->name} ditambahkan dengan nomor {$registration->registration_number}.");
    }

    public function show(Registration $registration): View
    {
        return view('admin.registrations.show', [
            'registration' => $registration->load('major', 'applicant'),
            'documents' => $registration->documents->keyBy('type'),
        ]);
    }

    /**
     * Buka kunci pendaftaran yang sudah dikirim agar pendaftar bisa memperbaiki data.
     */
    public function unlock(Registration $registration): RedirectResponse
    {
        $registration->update(['submitted_at' => null]);

        return back()->with('success', "Data {$registration->registration_number} dibuka kembali, pendaftar bisa mengubah dan mengirim ulang.");
    }

    /**
     * Lupa kata sandi: panitia membuat sandi baru lalu memberikannya ke pendaftar.
     */
    public function resetPassword(Registration $registration): RedirectResponse
    {
        abort_unless($registration->applicant, 404);

        $password = Str::lower(Str::random(8));
        $registration->applicant->update(['password' => $password]);

        return back()->with('success', "Kata sandi baru untuk {$registration->applicant->email}: {$password} (berikan ke pendaftar, sandi ini tidak ditampilkan lagi).");
    }

    public function document(RegistrationDocument $document): StreamedResponse
    {
        return Storage::disk('local')->response($document->path, $document->original_name);
    }

    public function edit(Registration $registration): View
    {
        return $this->form('admin.registrations.edit', $registration);
    }

    public function update(RegistrationRequest $request, Registration $registration): RedirectResponse
    {
        $registration->update($request->validated());

        return redirect()->route('admin.registrations.index')
            ->with('success', "Data {$registration->registration_number} berhasil diperbarui.");
    }

    public function destroy(Registration $registration): RedirectResponse
    {
        $registration->delete();

        return back()->with('success', "Pendaftar {$registration->registration_number} berhasil dihapus.");
    }

    private function form(string $view, Registration $registration): View
    {
        return view($view, [
            'registration' => $registration,
            'majors' => Major::ordered()->get(),
            'statuses' => RegistrationStatus::cases(),
            'pathways' => Registration::PATHWAYS,
        ]);
    }
}
