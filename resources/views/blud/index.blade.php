@extends('layouts.app')

@section('content')

  <!-- 2. PAGE HEADER -->
  <header class="page-header jr-page-header">
    <svg class="header-bg-pattern" viewBox="0 0 100 100" aria-hidden="true">
      <rect x="20" y="20" width="60" height="60" fill="none" stroke="var(--primary)" stroke-width="2"
        transform="rotate(45 50 50)" />
      <circle cx="50" cy="50" r="15" fill="none" stroke="var(--secondary)" stroke-width="2" />
    </svg>
    <div class="container">
      <span class="jr-eyebrow">BLUD & Unit Usaha Sekolah</span>
      <h1 class="page-title">Karya Siswa,<br />Siap Dipesan.</h1>
      <p class="page-subtitle">
        Produk dan jasa dari unit usaha SMKS Muhammadiyah 1 Genteng, dikerjakan siswa sebagai praktik
        kewirausahaan nyata. Pilih produk, isi formulir, dan pesanan langsung terhubung ke WhatsApp unit usahanya.
      </p>

      <div class="jr-header-stats">
        <div class="jr-header-stat">
          <strong>{{ $units->count() }}</strong>
          <span>Unit Usaha</span>
        </div>
        <div class="jr-header-stat">
          <strong>{{ $units->sum('products_count') }}</strong>
          <span>Produk & Jasa</span>
        </div>
        <div class="jr-header-stat">
          <strong>{{ $studentUnitsCount }}</strong>
          <span>Dikelola Siswa</span>
        </div>
      </div>
    </div>
  </header>

  @if ($units->isEmpty())
    <section class="section-padding">
      <div class="container">
        <!-- Tampilan saat belum ada data BLUD -->
        <div class="content-empty">
          <h3 class="content-empty-title">Data BLUD belum tersedia</h3>
          <p class="content-empty-desc">Produk dan unit usaha sekolah sedang disiapkan. Silakan kembali lagi nanti.</p>
        </div>
      </div>
    </section>
  @else
    <!-- 3. UNIT USAHA -->
    <section class="jr-band">
      <div class="container">
        <div class="jr-heading">
          <span class="badge badge-amber mb-2">Unit Usaha</span>
          <h2 class="font-head jr-section-title">Siapa yang Mengelola?</h2>
          <p class="jr-section-desc">Setiap unit usaha dikelola siswa jurusan terkait atau langsung oleh sekolah.</p>
        </div>
        <div class="bl-unit-grid">
          @foreach ($units as $unit)
            <a href="{{ route('blud.unit', $unit) }}" class="bl-unit">
              <span>
                <strong>{{ $unit->name }}</strong>
                <span>{{ $unit->manager_label }}</span>
                <small>{{ $unit->products_count }} produk & jasa &rarr;</small>
              </span>
            </a>
          @endforeach
        </div>
      </div>
    </section>

    <!-- 4. KATALOG PRODUK -->
    <section class="section-padding" id="katalog">
      <div class="container">
        <div class="jr-heading">
          <span class="badge badge-primary mb-2">Katalog</span>
          <h2 class="font-head jr-section-title" id="bl-catalog-title">{{ $activeUnit ? 'Produk '.$activeUnit->name : 'Semua Produk & Jasa' }}</h2>
        </div>

        {{-- Filter berjalan di browser (resources/js/pages/blud.js); href tetap ada sebagai cadangan tanpa JavaScript. --}}
        <nav class="bl-filter" aria-label="Filter unit usaha">
          <a href="{{ route('blud.index') }}#katalog" data-unit="" data-title="Semua Produk & Jasa"
            class="{{ $activeUnit ? '' : 'active' }}">Semua</a>
          @foreach ($units as $unit)
            <a href="{{ route('blud.index', ['unit' => $unit->slug]) }}#katalog" data-unit="{{ $unit->slug }}"
              data-title="Produk {{ $unit->name }}"
              class="{{ $activeUnit?->is($unit) ? 'active' : '' }}">{{ $unit->name }}</a>
          @endforeach
        </nav>

        <div class="bl-grid" id="bl-catalog">
          @foreach ($products as $product)
            <div class="bl-item" data-unit="{{ $product->businessUnit->slug }}"
              @if ($activeUnit && ! $activeUnit->is($product->businessUnit)) hidden @endif>
              @include('blud._product-card')
            </div>
          @endforeach
        </div>

        <div class="content-empty" id="bl-catalog-empty"
          @if ($products->contains(fn ($product) => ! $activeUnit || $activeUnit->is($product->businessUnit))) hidden @endif>
          <h3 class="content-empty-title">Belum ada produk</h3>
          <p class="content-empty-desc">Produk untuk unit usaha ini sedang disiapkan.</p>
        </div>
      </div>
    </section>
  @endif

@endsection
