<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PasswordController extends Controller
{
    public function edit(): View
    {
        return view('admin.password.edit');
    }

    public function update(PasswordRequest $request): RedirectResponse
    {
        // Cast 'hashed' di model User meng-hash password secara otomatis.
        $request->user()->update(['password' => $request->validated('password')]);

        // Cegah sesi lama dipakai ulang setelah password berganti.
        $request->session()->regenerate();

        return redirect()->route('admin.password.edit')->with('success', 'Password berhasil diubah.');
    }
}
