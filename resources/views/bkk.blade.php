@extends('layouts.app')

@section('content')

  <!-- 2. PAGE HEADER -->
  <header class="page-header">
    <svg class="header-bg-pattern" viewBox="0 0 100 100">
      <rect x="20" y="20" width="60" height="60" fill="none" stroke="var(--primary)" stroke-width="2"
        transform="rotate(45 50 50)" />
      <circle cx="50" cy="50" r="15" fill="none" stroke="var(--secondary)" stroke-width="2" />
    </svg>
    <div class="container">
      <div style="
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.4rem 1rem;
            border-radius: var(--radius-full);
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--secondary-light);
            margin-bottom: 1.2rem;
          ">
        Penyaluran Lulusan & Karir Alumni
      </div>
      <h1 class="page-title">
        Bursa Kerja Khusus (BKK)<br />SMKS Muhammadiyah 1 Genteng
      </h1>
      <p class="page-subtitle">
        Jembatan karir terpercaya yang menghubungkan alumni dan peserta didik
        dengan ratusan lowongan kerja di mitra industri & DUDIKA terkemuka
        secara nasional.
      </p>
    </div>
  </header>

  <!-- 3. MAIN CONTENT BKK -->
  <section class="section-padding">
    <div class="container">
      <!-- BKK Impact Summary Banner -->
      <div class="bkk-summary-banner">
        <div class="bkk-summary-number">
          <span>{{ $site->percent('employment_rate') }}%</span>
        </div>
        <div class="bkk-summary-text">
          <h3>Tingkat Keterserapan Alumni SMEMSA</h3>
          <p>
            Sebanyak <strong>{{ $site->get('graduates_absorbed') }}+ lulusan tahun terakhir</strong> langsung
            terserap kerja di mitra DUDIKA, berwirausaha mandiri lewat BLUD,
            dan melanjutkan studi ke perguruan tinggi negeri/swasta ternama.
          </p>
        </div>
      </div>

      <!-- BKK Key Statistics -->
      <div class="bkk-stats-grid">
        <div class="stat-card">
          <div class="stat-value">{{ $partnerCount }}+</div>
          <div class="stat-label">Mitra DUDI & Industri</div>
        </div>
        <div class="stat-card">
          <div class="stat-value">{{ $site->percent('employment_rate') }}%</div>
          <div class="stat-label">Alumni Terserap Kerja</div>
        </div>
        <div class="stat-card">
          <div class="stat-value">{{ $site->get('vacancies_per_year') }}+</div>
          <div class="stat-label">Lowongan Kerja Per Tahun</div>
        </div>
        <div class="stat-card">
          <div class="stat-value">100%</div>
          <div class="stat-label">Fasilitasi Rekrutmen Direct</div>
        </div>
      </div>

      <!-- Section Title for Job Portal -->
      <div class="text-center" style="margin-bottom: 2.5rem">
        <span class="badge badge-primary mb-2">Portal Lowongan Kerja BKK</span>
        <h2 class="font-head" style="
              font-size: 2.2rem;
              color: var(--primary-dark);
              margin-top: 0.5rem;
            ">
          Informasi Loker & Magang Terkini
        </h2>
        <p style="
              color: var(--text-muted);
              max-width: 650px;
              margin: 0.5rem auto 0;
            ">
          Daftar lowongan kerja resmi yang diverifikasi langsung oleh Tim BKK
          SMKS Muhammadiyah 1 Genteng.
        </p>
      </div>

      <!-- BKK Table Card -->
      <div class="bkk-table-card">
        <div class="bkk-table-header">
          <div>Perusahaan Mitra</div>
          <div>Posisi Pekerjaan</div>
          <div>Tipe</div>
          <div>Status</div>
          <div>Aksi</div>
        </div>

        @forelse ($vacancies as $vacancy)
        <!-- Job {{ $loop->iteration }} -->
        <div class="bkk-table-row">
          <div>
            <strong style="
                  color: var(--primary);
                  font-size: 1.05rem;
                  display: block;
                ">{{ $vacancy->partner->name }}</strong>
            <small style="color: var(--text-muted)">{{ $vacancy->location }}</small>
          </div>
          <div style="font-weight: 600">{{ $vacancy->position }}</div>
          <div><span class="skill-tag">{{ $vacancy->employment_type->label() }}</span></div>
          <div>
            <span class="badge badge-primary" style="font-size: 0.75rem">Dibuka</span>
          </div>
          <div>
            <a href="{{ $vacancy->apply_link }}"
              target="_blank" rel="noopener" style="
                  color: var(--secondary);
                  font-weight: 700;
                  font-size: 0.9rem;
                ">Lamar Loker &rarr;</a>
          </div>
        </div>

        @empty
        <!-- Tampilan saat belum ada lowongan dibuka -->
        <div class="content-empty" style="margin: 2rem auto;">
          <h3 class="content-empty-title">Belum ada lowongan yang dibuka</h3>
          <p class="content-empty-desc">Lowongan kerja & magang terbaru dari mitra BKK akan tampil di sini. Silakan cek kembali nanti.</p>
        </div>
        @endforelse
      </div>

      <!-- LAYANAN UNGGULAN BKK -->
      <div style="margin-top: 5rem">
        <div class="text-center">
          <span class="badge badge-primary mb-2">Program & Fasilitas BKK</span>
          <h2 class="font-head" style="
                font-size: 2.2rem;
                color: var(--primary-dark);
                margin-top: 0.5rem;
              ">
            Layanan Karir Komprehensif
          </h2>
          <p style="
                color: var(--text-muted);
                max-width: 650px;
                margin: 0.5rem auto 0;
              ">
            BKK SMKS Muhammadiyah 1 Genteng membekali siswa sejak bangku
            sekolah hingga siap kerja di dunia industri.
          </p>
        </div>

        <div class="service-grid">
          <div class="service-card">
            <h3>Penyaluran Kerja Direct</h3>
            <p>
              Rekrutmen sekolah langsung (School Recruitment) bekerjasama
              dengan puluhan perusahan DUDI terkemuka nasional.
            </p>
          </div>
          <div class="service-card">
            <h3>Bimbingan Karir & CV Workshop</h3>
            <p>
              Pelatihan pembuatan CV profesional, portofolio digital, dan
              psikotes kerja bagi seluruh calon lulusan.
            </p>
          </div>
          <div class="service-card">
            <h3>Simulasi Interview Kerja</h3>
            <p>
              Sesi wawancara kerja tiruan dengan instruktur industri agar
              alumni percaya diri saat menghadapi HRD perusahaan.
            </p>
          </div>
          <div class="service-card">
            <h3>Program Praktik Kerja Lapangan (PKL)</h3>
            <p>
              Penempatan magang terstruktur di Teaching Factory dan industri
              mitra sesuai bidang kompetensi masing-masing.
            </p>
          </div>
        </div>
      </div>

      <!-- MITRA PERUSAHAAN UTAMA -->
      <div style="margin-top: 5rem">
        <div class="text-center">
          <span class="badge badge-amber mb-2">DUDIKA Partner</span>
          <h2 class="font-head" style="
                font-size: 2.2rem;
                color: var(--primary-dark);
                margin-top: 0.5rem;
              ">
            Perusahaan Mitra Industri Utama
          </h2>
          <p style="
                color: var(--text-muted);
                max-width: 650px;
                margin: 0.5rem auto 0;
              ">
            Jaringan kemitraan strategis SMEMSA Genteng bersama institusi
            dan korporasi terkemuka.
          </p>
        </div>

        <div class="mitra-grid">
          @forelse ($partners as $partner)
          <div class="mitra-card">
            <div class="mitra-icon" style="background:transparent;"><img src="{{ $partner->logo_url }}"
                alt="{{ $partner->name }}"
                style="width:100%; height:100%; object-fit:contain; border-radius:var(--radius);"></div>
            <div class="mitra-info">
              <h4>{{ $partner->name }}</h4>
            </div>
          </div>
          @empty
          <!-- Tampilan saat belum ada mitra -->
          <div class="content-empty">
            <h3 class="content-empty-title">Data mitra belum tersedia</h3>
            <p class="content-empty-desc">Daftar perusahaan mitra industri sedang disiapkan.</p>
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </section>

  <!-- 4. FOOTER -->

@endsection
