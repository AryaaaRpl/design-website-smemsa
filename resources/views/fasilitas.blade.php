@extends('layouts.app')

@section('content')
<!-- 2. PAGE HEADER -->
<header class="page-header">
  <svg class="header-bg-pattern" viewBox="0 0 100 100">
    <rect x="20" y="20" width="60" height="60" fill="none" stroke="var(--primary)" stroke-width="2"
      transform="rotate(45 50 50)" />
    <circle cx="50" cy="50" r="15" fill="none" stroke="var(--secondary)" stroke-width="2" />
  </svg>
  <div class="container">
    <span class="badge-header">Sekolah Vokasi Terpadu</span>
    <h1 class="page-title">Infrastruktur &<br />Fasilitas Unggulan.</h1>
    <p class="page-subtitle">
      Lingkungan belajar modern yang didesain khusus untuk mendukung
      pengembangan keterampilan vokasi, kreativitas, dan inovasi peserta
      didik.
    </p>
  </div>
</header>
<!-- 2.5 DENAH & PETA SEKOLAH -->
<section class="map-section" id="denah" data-px-stage="light">
  <div class="container">
    <span class="eyebrow">Denah &amp; Unit Produksi</span>
    <h2 class="map-title">Sekolah yang <em>Bekerja Sungguhan.</em></h2>
    @php($mapTefaCount = $mapFacilities->where('is_tefa', true)->count())
    <p class="map-desc">
      {{ $mapTefaCount > 0 ? $mapTefaCount . ' unit' : 'Unit' }} Teaching Factory di sini melayani pelanggan nyata setiap
      hari — hotel, percetakan, binatu, ritel, hingga layanan keuangan. Klik
      titik pada denah untuk melihat detail tiap lokasi.
    </p>
    <div class="filter-row" role="group" aria-label="Saring jenis lokasi">
      <button class="filter-btn active" data-filter="all" aria-pressed="true">
        Semua Lokasi <span class="count">{{ $mapFacilities->count() }}</span>
      </button>
      <button class="filter-btn" data-filter="tefa" aria-pressed="false">
        Teaching Factory <span class="count">{{ $mapTefaCount }}</span>
      </button>
      <button class="filter-btn" data-filter="fasilitas" aria-pressed="false">
        Fasilitas Umum <span class="count">{{ $mapFacilities->count() - $mapTefaCount }}</span>
      </button>
    </div>
    <div class="map-layout">
      <!-- ============ PETA ============ -->
      <div class="map-stage">
        <svg class="campus-svg" viewBox="0 0 1000 800" preserveAspectRatio="xMidYMid meet" role="img"
          aria-label="Denah sekolah SMKS Muhammadiyah 1 Genteng, terdiri dari sekolah utara dan sekolah selatan yang dipisah Jalan KH Ahmad Dahlan">
          @include('partials.campus-map')
          <!-- ===== HOTSPOT ===== -->
          <g id="hotspot-layer"></g>
        </svg>
        <div class="map-legend">
          <span class="legend-item">
            <span class="legend-dot" style="background: var(--secondary)"></span>
            Teaching Factory (unit produksi)
          </span>
          <span class="legend-item">
            <span class="legend-dot" style="background: var(--primary)"></span>
            Fasilitas penunjang
          </span>
        </div>
      </div>
      <!-- ============ PANEL DETAIL ============ -->
      <!-- Latar gelap bottom sheet (HP) -->
      <div class="panel-backdrop" id="panelBackdrop" hidden></div>
      <div class="detail-panel" id="panel" aria-live="polite" data-lenis-prevent>
        <!-- Pegangan & tombol tutup: hanya tampil saat panel menjadi bottom sheet di HP -->
        <div class="panel-sheet-bar">
          <span class="panel-sheet-handle" aria-hidden="true"></span>
          <button type="button" class="panel-sheet-close" id="panelClose" aria-label="Tutup detail lokasi">&times;</button>
        </div>
        <div class="panel-empty" id="panelEmpty">
          <div>
            <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
              stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M9 20l-5.5 2.5V6L9 3.5m0 16.5l6-2.5M9 20V3.5m6 14l5.5 2.5V4L15 6.5m0 11V6.5m0 0L9 3.5" />
              <circle cx="12" cy="10" r="1.6" />
            </svg>
            <p>
              @if ($mapFacilities->isEmpty())
              Data lokasi fasilitas belum tersedia.
              @else
              Pilih salah satu titik pada denah untuk melihat detail
              lokasinya.
              @endif
            </p>
          </div>
        </div>
        <div id="panelContent" hidden></div>
      </div>
    </div>
    <!-- Daftar Lengkap: tampil di HP/tablet sebagai cara utama memilih lokasi (titik denah terlalu kecil) -->
    @if ($mapFacilities->isNotEmpty())
    <div class="index-list">
      <span class="eyebrow" style="margin-bottom: 0">Daftar Lengkap</span>
      <div class="index-grid" id="indexGrid"></div>
    </div>
    @endif
  </div>
</section>
<!-- 3. TEFA SECTION (Featured) - disembunyikan jika belum ada TEFA di daftar -->
@if ($tefaList->isNotEmpty())
<section class="tefa-section">
  <div class="watermark">TEFA</div>
  <div class="container tefa-grid">
    <div class="">
      <div class="visi-label" style="
              background: rgba(234, 179, 8, 0.2);
              color: var(--secondary-light);
            ">
        Standar Industri
      </div>
      <h2 class="tefa-title font-head">
        Teaching Factory (TEFA)<br />Terlengkap.
      </h2>
      <p class="tefa-desc">
        SMKS Muhammadiyah 1 Genteng merupakan sekolah dengan Tefa
        terlengkap. Setiap kompetensi keahlian dilengkapi ruang produksi
        mandiri yang beroperasi mematuhi standar industri sesungguhnya.
        Memberikan siswa pengalaman praktik langsung di bawah bimbingan
        Dudika (Dunia Usaha Dunia Industri) terkait.
      </p>
    </div>
    <div class="tefa-list">
      @foreach ($tefaList as $facility)
      <div class="tefa-item" data-facility="{{ $facility->slug }}" onclick="openItemModal('{{ $facility->slug }}')">
        <span class="tefa-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
        <div>
          <strong style="font-family: var(--font-head); font-size: 1.1rem">{{ $facility->list_name }}</strong><br />
          @if ($facility->major)
          <span style="font-size: 0.9rem; opacity: 0.85">{{ $facility->major->name }} ({{ $facility->major->code }})</span>
          @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif
<!-- 4. FASILITAS GRID -->
<section class="section-padding container" data-px-stage="subtle">
  <div class="text-center">
    <span class="badge-header">Sarana Penunjang</span>
    <h2 class="font-display" style="
            font-size: 2.5rem;
            color: var(--primary-dark);
            margin-top: 0.5rem;
          ">
      Fasilitas Sekolah Unggulan
    </h2>
  </div>
  <div class="fasilitas-grid">
    @forelse ($featuredFacilities as $facility)
    <!-- {{ $facility->name }} -->
    <div class="fac-card {{ $facility->is_wide ? 'wide' : '' }}" data-facility="{{ $facility->slug }}" onclick="openItemModal('{{ $facility->slug }}')">
      <div class="fac-icon-wrapper" @if ($facility->is_wide) style="margin-bottom: 0" @endif>
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          {!! $facility->icon->svg() !!}
        </svg>
      </div>
      @if ($facility->is_wide)
      <div>
        <h3>{{ $facility->list_name }}</h3>
        <p>{{ $facility->short_description }}</p>
      </div>
      @else
      <h3>{{ $facility->list_name }}</h3>
      <p>{{ $facility->short_description }}</p>
      @endif
    </div>
    @empty
    <!-- Tampilan saat belum ada fasilitas unggulan -->
    <div class="content-empty">
      <h3 class="content-empty-title">Data fasilitas belum tersedia</h3>
      <p class="content-empty-desc">Informasi fasilitas sekolah sedang disiapkan. Silakan kembali lagi nanti.</p>
    </div>
    @endforelse
  </div>
</section>

<!-- 6. INTERACTIVE DETAIL MODAL -->
<div class="modal-overlay" id="facility-modal-overlay" onclick="closeItemModalOnOverlay(event)">
  <div class="facility-modal-card" id="facility-modal-card">
    <!-- Modal Header Banner -->
    <div class="modal-banner" id="modal-banner">
      <div class="modal-banner-icon" id="modal-icon">🏢</div>
      <button class="modal-close-btn" onclick="closeItemModal()" aria-label="Tutup Detail">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
          <path d="M18 6 6 18" />
          <path d="m6 6 12 12" />
        </svg>
      </button>
    </div>
    <!-- Modal Content Body -->
    <div class="modal-body">
      <span class="modal-tag" id="modal-tag">FASILITAS UNGGULAN</span>
      <h3 class="modal-title" id="modal-title">Nama Fasilitas</h3>
      <p class="modal-desc" id="modal-desc">
        Deskripsi detail fasilitas sekolah.
      </p>
      <div class="modal-features-box">
        <div class="modal-section-title">
          Spesifikasi & Keunggulan Fasilitas:
        </div>
        <div class="modal-chips-row" id="modal-features">
          <!-- Chips dynamically rendered -->
        </div>
      </div>
      <div class="modal-highlight-box">
        <div class="modal-section-title" style="color: var(--primary); margin-bottom: 0.4rem">
          Nilai Tambah Pembelajaran:
        </div>
        <div class="modal-highlight-text" id="modal-highlight">
          Informasi nilai tambah.
        </div>
      </div>
      <div class="modal-footer-cta">
        <span style="font-size: 0.85rem; color: var(--text-muted)">Sekolah Berstandar Industri &bull;
          <strong>SMEMSA Genteng</strong></span>
        <a href="/spmb" class="btn-primary" style="text-decoration: none">
          Daftar & Rasakan Fasilitasnya &rarr;
        </a>
      </div>
    </div>
  </div>
</div>
<!-- 13. FOOTER -->

@endsection
@push('scripts')
<script>
  // Data fasilitas dari database (dipakai oleh resources/js/pages/fasilitas.js)
  window.facilityData = {{ Js::from($facilityData) }};
  // Urutan titik denah & Daftar Lengkap (slug), sesuai nomor titik.
  window.facilityMapOrder = {{ Js::from($mapFacilities->pluck('slug')) }};
</script>
@endpush
