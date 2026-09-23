<?php

namespace Tests\Feature\Admin;

use App\Models\Extracurricular;
use App\Models\User;
use Database\Seeders\ExtracurricularSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExtracurricularTest extends TestCase
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
            'name' => 'Robotik Club',
            'tag' => 'Sains & Teknologi',
            'card_style' => 'normal',
            'sort_order' => 1,
            'is_active' => '1',
            'achievements' => "Juara 1 Robotik\n\nJuara 2 Line Follower\n",
        ], $overrides);
    }

    public function test_guest_cannot_access_extracurriculars(): void
    {
        $this->get(route('admin.extracurriculars.index'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_create_extracurricular(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.extracurriculars.store'), $this->validData())
            ->assertRedirect(route('admin.extracurriculars.index'));

        $ekskul = Extracurricular::firstWhere('slug', 'robotik-club');
        $this->assertSame(['Juara 1 Robotik', 'Juara 2 Line Follower'], $ekskul->achievements);
    }

    public function test_card_style_must_be_valid(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.extracurriculars.store'), $this->validData(['card_style' => 'raksasa']))
            ->assertSessionHasErrors('card_style');
    }

    public function test_admin_can_update_and_delete_extracurricular(): void
    {
        $ekskul = Extracurricular::create(['name' => 'Lama', 'slug' => 'lama']);

        $this->actingAs($this->admin)
            ->put(route('admin.extracurriculars.update', $ekskul), $this->validData(['name' => 'Baru', 'slug' => 'lama']))
            ->assertRedirect(route('admin.extracurriculars.index'));
        $this->assertSame('Baru', $ekskul->fresh()->name);

        $this->actingAs($this->admin)->delete(route('admin.extracurriculars.destroy', $ekskul));
        $this->assertModelMissing($ekskul);
    }

    public function test_modal_image_falls_back_to_card_image(): void
    {
        $ekskul = new Extracurricular(['image' => 'assets/ekskul/silat.webp']);

        $this->assertSame(asset('assets/ekskul/silat.webp'), $ekskul->modal_image_url);
    }

    public function test_public_page_shows_active_extracurriculars(): void
    {
        $this->seed(ExtracurricularSeeder::class);
        Extracurricular::firstWhere('slug', 'pmr')->update(['is_active' => false]);

        $this->get(route('ekstrakurikuler'))
            ->assertOk()
            ->assertSee('ekskul-card featured reveal-item', false)
            ->assertSee('ekskul-card tall reveal-item', false)
            ->assertSee('Hizbul Wathan (HW)')
            ->assertDontSee('PMR Wira Unit SMEMSA');
    }

    public function test_public_page_shows_empty_state(): void
    {
        $this->get(route('ekstrakurikuler'))
            ->assertOk()
            ->assertSee('Data ekstrakurikuler belum tersedia');
    }
}
