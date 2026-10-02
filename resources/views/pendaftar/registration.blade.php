{{-- Tahap 2: ringkasan fase. Isian tiap fase dibuat di tahap 3. --}}
@extends('pendaftar.layouts.app')

@section('title', 'Pendaftaran')

@section('content')
    <div class="card spmb-card">
        <div class="card-header">Fase Pendaftaran</div>
        <div class="card-body">
            @include('pendaftar.partials.steps')
            <p class="text-muted">Formulir tiap fase segera tersedia.</p>
        </div>
    </div>
@endsection
