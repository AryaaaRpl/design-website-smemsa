@extends('admin.layouts.app')

@section('title', 'Edit Guru & Staf')

@section('content')
    <div class="page-header">
        <h1>Edit Guru & Staf</h1>
        <p>{{ $teacher->name }} &middot; {{ $teacher->category->label() }}</p>
    </div>

    <form method="POST" action="{{ route('admin.teachers.update', $teacher) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.teachers._form')
    </form>
@endsection
