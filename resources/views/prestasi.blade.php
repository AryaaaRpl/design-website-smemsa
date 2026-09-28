@extends('layouts.app')

@section('content')
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
                    <div class="stat-number">{{ $site->get('trophy_count') }}+</div>
                    <div class="stat-title">Piala Kejuaraan Tingkat Daerah & Jatim</div>
                </div>
                <div class="award-stat-card">
                    <div class="stat-number">{{ $site->percent('bnsp_rate') }}%</div>
                    <div class="stat-title">Kelulusan Bersertifikasi BNSP</div>
                </div>
                <div class="award-stat-card">
                    <div class="stat-number">{{ $site->yearsServing() }} Th</div>
                    <div class="stat-title">Pengabdian Vokasi Sejak {{ $site->get('founded_year') }}</div>
                </div>
            </div>
        </div>
    </header>

    <!-- 3. PINNACLE AWARD: PRESTASI UNGGULAN (dari database) -->
    @if ($featured)
        <section class="pinnacle-section container" data-px-stage="gold">
            <div class="pinnacle-card" onclick="openAwardModal('{{ $featured->slug }}')" role="button" tabindex="0"
                aria-label="Buka rincian {{ $featured->title }}">
                <div>
                    <div class="pinnacle-badge">Mahkota Prestasi {{ $featured->level?->label() }}
                        {{ $featured->achieved_at?->year }}</div>
                    <h2 class="pinnacle-title">
                        {{ $featured->title }}
                    </h2>
                    <p class="pinnacle-desc" id="pinnacle-text-reveal">
                        {{ $featured->excerpt }}
                    </p>

                    <div class="pinnacle-meta-grid">
                        <div class="pinnacle-meta-item">
                            <strong>Tingkat {{ $featured->level?->label() }}</strong>
                            <span>Skala Kompetisi</span>
                        </div>
                        <div class="pinnacle-meta-item">
                            <strong>{{ $featured->location }}</strong>
                            <span>Lokasi Penyelenggaraan</span>
                        </div>
                        <div class="pinnacle-meta-item">
                            <strong>Tahun {{ $featured->achieved_at?->year }}</strong>
                            <span>Periode Capaian</span>
                        </div>
                    </div>
                </div>

                <div class="pinnacle-trophy-box">
                    <div class="pinnacle-img-frame">
                        <img src="{{ $featured->image_url }}" alt="{{ $featured->title }}" loading="lazy"
                            onerror="
                this.closest('.card')
                  ? this.closest('.card').classList.add('no-image')
                  : null;
                this.remove();
              " />
                    </div>
                    <span class="badge-gold"
                        style="font-size: 0.78rem">{{ mb_strtoupper($featured->rank ?: $featured->level?->label()) }}</span>
                    <p style="font-size: 0.85rem; margin-top: 0.6rem; opacity: 0.85">
                        Klik untuk membaca liputan lengkap &rarr;
                    </p>
                </div>
            </div>
        </section>
    @endif

    <!-- 4. KATALOG PRESTASI (paginasi server, 18 per halaman) -->
    <section class="container" id="katalog-prestasi" style="padding-bottom: 5rem">
        <!-- Kontrol: pencarian, kategori, tahun, tampilan. Form GET agar tetap berfungsi tanpa JavaScript. -->
        <form class="catalog-control-panel" id="award-filter-form" method="GET" action="{{ route('prestasi') }}#katalog-prestasi" role="search">
            <div class="catalog-top-bar">
                <!-- Search input -->
                <div class="award-search-box">
                    <svg class="search-icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="search" name="cari" id="award-search-input" value="{{ $search }}"
                        placeholder="Cari nama kejuaraan, penyelenggara, atau kata kunci..."
                        aria-label="Cari prestasi kejuaraan" autocomplete="off" />
                </div>

                <!-- View Switcher -->
                <div class="view-switcher-group" role="group" aria-label="Pilihan tampilan katalog">
                    <button type="button" class="view-toggle-btn active" id="view-grid-btn" aria-pressed="true"
                        onclick="switchCatalogView('grid')">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        Grid
                    </button>
                    <button type="button" class="view-toggle-btn" id="view-timeline-btn" aria-pressed="false"
                        onclick="switchCatalogView('timeline')">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        Linimasa
                    </button>
                </div>
            </div>

            <!-- Category & Year Filter Row -->
            <div class="catalog-filters-row">
                {{-- Kategori aktif ikut terkirim saat mencari / mengganti tahun. Diletakkan SEBELUM tombol
                     kategori: jika tombol diklik, nilainya terkirim sesudahnya dan yang dipakai server. --}}
                <input type="hidden" name="kategori" id="award-category-input" value="{{ $activeCategory?->slug }}">

                <div class="category-chip-list" role="toolbar" aria-label="Filter kategori prestasi">
                    <button type="submit" name="kategori" value="" class="category-chip {{ $activeCategory ? '' : 'active' }}"
                        aria-pressed="{{ $activeCategory ? 'false' : 'true' }}">
                        Semua
                    </button>
                    @foreach ($categories as $category)
                        <button type="submit" name="kategori" value="{{ $category->slug }}"
                            class="category-chip {{ $activeCategory?->is($category) ? 'active' : '' }}"
                            aria-pressed="{{ $activeCategory?->is($category) ? 'true' : 'false' }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>

                <div class="year-select-wrap">
                    <label for="award-year-filter">Tahun:</label>
                    <select name="tahun" id="award-year-filter" class="year-select-dropdown"
                        aria-label="Filter tahun kejuaraan" onchange="this.form.requestSubmit ? this.form.requestSubmit() : this.form.submit()">
                        <option value="">Semua Tahun</option>
                        @foreach ($years as $optionYear)
                            <option value="{{ $optionYear }}" @selected($year === $optionYear)>{{ $optionYear }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <!-- Isi katalog (dimuat ulang tanpa refresh halaman oleh resources/js/pages/prestasi.js) -->
        <div id="award-catalog-results" aria-live="polite">
            @include('prestasi._catalog')
        </div>
    </section>

    <!-- 5. INTERACTIVE AWARD DETAIL MODAL -->
    <div class="modal-overlay" id="award-modal-overlay" onclick="closeAwardModalOnOverlay(event)" role="dialog"
        aria-modal="true" aria-labelledby="modal-award-title">
        <div class="award-modal-card" id="award-modal-card" data-lenis-prevent>
            <!-- Modal Header Typographic Banner -->
            <button class="modal-close-btn" onclick="closeAwardModal()" aria-label="Tutup Detail Prestasi">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-x">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
            </button>

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

