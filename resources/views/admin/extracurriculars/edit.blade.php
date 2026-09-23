@extends('admin.layouts.app')

@section('title', 'Edit Ekstrakurikuler')

@section('content')
    <div class="page-header">
        <h1>Edit Ekstrakurikuler</h1>
        <p>{{ $extracurricular->name }}</p>
    </div>

    <form method="POST" action="{{ route('admin.extracurriculars.update', $extracurricular) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.extracurriculars._form')
    </form>
@endsection
