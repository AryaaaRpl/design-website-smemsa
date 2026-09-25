@extends('layouts.app')

@section('content')
<p>Halaman peta sekolah telah digabungkan ke <a href="{{ url('/fasilitas') }}#denah">Fasilitas &amp; Denah Sekolah</a>. Mengalihkan...</p>
<script>window.location.href = "{{ url('/fasilitas') }}#denah";</script>

@endsection
