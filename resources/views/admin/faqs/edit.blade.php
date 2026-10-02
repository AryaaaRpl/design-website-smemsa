@extends('admin.layouts.app')

@section('title', 'Edit FAQ')

@section('content')
    <div class="page-header">
        <h1>Edit FAQ</h1>
        <p>{{ $faq->question }}</p>
    </div>

    <form method="POST" novalidate action="{{ route('admin.faqs.update', $faq) }}">
        @csrf
        @method('PUT')
        @include('admin.faqs._form')
    </form>
@endsection
