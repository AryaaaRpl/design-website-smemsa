@extends('layouts.app')

@section('content')

<!-- 2. HEADER BERITA -->
<header class="page-header news-detail-header">
    <div class="container news-detail-narrow">
        <nav class="news-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ url('/') }}">Beranda</a>
            <span aria-hidden="true">/</span>
            <a href="{{ route('berita') }}">Berita</a>
            <span aria-hidden="true">/</span>
            <span aria-current="page">{{ $post->category?->name ?? 'Berita' }}</span>
        </nav>

        <span class="badge-gold" style="font-size:0.75rem;">{{ mb_strtoupper($post->category?->name ?? 'Berita') }}</span>
        <h1 class="page-title news-detail-title" data-reveal>{{ $post->title }}</h1>

        <div class="news-detail-meta">
            <span>{{ $post->published_date }}</span>
            @if ($post->byline)
                <span>&bull; {{ $post->byline }}</span>
            @endif
            @if ($post->location)
                <span>&bull; {{ $post->location }}</span>
            @endif
            <span>&bull;</span>
            <span class="meta-views">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>
                Dibaca {{ number_format($post->views, 0, ',', '.') }} kali
            </span>
        </div>
    </div>
</header>

<!-- 3. ISI BERITA -->
<article class="container news-detail-narrow news-detail">
    <figure class="news-detail-cover">
        @if ($post->thumbnail_url)
            <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}">
        @else
            <span class="news-detail-noimg">Belum ada gambar</span>
        @endif
    </figure>

    @if ($post->excerpt)
        <p class="news-detail-lead">{{ $post->excerpt }}</p>
    @endif

    <div class="news-detail-body" data-reveal>
        {!! $post->body_html !!}
    </div>

    <footer class="news-detail-share">
        <div class="news-detail-share-links">
            <span>Bagikan:</span>
            <a href="https://wa.me/?text={{ rawurlencode($post->title.' '.url()->current()) }}" target="_blank" rel="noopener noreferrer">WhatsApp</a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer">Facebook</a>
        </div>
        <a href="{{ url('/spmb') }}" class="btn btn-primary" style="padding:0.5rem 1.4rem; font-size:0.88rem;">
            Gabung Bersama SMKS MUHI &rarr;
        </a>
    </footer>
</article>

<!-- 4. BERITA LAINNYA -->
@if ($relatedPosts->isNotEmpty())
<section class="nd-others">
    <div class="container news-detail-wide">
        <div class="news-detail-related-head">
            <h2 class="font-display">Berita Lainnya</h2>
            <a href="{{ route('berita') }}">Lihat Semua Berita &rarr;</a>
        </div>

        <div class="nd-others-grid">
            @foreach ($relatedPosts as $related)
            <a href="{{ route('berita.show', $related) }}" class="nd-other">
                <span class="nd-other-photo">
                    @if ($related->thumbnail_url)
                        <img src="{{ $related->card_thumbnail_url }}" alt="{{ $related->title }}" loading="lazy">
                    @else
                        <span aria-hidden="true">📰</span>
                    @endif
                </span>
                <span class="nd-other-body">
                    <small>{{ $related->category?->name ?? 'Berita' }} &middot; {{ $related->published_date }}</small>
                    <strong>{{ $related->title }}</strong>
                </span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
