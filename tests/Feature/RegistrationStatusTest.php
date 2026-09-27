<?php

namespace Tests\Feature;

use App\Enums\RegistrationStatus;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * SPMB: data pendaftar di admin dan cek status oleh calon siswa.
 */
class RegistrationStatusTest extends TestCase
{
    use RefreshDatabase;

    private function registration(array $overrides = []): Registration
    {
        return Registration::create(array_merge([
            'name' => 'Ahmad Fauzi', 'birth_date' => '2011-05-14', 'school_origin' => 'SMPN 1 Genteng',
        ], $overrides));
    }

    public function test_registration_number_is_generated(): void
    {
        $registration = $this->registration();

        $this->assertMatchesRegularExpression('/^SPMB-\d{4}-[A-Z0-9]{5}$/', $registration->registration_number);
        $this->assertSame(RegistrationStatus::Pending, $registration->fresh()->status);
    }

    public function test_status_page_renders(): void
    {
        $this->get(route('spmb.status'))->assertOk()->assertSee('Cek Status Pendaftaran');
    }

    public function test_student_can_check_status_with_number_and_birth_date(): void
    {
        $registration = $this->registration([
            'status' => RegistrationStatus::Incomplete, 'note' => 'Scan KK buram, mohon unggah ulang.',
        ]);

        $this->post(route('spmb.status.check'), [
            'registration_number' => strtolower($registration->registration_number),
            'birth_date' => '2011-05-14',
        ])
            ->assertOk()
            ->assertSee('Berkas Perlu Dilengkapi')
            ->assertSee('Scan KK buram, mohon unggah ulang.')
            ->assertSee('Ah*** Fa***')
            ->assertDontSee('Ahmad Fauzi');
    }

    public function test_wrong_birth_date_shows_not_found(): void
    {
        $registration = $this->registration();

        $this->post(route('spmb.status.check'), [
            'registration_number' => $registration->registration_number,
            'birth_date' => '2011-05-15',
        ])
            ->assertOk()
            ->assertSee('Data tidak ditemukan')
            ->assertDontSee('Menunggu Verifikasi');
    }

    public function test_status_check_requires_both_fields(): void
    {
        $this->post(route('spmb.status.check'), [])
            ->assertSessionHasErrors(['registration_number', 'birth_date']);
    }

    public function test_guest_cannot_access_registration_admin(): void
    {
        $this->get(route('admin.registrations.index'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_manage_registrations(): void
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('admin.registrations.store'), [
            'name' => 'Siti Aminah', 'birth_date' => '2011-01-02', 'phone' => '082241356668',
            'pathway' => 'Prestasi', 'status' => 'menunggu',
        ])->assertRedirect(route('admin.registrations.index'));

        $registration = Registration::firstWhere('name', 'Siti Aminah');
        $this->assertSame('6282241356668', $registration->phone);

        $this->get(route('admin.registrations.index'))->assertOk()->assertSee($registration->registration_number);
        $this->get(route('admin.registrations.create'))->assertOk();
        $this->get(route('admin.registrations.edit', $registration))->assertOk();

        $this->put(route('admin.registrations.update', $registration), [
            'name' => 'Siti Aminah', 'birth_date' => '2011-01-02', 'status' => 'diterima',
        ])->assertRedirect(route('admin.registrations.index'));
        $this->assertSame(RegistrationStatus::Accepted, $registration->fresh()->status);

        $this->delete(route('admin.registrations.destroy', $registration))->assertRedirect();
        $this->assertModelMissing($registration);
    }
}
