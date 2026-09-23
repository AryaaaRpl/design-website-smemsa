@extends('admin.layouts.app')

@section('title', 'Tambah Prestasi')

@section('content')
    <div class="page-header">
        <h1>Tambah Prestasi</h1>
        <p>Catat prestasi baru siswa SMEMSA.</p>
    </div>

    <form method="POST" action="{{ route('admin.achievements.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.achievements._form')
    </form>
@endsection
