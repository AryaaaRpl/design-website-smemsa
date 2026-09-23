<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function __invoke(): View
    {
        $posts = Post::published()->with('category')->latestPublished()->get();

        // Headline: berita unggulan terbaru, jika tidak ada pakai berita terbaru.
        $featured = $posts->firstWhere('is_featured', true) ?? $posts->first();

        $categories = Category::ofType(CategoryType::Post)->orderBy('name')->get();

        // Data modal detail, dikunci dengan slug berita.
        $newsData = $posts->mapWithKeys(fn (Post $post) => [$post->slug => $post->toModalArray()]);

        return view('berita', compact('posts', 'featured', 'categories', 'newsData'));
    }
}
