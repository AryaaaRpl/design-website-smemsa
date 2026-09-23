<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Models\Achievement;
use App\Models\Category;
use Illuminate\View\View;

class AchievementController extends Controller
{
    public function __invoke(): View
    {
        $achievements = Achievement::with('category')->latestAchieved()->get();

        // Prestasi unggulan untuk bagian "Mahkota Prestasi". Jika tidak ada, bagian ini disembunyikan.
        $featured = $achievements->firstWhere('is_featured', true);

        $categories = Category::ofType(CategoryType::Achievement)->orderBy('name')->get();

        $years = $achievements->pluck('achieved_at')->filter()->map->year->unique()->sortDesc()->values();

        $awardsData = $achievements->map->toCatalogArray()->values();

        return view('prestasi', compact('achievements', 'featured', 'categories', 'years', 'awardsData'));
    }
}
