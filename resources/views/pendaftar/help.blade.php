@extends('pendaftar.layouts.app')

@section('title', 'Bantuan')

@section('content')
    <div class="card spmb-card">
        <div class="card-header">Butuh Bantuan?</div>
        <div class="card-body">
            <p class="spmb-announce-desc">
                Hubungi admin SPMB SMK Muhammadiyah 1 Genteng lewat WhatsApp, termasuk jika lupa kata sandi.
                Sebutkan nomor pendaftaran Anda: <strong>{{ $registration->registration_number }}</strong>.
            </p>
            <a href="{{ $site->whatsappLink('spmb', 'Halo Admin SPMB, saya pendaftar dengan nomor '.$registration->registration_number.'.') }}"
                target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                WhatsApp Admin: {{ $site->whatsappDisplay('spmb') }}
            </a>
        </div>
    </div>
@endsection
