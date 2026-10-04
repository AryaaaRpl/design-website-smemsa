@extends('layouts.app')

@section('content')

@php
  $photos = $facility->images;
  $cover = $photos->first();
  // Deskripsi: pisahkan paragraf dengan baris kosong.
  $paragraphs = collect(preg_split('/\R{2,}/', trim((string) $facility->description)))->filter();
  $infos = array_filter([
    'Jenis' => $facility->type?->label(),
    'Lokasi' => $facility->location_label,
    'Konsentrasi Keahlian' => $facility->major ? $facility->major->name.' ('.$facility->major->code.')' : null,
  ]);
@endphp

<!-- 2. HEADER DETAIL -->
<header class="page-header fs-detail-header">
  <div class="container fs-narrow">
    <nav class="fs-breadcrumb" aria-label="Breadcrumb">
      <a href="{{ url('/') }}">Beranda</a>
      <span aria-hidden="true">/</span>
      <a href="{{ route('fasilitas') }}">Fasilitas</a>
      <span aria-hidden="true">/</span>
      <span aria-current="page">{{ $facility->list_name }}</span>
    </nav>

    @if ($facility->tag)
      <span class="badge {{ $facility->is_tefa ? 'badge-gold' : 'badge-primary' }}">{{ $facility->tag }}</span>
    @endif
    <h1 class="page-title fs-detail-title" data-reveal>{{ $facility->name }}</h1>
    @if ($facility->short_description)
      <p class="page-subtitle" data-reveal>{{ $facility->short_description }}</p>
    @endif
  </div>
</header>

<!-- 3. ISI DETAIL -->
<section class="container fs-narrow fs-detail">
  <!-- Galeri foto -->
  <figure class="fs-cover">
    @if ($cover)
      <img id="fs-cover-img" src="{{ $cover->url }}" alt="Foto {{ $facility->name }}" width="1200" height="600">
      <figcaption id="fs-cover-caption" @if (! $cover->caption) hidden @endif>{{ $cover->caption }}</figcaption>
    @else
      <span class="fs-noimg">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
          aria-hidden="true">{!! $facility->icon->svg() !!}</svg>
        Belum ada foto
      </span>
    @endif
  </figure>

  @if ($photos->count() > 1)
    <div class="fs-thumbs" role="group" aria-label="Galeri foto {{ $facility->list_name }}">
      @foreach ($photos as $photo)
        <button type="button" class="fs-thumb {{ $loop->first ? 'is-active' : '' }}" data-src="{{ $photo->url }}"
          data-caption="{{ $photo->caption }}" aria-label="Tampilkan foto {{ $loop->iteration }}">
          <img src="{{ $photo->url }}" alt="" loading="lazy" decoding="async">
        </button>
      @endforeach
    </div>
  @endif

  <div class="fs-detail-grid">
    <div>
      @if ($paragraphs->isNotEmpty())
        <h2 class="fs-subtitle">Tentang {{ $facility->is_tefa ? 'Teaching Factory' : 'Fasilitas' }} Ini</h2>
        <div class="fs-prose">
          @foreach ($paragraphs as $paragraph)
            <p>{{ $paragraph }}</p>
          @endforeach
        </div>
      @endif

      @if (! empty($facility->features))
        <div class="fs-block">
          <h2 class="fs-subtitle">Spesifikasi &amp; Sarana Utama</h2>
          <ul class="fs-features">
            @foreach ($facility->features as $feature)
              <li>{{ $feature }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if ($facility->highlight)
        <div class="fs-highlight">
          <span>Nilai Tambah Pembelajaran</span>
          <p>{{ $facility->highlight }}</p>
        </div>
      @endif
    </div>

    <aside class="fs-info-card" data-reveal>
      @if ($infos)
        <dl>
          @foreach ($infos as $label => $value)
            <div>
              <dt>{{ $label }}</dt>
              <dd>{{ $value }}</dd>
            </div>
          @endforeach
        </dl>
      @endif

      <a href="{{ url('/spmb') }}" class="btn btn-primary fs-cta">Daftar &amp; Rasakan Fasilitasnya &rarr;</a>
      @if ($facility->map_x !== null)
        <a href="{{ route('fasilitas') }}#denah" class="fs-link">Lihat lokasi di denah sekolah</a>
      @endif
      <a href="{{ route('fasilitas') }}" class="fs-link">&larr; Semua Fasilitas</a>
    </aside>
  </div>
</section>

<!-- 4. FASILITAS LAINNYA -->
@if ($others->isNotEmpty())
<section class="fs-others">
  <div class="container fs-narrow">
    <h2 class="fs-subtitle">{{ $facility->is_tefa ? 'Teaching Factory' : 'Fasilitas' }} Lainnya</h2>
    <div class="fs-others-grid">
      @foreach ($others as $other)
        <a href="{{ route('fasilitas.show', $other) }}" class="fs-other">
          <span class="fs-other-photo">
            @if ($other->images->first())
              <img src="{{ $other->images->first()->url }}" alt="{{ $other->name }}" loading="lazy">
            @else
              <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                aria-hidden="true">{!! $other->icon->svg() !!}</svg>
            @endif
          </span>
          <span class="fs-other-body">
            @if ($other->tag)
              <small>{{ $other->tag }}</small>
            @endif
            <strong>{{ $other->list_name }}</strong>
          </span>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif

@endsection

@if ($photos->count() > 1)
@push('scripts')
  <script>
    // Galeri: klik thumbnail untuk mengganti foto utama.
    document.querySelectorAll(".fs-thumb").forEach(function (thumb) {
      thumb.addEventListener("click", function () {
        const img = document.getElementById("fs-cover-img");
        const caption = document.getElementById("fs-cover-caption");
        if (!img) return;
        img.src = thumb.dataset.src;
        if (caption) {
          caption.textContent = thumb.dataset.caption || "";
          caption.hidden = !thumb.dataset.caption;
        }
        document.querySelectorAll(".fs-thumb").forEach(function (t) {
          t.classList.toggle("is-active", t === thumb);
        });
      });
    });
  </script>
@endpush
@endif
