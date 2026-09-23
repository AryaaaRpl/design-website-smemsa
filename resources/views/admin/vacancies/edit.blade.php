@extends('admin.layouts.app')

@section('title', 'Edit Lowongan')

@section('content')
    <div class="page-header">
        <h1>Edit Lowongan</h1>
        <p>{{ $vacancy->position }} &middot; {{ $vacancy->partner?->name }} &middot; {{ $vacancy->display_status }}</p>
    </div>

    <form method="POST" action="{{ route('admin.vacancies.update', $vacancy) }}">
        @csrf
        @method('PUT')
        @include('admin.vacancies._form')
    </form>
@endsection
