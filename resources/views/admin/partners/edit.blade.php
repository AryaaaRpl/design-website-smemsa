@extends('admin.layouts.app')

@section('title', 'Edit Mitra')

@section('content')
    <div class="page-header">
        <h1>Edit Mitra</h1>
        <p>{{ $partner->name }}</p>
    </div>

    <form method="POST" action="{{ route('admin.partners.update', $partner) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.partners._form')
    </form>
@endsection
