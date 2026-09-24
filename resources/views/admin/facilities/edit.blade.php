@extends('admin.layouts.app')

@section('title', 'Edit Fasilitas')

@section('content')
    <div class="page-header">
        <h1>Edit Fasilitas</h1>
        <p>{{ $facility->name }}</p>
    </div>

    <form method="POST" action="{{ route('admin.facilities.update', $facility) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.facilities._form')
    </form>
@endsection
