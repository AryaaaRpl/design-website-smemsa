@extends('layouts.app')

@section('content')

<!-- 2. PAGE HEADER -->
<header class="page-header">
    <div class="container">
        <span class="badge-gold">Warta & Jurnalistik Sekolah</span>
        <h1 class="page-title">Kabar Terkini &<br>Inovasi Vokasi MUHI.</h1>
        <p class="page-subtitle">
            Ikuti liputan kegiatan belajar mengajar, kerja sama industri nasional, pengabdian masyarakat, dan
            prestasi mutakhir civitas akademika SMKS Muhammadiyah 1 Genteng.
        </p>

        <!-- Filter Pills -->
        <div class="filter-container">
            <button class="filter-btn active" onclick="filterCategory('all', this)">Semua Berita</button>
            @foreach ($categories as $category)
            <button class="filter-btn" onclick="filterCategory('{{ $category->slug }}', this)">{{ $category->name }}</button>
            @endforeach
        </div>
    </div>
</header>

<!-- 3. FEATURED HEADLINE ARTICLE -->
@if ($featured)
<section class="featured-news-section container">
    <article class="featured-news-card" onclick="openNewsModal('{{ $featured->slug }}')">
        <div class="featured-news-img-wrap">
            <img src="{{ $featured->thumbnail_url }}" alt="{{ $featured->title }}" class="featured-news-img"
                onerror="this.closest('.card') ? this.closest('.card').classList.add('no-image') : null; this.remove();">
        </div>
        <div class="featured-news-body">
            <div style="display:flex; align-items:center; gap:0.8rem; margin-bottom:1rem;">
                <span class="badge-gold" style="font-size:0.75rem;">HEADLINE UTAMA</span>
                <span style="font-size:0.85rem; color:var(--text-subtle); font-weight:600;">{{ $featured->published_date }}@if ($featured->byline) &bull; {{ $featured->byline }}@endif</span>
            </div>
            <h2 class="font-display"
                style="font-size: clamp(1.6rem, 2.5vw, 2.2rem); color: var(--primary-dark); margin-bottom: 1rem; line-height: 1.25;">
                {{ $featured->title }}
            </h2>
            <p style="color: var(--text-muted); font-size: 1rem; line-height: 1.7; margin-bottom: 1.8rem;">
                {{ $featured->excerpt }}
            </p>
            <div
                style="display:flex; align-items:center; gap:0.5rem; color:var(--primary); font-family:var(--font-head); font-weight:700; font-size:0.92rem;">
                Baca Liputan Lengkap &rarr;
            </div>
        </div>
    </article>
</section>
@endif

<!-- 4. NEWS CARDS GRID -->
<section id="news-card" class="container">
    @if ($posts->isEmpty())
    <!-- Tampilan saat belum ada berita -->
    <div class="news-empty">
        <h3 class="news-empty-title">Belum ada berita</h3>
        <p class="news-empty-desc">Liputan dan kabar terbaru sekolah akan tampil di sini. Silakan kembali lagi nanti.</p>
    </div>
    @else
    <div class="news-grid">

        @foreach ($posts as $post)
        <!-- Card {{ $loop->iteration }}: {{ $post->title }} -->
        <article id="{{ $post->id }}" class="news-card" data-category="{{ $post->category?->slug }}" onclick="openNewsModal('{{ $post->slug }}')">
            <div class="news-card-img-wrap">
                <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}" class="news-card-img"
                    onerror="this.closest('.card') ? this.closest('.card').classList.add('no-image') : null; this.remove();">
            </div>
            <div class="news-card-body">
                <div>
                    <div class="news-card-meta">
                        <span class="badge-primary" style="font-size:0.72rem;">{{ mb_strtoupper($post->category?->name ?? 'Berita') }}</span>
                        <span>&bull; {{ $post->published_date }}</span>
                    </div>
                    <h3 class="news-card-title">{{ $post->title }}</h3>
                    <p class="news-card-excerpt">
                        {{ $post->excerpt }}
                    </p>
                </div>
                <div class="news-card-footer">
                    <span>{{ $post->location }}</span>
                    <span>Baca Warta &rarr;</span>
                </div>
            </div>
        </article>

        @endforeach
    </div>
    @endif
</section>

<!-- 5. INTERACTIVE NEWS DETAIL MODAL -->
<div class="modal-overlay" id="news-modal-overlay" onclick="closeNewsModalOnOverlay(event)">
    <div class="news-modal-card" id="news-modal-card" data-lenis-prevent>
        <!-- Modal Hero Header -->
        <div class="modal-news-hero">
            <img src="{{ $featured?->thumbnail_url }}" alt="Header Berita" id="modal-news-img"
                onerror="this.closest('.card') ? this.closest('.card').classList.add('no-image') : null; this.remove();">
            <button class="modal-close-btn" onclick="closeNewsModal()" aria-label="Tutup Berita">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Content Body -->
        <div class="modal-body">
            <div style="display:flex; align-items:center; gap:0.8rem;">
                <span class="badge-gold" id="modal-news-category" style="font-size:0.75rem;">KATEGORI</span>
                <span id="modal-news-date"
                    style="font-size:0.85rem; color:var(--text-subtle); font-weight:600;">Tanggal</span>
            </div>

            <h2 class="modal-headline" id="modal-news-title">Judul Berita Lengkap</h2>

            <div class="modal-full-text" id="modal-news-body">
                <!-- Dynamic Full Text Paragraphs -->
            </div>

            <div
                style="border-top:1px solid var(--border-card); padding-top:1.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
                <span style="font-size:0.88rem; color:var(--text-muted);">Bagikan warta ini ke civitas & alumni
                    &bull; <strong>SMKS MUHI</strong></span>
                <a href="index.html#ppdb" class="btn btn-primary" style="padding:0.5rem 1.4rem; font-size:0.88rem;">
                    Gabung Bersama SMKS MUHI &rarr;
                </a>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->

@endsection

@push('scripts')
<script>
    // Data detail berita dari database (dipakai oleh resources/js/pages/berita.js)
    window.newsDatabase = {{ Js::from($newsData) }};
</script>
@endpush