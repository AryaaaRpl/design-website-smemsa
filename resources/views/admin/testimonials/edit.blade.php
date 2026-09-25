@extends('admin.layouts.app')

@section('title', 'Edit Testimoni')

@section('content')
    <div class="page-header">
        <h1>Edit Testimoni</h1>
        <p>{{ $testimonial->name }}</p>
    </div>

    <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.testimonials._form')
    </form>
@endsection
