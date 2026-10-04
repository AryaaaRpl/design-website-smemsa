@extends('layouts.app')

@section('content')

<!-- 2. PAGE HEADER -->
<header class="page-header">
    <div class="container">
        <span class="badge-gold">Warta & Jurnalistik Sekolah</span>
        <h1 class="page-title" data-reveal>Kabar Terkini &<br>Inovasi Vokasi MUHI.</h1>
        <p class="page-subtitle" data-reveal>
            Ikuti liputan kegiatan belajar mengajar, kerja sama industri nasional, pengabdian masyarakat, dan
            prestasi mutakhir civitas akademika SMKS Muhammadiyah 1 Genteng.
        </p>
    </div>
</header>

<!-- Pembungkus sticky: bilah pencarian hanya menempel selama daftar berita terlihat, berhenti sebelum footer. -->
<div class="sticky-scope">
@if ($posts->isNotEmpty())
<!-- STICKY PENCARIAN & FILTER KATEGORI (resources/js/pages/berita.js) -->
<div class="news-sticky-bar">
    <div class="container">
        <div class="filter-container" id="news-filter">
            <button type="button" class="filter-btn active" data-category="all">Semua Berita</button>
            @foreach ($categories as $category)
            <button type="button" class="filter-btn" data-category="{{ $category->slug }}">{{ $category->name }}</button>
            @endforeach
        </div>

        <div class="news-search">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
            <input type="search" id="news-search-input" placeholder="Cari judul, ringkasan, atau lokasi..."
                aria-label="Cari berita" autocomplete="off">
        </div>
    </div>
</div>
@endif

<!-- 3. NEWS CARDS GRID -->
<section id="news-card" class="container">
    @if ($posts->isEmpty())
    <!-- Tampilan saat belum ada berita -->
    <div class="news-empty">
        <h3 class="news-empty-title">Belum ada berita</h3>
        <p class="news-empty-desc">Liputan dan kabar terbaru sekolah akan tampil di sini. Silakan kembali lagi nanti.</p>
    </div>
    @else
    <div class="news-grid" id="news-grid">

        @foreach ($posts as $post)
        <!-- Card {{ $loop->iteration }}: {{ $post->title }} -->
        <a href="{{ route('berita.show', $post) }}" id="{{ $post->id }}" class="news-card"
            data-category="{{ $post->category?->slug }}"
            data-search="{{ mb_strtolower(implode(' ', array_filter([$post->title, $post->excerpt, $post->location, $post->category?->name]))) }}">
            <div class="news-card-img-wrap">
                {{-- Kartu pertama = kandidat LCP di HP (1 kolom), sisanya lazy --}}
                <img src="{{ $post->card_thumbnail_url }}" alt="{{ $post->title }}" class="news-card-img"
                    width="640" height="480" decoding="async"
                    @if ($loop->first) fetchpriority="high" @else loading="lazy" @endif
                    onerror="this.closest('.card') ? this.closest('.card').classList.add('no-image') : null; this.remove();">
            </div>
            <div class="news-card-body">
                <div>
                    <div class="news-card-meta">
                        <span class="badge-primary" style="font-size:0.72rem;">{{ mb_strtoupper($post->category?->name ?? 'Berita') }}</span>
                        <span>{{ $post->published_date }}</span>
                        @php($views = number_format($post->views, 0, ',', '.'))
                        <span class="meta-views" title="Dibaca {{ $views }} kali" aria-label="Dibaca {{ $views }} kali">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>
                            {{ $views }}
                        </span>
                    </div>
                    <h3 class="news-card-title" aria-level="2">{{ $post->title }}</h3>
                    <p class="news-card-excerpt">
                        {{ $post->excerpt }}
                    </p>
                </div>
                <div class="news-card-footer">
                    <span>{{ $post->location }}</span>
                    <span>Baca Warta &rarr;</span>
                </div>
            </div>
        </a>

        @endforeach
    </div>

    <!-- Tampilan saat pencarian/filter tidak menemukan berita -->
    <div class="news-empty" id="news-no-result" hidden>
        <h3 class="news-empty-title">Berita tidak ditemukan</h3>
        <p class="news-empty-desc">Coba kata kunci lain atau pilih kategori "Semua Berita".</p>
    </div>
    @endif
</section>
</div>
<!-- /STICKY SCOPE -->

@endsection
