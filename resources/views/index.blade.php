@extends('layouts.app')

@section('content')

<!-- 2. HERO SECTION - WITH PROOF STRIP & 8 MAJOR QUICK CHIPS -->
<section class="hero-section" id="hero">
  <div class="px-stage" aria-hidden="true">
    <div class="px-grid px-grid-dark" data-parallax="0.10"></div>
    <div class="px-orb px-orb-blue" style="width: 520px; height: 520px; top: -140px; left: -120px"
      data-parallax="0.28"></div>
    <div class="px-orb px-orb-amber" style="width: 420px; height: 420px; bottom: -160px; right: -100px"
      data-parallax="-0.22"></div>
  </div>

  <div class="container">
    <div class="hero-grid">
      <div class="hero-text-col">
        <div class="badge badge-primary">
          <p>Selamat datang di <span>SMKS Muhammadiyah 1 Genteng</span></p>
        </div>

        <div class="badge" style="
                background: var(--secondary-surface);
                color: var(--secondary);
                text-transform: uppercase;
                letter-spacing: 0.1em;
                font-size: 0.75rem;
                margin-bottom: 1rem;
                border: 1px solid rgba(234, 179, 8, 0.3);
              ">
          SMK Pusat Keunggulan &bull; Excellent School
        </div>

        <h1 class="hero-headline">
          Good Skill, <br /><span class="highlight-amber">Good Attitude.</span>
        </h1>

        <p class="hero-lead">
          Mengintegrasikan kurikulum DUDI, sertifikasi BNSP, dan karakter
          Islami berkemajuan.
        </p>

        <div class="hero-actions">
          <a href="/spmb" class="btn btn-primary">Daftar SPMB 2026 &rarr;</a>
          <a href="#jurusan" class="btn btn-outline">Jelajahi 7 Konsentrasi Keahlian &rarr;</a>
        </div>
      </div>

      <div class="hero-image-col">
        <div class="hero-img-wrapper">
          <!-- SATU gambar untuk semua ukuran layar. Kelas desktop-only /
                 mobile-only dihapus agar tidak pernah tampil ganda. -->
          <img src="{{ asset('assets/background/3orang.png') }}" class="hero-students-img"
            alt="Tiga siswa SMKS Muhammadiyah 1 Genteng mengenakan seragam jurusan" width="1200" height="900" />


          <!-- Gradasi Pemudar -->
          <div class="hero-fade-gradient" aria-hidden="true"></div>

          <!-- Kartu Bukti Melayang -->
          <div class="hero-proof-bar-bottom">
            <div class="proof-col">
              <div class="proof-number">92,4%</div>
              <div class="proof-label">Terserap Kerja</div>
            </div>
            <div class="proof-col">
              <div class="proof-number">1135</div>
              <div class="proof-label">Jumlah Siswa</div>
            </div>
            <div class="proof-col">
              <div class="proof-number">1000</div>
              <div class="proof-label">Jumlah Prestasi</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 3. MARQUEE MITRA INDUSTRI DUDI (disembunyikan jika belum ada mitra) -->
@if ($partners->isNotEmpty())
<section class="marquee-section" aria-label="Mitra Industri DUDI">
  <div class="marquee-track">
    @foreach ([false, true] as $isDuplicate)
    @if ($isDuplicate)
    <!-- Seamless Loop Duplicate -->
    @endif
    <div class="marquee-group" @if ($isDuplicate) aria-hidden="true" @endif>
      @foreach ($partners as $partner)
      <div class="mitra-item">
        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" onerror="
                this.closest('.card')
                  ? this.closest('.card').classList.add('no-image')
                  : null;
                this.remove();
              " />
      </div>
      @endforeach
    </div>
    @endforeach
  </div>
</section>
@endif

<!-- 7 Major Quick Jump Chips (A.1) - Moved outside hero -->
<section class="major-quick-chips-section" style="
        background-color: var(--bg-alt);
        padding: 1.5rem 0;
        border-bottom: 1px solid var(--border-card);
      ">
  <div class="container">
    <div class="major-quick-chips-wrapper">
      <div class="major-chips-label" style="
              text-align: center;
              margin-bottom: 1rem;
              font-weight: 600;
              color: var(--text-muted);
            ">
        Pilih & Lompat ke Program Keahlian:
      </div>
      <div class="major-chips-list" role="navigation" aria-label="Daftar Cepat Jurusan" style="
              justify-content: center;
              flex-wrap: wrap;
              display: flex;
              gap: 0.75rem;
            ">
        <button class="major-chip-btn" onclick="jumpToMajor('rpl')">
          <img src="{{ asset('assets/major/PPLG-removebg-preview.png') }}" alt="PPLG" class="major-chip-icon" onerror="
                  this.closest('.card')
                    ? this.closest('.card').classList.add('no-image')
                    : null;
                  this.remove();
                " />
          PPLG
        </button>
        <button class="major-chip-btn" onclick="jumpToMajor('tkj')">
          <img src="{{ asset('assets/major/TJKT-removebg-preview.png') }}" alt="TJKT" class="major-chip-icon" onerror="
                  this.closest('.card')
                    ? this.closest('.card').classList.add('no-image')
                    : null;
                  this.remove();
                " />
          TJKT
        </button>
        <button class="major-chip-btn" onclick="jumpToMajor('dkv')">
          <img src="{{ asset('assets/major/dkv.png') }}" alt="DKV" class="major-chip-icon" onerror="
                  this.closest('.card')
                    ? this.closest('.card').classList.add('no-image')
                    : null;
                  this.remove();
                " />
          DKV
        </button>
        <button class="major-chip-btn" onclick="jumpToMajor('bd')">
          <img src="{{ asset('assets/major/logo bdp.png') }}" alt="Bisnis Digital" class="major-chip-icon" onerror="
                  this.closest('.card')
                    ? this.closest('.card').classList.add('no-image')
                    : null;
                  this.remove();
                " />
          Bisnis Digital
        </button>
        <button class="major-chip-btn" onclick="jumpToMajor('akl')">
          <img src="{{ asset('assets/major/logo AKL.png') }}" alt="Akuntansi" class="major-chip-icon" onerror="
                  this.closest('.card')
                    ? this.closest('.card').classList.add('no-image')
                    : null;
                  this.remove();
                " />
          Akuntansi
        </button>
        <button class="major-chip-btn" onclick="jumpToMajor('mplb')">
          <img src="{{ asset('assets/major/mp.jpeg') }}" alt="Perkantoran" class="major-chip-icon" onerror="
                  this.closest('.card')
                    ? this.closest('.card').classList.add('no-image')
                    : null;
                  this.remove();
                " />
          Perkantoran
        </button>
        <button class="major-chip-btn" onclick="jumpToMajor('ph')">
          <img src="{{ asset('assets/major/PH.png') }}" alt="Perhotelan" class="major-chip-icon" onerror="
                  this.closest('.card')
                    ? this.closest('.card').classList.add('no-image')
                    : null;
                  this.remove();
                " />
          Perhotelan
        </button>
      </div>
    </div>
  </div>
</section>

<!-- 4. COUNTER STATS STRIP (Section 2 in Flow: Hero -> Statistik) -->
<section class="stats-section" id="statistik" aria-label="Statistik Lembaga">
  <div class="px-stage" aria-hidden="true">
    <div class="px-grid" data-parallax="0.16"></div>
    <div class="px-ring" style="width: 520px; height: 520px; top: -180px; left: 8%" data-parallax="0.30"></div>
    <div class="px-ring" style="width: 340px; height: 340px; bottom: -140px; right: 12%" data-parallax="-0.24"></div>
    <div class="px-orb px-orb-amber" style="width: 360px; height: 360px; top: -120px; right: -80px"
      data-parallax="0.34"></div>
  </div>
  <div class="container">
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-num counter-value" data-target="1968">0</div>
        <div class="stat-label">Tahun Berdiri</div>
      </div>
      <div class="stat-card">
        <div class="stat-num counter-value" data-target="24">0</div>
        <div class="stat-label">Jumlah Mitra</div>
      </div>
      <div class="stat-card">
        <div class="stat-num">
          <span class="counter-value" data-target="18">0</span>+
        </div>
        <div class="stat-label">Ekstrakurikuler & Pembinaan Bakat</div>
      </div>
      <div class="stat-card">
        <div class="stat-num" style="color: #ffffff">A (Unggul)</div>
        <div class="stat-label">Akreditasi BAN-S/M Kemendikdasmen</div>
      </div>
    </div>
  </div>
</section>

<section class="sambutan-section" id="sambutan" aria-label="Sambutan Pimpinan Lembaga">
  <div class="container">
    <div class="executive-card" style="text-align: left">
      <div class="executive-photo-frame">
        <img src="{{ asset('assets/PAK-WAHID-AI-e1781064934191.png') }}" alt="Kepala Sekolah SMEMSA Wahid Wahyudi S.E. M.M."
          width="480" height="580" loading="lazy" onerror="
                this.closest('.card')
                  ? this.closest('.card').classList.add('no-image')
                  : null;
                this.remove();
              " />
        <div class="executive-photo-badge">
          <strong style="
                  display: block;
                  color: var(--primary);
                  font-size: 1.05rem;
                ">Wahid Wahyudi, S.E., M.M.</strong>
          <span style="font-size: 0.85rem; color: var(--text-muted)">Kepala Sekolah SMKS Muhammadiyah 1 Genteng</span>
        </div>
      </div>

      <div>
        <div class="badge badge-amber mb-2" style="margin-bottom: 1rem">
          Pesan Pimpinan Lembaga
        </div>
        <h3 class="executive-quote">
          "Sekolah yang baik adalah sekolah yang mengantar siswanya sampai
          ke tujuan, bukan hanya sampai ke ijazah."
        </h3>
        <p class="executive-bio-text">
          Kami berkomitmen mencetak generasi unggul yang tidak hanya cakap
          secara teknis dan adaptif terhadap revolusi industri, tetapi juga
          memiliki fondasi akhlak Islami yang kokoh. Di SMEMSA Genteng,
          setiap siswa dibekali sertifikasi kompetensi resmi BNSP melalui
          LSP-P1, kurikulum berbasis industri, dan ruang aktualisasi
          wirausaha nyata.
        </p>
        <div class="flex" style="gap: 1rem; flex-wrap: wrap">
          <a href="/visi-misi" class="btn btn-outline">Visi & Misi Sekolah &rarr;</a>
          <a href="fasilitas" class="btn btn-outline">Jelajahi Fasilitas &rarr;</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 5. KEUNGGULAN SEKOLAH (Section 3 in Flow: Hero -> Statistik -> Keunggulan) -->
<section class="executive-section" id="keunggulan">
  <div class="container">
    <div class="text-center section-header" style="margin-bottom: 2.5rem">
      <div class="badge badge-amber mb-2">SMK Pusat Keunggulan</div>
      <h2 class="section-title">Mengapa Memilih SMEMSA?</h2>
      <p class="section-desc" style="margin: 0 auto">
        Sinergi kurikulum industri, fasilitas Teaching Factory modern,
        sertifikasi lisensi BNSP, dan pembentukan karakter Islami
        berkemajuan.
      </p>
    </div>

    <!-- Why Choose SMEMSA Bento Grid -->
    <div class="why-bento-grid">
      <!-- Card 1 (Baris 1 Kolom 1) -->
      <div class="why-bento-card">
        <div class="why-icon-box">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-rocket">
            <path
              d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.71 1.1-1.42 1.5-2.02l2.5-2.5a2 2 0 0 0 0-2.83l-1.65-1.65a2 2 0 0 0-2.83 0l-2.5 2.5c-.6.4-1.31.79-2.02 1.5z" />
            <path d="M12 15l-3-3" />
            <path d="M15 12l-3-3" />
            <path d="M13.5 6.5C14.7 4.7 17.5 2 22 2c0 4.5-2.7 7.3-4.5 8.5L13.5 6.5z" />
          </svg>
        </div>
        <h3 class="font-head" style="font-size: 1.15rem; margin-bottom: 0.6rem">
          Sekolah Masa Depan
        </h3>
        <p style="font-size: 0.9rem; line-height: 1.6">
          Mengembangkan potensi peserta didik dengan kurikulum inovatif dan
          wawasan global untuk menghadapi tantangan masa depan.
        </p>
      </div>

      <!-- Card 2 (Baris 1 Kolom 2) -->
      <div class="why-bento-card">
        <div class="why-icon-box">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-cpu">
            <rect width="16" height="16" x="4" y="4" rx="2" />
            <rect width="6" height="6" x="9" y="9" rx="1" />
            <path d="M15 2v2" />
            <path d="M15 20v2" />
            <path d="M2 15h2" />
            <path d="M2 9h2" />
            <path d="M20 15h2" />
            <path d="M20 9h2" />
            <path d="M9 2v2" />
            <path d="M9 20v2" />
          </svg>
        </div>
        <h3 class="font-head" style="font-size: 1.15rem; margin-bottom: 0.6rem">
          Unggul Teknologi &amp; Digital
        </h3>
        <p style="font-size: 0.9rem; line-height: 1.6">
          Pembekalan skill digital modern, lab canggih, dan ekosistem
          pembelajaran berbasis teknologi terkini.
        </p>
      </div>

      <!-- Card 3 (Baris 1 Kolom 3) -->
      <div class="why-bento-card">
        <div class="why-icon-box">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-trophy">
            <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6" />
            <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18" />
            <path d="M4 22h16" />
            <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22" />
            <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22" />
            <path d="M18 2H6v7a6 6 0 0 0 12 0V2z" />
          </svg>
        </div>
        <h3 class="font-head" style="font-size: 1.15rem; margin-bottom: 0.6rem">
          Prestasi &amp; Kompetisi
        </h3>
        <p style="font-size: 0.9rem; line-height: 1.6">
          Mendorong siswa berprestasi di tingkat regional, nasional, hingga
          internasional dengan pembinaan intensif.
        </p>
      </div>

      <!-- Card 4 (Baris 2 Kolom 1) -->
      <div class="why-bento-card">
        <div class="why-icon-box">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-link">
            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
          </svg>
        </div>
        <h3 class="font-head" style="font-size: 1.15rem; margin-bottom: 0.6rem">
          Link &amp; Match Industri
        </h3>
        <p style="font-size: 0.9rem; line-height: 1.6">
          Kemitraan erat dengan puluhan DUDI nasional untuk penyusunan
          kurikulum bersama, magang, dan penyaluran kerja.
        </p>
      </div>

      <!-- Card 5 (Baris 2 Kolom 2) -->
      <div class="why-bento-card">
        <div class="why-icon-box">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-target">
            <circle cx="12" cy="12" r="10" />
            <circle cx="12" cy="12" r="6" />
            <circle cx="12" cy="12" r="2" />
          </svg>
        </div>
        <h3 class="font-head" style="font-size: 1.15rem; margin-bottom: 0.6rem">
          Fokus Skill &amp; Karakter
        </h3>
        <p style="font-size: 0.9rem; line-height: 1.6">
          Keseimbangan antara penguasaan kompetensi teknis (hard skill) dan
          pembentukan karakter Islami yang tangguh.
        </p>
      </div>

      <!-- Card 6 (Baris 2 Kolom 3) -->
      <div class="why-bento-card">
        <div class="why-icon-box">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-briefcase">
            <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
            <rect width="20" height="14" x="2" y="6" rx="2" />
          </svg>
        </div>
        <h3 class="font-head" style="font-size: 1.15rem; margin-bottom: 0.6rem">
          Siap Kerja &amp; Berwirausaha
        </h3>
        <p style="font-size: 0.9rem; line-height: 1.6">
          Mencetak lulusan BMW (Bekerja, Melanjutkan studi, Wirausaha) yang
          mandiri, kompeten, dan berdaya saing.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- 6. KONSENTRASI KEAHLIAN - "DARI KELAS X KE TEMPAT KERJA" (Section 4 in Flow) -->
<section class="majors-section" id="jurusan">
  <div class="px-stage" aria-hidden="true">
    <div class="px-grid px-grid-dark" data-parallax="0.09"></div>
    <div class="px-orb px-orb-blue" style="
            width: 460px;
            height: 460px;
            top: 6%;
            left: -180px;
            opacity: 0.28;
          " data-parallax="0.20"></div>
  </div>
  <div class="container">
    <!-- ═══ BAGIAN ATAS: ORBIT DUAL-RING + JUDUL (Satu Blok Melebar Penuh, Rata Tengah) ═══ -->
    <div class="majors-hero-orbit">
      <div class="orbit-hero-stage">
        <!-- D. Cincin Panduan Tipis (SVG pada R=210px & R=300px) -->
        <svg class="orbit-hero-svg" viewBox="0 0 640 640" aria-hidden="true">
          <!-- Cincin Luar (r = 300px) -->
          <circle cx="320" cy="320" r="300" class="orbit-guide-ring orbit-guide-ring-dashed" />
          <!-- Cincin Dalam (r = 210px) -->
          <circle cx="320" cy="320" r="210" class="orbit-guide-ring" />

          <!-- Titik Aksen Dekoratif pada Garis Panduan -->
          <circle cx="320" cy="20" r="3.5" class="orbit-guide-dot" />
          <circle cx="620" cy="320" r="3.5" class="orbit-guide-dot" />
          <circle cx="320" cy="620" r="3.5" class="orbit-guide-dot" />
          <circle cx="20" cy="320" r="3.5" class="orbit-guide-dot" />
        </svg>

        <!-- B. CINCIN DALAM (Radius 210px, 4 logo pertama) -->
        <div class="orbit-ring-inner" aria-hidden="true">
          @foreach ($majors->take(4) as $major)
          <!-- {{ $major->code }} ({{ $loop->index * 90 }} deg, 56x56) -->
          <div class="orbit-slot" style="--a: {{ $loop->index * 90 }}deg; --r: 210px">
            <div class="orbit-center">
              <div class="orbit-icon">
                <img src="{{ $major->logo_url }}" alt="" loading="lazy" onerror="
                        this.closest('.card')
                          ? this.closest('.card').classList.add('no-image')
                          : null;
                        this.remove();
                      " />
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <!-- B. CINCIN LUAR (Radius 300px, logo sisanya, Offset 45deg) -->
        <div class="orbit-ring-outer" aria-hidden="true">
          @foreach ($majors->slice(4)->values() as $major)
          <!-- {{ $major->code }} ({{ 45 + $loop->index * 90 }} deg, 48x48) -->
          <div class="orbit-slot" style="--a: {{ 45 + $loop->index * 90 }}deg; --r: 300px">
            <div class="orbit-center">
              <div class="orbit-icon">
                <img src="{{ $major->logo_url }}" alt="" onerror="
                        this.closest('.card')
                          ? this.closest('.card').classList.add('no-image')
                          : null;
                        this.remove();
                      " />
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <!-- A. Pusat Orbit: Judul Section Menyatu dengan Latar Radial Lembut (Max-Width 560px) -->
        <div class="orbit-hero-center">
          <div class="orbit-hero-badge">Konsentrasi Keahlian</div>
          <h2 class="orbit-hero-title">Dari Kelas X ke Tempat Kerja</h2>
          <p class="orbit-hero-desc">
            Pilih program keahlian untuk menelusuri alur pembelajaran nyata,
            praktik Teaching Factory, sertifikasi profesi BNSP, hingga
            keterserapan kerja di industri mitra.
          </p>
        </div>
      </div>
    </div>

    <!-- ═══ BAGIAN BAWAH: DUA KOLOM (Kiri 38%, Kanan 62%) ═══ -->
    @php($firstMajor = $majors->first())
    @if ($majors->isEmpty())
    <!-- Tampilan saat belum ada data jurusan -->
    <div class="majors-empty">
      <h3 class="majors-empty-title">Data jurusan belum tersedia</h3>
      <p class="majors-empty-desc">
        Informasi konsentrasi keahlian sedang disiapkan. Silakan kembali lagi nanti.
      </p>
    </div>
    @else
    <div class="majors-split-grid">
      <!-- KOLOM KIRI — DAFTAR 8 JURUSAN -->
      <div class="majors-list-col" id="major-tablist-container" role="tablist"
        aria-label="Daftar 8 Program Keahlian Vokasi">
        <!-- Baris dirender secara dinamis oleh JavaScript -->
      </div>

      <!-- KOLOM KANAN — PANEL ALUR PENDIDIKAN (STICKY, TOP 6REM) -->
      <div class="majors-detail-col" id="major-tabpanel-container" role="tabpanel" aria-live="polite"
        aria-labelledby="tab-btn-{{ $firstMajor?->slug }}">
        <div class="major-pathway-view" id="major-pathway-view">
          <!-- ═══ KEPALA PANEL: KIRI (FIGUR SISWA 3:4) + KANAN (IDENTITAS JURUSAN) ═══ -->
          <div class="major-panel-head-grid">
            <!-- Kiri (38%): Area Figur Siswa Potret Utuh -->
            <div class="major-figure-wrapper">
              <!-- Logo Jurusan Kecil di Pojok Kanan Atas -->
              <div class="major-figure-corner-logo" id="panel-figure-logo" title="Logo Program Keahlian">
                <img src="{{ $firstMajor?->logo_url }}" alt="Logo Jurusan" width="28" height="28" onerror="
                        this.closest('.card')
                          ? this.closest('.card').classList.add('no-image')
                          : null;
                        this.remove();
                      " />
              </div>
              <!-- Bayangan Lembut di Dasar Figur -->
              <div class="major-figure-shadow"></div>
              <!-- Foto Siswa (object-fit: contain, menempel di dasar bingkai) -->
              <img id="panel-student-photo" class="major-figure-img" src="{{ $firstMajor?->student_photo_url }}"
                alt="Siswa Berseragam {{ $firstMajor?->name }}" width="300" height="400" onerror="
                      this.closest('.card')
                        ? this.closest('.card').classList.add('no-image')
                        : null;
                      this.remove();
                    " />
              <!-- Fallback jika foto belum siap -->
              <div class="major-figure-fallback" id="panel-figure-fallback" style="display: none">
                <span id="panel-fallback-code">{{ $firstMajor?->code }}</span>
              </div>
            </div>

            <!-- Kanan (62%): Identitas Jurusan Lengkap -->
            <div class="major-identity-body">
              <span class="major-id-badge" id="panel-major-code">{{ $firstMajor?->code }}</span>
              <h3 class="major-id-title" id="panel-major-title">
                {{ $firstMajor?->name }}
              </h3>
              <p class="major-id-desc" id="panel-major-desc">
                {{ $firstMajor?->description }}
              </p>
              <div class="major-id-info-row">
                <div class="major-info-item">
                  <span class="major-info-icon">🏬</span>
                  <div>
                    <span class="major-info-label">TEFA:</span>
                    <span id="panel-tefa-name">{{ $firstMajor?->tefa_name }}</span>
                  </div>
                </div>
                <div class="major-info-item">
                  <span class="major-info-icon">📜</span>
                  <div>
                    <span class="major-info-label">Sertifikasi:</span>
                    <span id="panel-cert-name">{{ $firstMajor?->certification_summary }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ═══ ALUR 4 TAHAP HORIZONTAL MELEBAR PENUH ═══ -->
          <div class="major-flow-section">
            <div class="major-steps-track">
              <!-- Tahap 1: Yang Dipelajari -->
              <div class="major-step-box">
                <div class="major-step-header">
                  <div class="major-step-num">1</div>
                  <div class="major-step-title">Yang Dipelajari</div>
                </div>
                <ul class="major-step-list" id="panel-flow-stage1"></ul>
                <div class="major-step-tag">Kompetensi Inti</div>
              </div>

              <!-- Tahap 2: Tempat Praktik -->
              <div class="major-step-box">
                <div class="major-step-header">
                  <div class="major-step-num">2</div>
                  <div class="major-step-title">Tempat Praktik</div>
                </div>
                <ul class="major-step-list" id="panel-flow-stage2"></ul>
                <div class="major-step-tag" id="panel-flow-stage2-box">
                  Teaching Factory
                </div>
              </div>

              <!-- Tahap 3: Sertifikasi -->
              <div class="major-step-box">
                <div class="major-step-header">
                  <div class="major-step-num">3</div>
                  <div class="major-step-title">Sertifikasi</div>
                </div>
                <ul class="major-step-list" id="panel-flow-stage3"></ul>
                <div class="major-step-tag" id="panel-flow-stage3-box">
                  LSP-P1 BNSP
                </div>
              </div>

              <!-- Tahap 4: Setelah Lulus -->
              <div class="major-step-box">
                <div class="major-step-header">
                  <div class="major-step-num">4</div>
                  <div class="major-step-title">Setelah Lulus</div>
                </div>
                <ul class="major-step-list" id="panel-flow-stage4"></ul>
                <div class="major-step-tag" id="panel-flow-stage4-box">
                  Mitra Industri & Karir
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</section>

<!-- 7. TEFA & UNIT PRODUKSI BLUD SISWA (Section 5 in Flow: Jurusan -> TEFA/BLUD) -->
<section class="blud-section" id="blud">
  <div class="px-stage" aria-hidden="true">
    <div class="px-grid" data-parallax="0.14"></div>
    <div class="px-orb px-orb-blue" style="width: 560px; height: 560px; top: -180px; right: -140px"
      data-parallax="0.26"></div>
    <div class="px-orb px-orb-amber" style="width: 380px; height: 380px; bottom: -160px; left: -100px"
      data-parallax="-0.20"></div>
  </div>
  <div class="container">
    <div class="flex justify-between items-center flex-wrap" style="margin-bottom: 3.5rem; gap: 1.5rem">
      <div>
        <div class="badge badge-amber mb-2">
          Teaching Factory & Kewirausahaan Nyata
        </div>
        <h2 class="section-title" style="color: #ffffff; margin: 0.5rem 0">
          Karya & Unit Usaha Dikelola Siswa (BLUD)
        </h2>
        <p style="opacity: 0.85; max-width: 640px">
          Bukti pembelajaran aplikatif: siswa dilatih mengelola unit bisnis
          mandiri, menghasilkan produk komersial dan melayani pelanggan
          sesungguhnya.
        </p>
      </div>
      <a href="#jurusan" class="btn btn-amber">Lihat Unit Praktek Jurusan &rarr;</a>
    </div>

    <div class="blud-grid" id="blud-container">
      <!-- Data produk akan dirender oleh JavaScript -->
    </div>
  </div>
</section>

<!-- BLUD PRODUCT DETAIL MODAL (Matching Visi-Misi Modal) -->
<div class="blud-modal-overlay" id="blud-modal-overlay" onclick="closeBludModalOnOverlay(event)" data-lenis-prevent>
  <div class="blud-modal-card" id="blud-modal-card" data-lenis-prevent>
    <div class="blud-modal-banner" id="blud-modal-banner">
      <img src="" alt="" id="blud-modal-bg-img" class="bg-cover" style="display: none;" />
      <div class="blud-modal-banner-icon" id="blud-modal-icon-box">
        <span id="blud-modal-icon-emoji" style="font-size: 2.5rem;"></span>
        <img id="blud-modal-icon-img" src="" alt=""
          style="display: none; width: 100%; height: 100%; object-fit: cover; border-radius: 12px;" />
      </div>
      <button aria-label="Tutup Detail Produk BLUD" class="blud-modal-close-btn" onclick="closeBludModal()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
          <path d="M18 6 6 18" />
          <path d="m6 6 12 12" />
        </svg>
      </button>
    </div>
    <div class="blud-modal-body">
      <span class="blud-modal-tag" id="blud-modal-tag">Dikelola Siswa BLUD</span>
      <h3 class="blud-modal-title" id="blud-modal-title">Nama Produk BLUD</h3>
      <p class="blud-modal-desc" id="blud-modal-desc">Deskripsi lengkap produk...</p>

      <div class="blud-modal-specs-box">
        <div class="blud-modal-section-title">
          Spesifikasi &amp; Informasi Detail:
        </div>
        <div class="blud-modal-chips-row" id="blud-modal-chips">
          <!-- Chips dirender oleh JS -->
        </div>
      </div>

      <div class="blud-modal-highlight-box">
        <div class="blud-modal-section-title" style="color: #064e3b; margin-bottom: 0.4rem;">
          Nilai Praktik Vokasi &amp; Pembelajaran BLUD:
        </div>
        <div class="blud-modal-highlight-text" id="blud-modal-highlight">
          Highlight praktik...
        </div>
      </div>

      <div class="blud-modal-footer-cta">
        <div style="font-size: 0.85rem; color: #64748b;">
          <strong style="color: #0f172a;">Unit Usaha BLUD SMEMSA</strong> • Berlisensi &amp; Didampingi Guru Industri
        </div>
        <button class="btn btn-primary" onclick="closeBludModal()" style="padding: 0.6rem 1.4rem; font-size: 0.9rem;">
          Tutup Detail
        </button>
      </div>
    </div>
  </div>
</div>

<!-- UNIT USAHA SEKOLAH DETAIL MODAL -->
<div class="blud-modal-overlay" id="unit-usaha-modal-overlay" onclick="closeUnitUsahaModalOnOverlay(event)"
  data-lenis-prevent>
  <div class="blud-modal-card" id="unit-usaha-modal-card" data-lenis-prevent>
    <div class="blud-modal-banner" id="unit-usaha-modal-banner">
      <div class="blud-modal-banner-icon" id="unit-usaha-modal-icon-box">
        <span id="unit-usaha-modal-icon-emoji" style="font-size: 2.5rem;">🏢</span>
      </div>
      <button aria-label="Tutup Detail Unit Usaha" class="blud-modal-close-btn" onclick="closeUnitUsahaModal()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
          <path d="M18 6 6 18" />
          <path d="m6 6 12 12" />
        </svg>
      </button>
    </div>
    <div class="blud-modal-body">
      <span class="blud-modal-tag" id="unit-usaha-modal-tag">🏢 Unit Usaha Sekolah (TEFA &amp; BLUD)</span>
      <h3 class="blud-modal-title" id="unit-usaha-modal-title">Nama Unit Usaha</h3>
      <p class="blud-modal-desc" id="unit-usaha-modal-desc">Deskripsi lengkap unit usaha...</p>

      <div class="blud-modal-specs-box">
        <div class="blud-modal-section-title">
          Layanan &amp; Keunggulan Utama:
        </div>
        <div class="blud-modal-chips-row" id="unit-usaha-modal-chips">
          <!-- Chips dirender oleh JS -->
        </div>
      </div>

      <div class="blud-modal-highlight-box">
        <div class="blud-modal-section-title" style="color: #064e3b; margin-bottom: 0.4rem;">
          Nilai Ekosistem Vokasi &amp; Praktik Industri:
        </div>
        <div class="blud-modal-highlight-text" id="unit-usaha-modal-highlight">
          Highlight unit usaha...
        </div>
      </div>

      <div class="blud-modal-footer-cta">
        <div style="font-size: 0.85rem; color: #64748b;">
          <strong style="color: #0f172a;">Ekosistem TEFA &amp; BLUD SMEMSA</strong> • Berstandar DUDIKA
        </div>
        <button class="btn btn-primary" onclick="closeUnitUsahaModal()"
          style="padding: 0.6rem 1.4rem; font-size: 0.9rem;">
          Tutup Detail
        </button>
      </div>
    </div>
  </div>
</div>

<!-- 9. PRESTASI & TESTIMONI STRIP (Section 7 in Flow: BKK -> Prestasi) -->
<section class="achievements-section" id="prestasi">
  <div class="achieve-glow-bg"></div>
  <div class="container">
    <div class="achieve-grid">
      <!-- Left: Timeline Prestasi -->
      <div class="prestasi-left-col">
        <div class="badge badge-amber mb-2" style="margin-bottom: 1rem">
          Tradisi Kejuaraan
        </div>
        <h2 class="section-title">Jejak Prestasi Siswa SMEMSA</h2>
        <p style="
                color: var(--text-muted);
                font-size: 1.05rem;
                line-height: 1.7;
                margin-bottom: 2rem;
              ">
          Komitmen nyata dalam mengasah bakat akademik, teknologi rekayasa,
          seni, dan bela diri hingga podium tertinggi nasional.
        </p>

        <div class="timeline-box">
          <div class="timeline-progress-line">
            <div class="timeline-progress-bar" id="timeline-bar"></div>
          </div>

          <div class="timeline-card prestasi-item">
            <span class="badge badge-primary mb-2" style="font-size: 0.75rem">Juli 2026</span>
            <h3 class="font-head" style="
                    font-size: 1.2rem;
                    color: var(--primary);
                    margin: 0.3rem 0;
                  ">
              Juara Umum ME Awards 2026
            </h3>
            <p style="font-size: 0.9rem; color: var(--text-muted)">
              Tingkat Nasional (Muhammadiyah Education Awards)
            </p>
          </div>
          <div class="timeline-card prestasi-item">
            <span class="badge badge-primary mb-2" style="font-size: 0.75rem">Juni 2026</span>
            <h3 class="font-head" style="
                    font-size: 1.2rem;
                    color: var(--primary);
                    margin: 0.3rem 0;
                  ">
              Juara 3 Taekwondo Kejurprov Pelajar
            </h3>
            <p style="font-size: 0.9rem; color: var(--text-muted)">
              Tingkat Provinsi Jawa Timur (Malang)
            </p>
          </div>
          <div class="timeline-card prestasi-item">
            <span class="badge badge-primary mb-2" style="font-size: 0.75rem">Mei 2026</span>
            <h3 class="font-head" style="
                    font-size: 1.2rem;
                    color: var(--primary);
                    margin: 0.3rem 0;
                  ">
              Perwakilan Lomba Inovasi Digital Nasional
            </h3>
            <p style="font-size: 0.9rem; color: var(--text-muted)">
              Aplikasi Manajemen Vokasi Terpadu (Tim PPLG)
            </p>
          </div>
        </div>

        <a href="/prestasi" class="btn btn-outline" style="margin-top: 1.5rem">Lihat Galeri Prestasi Lengkap
          &rarr;</a>
      </div>

      <!-- Right: Testimonial Alumni Parallax Card -->
      <div class="testi-parallax-wrapper">
        <div class="testi-card" id="testi-parallax-card">
          <div class="testi-badge-float">
            <span>⭐</span> Cerita Sukses Alumni
          </div>

          <div>
            <div class="testi-quote-mark">“</div>
            <p style="
                    font-size: 1.28rem;
                    font-style: italic;
                    line-height: 1.75;
                    opacity: 0.95;
                    font-weight: 400;
                  ">
              "Magang di jurusan PPLG membuat saya langsung diterima kerja
              sebagai junior developer di software house mitra sekolah, dua
              minggu setelah kelulusan!"
            </p>
          </div>

          <div class="flex items-center" style="gap: 1.2rem; margin-top: 2.8rem">
            <div style="
                    width: 56px;
                    height: 56px;
                    background: rgba(255, 255, 255, 0.18);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: 800;
                    font-size: 1.15rem;
                    border: 2px solid rgba(255, 255, 255, 0.4);
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                  ">
              PPLG
            </div>
            <div>
              <strong style="display: block; font-size: 1.1rem; color: #ffffff">Ahmad Rizqi Pratama</strong>
              <span style="font-size: 0.85rem; color: rgba(255, 255, 255, 0.85)">Junior Web Developer &bull; PT
                Digital Kreatif
                Nusantara</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 10B. INFORMASI UNIT USAHA SEKOLAH (TEFA & BLUD) -->
<section class="unit-usaha-section" id="unit-usaha" aria-label="Informasi Unit Usaha Sekolah SMEMSA">
  <div class="px-stage" aria-hidden="true">
    <div class="px-grid" data-parallax="0.14"></div>
    <div class="px-orb px-orb-blue" style="width: 500px; height: 500px; top: -150px; left: -100px"
      data-parallax="0.22"></div>
    <div class="px-orb px-orb-amber" style="width: 400px; height: 400px; bottom: -120px; right: -80px"
      data-parallax="-0.18"></div>
  </div>
  <div class="container">
    <div class="flex justify-between items-center flex-wrap" style="margin-bottom: 3.5rem; gap: 1.5rem">
      <div>
        <div class="badge badge-amber mb-2">
          Unit Usaha &amp; Bisnis Vokasi
        </div>
        <h2 class="section-title" style="color: #ffffff; margin: 0.5rem 0">
          Ekosistem Unit Usaha Sekolah (TEFA &amp; BLUD)
        </h2>
        <p style="opacity: 0.85; max-width: 640px; color: #cbd5e1;">
          Fasilitas usaha mandiri berstandar industri tempat siswa mempraktikkan keahlian vokasi, melayani kebutuhan
          masyarakat, dan mencetak wirausaha muda.
        </p>
      </div>
      <a href="#blud" class="btn btn-amber">Lihat Produk BLUD Siswa &rarr;</a>
    </div>

    <div class="blud-grid">
      <!-- Card Unit Usaha 1 -->
      <div class="product-bento" style="padding: 1.8rem; justify-content: space-between; cursor: pointer;"
        onclick="openUnitUsahaModal(0)">
        <div>
          <div
            style="width: 100%; height: 180px; border-radius: var(--radius-sm); background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.2rem; text-align: center; margin-bottom: 1.2rem; box-shadow: inset 0 2px 10px rgba(0,0,0,0.15);">
            <span style="font-size: 3rem; margin-bottom: 0.4rem;">🖨️</span>
            <h4
              style="color: #fff; font-family: var(--font-display); font-size: 1.2rem; line-height: 1.3; font-weight: 800;">
              SMEMSA Print Studio</h4>
          </div>
          <div class="blud-learner-tag">DKV &amp; Bisnis Digital</div>
          <h3 class="font-head" style="font-size:1.25rem; color:#ffffff; margin: 0.4rem 0 0.6rem; line-height: 1.3;">
            Percetakan &amp; Merchandise</h3>
          <p style="font-size: 0.92rem; color: #cbd5e1; margin-bottom: 0.8rem; line-height: 1.5;">
            Layanan cetak banner, sablon kaos, mug merchandise, ID card, dan suvenir komersial berstandar industri.
          </p>
          <div style="display: flex; flex-wrap: wrap; gap: 0.4rem; margin-bottom: 1rem;">
            <span
              style="font-size: 0.78rem; background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.25rem 0.6rem; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15);">Cetak
              Satuan</span>
            <span
              style="font-size: 0.78rem; background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.25rem 0.6rem; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15);">Hasil
              Presisi</span>
            <span
              style="font-size: 0.78rem; background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.25rem 0.6rem; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15);">Order
              Digital</span>
          </div>
        </div>
      </div>

      <!-- Card Unit Usaha 2 -->
      <div class="product-bento" style="padding: 1.8rem; justify-content: space-between; cursor: pointer;"
        onclick="openUnitUsahaModal(1)">
        <div>
          <div
            style="width: 100%; height: 180px; border-radius: var(--radius-sm); background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.2rem; text-align: center; margin-bottom: 1.2rem; box-shadow: inset 0 2px 10px rgba(0,0,0,0.15);">
            <span style="font-size: 3rem; margin-bottom: 0.4rem;">🔧</span>
            <h4
              style="color: #fff; font-family: var(--font-display); font-size: 1.2rem; line-height: 1.3; font-weight: 800;">
              SMEMSA Tech Solutions</h4>
          </div>
          <div class="blud-learner-tag">TJKT &amp; PPLG</div>
          <h3 class="font-head" style="font-size:1.25rem; color:#ffffff; margin: 0.4rem 0 0.6rem; line-height: 1.3;">
            Service Center &amp; Software</h3>
          <p style="font-size: 0.92rem; color: #cbd5e1; margin-bottom: 0.8rem; line-height: 1.5;">
            Jasa perbaikan komputer/laptop, instalasi jaringan Wi-Fi/LAN, serta pembuatan website &amp; aplikasi UMKM.
          </p>
          <div style="display: flex; flex-wrap: wrap; gap: 0.4rem; margin-bottom: 1rem;">
            <span
              style="font-size: 0.78rem; background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.25rem 0.6rem; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15);">Teknisi
              BNSP</span>
            <span
              style="font-size: 0.78rem; background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.25rem 0.6rem; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15);">Garansi
              Service</span>
            <span
              style="font-size: 0.78rem; background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.25rem 0.6rem; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15);">NOC
              Center</span>
          </div>
        </div>
      </div>

      <!-- Card Unit Usaha 3 -->
      <div class="product-bento" style="padding: 1.8rem; justify-content: space-between; cursor: pointer;"
        onclick="openUnitUsahaModal(2)">
        <div>
          <div
            style="width: 100%; height: 180px; border-radius: var(--radius-sm); background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.2rem; text-align: center; margin-bottom: 1.2rem; box-shadow: inset 0 2px 10px rgba(0,0,0,0.15);">
            <span style="font-size: 3rem; margin-bottom: 0.4rem;">🏨</span>
            <h4
              style="color: #fff; font-family: var(--font-display); font-size: 1.2rem; line-height: 1.3; font-weight: 800;">
              SMEMSA Hospitality Hub</h4>
          </div>
          <div class="blud-learner-tag">Perhotelan &amp; MPLB</div>
          <h3 class="font-head" style="font-size:1.25rem; color:#ffffff; margin: 0.4rem 0 0.6rem; line-height: 1.3;">
            Edutel &amp; Laundry Center</h3>
          <p style="font-size: 0.92rem; color: #cbd5e1; margin-bottom: 0.8rem; line-height: 1.5;">
            Pengelolaan Mini Hotel (Edutel), jasa laundry wangi berkualitas, dan ruang rapat/meeting room komersial.
          </p>
          <div style="display: flex; flex-wrap: wrap; gap: 0.4rem; margin-bottom: 1rem;">
            <span
              style="font-size: 0.78rem; background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.25rem 0.6rem; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15);">Standar
              Hotel</span>
            <span
              style="font-size: 0.78rem; background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.25rem 0.6rem; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15);">Laundry
              Express</span>
            <span
              style="font-size: 0.78rem; background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.25rem 0.6rem; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15);">Ruang
              Rapat</span>
          </div>
        </div>
      </div>

      <!-- Card Unit Usaha 4 -->
      <div class="product-bento" style="padding: 1.8rem; justify-content: space-between; cursor: pointer;"
        onclick="openUnitUsahaModal(3)">
        <div>
          <div
            style="width: 100%; height: 180px; border-radius: var(--radius-sm); background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.2rem; text-align: center; margin-bottom: 1.2rem; box-shadow: inset 0 2px 10px rgba(0,0,0,0.15);">
            <span style="font-size: 3rem; margin-bottom: 0.4rem;">🛍️</span>
            <h4
              style="color: #fff; font-family: var(--font-display); font-size: 1.2rem; line-height: 1.3; font-weight: 800;">
              SMEMSA Mart &amp; Business</h4>
          </div>
          <div class="blud-learner-tag">Bisnis Digital &amp; AKL</div>
          <h3 class="font-head" style="font-size:1.25rem; color:#ffffff; margin: 0.4rem 0 0.6rem; line-height: 1.3;">
            Ritel &amp; Mini Market Siswa</h3>
          <p style="font-size: 0.92rem; color: #cbd5e1; margin-bottom: 0.8rem; line-height: 1.5;">
            Pusat perbelanjaan perlengkapan sekolah, makanan/minuman produk siswa, dan minimarket berbasis POS Kasir.
          </p>
          <div style="display: flex; flex-wrap: wrap; gap: 0.4rem; margin-bottom: 1rem;">
            <span
              style="font-size: 0.78rem; background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.25rem 0.6rem; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15);">Produk
              Lokal</span>
            <span
              style="font-size: 0.78rem; background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.25rem 0.6rem; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15);">Sistem
              POS</span>
            <span
              style="font-size: 0.78rem; background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.25rem 0.6rem; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15);">Lengkap
              &amp; Murah</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 11b. AJAKAN SPMB (ringkas) — pengganti section SPMB yang dipindah
       ke spmb.html. id="ppdb" dipertahankan agar tautan lama tetap hidup. -->
<section class="spmb-cta-section" id="ppdb">
  <div class="container">
    <div class="spmb-cta-band">
      <div class="spmb-cta-main">
        <span class="spmb-cta-badge">Tahun Ajaran 2026/2027</span>
        <h2 class="spmb-cta-title">Bergabung Bersama SMEMSA.</h2>
        <p class="spmb-cta-desc">
          Mulai langkah menuju karier vokasi bersama sekolah pusat keunggulan
          dengan Teaching Factory, sertifikasi BNSP, dan penyaluran kerja.
        </p>
        <a href="/spmb" class="spmb-cta-btn">
          Informasi &amp; Pendaftaran SPMB
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"
            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M5 12h14M13 6l6 6-6 6" />
          </svg>
        </a>
      </div>
      <ul class="spmb-cta-points">
        <li>
          <span class="spmb-point-num">4</span>
          <span class="spmb-point-label">Langkah Pendaftaran</span>
        </li>
        <li>
          <span class="spmb-point-num">7</span>
          <span class="spmb-point-label">Konsentrasi Keahlian</span>
        </li>
        <li>
          <span class="spmb-point-num">100%</span>
          <span class="spmb-point-label">Pendaftaran Online</span>
        </li>
      </ul>
    </div>
  </div>
</section>

<!-- 12. NEWS & EDITORIAL JOURNAL (Section 10 in Flow: SPMB -> Berita) -->
<section class="news-section" id="berita">
  <div class="container">
    <div class="text-center section-header">
      <div class="badge badge-amber mb-2">Jurnal & Informasi</div>
      <h2 class="section-title">Kabar & Berita</h2>
      <p class="section-desc" style="margin: 0 auto">
        Liputan kegiatan, prestasi terbaru, dan pengumuman resmi SMKS
        Muhammadiyah 1 Genteng.
      </p>
    </div>

    <div class="news-grid">
      <!-- Sidebar Category Filter -->
      <div class="news-filter-card">
        <h3 class="font-head" style="
                font-size: 1.15rem;
                color: var(--primary);
                margin-bottom: 1rem;
              ">
          Kategori Jurnal
        </h3>
        <ul class="news-filter-list">
          <li>
            <a href="javascript:void(0)" class="news-filter-link active" onclick="filterIndexNews('all', this)">Semua Berita <span>({{ $latestPosts->count() }})</span></a>
          </li>
          @foreach ($postCategories as $category)
          <li>
            <a href="javascript:void(0)" class="news-filter-link" onclick="filterIndexNews('{{ $category->slug }}', this)">{{ $category->name }} <span>({{ $latestPosts->where('category_id', $category->id)->count() }})</span></a>
          </li>
          @endforeach
        </ul>
      </div>

      <!-- Articles Grid -->
      <div class="news-cards-grid">
        @forelse ($latestPosts as $post)
        <!-- Article {{ $loop->iteration }} -->
        <div class="article-card" data-category="{{ $post->category?->slug }}">
          <div class="article-thumb"><img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}"
              style="width: 100%; height: 100%; object-fit: cover;"></div>
          <div class="article-body">
            <div>
              <span class="badge badge-primary mb-2" style="font-size: 0.75rem">{{ $post->published_date }}</span>
              <h3 class="font-head" style="
                      font-size: 1.15rem;
                      color: var(--primary);
                      margin: 0.4rem 0 0.6rem;
                      line-height: 1.35;
                    ">
                {{ $post->title }}
              </h3>
              <p style="
                      font-size: 0.88rem;
                      color: var(--text-muted);
                      line-height: 1.6;
                      margin-bottom: 1rem;
                    ">
                {{ $post->excerpt }}
              </p>
            </div>
            <a href="{{ route('berita') }}#{{ $post->id }}" style="
                    color: var(--secondary);
                    font-weight: 700;
                    font-size: 0.92rem;
                  ">Baca selengkapnya &rarr;</a>
          </div>
        </div>

        @empty
        <!-- Tampilan saat belum ada berita -->
        <div class="news-empty">
          <h3 class="news-empty-title">Belum ada berita</h3>
          <p class="news-empty-desc">Liputan dan kabar terbaru sekolah akan tampil di sini. Silakan kembali lagi nanti.</p>
        </div>
        @endforelse
      </div>
    </div>
  </div>
</section>

<!-- 13. FOOTER -->

@endsection