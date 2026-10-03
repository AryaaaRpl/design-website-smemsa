<?php

namespace Tests\Feature;

use App\Enums\RegistrationStatus;
use App\Models\Applicant;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * SPMB: data pendaftar di admin.
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

    public function test_admin_detail_unlock_and_reset_password(): void
    {
        Storage::fake('local');
        Storage::disk('local')->put('berkas/kk.pdf', 'isi');

        $applicant = Applicant::create(['email' => 'budi@contoh.id', 'password' => 'rahasia123']);
        $registration = $applicant->registration()->create([
            'name' => 'Budi Santoso', 'birth_date' => '2011-05-10', 'phone' => '081234567890',
            'nik' => '3510123456789012', 'guardian_name' => 'Pak Ahmad', 'submitted_at' => now(),
        ]);
        $document = $registration->documents()->create(['type' => 'kk', 'path' => 'berkas/kk.pdf', 'original_name' => 'kk.pdf']);

        // Pendaftar tidak bisa membuka admin.
        $this->get(route('admin.registrations.document', $document))->assertRedirect(route('admin.login'));

        $this->actingAs(User::factory()->create());

        $this->get(route('admin.registrations.show', $registration))->assertOk()
            ->assertSee('budi@contoh.id')->assertSee('Pak Ahmad')->assertSee('Buka Kunci');
        $this->get(route('admin.registrations.document', $document))->assertOk();

        $this->post(route('admin.registrations.unlock', $registration))->assertRedirect();
        $this->assertFalse($registration->fresh()->isSubmitted());

        $this->post(route('admin.registrations.reset-password', $registration))->assertSessionHas('new_password');
        $this->assertFalse(Hash::check('rahasia123', $applicant->fresh()->password));
    }
}
