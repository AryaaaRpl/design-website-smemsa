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
    <div class="ekskul-card {{ $ekskul->card_style->cssClass() }} reveal-item" role="button" tabindex="0" onclick="openEkskulModal('{{ $ekskul->slug }}')" onkeydown="if(event.key==='Enter'||event.key===' ') { event.preventDefault(); openEkskulModal('{{ $ekskul->slug }}'); }">
      <div class="card-bg" style="background-image: url('{{ $ekskul->image_url }}');"></div>
      <div class="card-content">
        <span class="tag">{{ $ekskul->tag }}</span>
        <h2 class="card-title">{{ $ekskul->name }}</h2>
        <div class="card-desc">
          {{ $ekskul->short_description }}
        </div>
        <span class="card-action">{{ $ekskul->card_style === \App\Enums\CardStyle::Featured ? 'Lihat Detail Program' : 'Detail Program' }} &rarr;</span>
      </div>
    </div>

    @empty
    <!-- Tampilan saat belum ada ekstrakurikuler -->
    <div class="content-empty">
      <h3 class="content-empty-title">Data ekstrakurikuler belum tersedia</h3>
      <p class="content-empty-desc">Daftar kegiatan ekstrakurikuler sedang disiapkan. Silakan kembali lagi nanti.</p>
    </div>
    @endforelse
  </div>
</section>

<!-- MODAL EKSTRAKURIKULER -->
<div class="ekskul-modal-overlay" id="ekskul-modal" onclick="if(event.target===this) closeEkskulModal()">
  <div class="ekskul-modal-content" role="dialog" aria-modal="true" data-lenis-prevent>
    <button class="ekskul-modal-close" onclick="closeEkskulModal()" aria-label="Tutup modal">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
        <path d="M18 6 6 18" />
        <path d="m6 6 12 12" />
      </svg>
    </button>
    <img src="" alt="" class="ekskul-modal-hero" id="modal-hero">
    <div class="ekskul-modal-body">
      <span class="ekskul-modal-badge" id="modal-badge"></span>
      <h2 class="ekskul-modal-title" id="modal-title"></h2>
      <div class="ekskul-modal-desc" id="modal-desc"></div>

      <div class="ekskul-modal-info-grid" id="modal-info-grid">
        <!-- Diisi dinamis -->
      </div>

      <div class="ekskul-modal-achievements" id="modal-achievements" style="display:none;">
        <h4>Prestasi & Penghargaan</h4>
        <ul id="modal-achievements-list"></ul>
      </div>
    </div>
  </div>
</div>

@endsection
@push('scripts')
<script>
  // Data detail ekstrakurikuler dari database (dipakai oleh resources/js/pages/ekstrakurikuler.js)
  window.ekskulData = {{ Js::from($ekskulData) }};
</script>
@endpush
