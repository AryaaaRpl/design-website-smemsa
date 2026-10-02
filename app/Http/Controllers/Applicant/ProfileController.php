<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Data awal setelah daftar akun (nama, tanggal lahir, No HP, NIK).
 * Menyimpan data ini sekaligus membuat nomor pendaftaran.
 */
class ProfileController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        if ($request->user('applicant')->registration()->exists()) {
            return redirect()->route('pendaftar.dashboard');
        }

        return view('pendaftar.profile');
    }

    public function store(Request $request): RedirectResponse
    {
        $applicant = $request->user('applicant');

        if ($applicant->registration()->exists()) {
            return redirect()->route('pendaftar.dashboard');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'birth_date' => ['required', 'date', 'before:today', 'after:1990-01-01'],
            'phone' => ['required', 'regex:/^(\+62|62|0)8[0-9]{7,12}$/'],
            'nik' => ['required', 'digits:16', 'unique:registrations,nik'],
        ], [
            'phone.regex' => 'Nomor HP tidak valid. Contoh: 081234567890.',
            'nik.digits' => 'NIK harus 16 digit angka.',
            'nik.unique' => 'NIK ini sudah terdaftar. Hubungi panitia jika ini NIK Anda.',
        ], [
            'name' => 'nama lengkap',
            'birth_date' => 'tanggal lahir',
            'phone' => 'nomor HP',
            'nik' => 'NIK',
        ]);

        $applicant->registration()->create($data);

        // Modal tata cara pendaftaran tampil sekali, tepat setelah data awal disimpan.
        return redirect()->route('pendaftar.dashboard')->with('show_guide', true);
    }
}
