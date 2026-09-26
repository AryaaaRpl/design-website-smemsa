@extends('admin.layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <div class="page-header">
        <h1>Edit Produk</h1>
        <p>{{ $product->name }}</p>
    </div>

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.products._form')
    </form>
@endsection
