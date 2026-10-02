<?php

namespace Tests\Feature;

use App\Models\Applicant;
use App\Models\Major;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ApplicantRegistrationFormTest extends TestCase
{
    use RefreshDatabase;

    private Registration $registration;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');

        $applicant = Applicant::create(['email' => 'a@contoh.id', 'password' => 'rahasia123']);
        $this->registration = $applicant->registration()->create([
            'name' => 'Budi Santoso', 'birth_date' => '2011-05-10', 'phone' => '081234567890', 'nik' => '3510123456789012',
        ]);
        $this->actingAs($applicant, 'applicant');
    }

    private function dataDiri(): array
    {
        return [
            'name' => 'Budi Santoso', 'gender' => 'Laki-laki', 'birth_place' => 'Banyuwangi', 'birth_date' => '2011-05-10',
            'religion' => 'Islam', 'nisn' => '0112233445', 'nik' => '3510123456789012', 'kk_number' => '3510123456789999',
            'phone' => '081234567890', 'shirt_size' => 'M',
        ];
    }

    private function formulir(): array
    {
        return [
            'school_origin' => 'SMP Negeri 1 Genteng',
            'father_name' => 'Ahmad', 'father_status' => 'Masih Hidup', 'father_job' => 'Petani', 'father_phone' => '081111111111',
            'mother_name' => 'Siti', 'mother_status' => 'Masih Hidup', 'mother_job' => 'Ibu Rumah Tangga',
            'guardian_name' => 'Ahmad', 'guardian_job' => 'Petani', 'guardian_phone' => '081111111111', 'guardian_relation' => 'Ayah',
            'residence_status' => 'Bersama Orang Tua', 'address' => 'Jl. KH. Ahmad Dahlan No. 10, Genteng',
        ];
    }

    private function files(): array
    {
        return collect(Registration::DOCUMENTS)->keys()
            ->mapWithKeys(fn ($type) => [$type => UploadedFile::fake()->create("{$type}.pdf", 100, 'application/pdf')])
            ->all();
    }

    public function test_full_flow_from_pathway_to_submit(): void
    {
        $major = Major::create(['code' => 'PPLG', 'name' => 'Pengembang Perangkat Lunak', 'slug' => 'pplg']);

        $this->get(route('pendaftar.registration'))->assertRedirect(route('pendaftar.phase', 'jalur'));

        $this->post(route('pendaftar.phase.update', 'jalur'), ['pathway' => 'Prestasi'])
            ->assertRedirect(route('pendaftar.phase', 'data-diri'));
        $this->post(route('pendaftar.phase.update', 'data-diri'), $this->dataDiri())
            ->assertRedirect(route('pendaftar.phase', 'formulir'));
        $this->post(route('pendaftar.phase.update', 'formulir'), $this->formulir())
            ->assertRedirect(route('pendaftar.phase', 'berkas'));
        $this->post(route('pendaftar.phase.update', 'berkas'), $this->files())
            ->assertRedirect(route('pendaftar.phase', 'jurusan'));
        $this->post(route('pendaftar.phase.update', 'jurusan'), ['major_id' => $major->id])
            ->assertRedirect(route('pendaftar.phase', 'jurusan'));

        $registration = $this->registration->fresh();
        $this->assertSame(6, $registration->currentStep());
        $this->assertSame(4, $registration->documents()->count());
        Storage::disk('local')->assertExists($registration->documents()->first()->path);

        $this->get(route('pendaftar.phase', 'jurusan'))->assertSee('Kirim Pendaftaran');
        $this->post(route('pendaftar.submit'))->assertRedirect(route('pendaftar.dashboard'));
        $this->assertTrue($registration->fresh()->isSubmitted());

        // Setelah dikirim, data terkunci.
        $this->post(route('pendaftar.phase.update', 'jalur'), ['pathway' => 'Reguler']);
        $this->assertSame('Prestasi', $registration->fresh()->pathway);
    }

    public function test_phases_open_in_order(): void
    {
        $this->get(route('pendaftar.phase', 'formulir'))->assertRedirect(route('pendaftar.registration'));
        $this->get(route('pendaftar.phase', 'tidak-ada'))->assertNotFound();
        $this->post(route('pendaftar.submit'));
        $this->assertFalse($this->registration->fresh()->isSubmitted());
    }

    public function test_validation_and_partial_upload(): void
    {
        $this->registration->update(['pathway' => 'Reguler'] + $this->dataDiri() + $this->formulir());

        $this->post(route('pendaftar.phase.update', 'data-diri'), ['nisn' => '12', 'kk_number' => 'abc'] + $this->dataDiri())
            ->assertSessionHasErrors(['nisn', 'kk_number']);

        // Sebagian berkas dulu: tetap di fase berkas.
        $this->post(route('pendaftar.phase.update', 'berkas'), ['kk' => UploadedFile::fake()->create('kk.pdf', 100, 'application/pdf')])
            ->assertRedirect(route('pendaftar.phase', 'berkas'));

        $this->post(route('pendaftar.phase.update', 'berkas'), ['akte' => UploadedFile::fake()->create('akte.exe', 100)])
            ->assertSessionHasErrors('akte');
        $this->post(route('pendaftar.phase.update', 'berkas'), ['akte' => UploadedFile::fake()->create('akte.pdf', 3000, 'application/pdf')])
            ->assertSessionHasErrors('akte');
    }

    public function test_document_only_visible_to_owner(): void
    {
        $this->registration->update(['pathway' => 'Reguler'] + $this->dataDiri() + $this->formulir());
        $this->post(route('pendaftar.phase.update', 'berkas'), $this->files());
        $document = $this->registration->documents()->first();

        $this->get(route('pendaftar.document', $document))->assertOk();

        $other = Applicant::create(['email' => 'lain@contoh.id', 'password' => 'rahasia123']);
        $other->registration()->create(['name' => 'Lain', 'birth_date' => '2011-01-01', 'phone' => '081234567891', 'nik' => '3510123456789013']);
        $this->actingAs($other, 'applicant')->get(route('pendaftar.document', $document))->assertNotFound();
    }
}
