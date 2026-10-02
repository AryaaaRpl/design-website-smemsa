<?php

namespace Tests\Feature;

use App\Models\Applicant;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicantAuthTest extends TestCase
{
    use RefreshDatabase;

    private function profileData(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Budi Santoso', 'birth_date' => '2011-05-10',
            'phone' => '081234567890', 'nik' => '3510123456789012',
        ], $overrides);
    }

    public function test_register_then_fill_profile_then_dashboard(): void
    {
        $this->post(route('pendaftar.register.store'), [
            'email' => 'budi@contoh.id', 'password' => 'rahasia123', 'password_confirmation' => 'rahasia123',
        ])->assertRedirect(route('pendaftar.profile'));

        $this->assertAuthenticated('applicant');

        // Belum isi data awal: dashboard mengarahkan ke data awal.
        $this->get(route('pendaftar.dashboard'))->assertRedirect(route('pendaftar.profile'));

        $this->post(route('pendaftar.profile.store'), $this->profileData())
            ->assertRedirect(route('pendaftar.dashboard'));

        $registration = Registration::sole();
        $this->assertSame(Applicant::sole()->id, $registration->applicant_id);
        $this->assertStringStartsWith('SPMB-', $registration->registration_number);

        $this->get(route('pendaftar.dashboard'))->assertOk()->assertSee($registration->registration_number);
    }

    public function test_login_and_logout(): void
    {
        Applicant::create(['email' => 'ani@contoh.id', 'password' => 'rahasia123']);

        $this->post(route('pendaftar.login.store'), ['email' => 'ani@contoh.id', 'password' => 'salah'])
            ->assertSessionHasErrors('email');

        $this->post(route('pendaftar.login.store'), ['email' => 'ani@contoh.id', 'password' => 'rahasia123'])
            ->assertRedirect(route('pendaftar.dashboard'));

        $this->post(route('pendaftar.logout'))->assertRedirect(route('pendaftar.login'));
        $this->assertGuest('applicant');
    }

    public function test_validation_rules(): void
    {
        Applicant::create(['email' => 'ada@contoh.id', 'password' => 'rahasia123']);

        $this->post(route('pendaftar.register.store'), [
            'email' => 'ada@contoh.id', 'password' => 'pendek', 'password_confirmation' => 'beda',
        ])->assertSessionHasErrors(['email', 'password']);

        $this->actingAs(Applicant::create(['email' => 'b@contoh.id', 'password' => 'rahasia123']), 'applicant')
            ->post(route('pendaftar.profile.store'), $this->profileData(['nik' => '123', 'phone' => '12']))
            ->assertSessionHasErrors(['nik', 'phone']);
    }

    public function test_guest_redirected_to_applicant_login_and_admin_is_separate(): void
    {
        $this->get(route('pendaftar.dashboard'))->assertRedirect(route('pendaftar.login'));

        // Login pendaftar tidak membuka admin.
        $this->actingAs(Applicant::create(['email' => 'c@contoh.id', 'password' => 'rahasia123']), 'applicant')
            ->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_login_does_not_open_applicant_area(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('pendaftar.dashboard'))->assertRedirect(route('pendaftar.login'));
    }

    private function registeredApplicant(array $registration = []): Applicant
    {
        $applicant = Applicant::create(['email' => 'd@contoh.id', 'password' => 'rahasia123']);
        $applicant->registration()->create($this->profileData($registration));

        return $applicant;
    }

    public function test_guide_modal_shows_once_after_profile(): void
    {
        $applicant = Applicant::create(['email' => 'e@contoh.id', 'password' => 'rahasia123']);
        $this->actingAs($applicant, 'applicant');

        $this->followingRedirects()
            ->post(route('pendaftar.profile.store'), $this->profileData())
            ->assertSee('Tata Cara Pendaftaran');

        $this->get(route('pendaftar.dashboard'))->assertDontSee('Tata Cara Pendaftaran');
    }

    public function test_dashboard_pages_and_topbar(): void
    {
        $this->actingAs($this->registeredApplicant(), 'applicant');

        $this->get(route('pendaftar.dashboard'))->assertOk()
            ->assertSee('Halo, <strong>Budi Santoso</strong>', false)
            ->assertSee('d@contoh.id')
            ->assertSee('Belum dipilih');

        foreach (['registration', 'announcement', 'help'] as $page) {
            $this->get(route('pendaftar.'.$page))->assertOk()
                ->assertSee('No. Pendaftaran')
                ->assertSee('SMK Muhammadiyah 1 Genteng');
        }
    }

    public function test_current_step_follows_progress(): void
    {
        $registration = $this->registeredApplicant()->registration;
        $this->assertSame(1, $registration->currentStep());

        $registration->update(['pathway' => 'Prestasi']);
        $this->assertSame(2, $registration->fresh()->currentStep());
    }
}
