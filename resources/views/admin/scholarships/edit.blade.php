@extends('admin.layouts.app')

@section('title', 'Edit Beasiswa')

@section('content')
    <div class="page-header">
        <h1>Edit Beasiswa</h1>
        <p>{{ $scholarship->name }}</p>
    </div>

    <form method="POST" novalidate action="{{ route('admin.scholarships.update', $scholarship) }}">
        @csrf
        @method('PUT')
        @include('admin.scholarships._form')
    </form>
@endsection
