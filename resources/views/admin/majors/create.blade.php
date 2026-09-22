@extends('admin.layouts.app')

@section('title', 'Tambah Jurusan')

@section('content')
    <div class="page-header">
        <h1>Tambah Jurusan</h1>
        <p>Lengkapi data konsentrasi keahlian baru.</p>
    </div>

    <form method="POST" action="{{ route('admin.majors.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.majors._form')
    </form>
@endsection
