@extends('admin.layouts.guest')

@section('title', 'Data Awal')
@section('brand', 'SPMB SMEMSA')

@section('content')
    <main class="login-page">
        <div class="login-card">
            <div class="login-brand">
                <img src="{{ asset('assets/logo.webp') }}" alt="Logo SMEMSA">
                <h1>Data Awal Pendaftar</h1>
                <p>Lengkapi data berikut untuk mendapatkan nomor pendaftaran</p>
            </div>

            <form method="POST" action="{{ route('pendaftar.profile.store') }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-input"
                        value="{{ old('name') }}" required maxlength="100" autofocus autocomplete="name">
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="birth_date" class="form-label">Tanggal Lahir</label>
                    <input type="date" id="birth_date" name="birth_date" class="form-input"
                        value="{{ old('birth_date') }}" required max="{{ now()->subDay()->toDateString() }}">
                    @error('birth_date') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">No. Telepon / WhatsApp</label>
                    <input type="tel" id="phone" name="phone" class="form-input" inputmode="tel"
                        value="{{ old('phone') }}" placeholder="081234567890" required autocomplete="tel">
                    @error('phone') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" id="nik" name="nik" class="form-input" inputmode="numeric"
                        value="{{ old('nik') }}" required minlength="16" maxlength="16" pattern="[0-9]{16}">
                    <div class="form-help">16 digit sesuai Kartu Keluarga.</div>
                    @error('nik') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-block">Simpan &amp; Lanjutkan</button>
            </form>

            <form method="POST" action="{{ route('pendaftar.logout') }}" class="login-switch">
                @csrf
                <button type="submit" class="login-link-btn">Keluar</button>
            </form>
        </div>
    </main>
@endsection
