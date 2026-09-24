<?php

namespace Tests\Feature\Admin;

use App\Enums\VacancyStatus;
use App\Models\JobVacancy;
use App\Models\Major;
use App\Models\Partner;
use App\Models\User;
use Database\Seeders\BkkSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BkkTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create();
    }

    private function makeVacancy(array $attributes = []): JobVacancy
    {
        $partner = Partner::create(['name' => 'PT Uji', 'slug' => 'pt-uji-'.uniqid()]);

        return JobVacancy::create(array_merge([
            'partner_id' => $partner->id,
            'position' => 'Posisi Uji',
            'slug' => 'posisi-'.uniqid(),
            'employment_type' => 'full-time',
            'closes_at' => today()->addDays(7),
        ], $attributes));
    }

    public function test_guest_cannot_access_bkk_admin(): void
    {
        $this->get(route('admin.partners.index'))->assertRedirect(route('admin.login'));
        $this->get(route('admin.vacancies.index'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_create_partner_with_majors(): void
    {
        $major = Major::create(['code' => 'PPLG', 'name' => 'PPLG', 'slug' => 'rpl']);

        $this->actingAs($this->admin)
            ->post(route('admin.partners.store'), [
                'name' => 'PT Mitra Baru',
                'sort_order' => 1,
                'is_active' => '1',
                'majors' => [$major->id],
            ])
            ->assertRedirect(route('admin.partners.index'));

        $partner = Partner::firstWhere('slug', 'pt-mitra-baru');
        $this->assertTrue($partner->is_active);
        $this->assertSame([$major->id], $partner->majors->pluck('id')->all());
    }

    public function test_deleting_partner_deletes_its_vacancies(): void
    {
        $vacancy = $this->makeVacancy();

        $this->actingAs($this->admin)->delete(route('admin.partners.destroy', $vacancy->partner));

        $this->assertModelMissing($vacancy);
    }

    public function test_admin_can_create_vacancy(): void
    {
        $partner = Partner::create(['name' => 'PT Uji', 'slug' => 'pt-uji']);

        $this->actingAs($this->admin)
            ->post(route('admin.vacancies.store'), [
                'partner_id' => $partner->id,
                'position' => 'Teknisi Jaringan',
                'employment_type' => 'magang',
                'status' => 'open',
                'closes_at' => today()->addDays(10)->toDateString(),
            ])
            ->assertRedirect(route('admin.vacancies.index'));

        $this->assertDatabaseHas('job_vacancies', ['slug' => 'teknisi-jaringan', 'employment_type' => 'magang']);
    }

    public function test_expired_and_closed_vacancies_are_hidden_from_public_page(): void
    {
        $this->makeVacancy(['position' => 'Lowongan Aktif']);
        $this->makeVacancy(['position' => 'Lowongan Lewat', 'closes_at' => today()->subDay()]);
        $this->makeVacancy(['position' => 'Lowongan Ditutup', 'status' => VacancyStatus::Closed]);
        $this->makeVacancy(['position' => 'Lowongan Hari Ini', 'closes_at' => today()]);

        $this->get(route('bkk'))
            ->assertOk()
            ->assertSee('Lowongan Aktif')
            ->assertSee('Lowongan Hari Ini')
            ->assertDontSee('Lowongan Lewat')
            ->assertDontSee('Lowongan Ditutup');
    }

    public function test_admin_list_filters_expired_vacancies(): void
    {
        $this->makeVacancy(['position' => 'Lowongan Aktif']);
        $this->makeVacancy(['position' => 'Lowongan Lewat', 'closes_at' => today()->subDay()]);

        $this->actingAs($this->admin)
            ->get(route('admin.vacancies.index', ['filter' => 'expired']))
            ->assertSee('Lowongan Lewat')
            ->assertSee('Kedaluwarsa')
            ->assertDontSee('Lowongan Aktif');

        $this->actingAs($this->admin)
            ->get(route('admin.vacancies.index'))
            ->assertSee('1 lowongan kedaluwarsa');
    }

    public function test_apply_link_falls_back_to_whatsapp(): void
    {
        $vacancy = $this->makeVacancy(['position' => 'Junior Web Developer']);
        $this->assertStringStartsWith('https://wa.me/'.'6282241356668', $vacancy->apply_link);
        $this->assertStringContainsString('Junior%20Web%20Developer', $vacancy->apply_link);

        $vacancy->update(['apply_url' => 'https://karir.example.com']);
        $this->assertSame('https://karir.example.com', $vacancy->apply_link);
    }

    public function test_public_pages_show_seeded_partners(): void
    {
        $this->seed(BkkSeeder::class);

        $this->get(route('bkk'))
            ->assertOk()
            ->assertSee('PT. Semesta Multitekno')
            ->assertSee('Junior Web Developer');

        // Mitra tanpa logo (hanya punya lowongan) tidak tampil di marquee beranda.
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('alt="Bank Muamalat"', false)
            ->assertDontSee('alt="Hotel Ketapang Indah"', false);
    }

    public function test_public_pages_show_empty_state_without_data(): void
    {
        $this->get(route('bkk'))
            ->assertOk()
            ->assertSee('Belum ada lowongan yang dibuka')
            ->assertSee('Data mitra belum tersedia');

        $this->get(route('home'))->assertOk()->assertDontSee('marquee-section', false);
    }
}
