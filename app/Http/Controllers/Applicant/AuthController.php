<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

/**
 * Login, daftar akun & keluar untuk pendaftar SPMB online (guard "applicant").
 */
class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('pendaftar.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [], ['password' => 'kata sandi']);

        if (! Auth::guard('applicant')->attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Email atau kata sandi salah.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('pendaftar.dashboard'));
    }

    public function showRegister(): View
    {
        return view('pendaftar.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:applicants,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'email.unique' => 'Email ini sudah terdaftar. Silakan masuk.',
        ], ['password' => 'kata sandi']);

        $applicant = Applicant::create($data);

        Auth::guard('applicant')->login($applicant);
        $request->session()->regenerate();

        return redirect()->route('pendaftar.profile');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('applicant')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pendaftar.login');
    }
}
