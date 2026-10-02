@extends('admin.layouts.app')

@section('title', 'Tambah Pendaftar')

@section('content')
    <div class="page-header">
        <h1>Tambah Pendaftar</h1>
        <p>Nomor pendaftaran dibuat otomatis setelah disimpan. Berikan nomor itu ke calon siswa.</p>
    </div>

    <form method="POST" novalidate action="{{ route('admin.registrations.store') }}">
        @csrf
        @include('admin.registrations._form')
    </form>
@endsection
