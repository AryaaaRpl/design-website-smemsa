@extends('admin.layouts.guest')

@section('title', 'Daftar Akun')
@section('brand', 'SPMB SMEMSA')

@section('content')
    <main class="login-page">
        <div class="login-card">
            <div class="login-brand">
                <img src="{{ asset('assets/logo.webp') }}" alt="Logo SMEMSA">
                <h1>Daftar Akun SPMB</h1>
                <p>Buat akun untuk memulai pendaftaran</p>
            </div>

            <form method="POST" action="{{ route('pendaftar.register.store') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-input"
                        value="{{ old('email') }}" required autofocus autocomplete="email">
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" id="password" name="password" class="form-input"
                        required minlength="8" autocomplete="new-password">
                    <div class="form-help">Minimal 8 karakter.</div>
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input"
                        required minlength="8" autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
            </form>

            <p class="login-switch">Sudah punya akun? <a href="{{ route('pendaftar.login') }}">Masuk</a></p>
            <a href="{{ url('/spmb') }}" class="login-back">&larr; Kembali ke info SPMB</a>
        </div>
    </main>
@endsection
