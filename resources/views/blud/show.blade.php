@extends('layouts.app')

@section('content')

  @php
    $unit = $product->businessUnit;
    $canOrder = $product->isAvailable();
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

  <!-- 3. DETAIL & PESAN -->
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

        @if (! empty($product->variants) || ! empty($product->specs))
          <div class="bl-block">
            <h2>Spesifikasi</h2>
            <dl class="bl-specs">
              @if (! empty($product->variants))
                <div>
                  <dt>Varian</dt>
                  <dd>{{ implode(', ', $product->variants) }}</dd>
                </div>
              @endif
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

      <!-- Kartu pesan -->
      <aside class="bl-order" id="pesan">
        <div class="bl-price">{{ $product->price_label }}</div>
        <span class="bl-stock {{ $canOrder ? '' : 'is-empty' }}">{{ $product->availability_label }}</span>

        <form method="POST" action="{{ route('blud.order', $product) }}">
          @csrf

          <div class="bl-field">
            <label for="customer_name">Nama Pemesan</label>
            <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}"
              maxlength="100" autocomplete="name" required @disabled(! $canOrder)>
            @error('customer_name') <div class="bl-field-error">{{ $message }}</div> @enderror
          </div>

          <div class="bl-field">
            <label for="customer_phone">Nomor WhatsApp</label>
            <input type="tel" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}"
              placeholder="081234567890" autocomplete="tel" required @disabled(! $canOrder)>
            @error('customer_phone') <div class="bl-field-error">{{ $message }}</div> @enderror
          </div>

          @if (! empty($product->variants))
            <div class="bl-field">
              <label for="variant">Varian</label>
              <select id="variant" name="variant" required @disabled(! $canOrder)>
                <option value="">Pilih varian</option>
                @foreach ($product->variants as $variant)
                  <option value="{{ $variant }}" @selected(old('variant') === $variant)>{{ $variant }}</option>
                @endforeach
              </select>
              @error('variant') <div class="bl-field-error">{{ $message }}</div> @enderror
            </div>
          @endif

          <div class="bl-field">
            <label for="quantity">Jumlah{{ $product->price_unit ? ' ('.$product->price_unit.')' : '' }}</label>
            <input type="number" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="1"
              max="{{ $product->tracksStock() ? max($product->stock, 1) : 100 }}" required @disabled(! $canOrder)>
            @error('quantity') <div class="bl-field-error">{{ $message }}</div> @enderror
          </div>

          <div class="bl-field">
            <label for="note">Catatan (opsional)</label>
            <textarea id="note" name="note" rows="3" maxlength="500"
              placeholder="{{ $product->type->notePlaceholder() }}"
              @disabled(! $canOrder)>{{ old('note') }}</textarea>
            @error('note') <div class="bl-field-error">{{ $message }}</div> @enderror
          </div>

          <button type="submit" class="btn btn-primary" @disabled(! $canOrder)>
            {{ $canOrder ? 'Pesan via WhatsApp' : 'Stok Habis' }}
          </button>
          <p class="bl-order-note">
            Pesanan tercatat, lalu Anda diarahkan ke WhatsApp {{ $unit->name }} untuk konfirmasi pembayaran & pengambilan.
          </p>
        </form>

        <a href="{{ route('blud.unit', $unit) }}" class="bl-seller">
          <span>
            <strong>{{ $unit->name }}</strong>
            <span>{{ $unit->manager_label }}</span>
          </span>
        </a>
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
