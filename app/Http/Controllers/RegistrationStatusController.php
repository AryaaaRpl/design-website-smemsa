<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Cek status pendaftaran SPMB oleh calon siswa, tanpa perlu menghubungi panitia.
 */
class RegistrationStatusController extends Controller
{
    public function show(): View
    {
        return view('spmb.cek-status');
    }

    public function check(Request $request): View
    {
        $validated = $request->validate([
            'registration_number' => ['required', 'string', 'max:30'],
            'birth_date' => ['required', 'date'],
        ], [], [
            'registration_number' => 'nomor pendaftaran',
            'birth_date' => 'tanggal lahir',
        ]);

        // Nomor & tanggal lahir harus cocok, agar status tidak bisa dilihat hanya dengan menebak nomor.
        $registration = Registration::query()
            ->with('major')
            ->where('registration_number', Str::upper(trim($validated['registration_number'])))
            ->whereDate('birth_date', $validated['birth_date'])
            ->first();

        return view('spmb.cek-status', [
            'registration' => $registration,
            'notFound' => $registration === null,
        ]);
    }
}
