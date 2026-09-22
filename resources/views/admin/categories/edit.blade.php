@extends('admin.layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <div class="page-header">
        <h1>Edit Kategori</h1>
        <p>{{ $category->type->label() }} &middot; {{ $category->name }}</p>
    </div>

    <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="form-narrow">
        @csrf
        @method('PUT')
        @include('admin.categories._form')
    </form>
@endsection
