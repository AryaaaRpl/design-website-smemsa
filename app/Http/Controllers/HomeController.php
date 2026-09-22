<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $majors = Major::active()->ordered()->get();

        $majorsData = $majors->values()
            ->map(fn (Major $major, int $index) => $major->toLandingArray($index + 1));

        return view('index', compact('majors', 'majorsData'));
    }
}
