@extends('admin.layouts.app')

@section('title', 'Tambah FAQ')

@section('content')
    <div class="page-header">
        <h1>Tambah FAQ</h1>
        <p>Tambahkan pertanyaan di halaman SPMB.</p>
    </div>

    <form method="POST" novalidate action="{{ route('admin.faqs.store') }}">
        @csrf
        @include('admin.faqs._form')
    </form>
@endsection
