<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Models\Achievement;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

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

        $years = Achievement::query()
            ->whereNotNull('achieved_at')
            ->pluck('achieved_at')
            ->map->year
            ->unique()
            ->sortDesc()
            ->values();

        $totalAchievements = Achievement::count();

        $data = compact(
            'achievements', 'categories', 'activeCategory', 'years',
            'search', 'year', 'totalAchievements',
        );

        // Permintaan dari prestasi.js (ganti filter/halaman tanpa refresh): cukup kirim isi katalog.
        // Header Vary: cache browser membedakan halaman penuh & isi katalog pada URL yang sama.
        $view = $request->ajax() ? 'prestasi._catalog' : 'prestasi';

        return response()->view($view, $data)->header('Vary', 'X-Requested-With');
    }

    /**
     * Halaman detail prestasi (pengganti modal).
     */
    public function show(Achievement $achievement): View
    {
        $achievement->load(['category', 'major']);

        // Prestasi lain dari kategori yang sama (jika kurang, isi dengan yang terbaru).
        $others = Achievement::with('category')
            ->whereKeyNot($achievement->id)
            ->orderByRaw('category_id = ? desc', [$achievement->category_id])
            ->latestAchieved()
            ->take(3)
            ->get();

        return view('prestasi.show', compact('achievement', 'others'));
    }
}
