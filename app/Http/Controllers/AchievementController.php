<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Models\Achievement;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AchievementController extends Controller
{
    /** Jumlah prestasi per halaman katalog. */
    private const PER_PAGE = 9;

    public function __invoke(Request $request): Response
    {
        $search = trim((string) $request->query('cari'));
        $categorySlug = (string) $request->query('kategori');
        $year = (int) $request->query('tahun') ?: null;

        $categories = Category::ofType(CategoryType::Achievement)->orderBy('name')->get();
        $activeCategory = $categories->firstWhere('slug', $categorySlug);

        // Pencarian & filter dijalankan di database agar tetap cepat walau data ribuan.
        $achievements = Achievement::with('category')
            ->when($search !== '', fn ($query) => $query->where(fn ($query) => $query
                ->where('title', 'like', "%{$search}%")
                ->orWhere('organizer', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhere('excerpt', 'like', "%{$search}%")))
            ->when($activeCategory, fn ($query) => $query->where('category_id', $activeCategory->id))
            ->when($year, fn ($query) => $query->whereYear('achieved_at', $year))
            ->latestAchieved()
            ->paginate(self::PER_PAGE)
            ->withQueryString()
            ->fragment('katalog-prestasi');

        // Prestasi unggulan untuk bagian "Mahkota Prestasi". Jika tidak ada, bagian ini disembunyikan.
        $featured = Achievement::with('category')->headline()->latestAchieved()->first();

        $years = Achievement::query()
            ->whereNotNull('achieved_at')
            ->pluck('achieved_at')
            ->map->year
            ->unique()
            ->sortDesc()
            ->values();

        $totalAchievements = Achievement::count();

        // Data modal detail: prestasi di halaman ini + prestasi unggulan.
        $awardsData = collect($achievements->items())
            ->when($featured, fn ($items) => $items->push($featured))
            ->unique('id')
            ->map->toCatalogArray()
            ->values();

        $data = compact(
            'achievements', 'featured', 'categories', 'activeCategory', 'years',
            'search', 'year', 'totalAchievements', 'awardsData',
        );

        // Permintaan dari prestasi.js (ganti filter/halaman tanpa refresh): cukup kirim isi katalog.
        // Header Vary: cache browser membedakan halaman penuh & isi katalog pada URL yang sama.
        $view = $request->ajax() ? 'prestasi._catalog' : 'prestasi';

        return response()->view($view, $data)->header('Vary', 'X-Requested-With');
    }
}
