<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        // Semua berita dikirim sekaligus; pencarian & filter kategori berjalan di browser tanpa memuat ulang.
        $posts = Post::published()->with('category')->latestPublished()->get();

        $categories = Category::ofType(CategoryType::Post)->orderBy('name')->get();

        return view('berita', compact('posts', 'categories'));
    }

    public function show(Post $post): View
    {
        // Draf atau berita terjadwal belum boleh dibuka dari website.
        abort_unless(Post::published()->whereKey($post->id)->exists(), 404);

        // Hitung sekali per sesi agar refresh berulang tidak menambah jumlah dibaca.
        // withoutTimestamps: menambah views tidak boleh mengubah updated_at berita.
        $viewed = session()->get('viewed_posts', []);
        if (! in_array($post->id, $viewed)) {
            Post::withoutTimestamps(fn () => $post->increment('views'));
            session()->push('viewed_posts', $post->id);
        }

        $post->load('category');

        // Berita lain dari kategori yang sama, dilengkapi berita terbaru jika kurang.
        $relatedPosts = Post::published()
            ->with('category')
            ->whereKeyNot($post->id)
            ->orderByRaw('category_id = ? desc', [$post->category_id ?? 0])
            ->latestPublished()
            ->take(3)
            ->get();

        return view('berita.show', compact('post', 'relatedPosts'));
    }
}
