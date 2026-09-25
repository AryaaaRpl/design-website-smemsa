<?php

namespace App\Http\Controllers;

use App\Enums\FacilityType;
use App\Models\Achievement;
use App\Models\Facility;
use App\Models\JobVacancy;
use App\Models\Major;
use App\Models\Partner;
use Illuminate\View\View;

/**
 * Halaman publik Konsentrasi Keahlian: daftar jurusan & detail per jurusan.
 */
class MajorPageController extends Controller
{
    public function index(): View
    {
        $majors = Major::active()
            ->withCount(['achievements', 'facilities', 'partners'])
            ->ordered()
            ->get();

        $stats = [
            'majors' => $majors->count(),
            'tefa' => Facility::ofType(FacilityType::TeachingFactory)->count(),
            'partners' => Partner::count(),
        ];

        return view('jurusan.index', compact('majors', 'stats'));
    }

    public function show(Major $major): View
    {
        // Jurusan nonaktif tidak bisa dibuka dari website.
        abort_unless($major->is_active, 404);

        $major->load([
            'headTeachers',
            'facilities' => fn ($query) => $query->with('images')->ordered(),
            'testimonials' => fn ($query) => $query->published()->ordered(),
            'partners' => fn ($query) => $query->ordered(),
        ]);

        $achievements = Achievement::where('major_id', $major->id)->latestAchieved()->take(6)->get();

        // Lowongan yang masih dibuka dari mitra jurusan ini.
        $vacancies = JobVacancy::open()
            ->with('partner')
            ->whereIn('partner_id', $major->partners->pluck('id'))
            ->orderByRaw('closes_at is null')
            ->orderBy('closes_at')
            ->take(5)
            ->get();

        $otherMajors = Major::active()->ordered()->whereKeyNot($major->id)->get();

        return view('jurusan.show', compact('major', 'achievements', 'vacancies', 'otherMajors'));
    }
}
