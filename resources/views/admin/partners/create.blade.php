@extends('admin.layouts.app')

@section('title', 'Tambah Mitra')

@section('content')
    <div class="page-header">
        <h1>Tambah Mitra</h1>
        <p>Tambahkan perusahaan mitra industri baru.</p>
    </div>

    <form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.partners._form')
    </form>
@endsection
