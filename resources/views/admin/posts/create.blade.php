@extends('admin.layouts.app')

@section('title', 'Tulis Berita')

@section('content')
    <div class="page-header">
        <h1>Tulis Berita</h1>
        <p>Berita baru disimpan sebagai draf sampai statusnya diubah menjadi Terbit.</p>
    </div>

    <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.posts._form')
    </form>
@endsection
