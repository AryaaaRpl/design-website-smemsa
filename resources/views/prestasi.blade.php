@extends('layouts.app')

@section('content')

  <!-- Mobile Drawer -->
  <div class="mobile-overlay" id="mobile-overlay"></div>
  <div class="mobile-drawer" id="mobile-drawer">
    <button class="drawer-close" id="drawer-close-btn">&times;</button>
    <div class="brand-box" style="margin-bottom: 2rem">
      <img src="{{ asset('assets/logo.webp') }}" alt="Logo SMEMSA" class="brand-logo" onerror="
            this.closest('.card')
              ? this.closest('.card').classList.add('no-image')
              : null;
            this.remove();
          " />
      <div>
        <strong style="color: var(--primary); font-size: 1.1rem; display: block">SMEMSA GENTENG</strong>
        <small style="color: var(--text-muted); font-size: 0.75rem">NPSN 20525597 &bull; Akreditasi A</small>
      </div>
    </div>

    <div class="drawer-links">
      <a href="index.html#hero" class="">🏠 Beranda</a>

      <div class="drawer-section-title">Halaman Informasi</div>
      <a href="/bkk" class="">💼 Bursa Kerja Khusus (BKK)</a>
      <a href="/visi-misi">🎯 Visi & Misi Sekolah</a>
      <a href="/guru">👥 Guru & Tenaga Kependidikan</a>
      <a href="/fasilitas">🏢 Fasilitas Unggulan</a>
      <a href="/ekstrakurikuler">⚽ Ekstrakurikuler & IPM</a>
      <a href="/prestasi">🏆 Prestasi & Penghargaan</a>
      <a href="/berita" class="">📰 Jurnal & Kabar Sekolah</a>

      <div class="drawer-section-title">Navigasi Halaman Utama</div>
      <a href="index.html#sambutan">👤 Sambutan Kepala Sekolah</a>
      <a href="index.html#jurusan">💻 7 Program Keahlian</a>

      <a href="/lsp" class="">📜 LSP-P1</a>
      <a href="index.html#blud">🏬 Unit Produksi BLUD</a>

      <div style="margin-top: 1.5rem">
        <a href="/spmb" class="btn btn-primary"
          style="width: 100%; text-align: center; justify-content: center">Daftar SPMB 2026</a>
      </div>
    </div>
  </div>

  <!-- 2. PAGE HEADER -->
  <header class="page-header">
    <div class="container">
      <span class="badge-gold">Rekam Jejak Prestasi & Kejuaraan</span>
      <h1 class="page-title">Tradisi Juara &<br />Hall of Fame Prestasi.</h1>
      <p class="page-subtitle">
        Dedikasi, inovasi rekayasa, dan kerja keras peserta didik SMKS
        Muhammadiyah 1 Genteng yang telah diakui hingga podium tertinggi
        kejuaraan tingkat regional, provinsi, dan nasional.
      </p>

      <!-- Stats Bar: Homogenized Number + Label -->
      <div class="awards-stats-grid">
        <div class="award-stat-card">
          <div class="stat-number">48+</div>
          <div class="stat-title">Piala Kejuaraan Tingkat Daerah & Jatim</div>
        </div>
        <div class="award-stat-card">
          <div class="stat-number">100%</div>
          <div class="stat-title">Kelulusan Bersertifikasi BNSP</div>
        </div>
        <div class="award-stat-card">
          <div class="stat-number">58 Th</div>
          <div class="stat-title">Pengabdian Vokasi Sejak 1968</div>
        </div>
      </div>
    </div>
  </header>

  <!-- 3. PINNACLE AWARD: ME AWARDS JUARA UMUM NASIONAL -->
  <section class="pinnacle-section container" data-px-stage="gold">
    <div class="pinnacle-card" onclick="openAwardModal('me-awards')" role="button" tabindex="0"
      aria-label="Buka rincian Juara Umum ME Awards Nasional">
      <div>
        <div class="pinnacle-badge">Mahkota Prestasi Nasional 2026</div>
        <h2 class="pinnacle-title">
          Juara Umum Muhammadiyah Education Awards (ME Awards) Nasional
        </h2>
        <p class="pinnacle-desc" id="pinnacle-text-reveal">
          Pencapaian puncak prestisius yang membuktikan keunggulan
          komprehensif SMKS Muhammadiyah 1 Genteng. Mengungguli ratusan
          sekolah kejuruan se-Indonesia dalam bidang riset inovasi digital,
          robotika, seni budaya, dan kepemimpinan Islami.
        </p>

        <div class="pinnacle-meta-grid">
          <div class="pinnacle-meta-item">
            <strong>Tingkat Nasional</strong>
            <span>Skala Kompetisi</span>
          </div>
          <div class="pinnacle-meta-item">
            <strong>Universitas Muhammadiyah Malang / Nasional</strong>
            <span>Lokasi Penyelenggaraan</span>
          </div>
          <div class="pinnacle-meta-item">
            <strong>Tahun 2026</strong>
            <span>Periode Capaian</span>
          </div>
        </div>
      </div>

      <div class="pinnacle-trophy-box">
        <div class="pinnacle-img-frame">
          <img src="{{ asset('assets/juara-me-awards.jpg') }}" alt="Dokumentasi Penyerahan Piala Juara Umum ME Awards SMEMSA"
            loading="lazy" onerror="
                this.closest('.card')
                  ? this.closest('.card').classList.add('no-image')
                  : null;
                this.remove();
              " />
        </div>
        <span class="badge-gold" style="font-size: 0.78rem">JUARA UMUM NASIONAL</span>
        <p style="font-size: 0.85rem; margin-top: 0.6rem; opacity: 0.85">
          Klik untuk membaca liputan lengkap &rarr;
        </p>
      </div>
    </div>
  </section>

  <!-- 4. REAL INTERACTIVE CATALOG SECTION -->
  <section class="container" id="katalog-prestasi" style="padding-bottom: 5rem">
    <!-- Control Panel: Search, Category Filters, Year Select, View Switcher -->
    <div class="catalog-control-panel">
      <div class="catalog-top-bar">
        <!-- Search input -->
        <div class="award-search-box">
          <svg class="search-icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
          <input type="text" id="award-search-input"
            placeholder="Cari nama kejuaraan, penyelenggara, atau kata kunci..." aria-label="Cari prestasi kejuaraan" />
        </div>

        <!-- View Switcher -->
        <div class="view-switcher-group" role="group" aria-label="Pilihan tampilan katalog">
          <button class="view-toggle-btn active" id="view-grid-btn" aria-pressed="true"
            onclick="switchCatalogView('grid')">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <rect x="3" y="3" width="7" height="7"></rect>
              <rect x="14" y="3" width="7" height="7"></rect>
              <rect x="14" y="14" width="7" height="7"></rect>
              <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
            Grid
          </button>
          <button class="view-toggle-btn" id="view-timeline-btn" aria-pressed="false"
            onclick="switchCatalogView('timeline')">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <circle cx="12" cy="12" r="10"></circle>
              <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            Linimasa
          </button>
        </div>
      </div>

      <!-- Category & Year Filter Row -->
      <div class="catalog-filters-row">
        <div class="category-chip-list" role="toolbar" aria-label="Filter kategori prestasi">
          <button class="category-chip active" aria-pressed="true" data-category="all"
            onclick="filterByCategory('all', this)">
            Semua
          </button>
          <button class="category-chip" aria-pressed="false" data-category="teknologi"
            onclick="filterByCategory('teknologi', this)">
            Teknologi
          </button>
          <button class="category-chip" aria-pressed="false" data-category="bela-diri"
            onclick="filterByCategory('bela-diri', this)">
            Bela Diri
          </button>
          <button class="category-chip" aria-pressed="false" data-category="seni"
            onclick="filterByCategory('seni', this)">
            Seni
          </button>
          <button class="category-chip" aria-pressed="false" data-category="akademik"
            onclick="filterByCategory('akademik', this)">
            Akademik
          </button>
          <button class="category-chip" aria-pressed="false" data-category="esports"
            onclick="filterByCategory('esports', this)">
            E-Sports
          </button>
        </div>

        <div class="year-select-wrap">
          <label for="award-year-filter">Tahun:</label>
          <select id="award-year-filter" class="year-select-dropdown" onchange="filterByYear(this.value)"
            aria-label="Filter tahun kejuaraan">
            <option value="all">Semua Tahun</option>
            <option value="2026">2026</option>
            <option value="2025">2025</option>
            <option value="2024">2024</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Accessible Status Live Region -->
    <div class="catalog-status-bar" id="catalog-status-bar" aria-live="polite">
      <span id="catalog-count-text">Menampilkan 6 dari 48 prestasi</span>
      <span id="active-filter-indicator" style="font-size: 0.85rem; color: var(--primary); font-weight: 700"></span>
    </div>

    <!-- VIEW 1: Modern Typographic Grid -->
    <div class="awards-catalog-grid" id="awards-grid-container">
      <!-- Rendered by JavaScript -->
    </div>

    <!-- VIEW 2: Chronological Timeline -->
    <div class="awards-timeline-wrap" id="awards-timeline-container">
      <!-- Rendered by JavaScript -->
    </div>

    <!-- Empty State -->
    <div class="catalog-empty-state" id="catalog-empty-state">
      <h3 style="
            color: var(--primary-dark);
            font-size: 1.4rem;
            margin-bottom: 0.6rem;
          ">
        Tidak ada prestasi yang cocok
      </h3>
      <p style="
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
          ">
        Coba gunakan kata kunci pencarian lain atau atur ulang filter kategori
        dan tahun.
      </p>
      <button class="btn btn-outline" onclick="resetAllFilters()">
        Atur Ulang Filter
      </button>
    </div>

    <!-- Load More Section -->
    <div class="load-more-section" id="load-more-container">
      <button class="btn btn-outline" id="load-more-btn" onclick="loadMoreAwards()" style="min-width: 220px">
        Muat Lebih Banyak (+6)
      </button>
    </div>
  </section>

  <!-- 5. INTERACTIVE AWARD DETAIL MODAL -->
  <div class="modal-overlay" id="award-modal-overlay" onclick="closeAwardModalOnOverlay(event)" role="dialog"
    aria-modal="true" aria-labelledby="modal-award-title">
    <div class="award-modal-card" id="award-modal-card" data-lenis-prevent>
      <!-- Modal Header Typographic Banner -->
      <div class="modal-banner" id="modal-award-banner" style="
            background: linear-gradient(
              135deg,
              var(--primary-dark) 0%,
              var(--primary) 100%
            );
          ">
        <div style="text-align: center; color: #ffffff; padding: 1.5rem">
          <span class="badge-gold" id="modal-award-badge" style="font-size: 0.78rem">TINGKAT NASIONAL</span>
          <div id="modal-banner-sub" style="
                font-family: var(--font-mono);
                font-size: 0.85rem;
                margin-top: 0.6rem;
                opacity: 0.9;
              ">
            Kategori Kejuaraan Vokasi
          </div>
        </div>
        <button class="modal-close-btn" onclick="closeAwardModal()" aria-label="Tutup Detail Prestasi">
          &times;
        </button>
      </div>

      <!-- Modal Content Body -->
      <div class="modal-body">
        <div class="modal-meta-row">
          <span class="badge-primary" id="modal-award-cat" style="font-size: 0.75rem">TEKNOLOGI</span>
          <span id="modal-award-location">Universitas Muhammadiyah Malang &bull; 2026</span>
        </div>

        <h2 class="modal-headline" id="modal-award-title">
          Juara Umum Muhammadiyah Education Awards (ME Awards) 2026
        </h2>

        <div class="modal-achievement-box">
          <strong>Penyelenggara & Kategori:</strong>
          <span id="modal-award-org">Majelis Dikdasmen PWM Jawa Timur &bull; Seluruh Jenjang SMK
            se-Indonesia</span>
        </div>

        <div class="modal-full-text" id="modal-award-desc">
          <!-- Dynamic Full Text -->
        </div>

        <div class="modal-footer-share">
          <span style="font-size: 0.88rem; color: var(--text-muted)">Pusat Keunggulan Vokasi &bull;
            <strong>SMEMSA Genteng</strong></span>
          <a href="/spmb" class="btn btn-primary" style="padding: 0.5rem 1.4rem; font-size: 0.88rem">
            Daftar & Berprestasi Bersama SMEMSA &rarr;
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- 6. FOOTER -->
  <!-- FOOTER -->

@endsection
