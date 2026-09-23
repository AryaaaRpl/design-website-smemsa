<?php

namespace Tests\Feature\Admin;

use App\Enums\CategoryType;
use App\Models\Achievement;
use App\Models\Category;
use App\Models\User;
use Database\Seeders\AchievementSeeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AchievementTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create();
        $this->category = Category::create(['type' => CategoryType::Achievement, 'name' => 'Teknologi', 'slug' => 'teknologi']);
    }

    private function validData(array $overrides = []): array
    {
        return array_merge([
            'title' => 'Juara 1 LKS Web Technologies',
            'category_id' => $this->category->id,
            'level' => 'provinsi',
            'achieved_at' => '2026-04-10',
            'excerpt' => 'Ringkasan.',
        ], $overrides);
    }

    private function makeAchievement(array $attributes = []): Achievement
    {
        return Achievement::create(array_merge([
            'title' => 'Prestasi',
            'slug' => 'prestasi-'.uniqid(),
            'category_id' => $this->category->id,
            'level' => 'nasional',
            'achieved_at' => '2026-01-01',
        ], $attributes));
    }

    public function test_guest_cannot_access_achievements(): void
    {
        $this->get(route('admin.achievements.index'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_create_achievement(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.achievements.store'), $this->validData())
            ->assertRedirect(route('admin.achievements.index'));

        $this->assertDatabaseHas('achievements', ['slug' => 'juara-1-lks-web-technologies', 'level' => 'provinsi']);
    }

    public function test_category_must_be_achievement_category(): void
    {
        $postCategory = Category::create(['type' => CategoryType::Post, 'name' => 'Kegiatan', 'slug' => 'kegiatan']);

        $this->actingAs($this->admin)
            ->post(route('admin.achievements.store'), $this->validData(['category_id' => $postCategory->id]))
            ->assertSessionHasErrors('category_id');
    }

    public function test_new_featured_replaces_previous_featured(): void
    {
        $old = $this->makeAchievement(['title' => 'Unggulan Lama', 'is_featured' => true]);

        $this->actingAs($this->admin)
            ->post(route('admin.achievements.store'), $this->validData(['is_featured' => '1']))
            ->assertSessionHas('success', fn (string $message) => str_contains($message, 'Unggulan Lama'));

        $this->assertFalse($old->fresh()->is_featured);
        $this->assertSame(1, Achievement::headline()->count());
    }

    public function test_admin_can_update_and_delete_achievement(): void
    {
        $achievement = $this->makeAchievement(['slug' => 'lama']);

        $this->actingAs($this->admin)
            ->put(route('admin.achievements.update', $achievement), $this->validData(['title' => 'Baru', 'slug' => 'lama']))
            ->assertRedirect(route('admin.achievements.index'));
        $this->assertSame('Baru', $achievement->fresh()->title);

        $this->actingAs($this->admin)->delete(route('admin.achievements.destroy', $achievement));
        $this->assertSoftDeleted($achievement);
    }

    public function test_catalog_array_matches_page_format(): void
    {
        $achievement = $this->makeAchievement([
            'rank' => 'Medali Emas', 'field_label' => 'Teknologi IT', 'achieved_at' => '2026-03-15',
            'description' => "Satu <b>tebal</b>\n\nDua",
        ]);

        $data = $achievement->fresh()->toCatalogArray();

        $this->assertSame('MEDALI EMAS', $data['badge']);
        $this->assertSame('Teknologi IT', $data['categoryLabel']);
        $this->assertSame('2026', $data['year']);
        $this->assertSame('Maret 2026', $data['dateStr']);
        $this->assertSame('teknologi', $data['category']);
        $this->assertArrayHasKey('imageUrl', $data);
        $this->assertStringContainsString('&lt;b&gt;tebal&lt;/b&gt;', $data['fullDesc']);
    }

    public function test_public_page_shows_achievements_from_database(): void
    {
        $this->seed([CategorySeeder::class, AchievementSeeder::class]);

        $this->get(route('prestasi'))
            ->assertOk()
            ->assertSee('Mahkota Prestasi')
            ->assertSee('Juara Umum Muhammadiyah Education Awards')
            ->assertSee('Juara 1 MPL Student League', false)
            ->assertSee('<option value="2024">2024</option>', false);
    }

    public function test_public_page_shows_empty_state_without_achievements(): void
    {
        $this->get(route('prestasi'))
            ->assertOk()
            ->assertSee('Belum ada data prestasi')
            ->assertDontSee('Mahkota Prestasi');
    }
}
