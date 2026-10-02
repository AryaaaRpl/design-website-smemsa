<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Halaman dashboard SPMB pendaftar. $registration dibagikan oleh middleware EnsureApplicantRegistered.
 */
class DashboardController extends Controller
{
    public function home(): View
    {
        return view('pendaftar.home');
    }

    public function registration(): View
    {
        return view('pendaftar.registration');
    }

    public function announcement(): View
    {
        return view('pendaftar.announcement');
    }

    public function help(): View
    {
        return view('pendaftar.help');
    }
}
