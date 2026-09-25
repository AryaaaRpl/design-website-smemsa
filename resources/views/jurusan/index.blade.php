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
      <span class="jr-eyebrow">Konsentrasi Keahlian</span>
      <h1 class="page-title">
        {{ $stats['majors'] ? $stats['majors'] . ' Program Keahlian,' : 'Program Keahlian,' }}<br />Satu Tujuan: Siap Kerja.
      </h1>
      <p class="page-subtitle">
        Setiap konsentrasi keahlian di SMKS Muhammadiyah 1 Genteng dibekali Teaching Factory,
        sertifikasi kompetensi BNSP, dan jejaring mitra industri agar lulusan siap kerja,
        berwirausaha, atau melanjutkan studi.
      </p>

      <div class="jr-header-stats">
        <div class="jr-header-stat">
          <strong>{{ $stats['majors'] }}</strong>
          <span>Konsentrasi Keahlian</span>
        </div>
        <div class="jr-header-stat">
          <strong>{{ $stats['tefa'] }}</strong>
          <span>Unit Teaching Factory</span>
        </div>
        <div class="jr-header-stat">
          <strong>{{ $stats['partners'] }}+</strong>
          <span>Mitra Industri</span>
        </div>
        <div class="jr-header-stat">
          <strong>{{ $site->percent('employment_rate', ',') }}%</strong>
          <span>Alumni Terserap Kerja</span>
        </div>
      </div>
    </div>
  </header>

  <!-- 3. DAFTAR JURUSAN -->
  <section class="section-padding">
    <div class="container">
      <div class="text-center" style="margin-bottom: 2.5rem">
        <span class="badge badge-primary mb-2">Pilih Program Keahlianmu</span>
        <h2 class="font-head jr-section-title">Temukan Jurusan yang Sesuai Minat & Bakatmu</h2>
        <p class="jr-section-desc">
          Klik kartu untuk melihat kurikulum, tempat praktik, sertifikasi, prestasi, hingga peluang karir tiap jurusan.
        </p>
      </div>

      @if ($majors->isEmpty())
        <!-- Tampilan saat belum ada data jurusan -->
        <div class="content-empty">
          <h3 class="content-empty-title">Data jurusan belum tersedia</h3>
          <p class="content-empty-desc">Informasi konsentrasi keahlian sedang disiapkan. Silakan kembali lagi nanti.</p>
        </div>
      @else
        <div class="jr-grid">
          @foreach ($majors as $major)
            <a href="{{ route('jurusan.show', $major) }}" class="jr-card" aria-label="Lihat detail jurusan {{ $major->name }}">
              <div class="jr-card-visual">
                @if ($major->logo_url)
                  <span class="jr-card-logo"><img src="{{ $major->logo_url }}" alt="Logo {{ $major->code }}" loading="lazy"></span>
                @endif
                @if ($major->student_photo_url)
                  <img class="jr-card-photo" src="{{ $major->student_photo_url }}" alt="Siswa {{ $major->name }}" loading="lazy">
                @else
                  <span class="jr-card-fallback">{{ $major->code }}</span>
                @endif
              </div>

              <div class="jr-card-body">
                <span class="jr-code">{{ $major->code }}</span>
                <h3 class="jr-card-title">{{ $major->name }}</h3>
                @if ($major->description)
                  <p class="jr-card-desc">{{ $major->description }}</p>
                @endif

                <ul class="jr-card-meta">
                  @if ($major->tefa_name)
                    <li><span>TEFA</span>{{ $major->tefa_name }}</li>
                  @endif
                  @if ($major->certification_summary)
                    <li><span>Sertifikasi</span>{{ $major->certification_summary }}</li>
                  @endif
                </ul>

                <div class="jr-card-footer">
                  <span class="jr-card-counts">
                    {{ $major->achievements_count }} Prestasi &bull; {{ $major->partners_count }} Mitra
                  </span>
                  <span class="jr-card-link">Lihat Detail &rarr;</span>
                </div>
              </div>
            </a>
          @endforeach
        </div>
      @endif
    </div>
  </section>

  <!-- 4. CTA SPMB -->
  <section class="jr-cta-section">
    <div class="container">
      <div class="jr-cta">
        <div>
          <h2 class="font-head">Masih bingung memilih jurusan?</h2>
          <p>Konsultasikan minat dan bakatmu bersama Panitia SPMB {{ $site->get('spmb_academic_year') }}.</p>
        </div>
        <div class="jr-cta-actions">
          <a href="{{ url('/spmb') }}" class="btn btn-primary">Daftar SPMB {{ $site->spmbYear() }} &rarr;</a>
          <a href="{{ $site->whatsappLink('spmb', 'Halo Panitia SPMB, saya ingin konsultasi memilih jurusan') }}"
            target="_blank" rel="noopener noreferrer" class="btn jr-btn-light">Konsultasi via WhatsApp</a>
        </div>
      </div>
    </div>
  </section>

@endsection
