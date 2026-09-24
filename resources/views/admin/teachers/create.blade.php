@extends('admin.layouts.app')

@section('title', 'Tambah Guru & Staf')

@section('content')
    <div class="page-header">
        <h1>Tambah Guru & Staf</h1>
        <p>Tambahkan data pimpinan, guru, atau staff karyawan.</p>
    </div>

    <form method="POST" action="{{ route('admin.teachers.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.teachers._form')
    </form>
@endsection
