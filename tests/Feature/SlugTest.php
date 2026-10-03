<?php

namespace Tests\Feature;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Slug otomatis dari judul, unik, ikut berubah saat judul diubah, dan link lama dialihkan.
 */
class SlugTest extends TestCase
{
    use RefreshDatabase;

    private function makePost(string $title): Post
    {
        return Post::create(['title' => $title, 'body' => 'Isi', 'status' => PostStatus::Published, 'published_at' => now()->subDay()]);
    }

    public function test_slug_is_generated_unique_and_follows_title(): void
    {
        $first = $this->makePost('Juara 1 LKS');
        $second = $this->makePost('Juara 1 LKS');

        $this->assertSame('juara-1-lks', $first->slug);
        $this->assertSame('juara-1-lks-2', $second->slug);

        $first->update(['title' => 'Juara 1 LKS Provinsi']);
        $this->assertSame('juara-1-lks-provinsi', $first->slug);

        // Simpan tanpa mengubah judul: slug tetap.
        $first->update(['body' => 'Isi baru']);
        $this->assertSame('juara-1-lks-provinsi', $first->fresh()->slug);
    }

    public function test_old_link_redirects_to_new_slug(): void
    {
        $post = $this->makePost('Kunjungan Industri');
        $post->update(['title' => 'Kunjungan Industri ke Bali']);

        $this->get('/berita/kunjungan-industri')
            ->assertStatus(301)
            ->assertRedirect(url('berita/kunjungan-industri-ke-bali'));
        $this->get('/berita/kunjungan-industri-ke-bali')->assertOk();
        $this->get('/berita/tidak-pernah-ada')->assertNotFound();
    }

    public function test_admin_form_has_no_slug_field(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('admin.posts.create'))->assertOk()->assertDontSee('name="slug"', false);
    }
}
