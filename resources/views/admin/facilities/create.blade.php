@extends('admin.layouts.app')

@section('title', 'Tambah Fasilitas')

@section('content')
    <div class="page-header">
        <h1>Tambah Fasilitas</h1>
        <p>Tambahkan fasilitas atau Teaching Factory beserta galerinya.</p>
    </div>

    <form method="POST" action="{{ route('admin.facilities.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.facilities._form')
    </form>
@endsection
