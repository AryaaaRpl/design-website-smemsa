@extends('admin.layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <div class="page-header">
        <h1>Tambah Produk</h1>
        <p>Tambahkan barang atau jasa BLUD baru.</p>
    </div>

    @if ($units->isEmpty())
        <div class="alert">Belum ada unit usaha. <a href="{{ route('admin.business-units.create') }}">Tambah unit usaha</a> terlebih dahulu.</div>
    @else
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.products._form')
        </form>
    @endif
@endsection
