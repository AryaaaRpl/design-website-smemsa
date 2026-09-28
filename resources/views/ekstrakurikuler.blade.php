@extends('layouts.app')

@section('content')

<!-- 2. PAGE HEADER -->
<header class="page-header">
  <div class="container reveal-item">
    <span class="badge">Pengembangan Karakter & Minat</span>
    <h1 class="page-title">
      Membentuk Karakter,<br />Mengasah Talenta Juara.
    </h1>
    <p class="page-subtitle">
      Beragam pilihan kegiatan ekstrakurikuler di SMKS Muhammadiyah 1
      Genteng untuk menyalurkan potensi, minat, dan melatih jiwa
      kepemimpinan peserta didik.
    </p>
  </div>
</header>

<!-- 3. EKSTRAKURIKULER GRID -->
<section class="ekskul-section container" data-px-stage="light">
  <div class="ekskul-grid">
    @forelse ($extracurriculars as $ekskul)
    <!-- {{ $loop->iteration }}. {{ $ekskul->name }} -->
    <a href="{{ route('ekstrakurikuler.show', $ekskul) }}" class="ekskul-card {{ $ekskul->card_style->cssClass() }} reveal-item">
      <div class="card-bg" style="background-image: url('{{ $ekskul->image_url }}');"></div>
      <div class="card-content">
        <span class="tag">{{ $ekskul->tag }}</span>
        <h2 class="card-title">{{ $ekskul->name }}</h2>
        <div class="card-desc">
          {{ $ekskul->short_description }}
        </div>
        <span class="card-action">{{ $ekskul->card_style === \App\Enums\CardStyle::Featured ? 'Lihat Detail Program' : 'Detail Program' }} &rarr;</span>
      </div>
    </a>

    @empty
    <!-- Tampilan saat belum ada ekstrakurikuler -->
    <div class="content-empty">
      <h3 class="content-empty-title">Data ekstrakurikuler belum tersedia</h3>
      <p class="content-empty-desc">Daftar kegiatan ekstrakurikuler sedang disiapkan. Silakan kembali lagi nanti.</p>
    </div>
    @endforelse
  </div>
</section>

@endsection
