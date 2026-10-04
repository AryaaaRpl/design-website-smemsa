@extends('layouts.app')

@section('content')
    <!-- 2. PAGE HEADER -->
    <header class="page-header">
        <div class="container">
            <span class="badge-gold">Rekam Jejak Prestasi & Kejuaraan</span>
            <h1 class="page-title" data-reveal>Tradisi Juara &<br />Hall of Fame Prestasi.</h1>
            <p class="page-subtitle" data-reveal>
                Dedikasi, inovasi rekayasa, dan kerja keras peserta didik SMKS
                Muhammadiyah 1 Genteng yang telah diakui hingga podium tertinggi
                kejuaraan tingkat regional, provinsi, dan nasional.
            </p>
        </div>
    </header>

    <div class="page-header">
        <div container>
            <!-- Stats Bar: Homogenized Number + Label -->
            <div class="awards-stats-grid">
                <div class="award-stat-card" data-reveal>
                    <div class="stat-number">{{ $site->get('trophy_count') }}+</div>
                    <div class="stat-title">Piala Kejuaraan Tingkat Daerah & Jatim</div>
                </div>
                <div class="award-stat-card" data-reveal>
                    <div class="stat-number">{{ $site->percent('bnsp_rate') }}%</div>
                    <div class="stat-title">Kelulusan Bersertifikasi BNSP</div>
                </div>
                <div class="award-stat-card" data-reveal>
                    <div class="stat-number">{{ $site->yearsServing() }} Th</div>
                    <div class="stat-title">Pengabdian Vokasi Sejak {{ $site->get('founded_year') }}</div>
                </div>
            </div>
        </div>

    </div>

    <!-- 4. KATALOG PRESTASI (paginasi server, 18 per halaman) -->
    <section class="container" id="katalog-prestasi" style="padding-bottom: 5rem">
        <!-- Kontrol: pencarian, kategori, tahun. Form GET agar tetap berfungsi tanpa JavaScript. -->
        <form class="catalog-control-panel" id="award-filter-form" method="GET"
            action="{{ route('prestasi') }}#katalog-prestasi" role="search">
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
            </div>

            <!-- Category & Year Filter Row -->
            <div class="catalog-filters-row">
                {{-- Kategori aktif ikut terkirim saat mencari / mengganti tahun. Diletakkan SEBELUM tombol
                     kategori: jika tombol diklik, nilainya terkirim sesudahnya dan yang dipakai server. --}}
                <input type="hidden" name="kategori" id="award-category-input" value="{{ $activeCategory?->slug }}">

                <div class="category-chip-list" role="toolbar" aria-label="Filter kategori prestasi">
                    <button type="submit" name="kategori" value=""
                        class="category-chip {{ $activeCategory ? '' : 'active' }}"
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
                        aria-label="Filter tahun kejuaraan"
                        onchange="this.form.requestSubmit ? this.form.requestSubmit() : this.form.submit()">
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

    <!-- 6. FOOTER -->
    <!-- FOOTER -->
@endsection
