@extends('admin.layouts.app')

@section('title', 'Edit Berita')

@section('content')
    <div class="page-header">
        <h1>Edit Berita</h1>
        <p>{{ $post->title }}</p>
    </div>

    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.posts._form')
    </form>
@endsection
