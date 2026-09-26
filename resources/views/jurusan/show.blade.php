@extends('layouts.app')

@section('content')

  @php
    // Alur 4 tahap pendidikan (bagian yang daftarnya kosong tetap tampil dengan keterangan).
    $pathway = [
      ['title' => 'Yang Dipelajari', 'items' => $major->competencies ?? [], 'note' => 'Kompetensi Inti'],
      ['title' => 'Tempat Praktik', 'items' => $major->practice_items ?? [], 'note' => $major->practice_note ?: 'Teaching Factory'],
      ['title' => 'Sertifikasi', 'items' => $major->certification_items ?? [], 'note' => $major->certification_note ?: 'LSP-P1 BNSP'],
      ['title' => 'Setelah Lulus', 'items' => $major->career_items ?? [], 'note' => $major->career_note ?: 'Mitra Industri & Karir'],
    ];
  @endphp

  <!-- 2. HERO JURUSAN -->
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
          <a href="{{ route('jurusan.index') }}">Konsentrasi Keahlian</a>
          <span aria-hidden="true">/</span>
          <span aria-current="page">{{ $major->code }}</span>
        </nav>

        <div class="jr-hero-identity">
          @if ($major->logo_url)
            <span class="jr-hero-logo"><img src="{{ $major->logo_url }}" alt="Logo {{ $major->code }}"></span>
          @endif
          <span class="jr-code jr-code-light">{{ $major->code }}</span>
        </div>

        <h1 class="page-title">{{ $major->name }}</h1>
        @if ($major->description)
          <p class="page-subtitle">{{ $major->description }}</p>
        @endif

        <div class="jr-hero-actions">
          <a href="{{ url('/spmb') }}" class="btn btn-primary">Daftar Jurusan Ini &rarr;</a>
          <a href="{{ $site->whatsappLink('spmb', "Halo Panitia SPMB, saya ingin bertanya tentang jurusan {$major->name}") }}"
            target="_blank" rel="noopener noreferrer" class="btn jr-btn-light">Tanya Panitia (WhatsApp)</a>
        </div>
      </div>

      <div class="jr-hero-figure">
        @if ($major->student_photo_url)
          <img src="{{ $major->student_photo_url }}" alt="Siswa {{ $major->name }}">
        @else
          <span class="jr-card-fallback">{{ $major->code }}</span>
        @endif
      </div>
    </div>
  </header>

  <!-- 3. RINGKASAN -->
  <section class="container jr-facts-wrap">
    <div class="jr-facts">
      <div class="jr-fact">
        <span class="jr-fact-label">Teaching Factory</span>
        <strong>{{ $major->tefa_name ?: '-' }}</strong>
      </div>
      <div class="jr-fact">
        <span class="jr-fact-label">Sertifikasi</span>
        <strong>{{ $major->certification_summary ?: '-' }}</strong>
      </div>
      <div class="jr-fact">
        <span class="jr-fact-label">Prestasi Siswa</span>
        <strong>{{ $achievements->count() }} Capaian</strong>
      </div>
      <div class="jr-fact">
        <span class="jr-fact-label">Mitra Industri</span>
        <strong>{{ $major->partners->count() }} Perusahaan</strong>
      </div>
    </div>
  </section>

  <!-- 4. ALUR PENDIDIKAN -->
  <section class="section-padding" style="padding-top: 4rem">
    <div class="container">
      <div class="jr-heading">
        <span class="badge badge-primary mb-2">Alur Pendidikan Vokasi</span>
        <h2 class="font-head jr-section-title">Dari Kelas X ke Tempat Kerja</h2>
      </div>

      <div class="jr-steps">
        @foreach ($pathway as $step)
          <div class="jr-step">
            <div class="jr-step-head">
              <span class="jr-step-num">{{ $loop->iteration }}</span>
              <h3>{{ $step['title'] }}</h3>
            </div>
            <ul class="jr-step-list">
              @forelse ($step['items'] as $item)
                <li>{{ $item }}</li>
              @empty
                <li>Informasi segera tersedia</li>
              @endforelse
            </ul>
            <span class="jr-step-note">{{ $step['note'] }}</span>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- 5. KEPALA KONSENTRASI -->
  @if ($major->headTeachers->isNotEmpty())
    <section class="jr-band">
      <div class="container">
        <div class="jr-heading">
          <span class="badge badge-amber mb-2">Pembimbing Program</span>
          <h2 class="font-head jr-section-title">Kepala Konsentrasi Keahlian</h2>
        </div>
        <div class="jr-people">
          @foreach ($major->headTeachers as $teacher)
            <div class="jr-person">
              <div class="jr-person-photo">
                @if ($teacher->photo_url)
                  <img src="{{ $teacher->photo_url }}" alt="Foto {{ $teacher->name }}" loading="lazy">
                @else
                  <span>{{ collect(explode(' ', $teacher->name))->take(2)->map(fn ($w) => mb_substr($w, 0, 1))->implode('') }}</span>
                @endif
              </div>
              <div>
                <strong>{{ $teacher->name }}</strong>
                <span>Kepala Konsentrasi {{ $major->code }}</span>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  <!-- 6. FASILITAS & TEFA -->
  @if ($major->facilities->isNotEmpty())
    <section class="section-padding">
      <div class="container">
        <div class="jr-heading">
          <span class="badge badge-primary mb-2">Tempat Praktik</span>
          <h2 class="font-head jr-section-title">Fasilitas & Teaching Factory</h2>
        </div>
        <div class="jr-facility-grid">
          @foreach ($major->facilities as $facility)
            <article class="jr-facility">
              <div class="jr-facility-photo">
                @if ($facility->images->isNotEmpty())
                  <img src="{{ $facility->images->first()->url }}" alt="Foto {{ $facility->name }}" loading="lazy">
                @endif
                <span class="jr-facility-tag">{{ $facility->type->label() }}</span>
              </div>
              <div class="jr-facility-body">
                <h3>{{ $facility->name }}</h3>
                @if ($facility->description)
                  <p>{{ $facility->description }}</p>
                @endif
                @if (! empty($facility->features))
                  <div class="jr-chips">
                    @foreach (array_slice($facility->features, 0, 4) as $feature)
                      <span class="skill-tag">{{ $feature }}</span>
                    @endforeach
                  </div>
                @endif
              </div>
            </article>
          @endforeach
        </div>
        <div class="text-center" style="margin-top: 2rem">
          <a href="{{ url('/fasilitas') }}" class="btn btn-outline">Lihat Denah & Semua Fasilitas &rarr;</a>
        </div>
      </div>
    </section>
  @endif

  <!-- 6b. PRODUK BLUD JURUSAN -->
  @if ($products->isNotEmpty())
    <section class="section-padding"{!! $major->facilities->isNotEmpty() ? ' style="padding-top: 0"' : '' !!}>
      <div class="container">
        <div class="jr-heading">
          <span class="badge badge-primary mb-2">Karya Siswa</span>
          <h2 class="font-head jr-section-title">Produk BLUD {{ $major->code }}</h2>
          <p class="jr-section-desc">Barang dan jasa dari unit usaha yang dikelola siswa {{ $major->code }}. Bisa dipesan langsung.</p>
        </div>
        <div class="bl-grid">
          @foreach ($products as $product)
            @include('blud._product-card')
          @endforeach
        </div>
        <div class="text-center" style="margin-top: 2rem">
          <a href="{{ route('blud.index') }}" class="btn btn-outline">Lihat Semua Produk BLUD &rarr;</a>
        </div>
      </div>
    </section>
  @endif

  <!-- 7. PRESTASI -->
  @if ($achievements->isNotEmpty())
    <section class="jr-band">
      <div class="container">
        <div class="jr-heading">
          <span class="badge badge-amber mb-2">Rekam Jejak</span>
          <h2 class="font-head jr-section-title">Prestasi Siswa {{ $major->code }}</h2>
        </div>
        <div class="jr-achievement-grid">
          @foreach ($achievements as $achievement)
            <div class="jr-achievement">
              <span class="jr-achievement-badge">{{ mb_strtoupper($achievement->rank ?: $achievement->level?->label()) }}</span>
              <h3>{{ $achievement->title }}</h3>
              <span class="jr-achievement-meta">
                {{ $achievement->achieved_label }} &bull; Tingkat {{ $achievement->level?->label() }}
              </span>
            </div>
          @endforeach
        </div>
        <div class="text-center" style="margin-top: 2rem">
          <a href="{{ url('/prestasi') }}" class="btn btn-outline">Lihat Semua Prestasi &rarr;</a>
        </div>
      </div>
    </section>
  @endif

  <!-- 8. MITRA INDUSTRI -->
  @if ($major->partners->isNotEmpty())
    <section class="section-padding">
      <div class="container">
        <div class="jr-heading">
          <span class="badge badge-primary mb-2">Kerja Sama DUDIKA</span>
          <h2 class="font-head jr-section-title">Mitra Industri {{ $major->code }}</h2>
          <p class="jr-section-desc">Perusahaan yang bekerja sama untuk praktik kerja lapangan, rekrutmen, dan pengembangan kurikulum.</p>
        </div>
        <div class="mitra-grid">
          @foreach ($major->partners as $partner)
            <div class="mitra-card">
              <div class="mitra-icon" style="background:transparent;">
                @if ($partner->logo_url)
                  <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
                    style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);">
                @else
                  <span class="jr-partner-initial">{{ mb_substr($partner->name, 0, 1) }}</span>
                @endif
              </div>
              <div class="mitra-info">
                <h4>{{ $partner->name }}</h4>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  <!-- 9. LOWONGAN DARI MITRA -->
  @if ($vacancies->isNotEmpty())
    <section class="jr-band">
      <div class="container">
        <div class="jr-heading">
          <span class="badge badge-amber mb-2">Peluang Karir</span>
          <h2 class="font-head jr-section-title">Lowongan Terbaru dari Mitra</h2>
        </div>
        <div class="jr-vacancy-list">
          @foreach ($vacancies as $vacancy)
            <div class="jr-vacancy">
              <div>
                <strong>{{ $vacancy->position }}</strong>
                <span>{{ $vacancy->partner->name }}{{ $vacancy->location ? ' • '.$vacancy->location : '' }}</span>
              </div>
              <span class="skill-tag">{{ $vacancy->employment_type->label() }}</span>
              <a href="{{ $vacancy->apply_link }}" target="_blank" rel="noopener" class="jr-vacancy-link">Lamar &rarr;</a>
            </div>
          @endforeach
        </div>
        <div class="text-center" style="margin-top: 2rem">
          <a href="{{ url('/bkk') }}" class="btn btn-outline">Lihat Semua Lowongan BKK &rarr;</a>
        </div>
      </div>
    </section>
  @endif

  <!-- 10. TESTIMONI ALUMNI -->
  @if ($major->testimonials->isNotEmpty())
    <section class="section-padding">
      <div class="container">
        <div class="jr-heading">
          <span class="badge badge-primary mb-2">Cerita Sukses</span>
          <h2 class="font-head jr-section-title">Kata Alumni {{ $major->code }}</h2>
        </div>
        <div class="jr-testi-grid">
          @foreach ($major->testimonials as $testimonial)
            <figure class="jr-testi">
              <blockquote>"{{ $testimonial->quote }}"</blockquote>
              <figcaption>
                <span class="jr-testi-avatar">
                  @if ($testimonial->photo_url)
                    <img src="{{ $testimonial->photo_url }}" alt="Foto {{ $testimonial->name }}" loading="lazy">
                  @else
                    {{ $testimonial->initials }}
                  @endif
                </span>
                <span>
                  <strong>{{ $testimonial->name }}</strong>
                  <small>{{ $testimonial->job_title ?: 'Alumni ' . $major->code }}</small>
                </span>
              </figcaption>
            </figure>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  <!-- 11. CTA SPMB -->
  <section class="jr-cta-section">
    <div class="container">
      <div class="jr-cta">
        <div>
          <h2 class="font-head">Siap bergabung di {{ $major->code }}?</h2>
          <p>Pendaftaran SPMB Tahun Ajaran {{ $site->get('spmb_academic_year') }} dibuka sepanjang tahun.</p>
        </div>
        <div class="jr-cta-actions">
          <a href="{{ url('/spmb') }}" class="btn btn-secondary">Daftar SPMB {{ $site->spmbYear() }} &rarr;</a>
          <a href="{{ $site->whatsappLink('spmb', "Halo Panitia SPMB, saya ingin mendaftar di jurusan {$major->name}") }}"
            target="_blank" rel="noopener noreferrer" class="btn jr-btn-light">Hubungi Panitia</a>
        </div>
      </div>
    </div>
  </section>

  <!-- 12. JURUSAN LAIN -->
  @if ($otherMajors->isNotEmpty())
    <section class="section-padding" style="padding-top: 0">
      <div class="container">
        <div class="jr-heading">
          <h2 class="font-head jr-section-title" style="font-size: 1.5rem">Jelajahi Jurusan Lainnya</h2>
        </div>
        <div class="jr-other-list">
          @foreach ($otherMajors as $other)
            <a href="{{ route('jurusan.show', $other) }}" class="jr-other">
              @if ($other->logo_url)
                <img src="{{ $other->logo_url }}" alt="" loading="lazy">
              @endif
              <span>
                
                <small>{{ $other->name }}</small>
              </span>
            </a>
          @endforeach
        </div>
      </div>
    </section>
  @endif

@endsection
