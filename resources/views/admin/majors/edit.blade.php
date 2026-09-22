@extends('admin.layouts.app')

@section('title', 'Edit Jurusan')

@section('content')
    <div class="page-header">
        <h1>Edit Jurusan</h1>
        <p>{{ $major->code }} &middot; {{ $major->name }}</p>
    </div>

    <form method="POST" action="{{ route('admin.majors.update', $major) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.majors._form')
    </form>
@endsection
