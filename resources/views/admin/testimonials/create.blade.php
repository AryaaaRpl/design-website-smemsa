@extends('admin.layouts.app')

@section('title', 'Tambah Testimoni')

@section('content')
    <div class="page-header">
        <h1>Tambah Testimoni</h1>
        <p>Tambahkan cerita sukses alumni.</p>
    </div>

    <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.testimonials._form')
    </form>
@endsection
