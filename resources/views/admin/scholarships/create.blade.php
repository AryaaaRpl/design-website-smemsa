@extends('admin.layouts.app')

@section('title', 'Tambah Beasiswa')

@section('content')
    <div class="page-header">
        <h1>Tambah Beasiswa</h1>
        <p>Tambahkan skema beasiswa di halaman SPMB.</p>
    </div>

    <form method="POST" novalidate action="{{ route('admin.scholarships.store') }}">
        @csrf
        @include('admin.scholarships._form')
    </form>
@endsection
