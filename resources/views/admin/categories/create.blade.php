@extends('admin.layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="page-header">
        <h1>Tambah Kategori</h1>
        <p>Buat kategori baru untuk berita atau prestasi.</p>
    </div>

    <form method="POST" action="{{ route('admin.categories.store') }}" class="form-narrow">
        @csrf
        @include('admin.categories._form')
    </form>
@endsection
