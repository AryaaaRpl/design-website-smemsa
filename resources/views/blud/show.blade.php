@extends('layouts.app')

@section('content')

  @php
    $unit = $product->businessUnit;
    $whatsappLink = $product->whatsappLink();
  @endphp

  <!-- 2. HEADER PRODUK -->
  <header class="page-header bl-product-header">
    <svg class="header-bg-pattern" viewBox="0 0 100 100" aria-hidden="true">
      <rect x="20" y="20" width="60" height="60" fill="none" stroke="var(--primary)" stroke-width="2"
        transform="rotate(45 50 50)" />
      <circle cx="50" cy="50" r="15" fill="none" stroke="var(--secondary)" stroke-width="2" />
    </svg>
    <div class="container">
      <nav class="jr-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ url('/') }}">Beranda</a>
        <span aria-hidden="true">/</span>
        <a href="{{ route('blud.index') }}">BLUD</a>
        <span aria-hidden="true">/</span>
        <a href="{{ route('blud.unit', $unit) }}">{{ $unit->name }}</a>
        <span aria-hidden="true">/</span>
        <span aria-current="page">{{ $product->name }}</span>
      </nav>

      <div class="jr-hero-identity">
        <span class="jr-code jr-code-light">{{ $product->type->label() }} &bull; {{ $unit->manager_label }}</span>
      </div>

      <h1 class="page-title">{{ $product->name }}</h1>
      @if ($product->tagline)
        <p class="page-subtitle">{{ $product->tagline }}</p>
      @endif
    </div>
  </header>

  <!-- 3. DETAIL & PESAN VIA WHATSAPP -->
  <section class="section-padding" style="padding-top: 3rem">
    <div class="container bl-detail">
      <div>
        <div class="bl-detail-photo">
          @if ($product->image_url)
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
          @else
            <span class="bl-noimg">Belum ada gambar</span>
          @endif
        </div>

        @if ($product->description || $product->summary)
          <div class="bl-block">
            <h2>Deskripsi</h2>
            <div class="bl-prose">
              @if ($product->description)
                {!! $product->description_html !!}
              @else
                <p>{{ $product->summary }}</p>
              @endif
            </div>
          </div>
        @endif

        @if (! empty($product->specs))
          <div class="bl-block">
            <h2>Spesifikasi</h2>
            <dl class="bl-specs">
              @foreach ($product->specs ?? [] as $spec)
                <div>
                  <dt>{{ $spec['label'] }}</dt>
                  <dd>{{ $spec['value'] }}</dd>
                </div>
              @endforeach
            </dl>
          </div>
        @endif
      </div>

      <!-- Pesan via WhatsApp (harga & ketersediaan ditanyakan langsung) -->
      <aside class="bl-order" id="pesan">
        <div class="bl-order-text">
          <h2>Tertarik dengan {{ $product->name }}?</h2>
          <p>
            Tanyakan harga, ketersediaan, dan detail {{ mb_strtolower($product->type->label()) }} ini langsung
            ke pemilik/perwakilannya lewat WhatsApp.
          </p>
          <a href="{{ route('blud.unit', $unit) }}" class="bl-seller">
            <strong>{{ $unit->name }}</strong>
            <span>{{ $unit->manager_label }}</span>
          </a>
        </div>

        @if ($whatsappLink)
          <a href="{{ $whatsappLink }}" class="btn btn-primary bl-wa-btn" target="_blank" rel="noopener noreferrer">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true">
              <path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.64.07-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.49-1.77-1.66-2.07-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.03-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48 0 1.46 1.07 2.88 1.21 3.07.15.2 2.1 3.2 5.08 4.49.71.31 1.26.49 1.69.63.71.22 1.36.19 1.87.12.57-.09 1.76-.72 2.01-1.41.25-.7.25-1.29.17-1.41-.07-.12-.27-.2-.57-.35zM12.04 21.5a9.47 9.47 0 0 1-4.83-1.32l-.35-.21-3.59.94.96-3.5-.23-.36a9.46 9.46 0 0 1-1.45-5.04c0-5.23 4.26-9.49 9.5-9.49 2.54 0 4.92.99 6.71 2.79a9.43 9.43 0 0 1 2.78 6.71c0 5.23-4.26 9.48-9.49 9.48zm8.08-17.56A11.35 11.35 0 0 0 12.04.6C5.74.6.62 5.72.62 12.02c0 2.01.53 3.98 1.53 5.71L.53 23.4l5.81-1.52a11.4 11.4 0 0 0 5.7 1.45c6.29 0 11.42-5.12 11.42-11.42 0-3.05-1.19-5.92-3.34-8.08z" />
            </svg>
            Pesan via WhatsApp
          </a>
        @endif
      </aside>
    </div>
  </section>

  <!-- 4. PRODUK LAIN DARI UNIT YANG SAMA -->
  @if ($relatedProducts->isNotEmpty())
    <section class="jr-band">
      <div class="container">
        <div class="jr-heading">
          <h2 class="font-head jr-section-title" style="font-size: 1.5rem">Produk Lain dari {{ $unit->name }}</h2>
        </div>
        <div class="bl-grid">
          @foreach ($relatedProducts as $product)
            @include('blud._product-card')
          @endforeach
        </div>
      </div>
    </section>
  @endif

@endsection
