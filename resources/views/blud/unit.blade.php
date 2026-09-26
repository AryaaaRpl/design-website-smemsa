@extends('layouts.app')

@section('content')

  <!-- 2. HERO UNIT USAHA -->
  <header class="page-header jr-detail-hero">
    <svg class="header-bg-pattern" viewBox="0 0 100 100" aria-hidden="true">
      <rect x="20" y="20" width="60" height="60" fill="none" stroke="var(--primary)" stroke-width="2"
        transform="rotate(45 50 50)" />
      <circle cx="50" cy="50" r="15" fill="none" stroke="var(--secondary)" stroke-width="2" />
    </svg>
    <div class="container jr-hero-grid">
      <div>
        <nav class="jr-breadcrumb" aria-label="Breadcrumb">
          <a href="{{ url('/') }}">Beranda</a>
          <span aria-hidden="true">/</span>
          <a href="{{ route('blud.index') }}">BLUD</a>
          <span aria-hidden="true">/</span>
          <span aria-current="page">{{ $unit->name }}</span>
        </nav>

        <div class="jr-hero-identity">
          <span class="jr-code jr-code-light">{{ $unit->manager_label }}</span>
        </div>

        <h1 class="page-title">{{ $unit->name }}</h1>
        @if ($unit->summary)
          <p class="page-subtitle">{{ $unit->summary }}</p>
        @endif

        <div class="jr-hero-actions">
          <a href="#produk" class="btn btn-primary">Lihat Produk &rarr;</a>
          <a href="{{ $unit->whatsappLink("Halo {$unit->name}, saya ingin bertanya tentang produk/layanan Anda.") }}"
            target="_blank" rel="noopener noreferrer" class="btn jr-btn-light">Tanya via WhatsApp</a>
        </div>
      </div>

      <div class="jr-hero-figure">
        @if ($unit->image_url)
          <img src="{{ $unit->image_url }}" alt="Foto {{ $unit->name }}">
        @else
          <span class="bl-noimg bl-noimg-dark">Belum ada gambar</span>
        @endif
      </div>
    </div>
  </header>

  <!-- 3. RINGKASAN -->
  <section class="container jr-facts-wrap">
    <div class="jr-facts">
      <div class="jr-fact">
        <span class="jr-fact-label">Bidang Usaha</span>
        <strong>{{ $unit->tagline ?: '-' }}</strong>
      </div>
      <div class="jr-fact">
        <span class="jr-fact-label">Pengelola</span>
        <strong>{{ $unit->managed_by->label() }}</strong>
      </div>
      <div class="jr-fact">
        <span class="jr-fact-label">Jurusan</span>
        <strong>{{ $unit->majors_label ?: '-' }}</strong>
      </div>
      <div class="jr-fact">
        <span class="jr-fact-label">Produk & Jasa</span>
        <strong>{{ $unit->products->count() }} Item</strong>
      </div>
    </div>
  </section>

  <!-- 4. TENTANG -->
  @if ($unit->description || ! empty($unit->features))
    <section class="section-padding" style="padding-top: 4rem">
      <div class="container" style="max-width: 820px">
        <div class="jr-heading">
          <span class="badge badge-primary mb-2">Tentang Unit Usaha</span>
          <h2 class="font-head jr-section-title">Praktik Kewirausahaan Nyata</h2>
        </div>
        <div class="bl-prose">{!! $unit->description_html !!}</div>
        @if (! empty($unit->features))
          <div class="jr-chips" style="justify-content: center; margin-top: 1rem">
            @foreach ($unit->features as $feature)
              <span class="skill-tag">{{ $feature }}</span>
            @endforeach
          </div>
        @endif
      </div>
    </section>
  @endif

  <!-- 5. PRODUK -->
  <section class="jr-band" id="produk">
    <div class="container">
      <div class="jr-heading">
        <span class="badge badge-amber mb-2">Katalog</span>
        <h2 class="font-head jr-section-title">Produk & Jasa {{ $unit->name }}</h2>
      </div>

      @if ($unit->products->isEmpty())
        <div class="content-empty">
          <h3 class="content-empty-title">Belum ada produk</h3>
          <p class="content-empty-desc">Produk unit usaha ini sedang disiapkan.</p>
        </div>
      @else
        <div class="bl-grid">
          @foreach ($unit->products as $product)
            @include('blud._product-card')
          @endforeach
        </div>
      @endif

      <div class="text-center" style="margin-top: 2rem">
        <a href="{{ route('blud.index') }}" class="btn btn-outline">Lihat Semua Unit Usaha &rarr;</a>
      </div>
    </div>
  </section>

@endsection
