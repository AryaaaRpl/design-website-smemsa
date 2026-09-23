@extends('admin.layouts.app')

@section('title', 'Edit Prestasi')

@section('content')
    <div class="page-header">
        <h1>Edit Prestasi</h1>
        <p>{{ $achievement->title }}</p>
    </div>

    <form method="POST" action="{{ route('admin.achievements.update', $achievement) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.achievements._form')
    </form>
@endsection
