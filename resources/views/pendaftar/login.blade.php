@extends('admin.layouts.guest')

@section('title', 'Masuk')
@section('brand', 'SPMB SMEMSA')

@section('content')
    <main class="login-page">
        <div class="login-card">
            <div class="login-brand">
                <img src="{{ asset('assets/logo.webp') }}" alt="Logo SMEMSA">
                <h1>SPMB SMEMSA</h1>
                <p>Masuk untuk melanjutkan pendaftaran</p>
            </div>

            <form method="POST" novalidate action="{{ route('pendaftar.login.store') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-input"
                        value="{{ old('email') }}" required autofocus autocomplete="username">
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" id="password" name="password" class="form-input"
                        required autocomplete="current-password">
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="remember" value="1">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </form>

            <p class="login-switch">Belum punya akun? <a href="{{ route('pendaftar.register') }}">Daftar di sini</a></p>
            <p class="login-switch login-switch-muted">Lupa kata sandi? Hubungi panitia SPMB.</p>
            <a href="{{ url('/spmb') }}" class="login-back">&larr; Kembali ke info SPMB</a>
        </div>
    </main>
@endsection
