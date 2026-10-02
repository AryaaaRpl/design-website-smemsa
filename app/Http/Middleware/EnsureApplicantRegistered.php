<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * Halaman dashboard SPMB hanya untuk pendaftar yang sudah mengisi data awal.
 * Data pendaftaran dibagikan ke semua view sebagai $registration.
 */
class EnsureApplicantRegistered
{
    public function handle(Request $request, Closure $next): Response
    {
        $registration = $request->user('applicant')->registration()->first();

        if (! $registration) {
            return redirect()->route('pendaftar.profile');
        }

        $request->attributes->set('registration', $registration);
        View::share('registration', $registration);

        return $next($request);
    }
}
