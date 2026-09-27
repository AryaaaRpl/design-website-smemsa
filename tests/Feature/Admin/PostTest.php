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

    public function test_news_cards_link_to_detail_page_instead_of_modal(): void
    {
        $post = Post::create([
            'title' => 'Kunjungan Industri', 'slug' => 'kunjungan-industri', 'body' => "Paragraf satu.\n\nParagraf dua.",
            'status' => PostStatus::Published, 'published_at' => now()->subDay(),
        ]);

        foreach ([route('home'), route('berita')] as $url) {
            $this->get($url)
                ->assertSee(route('berita.show', $post), false)
                ->assertDontSee('openNewsModal')
                ->assertDontSee('news-modal-overlay');
        }

        $this->get(route('berita.show', $post))
            ->assertOk()
            ->assertSee('Kunjungan Industri')
            ->assertSee('<p>Paragraf dua.</p>', false)
            ->assertSee('Belum ada gambar');
    }

    public function test_news_page_lists_all_posts_equally_with_search_and_filter(): void
    {
        $category = Category::create(['name' => 'Prestasi', 'slug' => 'prestasi', 'type' => CategoryType::Post]);
        Post::create([
            'title' => 'Juara Robotik', 'slug' => 'juara-robotik', 'body' => 'x', 'location' => 'Surabaya',
            'category_id' => $category->id, 'status' => PostStatus::Published, 'published_at' => now()->subDay(),
        ]);

        $this->get(route('berita'))
            ->assertOk()
            ->assertDontSee('HEADLINE UTAMA')
            ->assertDontSee('featured-news-card')
            ->assertSee('id="news-search-input"', false)
            ->assertSee('data-category="prestasi"', false)
            // Teks pencarian disiapkan server dalam huruf kecil.
            ->assertSee('data-search="juara robotik surabaya prestasi"', false);
    }

    public function test_admin_post_form_has_no_headline_option(): void
    {
        $this->actingAs($this->admin)
            ->get(route('admin.posts.create'))
            ->assertOk()
            ->assertDontSee('headline', false);
    }

    public function test_detail_page_hides_draft_and_scheduled_posts(): void
    {
        $draft = Post::create(['title' => 'Draf', 'slug' => 'draf', 'body' => 'x']);
        $scheduled = Post::create([
            'title' => 'Besok', 'slug' => 'besok', 'body' => 'x',
            'status' => PostStatus::Published, 'published_at' => now()->addDay(),
        ]);

        $this->get(route('berita.show', $draft))->assertNotFound();
        $this->get(route('berita.show', $scheduled))->assertNotFound();
    }

    public function test_public_pages_show_empty_state_without_posts(): void
    {
        $this->get(route('home'))->assertOk()->assertSee('Belum ada berita');
        $this->get(route('berita'))->assertOk()->assertSee('Belum ada berita');
    }
}
