<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Models\Achievement;
use App\Models\BusinessUnit;
use App\Models\Category;
use App\Models\Extracurricular;
use App\Models\Major;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Product;
use App\Models\Testimonial;
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

        // Angka statistik yang dihitung otomatis dari database.
        $stats = [
            'partners' => Partner::count(),
            'extracurriculars' => Extracurricular::active()->count(),
        ];

        // Section "Jejak Prestasi Siswa SMEMSA": 3 prestasi terbaru & testimoni alumni.
        $latestAchievements = Achievement::latestAchieved()->take(3)->get();
        $testimonials = Testimonial::published()->with('major')->ordered()->get();

        // Section BLUD: produk unggulan & daftar unit usaha.
        $bludProducts = Product::visible()->featured()->with('businessUnit.majors')->ordered()->get();
        $businessUnits = BusinessUnit::active()->with('majors')->ordered()->get();

        return view('index', compact(
            'majors', 'majorsData', 'latestPosts', 'postCategories', 'partners', 'stats',
            'latestAchievements', 'testimonials', 'bludProducts', 'businessUnits',
        ));
    }
}
