<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use App\Models\Partner;
use Illuminate\View\View;

class BkkController extends Controller
{
    public function __invoke(): View
    {
        // Hanya lowongan yang dibuka & belum melewati batas lamaran.
        $vacancies = JobVacancy::open()
            ->with('partner')
            ->orderByRaw('closes_at is null')
            ->orderBy('closes_at')
            ->get();

        $partners = Partner::active()->ordered()->get();

        return view('bkk', compact('vacancies', 'partners'));
    }
}
