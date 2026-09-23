@extends('admin.layouts.app')

@section('title', 'Tambah Lowongan')

@section('content')
    <div class="page-header">
        <h1>Tambah Lowongan</h1>
        <p>Batas lamaran otomatis diisi 30 hari dari hari ini, bisa diubah.</p>
    </div>

    <form method="POST" action="{{ route('admin.vacancies.store') }}">
        @csrf
        @include('admin.vacancies._form')
    </form>
@endsection
