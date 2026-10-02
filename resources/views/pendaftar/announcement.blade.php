@extends('pendaftar.layouts.app')

@section('title', 'Pengumuman')

@section('content')
    <div class="card spmb-card">
        <div class="card-header">Hasil Seleksi</div>
        <div class="card-body">
            <span class="status status-{{ $registration->status->tone() }}">{{ $registration->status->label() }}</span>
            <p class="spmb-announce-desc">{{ $registration->status->description() }}</p>

            @if ($registration->note)
                <div class="spmb-note">
                    <strong>Catatan panitia</strong>
                    <p>{{ $registration->note }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
