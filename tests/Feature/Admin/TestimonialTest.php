<?php

namespace Tests\Feature\Admin;

use App\Models\Testimonial;
use App\Models\User;
use Database\Seeders\AchievementSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\MajorSeeder;
use Database\Seeders\TestimonialSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestimonialTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create();
    }

    private function validData(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Siti Aminah',
            'role' => 'Staff Akuntansi',
            'company' => 'Bank Jatim Syariah',
            'graduation_year' => 2024,
            'quote' => 'Bank Mini Sekolah melatih saya teliti mengelola transaksi.',
            'sort_order' => 1,
            'is_published' => '1',
        ], $overrides);
    }

    public function test_guest_cannot_access_testimonials(): void
    {
        $this->get(route('admin.testimonials.index'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_create_update_and_delete_testimonial(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.testimonials.store'), $this->validData())
            ->assertRedirect(route('admin.testimonials.index'));

        $testimonial = Testimonial::firstWhere('name', 'Siti Aminah');
        $this->assertSame('Staff Akuntansi • Bank Jatim Syariah', $testimonial->job_title);

        $this->actingAs($this->admin)
            ->put(route('admin.testimonials.update', $testimonial), $this->validData(['name' => 'Siti Aminah, S.E.']))
            ->assertRedirect(route('admin.testimonials.index'));
        $this->assertSame('Siti Aminah, S.E.', $testimonial->fresh()->name);

        $this->actingAs($this->admin)->delete(route('admin.testimonials.destroy', $testimonial));
        $this->assertModelMissing($testimonial);
    }

    public function test_quote_is_required_and_limited(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.testimonials.store'), $this->validData(['quote' => str_repeat('a', 401)]))
            ->assertSessionHasErrors('quote');
    }

    public function test_initials_used_when_photo_is_empty(): void
    {
        $this->assertSame('AR', (new Testimonial(['name' => 'Ahmad Rizqi Pratama']))->initials);
    }

    public function test_home_shows_vertical_slider_with_seeded_testimonials(): void
    {
        $this->seed([MajorSeeder::class, TestimonialSeeder::class]);
        Testimonial::firstWhere('name', 'Rizal Maulana')->update(['is_published' => false]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('id="testi-slider"', false)
            ->assertSee('Ahmad Rizqi Pratama')
            ->assertSee('Nadia Putri Lestari')
            ->assertSee('class="testi-dots"', false)
            ->assertDontSee('Rizal Maulana');
    }

    public function test_single_testimonial_has_no_dots(): void
    {
        Testimonial::create(['name' => 'Satu Saja', 'quote' => 'Hanya satu.', 'is_published' => true]);

        $this->get(route('home'))
            ->assertSee('Satu Saja')
            ->assertDontSee('class="testi-dots"', false);
    }

    public function test_home_shows_empty_card_without_testimonials(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Cerita alumni segera hadir.')
            ->assertSee('Prestasi terbaru segera hadir');
    }

    public function test_timeline_shows_three_latest_achievements(): void
    {
        $this->seed([CategorySeeder::class, AchievementSeeder::class]);

        $this->get(route('home'))
            ->assertSee('Dua Atlet Taekwondo Smemsa Raih Juara 3')
            ->assertDontSee('Prestasi terbaru segera hadir');
    }
}
