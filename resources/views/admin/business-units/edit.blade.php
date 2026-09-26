@extends('admin.layouts.app')

@section('title', 'Edit Unit Usaha')

@section('content')
    <div class="page-header">
        <h1>Edit Unit Usaha</h1>
        <p>{{ $unit->name }}</p>
    </div>

    <form method="POST" action="{{ route('admin.business-units.update', $unit) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.business-units._form')
    </form>
@endsection
