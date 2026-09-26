@extends('admin.layouts.app')

@section('title', 'Tambah Unit Usaha')

@section('content')
    <div class="page-header">
        <h1>Tambah Unit Usaha</h1>
        <p>Tambahkan unit usaha BLUD baru.</p>
    </div>

    <form method="POST" action="{{ route('admin.business-units.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.business-units._form')
    </form>
@endsection
