<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Models\Category;
use App\Models\Major;
use App\Models\Partner;
use App\Models\Post;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $majors = Major::active()->ordered()->get();

        $majorsData = $majors->values()
            ->map(fn (Major $major, int $index) => $major->toLandingArray($index + 1));

        $latestPosts = Post::published()->with('category')->latestPublished()->take(5)->get();

        $postCategories = Category::ofType(CategoryType::Post)->orderBy('name')->get();

        $partners = Partner::active()->ordered()->get();

        return view('index', compact('majors', 'majorsData', 'latestPosts', 'postCategories', 'partners'));
    }
}
