<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\View\View;

class ExtracurricularController extends Controller
{
    public function __invoke(): View
    {
        $extracurriculars = Extracurricular::active()->ordered()->get();

        // Data modal detail, dikunci dengan slug.
        $ekskulData = $extracurriculars->mapWithKeys(fn (Extracurricular $item) => [$item->slug => $item->toModalArray()]);

        return view('ekstrakurikuler', compact('extracurriculars', 'ekskulData'));
    }
}
