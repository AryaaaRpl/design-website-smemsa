@extends('layouts.app')

@section('content')

@php
  // Info latihan: hanya yang diisi admin yang ditampilkan.
  $infos = array_filter([
    'Jadwal Latihan' => $ekskul->schedule,
    'Pembina' => $ekskul->coach_name,
    'Tempat Latihan' => $ekskul->location,
    'Terbuka Untuk' => $ekskul->audience,
  ]);
@endphp

<!-- 2. HEADER DETAIL -->
<header class="page-header ek-detail-header">
  <div class="container ek-narrow">
    <nav class="ek-breadcrumb" aria-label="Breadcrumb">
      <a href="{{ url('/') }}">Beranda</a>
      <span aria-hidden="true">/</span>
      <a href="{{ route('ekstrakurikuler') }}">Ekstrakurikuler</a>
      <span aria-hidden="true">/</span>
      <span aria-current="page">{{ $ekskul->name }}</span>
    </nav>

    @if ($ekskul->tag)
      <span class="badge">{{ $ekskul->tag }}</span>
    @endif
    <h1 class="page-title ek-detail-title">{{ $ekskul->name }}</h1>
    @if ($ekskul->short_description)
      <p class="page-subtitle">{{ $ekskul->short_description }}</p>
    @endif
  </div>
</header>

<!-- 3. ISI DETAIL -->
<section class="container ek-narrow ek-detail">
  <figure class="ek-detail-cover">
    @if ($ekskul->modal_image_url)
      <img src="{{ $ekskul->modal_image_url }}" alt="Kegiatan {{ $ekskul->name }}">
    @else
      <span class="ek-noimg">Belum ada gambar</span>
    @endif
  </figure>

  <div class="ek-detail-grid">
    <div>
      @if ($ekskul->description)
        <h2 class="ek-subtitle">Tentang Program</h2>
        <div class="ek-prose">{!! $ekskul->description_html !!}</div>
      @endif

      @if (! empty($ekskul->achievements))
        <div class="ek-achievements">
          <h2 class="ek-subtitle">Prestasi &amp; Penghargaan</h2>
          <ul>
            @foreach ($ekskul->achievements as $achievement)
              <li>{{ $achievement }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    </div>

    <aside class="ek-info-card">
      @if ($infos)
        <dl>
          @foreach ($infos as $label => $value)
            <div>
              <dt>{{ $label }}</dt>
              <dd>{{ $value }}</dd>
            </div>
          @endforeach
        </dl>
      @endif
      <a href="{{ route('ekstrakurikuler') }}" class="ek-back-link">&larr; Semua Ekstrakurikuler</a>
    </aside>
  </div>
</section>

<!-- 4. EKSTRAKURIKULER LAINNYA -->
@if ($others->isNotEmpty())
<section class="ek-others">
  <div class="container ek-narrow">
    <h2 class="ek-subtitle">Ekstrakurikuler Lainnya</h2>
    <div class="ek-others-grid">
      @foreach ($others as $other)
        <a href="{{ route('ekstrakurikuler.show', $other) }}" class="ek-other">
          <span class="ek-other-photo">
            @if ($other->image_url)
              <img src="{{ $other->image_url }}" alt="{{ $other->name }}" loading="lazy">
            @endif
          </span>
          <span class="ek-other-body">
            @if ($other->tag)
              <small>{{ $other->tag }}</small>
            @endif
            <strong>{{ $other->name }}</strong>
          </span>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif

@endsection
