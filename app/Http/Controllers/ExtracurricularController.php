<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\View\View;

class ExtracurricularController extends Controller
{
    public function index(): View
    {
        $extracurriculars = Extracurricular::active()->ordered()->get();

        return view('ekstrakurikuler', compact('extracurriculars'));
    }

    public function show(Extracurricular $extracurricular): View
    {
        // Ekstrakurikuler nonaktif tidak bisa dibuka dari website.
        abort_unless($extracurricular->is_active, 404);

        $others = Extracurricular::active()
            ->ordered()
            ->whereKeyNot($extracurricular->id)
            ->take(3)
            ->get();

        return view('ekstrakurikuler.show', ['ekskul' => $extracurricular, 'others' => $others]);
    }
}
