<?php

namespace Tests\Feature\Admin;

use App\Enums\CategoryType;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_guest_cannot_access_categories(): void
    {
        auth()->logout();

        $this->get(route('admin.categories.index'))->assertRedirect(route('admin.login'));
    }

    public function test_index_can_filter_by_type(): void
    {
        $this->seed(CategorySeeder::class);

        $this->get(route('admin.categories.index', ['type' => 'achievement']))
            ->assertOk()
            ->assertSee('Bela Diri')
            ->assertDontSee('Kegiatan Siswa');
    }

    public function test_admin_can_create_category_with_auto_slug(): void
    {
        $this->post(route('admin.categories.store'), ['type' => 'post', 'name' => 'Pengumuman Akademik'])
            ->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseHas('categories', ['type' => 'post', 'slug' => 'pengumuman-akademik']);
    }

    public function test_same_slug_is_allowed_for_different_types(): void
    {
        Category::create(['type' => CategoryType::Post, 'name' => 'Prestasi', 'slug' => 'prestasi']);

        $this->post(route('admin.categories.store'), ['type' => 'achievement', 'name' => 'Prestasi'])
            ->assertSessionHasNoErrors();

        $this->post(route('admin.categories.store'), ['type' => 'post', 'name' => 'Prestasi'])
            ->assertSessionHasErrors('slug');
    }

    public function test_type_must_be_valid(): void
    {
        $this->post(route('admin.categories.store'), ['type' => 'salah', 'name' => 'Tes'])
            ->assertSessionHasErrors('type');
    }

    public function test_admin_can_update_category(): void
    {
        $category = Category::create(['type' => CategoryType::Post, 'name' => 'Lama', 'slug' => 'lama']);

        $this->put(route('admin.categories.update', $category), ['type' => 'post', 'name' => 'Baru', 'slug' => 'lama'])
            ->assertRedirect(route('admin.categories.index'));

        $this->assertSame('Baru', $category->fresh()->name);
    }

    public function test_deleting_category_keeps_related_posts(): void
    {
        $category = Category::create(['type' => CategoryType::Post, 'name' => 'Kegiatan', 'slug' => 'kegiatan']);
        $post = Post::create(['title' => 'Berita', 'slug' => 'berita', 'body' => 'Isi', 'category_id' => $category->id]);

        $this->delete(route('admin.categories.destroy', $category))->assertRedirect(route('admin.categories.index'));

        $this->assertModelMissing($category);
        $this->assertNull($post->fresh()->category_id);
    }
}
