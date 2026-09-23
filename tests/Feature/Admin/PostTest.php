<?php

namespace Tests\Feature\Admin;

use App\Enums\CategoryType;
use App\Enums\PostStatus;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\PostSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostTest extends TestCase
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
            'title' => 'Kunjungan Industri ke PT Telkom',
            'excerpt' => 'Ringkasan kunjungan.',
            'body' => "Paragraf pertama.\n\nParagraf kedua.",
            'status' => 'published',
        ], $overrides);
    }

    public function test_guest_cannot_access_posts(): void
    {
        $this->get(route('admin.posts.index'))->assertRedirect(route('admin.login'));
    }

    public function test_index_can_filter_by_status_and_search(): void
    {
        Post::create(['title' => 'Berita Terbit', 'slug' => 'terbit', 'body' => 'x', 'status' => PostStatus::Published, 'published_at' => now()]);
        Post::create(['title' => 'Berita Draf', 'slug' => 'draf', 'body' => 'x']);

        $this->actingAs($this->admin)
            ->get(route('admin.posts.index', ['status' => 'draft']))
            ->assertOk()
            ->assertSee('Berita Draf')
            ->assertDontSee('Berita Terbit');

        $this->actingAs($this->admin)
            ->get(route('admin.posts.index', ['search' => 'Terbit']))
            ->assertSee('Berita Terbit')
            ->assertDontSee('Berita Draf');
    }

    public function test_admin_can_create_post(): void
    {
        Storage::fake('public');

        $this->actingAs($this->admin)
            ->post(route('admin.posts.store'), $this->validData([
                'thumbnail' => UploadedFile::fake()->create('foto.jpg', 100, 'image/jpeg'),
            ]))
            ->assertRedirect(route('admin.posts.index'));

        $post = Post::firstWhere('slug', 'kunjungan-industri-ke-pt-telkom');

        $this->assertSame($this->admin->id, $post->user_id);
        $this->assertNotNull($post->published_at, 'Berita terbit tanpa tanggal memakai waktu sekarang.');
        Storage::disk('public')->assertExists($post->thumbnail);
    }

    public function test_category_must_be_a_post_category(): void
    {
        $achievementCategory = Category::create(['type' => CategoryType::Achievement, 'name' => 'Seni', 'slug' => 'seni']);

        $this->actingAs($this->admin)
            ->post(route('admin.posts.store'), $this->validData(['category_id' => $achievementCategory->id]))
            ->assertSessionHasErrors('category_id');
    }

    public function test_admin_can_update_post(): void
    {
        $post = Post::create(['title' => 'Lama', 'slug' => 'lama', 'body' => 'x']);

        $this->actingAs($this->admin)
            ->put(route('admin.posts.update', $post), $this->validData(['title' => 'Baru', 'slug' => 'lama']))
            ->assertRedirect(route('admin.posts.index'));

        $this->assertSame('Baru', $post->fresh()->title);
    }

    public function test_admin_can_delete_post(): void
    {
        $post = Post::create(['title' => 'Hapus', 'slug' => 'hapus', 'body' => 'x']);

        $this->actingAs($this->admin)
            ->delete(route('admin.posts.destroy', $post))
            ->assertRedirect(route('admin.posts.index'));

        $this->assertSoftDeleted($post);
    }

    public function test_new_headline_replaces_previous_headline(): void
    {
        $old = Post::create(['title' => 'Headline Lama', 'slug' => 'headline-lama', 'body' => 'x', 'status' => PostStatus::Published, 'published_at' => now(), 'is_featured' => true]);

        $this->actingAs($this->admin)
            ->post(route('admin.posts.store'), $this->validData(['is_featured' => '1']))
            ->assertRedirect(route('admin.posts.index'))
            ->assertSessionHas('success', fn (string $message) => str_contains($message, 'Headline Lama'));

        $this->assertFalse($old->fresh()->is_featured);
        $this->assertSame(1, Post::headline()->count());
        $this->assertTrue(Post::firstWhere('slug', 'kunjungan-industri-ke-pt-telkom')->is_featured);
    }

    public function test_updating_current_headline_keeps_it_without_warning(): void
    {
        $post = Post::create(['title' => 'Headline', 'slug' => 'headline', 'body' => 'x', 'status' => PostStatus::Published, 'published_at' => now(), 'is_featured' => true]);

        $this->actingAs($this->admin)
            ->put(route('admin.posts.update', $post), $this->validData(['slug' => 'headline', 'is_featured' => '1']))
            ->assertSessionHas('success', 'Berita berhasil diperbarui.');

        $this->assertTrue($post->fresh()->is_featured);
    }

    public function test_only_published_post_can_be_headline(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.posts.store'), $this->validData(['status' => 'draft', 'is_featured' => '1']))
            ->assertSessionHasErrors(['is_featured' => 'Hanya berita berstatus Terbit yang bisa dijadikan headline utama.']);
    }

    public function test_form_shows_current_headline_warning(): void
    {
        Post::create(['title' => 'Headline Sekarang', 'slug' => 'headline-sekarang', 'body' => 'x', 'status' => PostStatus::Published, 'published_at' => now(), 'is_featured' => true]);

        $this->actingAs($this->admin)
            ->get(route('admin.posts.create'))
            ->assertSee('Headline saat ini:', false)
            ->assertSee('Headline Sekarang');
    }

    public function test_body_html_escapes_content_and_splits_paragraphs(): void
    {
        $post = new Post(['body' => "Satu <script>alert(1)</script>\n\nDua"]);

        $this->assertSame("<p>Satu &lt;script&gt;alert(1)&lt;/script&gt;</p>\n<p>Dua</p>", $post->body_html);
    }

    public function test_public_pages_only_show_published_posts(): void
    {
        $this->seed([CategorySeeder::class, PostSeeder::class]);
        Post::create(['title' => 'Draf Rahasia', 'slug' => 'draf-rahasia', 'body' => 'x']);
        Post::create(['title' => 'Terjadwal Besok', 'slug' => 'besok', 'body' => 'x', 'status' => PostStatus::Published, 'published_at' => now()->addDay()]);

        foreach ([route('home'), route('berita')] as $url) {
            $this->get($url)
                ->assertOk()
                ->assertSee('Raih Juara Umum ME Awards')
                ->assertDontSee('Draf Rahasia')
                ->assertDontSee('Terjadwal Besok');
        }

        $this->get(route('berita'))->assertSee('Kerja Sama Industri')->assertSee('18 Juni 2026');
    }

    public function test_public_pages_show_empty_state_without_posts(): void
    {
        $this->get(route('home'))->assertOk()->assertSee('Belum ada berita');
        $this->get(route('berita'))->assertOk()->assertSee('Belum ada berita');
    }
}
