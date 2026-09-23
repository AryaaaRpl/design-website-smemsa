@extends('admin.layouts.app')

@section('title', 'Tambah Ekstrakurikuler')

@section('content')
    <div class="page-header">
        <h1>Tambah Ekstrakurikuler</h1>
        <p>Tambahkan kegiatan ekstrakurikuler baru.</p>
    </div>

    <form method="POST" action="{{ route('admin.extracurriculars.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.extracurriculars._form')
    </form>
@endsection
