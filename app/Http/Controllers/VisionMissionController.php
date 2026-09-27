<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\View\View;

class VisionMissionController extends Controller
{
    public function __invoke(): View
    {
        // Tombol jurusan langsung menuju halaman detail jurusan (/jurusan/{slug}).
        $majors = Major::active()->ordered()->get();

        return view('visi-misi', compact('majors'));
    }
}
