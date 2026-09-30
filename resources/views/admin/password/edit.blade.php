@extends('admin.layouts.app')

@section('title', 'Ubah Password')

@section('content')
    <div class="page-header">
        <h1>Ubah Password</h1>
        <p>Ganti password akun admin secara berkala agar tetap aman.</p>
    </div>

    <form method="POST" action="{{ route('admin.password.update') }}" class="form-narrow">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
        @endif

        <div class="card form-card">
            <div class="card-header">Password Akun</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="current_password" class="form-label">Password Saat Ini <span class="required">*</span></label>
                    <input type="password" id="current_password" name="current_password" class="form-input"
                        required autocomplete="current-password">
                    @error('current_password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password Baru <span class="required">*</span></label>
                    <input type="password" id="password" name="password" class="form-input"
                        required minlength="8" autocomplete="new-password">
                    <div class="form-help">Minimal 8 karakter, mengandung huruf dan angka.</div>
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Ulangi Password Baru <span class="required">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input"
                        required minlength="8" autocomplete="new-password">
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Password</button>
        </div>
    </form>
@endsection
