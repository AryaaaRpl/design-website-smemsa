@extends('layouts.app')

@section('content')

@php
  $isTopLevel = in_array($achievement->level?->value, ['nasional', 'internasional'], true);
  // Info capaian: hanya yang diisi admin yang ditampilkan.
  $infos = array_filter([
    'Peringkat' => $achievement->rank,
    'Tingkat' => $achievement->level?->label(),
    'Tanggal' => $achievement->achieved_label,
    'Lokasi' => $achievement->location,
    'Penyelenggara' => $achievement->organizer,
    'Ajang' => $achievement->event_name,
    'Bidang' => $achievement->field_name,
    'Konsentrasi Keahlian' => $achievement->major ? $achievement->major->name.' ('.$achievement->major->code.')' : null,
    'Peserta' => $achievement->participants,
  ]);
@endphp

<!-- 2. HEADER DETAIL -->
<header class="page-header pd-header">
  <div class="container pd-narrow">
    <nav class="pd-breadcrumb" aria-label="Breadcrumb">
      <a href="{{ url('/') }}">Beranda</a>
      <span aria-hidden="true">/</span>
      <a href="{{ route('prestasi') }}">Prestasi</a>
      <span aria-hidden="true">/</span>
      <span aria-current="page">{{ $achievement->title }}</span>
    </nav>

    <span class="pd-rank {{ $isTopLevel ? 'is-top' : '' }}">
      {{ mb_strtoupper($achievement->rank ?: ($achievement->level?->label() ?? 'Prestasi')) }}
    </span>
    <h1 class="page-title pd-title" data-reveal>{{ $achievement->title }}</h1>
    <p class="pd-meta">
      @if ($achievement->achieved_label)<span>{{ $achievement->achieved_label }}</span>@endif
      @if ($achievement->location)<span>{{ $achievement->location }}</span>@endif
      @if ($achievement->level)<span>Tingkat {{ $achievement->level->label() }}</span>@endif
    </p>
  </div>
</header>

<!-- 3. ISI DETAIL -->
<section class="container pd-narrow pd-detail">
  @if ($achievement->image_url)
    <figure class="pd-cover">
      <img src="{{ $achievement->image_url }}" alt="Dokumentasi {{ $achievement->title }}" width="1200" height="675">
    </figure>
  @endif

  <div class="pd-grid">
    <div>
      @if ($achievement->excerpt)
        <p class="pd-lead">{{ $achievement->excerpt }}</p>
      @endif

      @if ($achievement->description)
        <h2 class="pd-subtitle">Liputan Lengkap</h2>
        <div class="pd-prose" data-reveal>{!! $achievement->description_html !!}</div>
      @endif
    </div>

    <aside class="pd-info-card" data-reveal>
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

      <div class="pd-actions">
        <p class="pd-actions-note">Ingin berprestasi seperti ini?</p>
        <a href="{{ url('/spmb') }}" class="pd-cta">
          <span>Daftar SPMB Sekarang</span>
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.4"
            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14" /><path d="m13 6 6 6-6 6" /></svg>
        </a>
        <a href="{{ route('prestasi') }}#katalog-prestasi" class="pd-link">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4"
            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5" /><path d="m11 18-6-6 6-6" /></svg>
          <span>Semua Prestasi</span>
        </a>
      </div>
    </aside>
  </div>
</section>

<!-- 4. PRESTASI LAINNYA -->
@if ($others->isNotEmpty())
<section class="pd-others">
  <div class="container pd-narrow">
    <h2 class="pd-subtitle">Prestasi Lainnya</h2>
    <div class="pd-others-grid">
      @foreach ($others as $other)
        <a href="{{ route('prestasi.show', $other) }}" class="pd-other">
          <span class="pd-other-photo">
            @if ($other->image_url)
              <img src="{{ $other->image_url }}" alt="{{ $other->title }}" loading="lazy">
            @else
              <span aria-hidden="true">🏆</span>
            @endif
          </span>
          <span class="pd-other-body">
            <small>{{ $other->field_name }}{{ $other->achieved_at ? ' · '.$other->achieved_at->year : '' }}</small>
            <strong>{{ $other->title }}</strong>
          </span>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif

@endsection
