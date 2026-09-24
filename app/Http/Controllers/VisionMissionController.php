<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\View\View;

class VisionMissionController extends Controller
{
    public function __invoke(): View
    {
        $majors = Major::active()->ordered()->get();

        // Data modal detail jurusan, dikunci dengan slug.
        $majorsProfile = $majors->mapWithKeys(fn (Major $major) => [$major->slug => $major->toProfileArray()]);

        return view('visi-misi', compact('majors', 'majorsProfile'));
    }
}
