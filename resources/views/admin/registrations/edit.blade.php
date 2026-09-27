@extends('admin.layouts.app')

@section('title', 'Edit Pendaftar')

@section('content')
    <div class="page-header">
        <h1>Edit Pendaftar</h1>
        <p>{{ $registration->registration_number }} · {{ $registration->name }}</p>
    </div>

    <form method="POST" action="{{ route('admin.registrations.update', $registration) }}">
        @csrf
        @method('PUT')
        @include('admin.registrations._form')
    </form>
@endsection
