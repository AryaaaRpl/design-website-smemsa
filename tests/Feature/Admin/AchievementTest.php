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

    public function test_admin_form_has_no_featured_option(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.achievements.create'))
            ->assertOk()
            ->assertDontSee('name="is_featured"', false)
            ->assertDontSee('Jadikan prestasi unggulan');
    }

    public function test_catalog_cards_link_to_detail_page_without_modal(): void
    {
        $achievement = $this->makeAchievement(['title' => 'Juara Robot', 'slug' => 'juara-robot']);

        $this->get(route('prestasi'))
            ->assertOk()
            ->assertSee(route('prestasi.show', $achievement), false)
            ->assertDontSee('openAwardModal', false)
            ->assertDontSee('award-modal-overlay', false);
    }

    public function test_detail_page_shows_achievement(): void
    {
        $achievement = $this->makeAchievement([
            'title' => 'Juara Robot Nasional', 'slug' => 'juara-robot', 'rank' => 'Medali Emas',
            'organizer' => 'Kemendikbud', 'location' => 'Jakarta', 'excerpt' => 'Ringkasan singkat.',
            'description' => "Paragraf satu.\n\nParagraf dua.",
        ]);
        $this->makeAchievement(['title' => 'Prestasi Lain']);

        $this->get(route('prestasi.show', $achievement))
            ->assertOk()
            ->assertSee('Juara Robot Nasional')
            ->assertSee('MEDALI EMAS')
            ->assertSee('Kemendikbud')
            ->assertSee('Paragraf dua.')
            ->assertSee('Prestasi Lainnya')
            ->assertSee('Prestasi Lain');
    }

    public function test_unknown_achievement_returns_404(): void
    {
        $this->get('/prestasi/tidak-ada')->assertNotFound();
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
    }

    public function test_public_page_shows_achievements_from_database(): void
    {
        $this->seed([CategorySeeder::class, AchievementSeeder::class]);

        $this->get(route('prestasi'))
            ->assertOk()
            ->assertSee('Juara Umum Muhammadiyah Education Awards')
            ->assertSee('Juara 1 MPL Student League', false)
            ->assertSee('<option value="2024" >2024</option>', false);
    }

    public function test_public_page_paginates_9_per_page(): void
    {
        foreach (range(1, 20) as $i) {
            $this->makeAchievement(['title' => "Prestasi Nomor {$i}", 'achieved_at' => now()->subDays($i)]);
        }

        $this->get(route('prestasi'))
            ->assertOk()
            ->assertSee('Menampilkan 1–9 dari 20 prestasi')
            ->assertSee('Prestasi Nomor 9<', false)
            ->assertDontSee('Prestasi Nomor 10<', false)
            ->assertSee('Halaman 1 dari 3');

        $this->get(route('prestasi', ['page' => 3]))
            ->assertOk()
            ->assertSee('Menampilkan 19–20 dari 20 prestasi')
            ->assertSee('Prestasi Nomor 20');
    }

    public function test_public_page_filters_by_search_category_and_year(): void
    {
        $other = Category::create(['type' => CategoryType::Achievement, 'name' => 'Olahraga', 'slug' => 'olahraga']);
        $this->makeAchievement(['title' => 'Juara Robot Nasional', 'achieved_at' => '2025-05-01']);
        $this->makeAchievement(['title' => 'Juara Silat Daerah', 'category_id' => $other->id, 'achieved_at' => '2024-05-01']);

        // Cukup cek isi katalog (request AJAX).
        $ajax = ['X-Requested-With' => 'XMLHttpRequest'];

        $this->get(route('prestasi', ['cari' => 'robot']), $ajax)
            ->assertSee('Juara Robot Nasional')->assertDontSee('Juara Silat Daerah');

        $this->get(route('prestasi', ['kategori' => 'olahraga']), $ajax)
            ->assertSee('Juara Silat Daerah')->assertDontSee('Juara Robot Nasional');

        $this->get(route('prestasi', ['tahun' => 2025]), $ajax)
            ->assertSee('Juara Robot Nasional')->assertDontSee('Juara Silat Daerah');

        $this->get(route('prestasi', ['cari' => 'tidak-ada']))
            ->assertSee('Tidak ada prestasi yang cocok');
    }

    public function test_ajax_request_returns_only_catalog(): void
    {
        $this->makeAchievement(['title' => 'Prestasi Ajax']);

        $this->get(route('prestasi'), ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertOk()
            ->assertHeader('Vary', 'X-Requested-With')
            ->assertSee('Prestasi Ajax')
            ->assertDontSee('award-filter-form', false);
    }

    public function test_public_page_shows_empty_state_without_achievements(): void
    {
        $this->get(route('prestasi'))
            ->assertOk()
            ->assertSee('Belum ada data prestasi')
            ->assertDontSee('Mahkota Prestasi');
    }
}
