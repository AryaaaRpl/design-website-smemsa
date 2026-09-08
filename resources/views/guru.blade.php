@extends('layouts.app')

@section('content')

  <!-- Mobile Drawer -->

  <!-- Mobile Drawer -->
  <div class="mobile-overlay" id="mobile-overlay"></div>
  <div class="mobile-drawer" id="mobile-drawer">
    <button class="drawer-close" id="drawer-close-btn">×</button>
    <div class="brand-box" style="margin-bottom: 2rem">
      <img alt="Logo SMEMSA" class="brand-logo" onerror="
            this.closest('.card')
              ? this.closest('.card').classList.add('no-image')
              : null;
            this.remove();
          " src="{{ asset('assets/logo.webp') }}" />
      <div>
        <strong style="color: var(--primary); font-size: 1.1rem; display: block">SMEMSA GENTENG</strong>
        <small style="color: var(--text-muted); font-size: 0.75rem">NPSN 20525597 • Akreditasi A</small>
      </div>
    </div>
    <div class="drawer-links">
      <a class="" href="index.html#hero">🏠 Beranda</a>
      <div class="drawer-section-title">Halaman Informasi</div>
      <a class="" href="/bkk">💼 Bursa Kerja Khusus (BKK)</a>
      <a href="/visi-misi">🎯 Visi &amp; Misi Sekolah</a>
      <a href="/guru">👥 Guru &amp; Staff Karyawan</a>
      <a href="/fasilitas">🏢 Fasilitas Unggulan</a>
      <a href="/ekstrakurikuler">⚽ Ekstrakurikuler &amp; IPM</a>
      <a href="/prestasi">🏆 Prestasi &amp; Penghargaan</a>
      <a class="" href="/berita">📰 Jurnal &amp; Kabar Sekolah</a>
      <div class="drawer-section-title">Navigasi Halaman Utama</div>
      <a href="index.html#sambutan">👤 Sambutan Kepala Sekolah</a>
      <a href="index.html#jurusan">💻 7 Program Keahlian</a>
      <a class="" href="/lsp">📜 LSP-P1</a>
      <a href="index.html#blud">🏬 Unit Produksi BLUD</a>
      <div style="margin-top: 1.5rem">
        <a class="btn btn-primary" href="index.html#ppdb"
          style="width: 100%; text-align: center; justify-content: center">Daftar SPMB 2026</a>
      </div>
    </div>
  </div>

  <!-- 2. PAGE HEADER -->
  <header class="page-header" style="margin-bottom: 4rem">
    <div class="container">
      <span class="badge-gold">Tenaga Pendidik</span>
      <h1 class="page-title">Orang-Orang di Balik<br />Setiap Kompetensi.</h1>
      <p class="page-subtitle">
        Mengenal lebih dekat para pendidik inspiratif dan tenaga kependidikan
        dedikatif yang membimbing siswa-siswi SMKS Muhammadiyah 1 Genteng
        menuju prestasi gemilang.
      </p>
      <!-- Stats Strip -->
      <div style="
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2.5rem;
          ">
        <div style="text-align: center">
          <div class="header-stat-num" style="
                font-size: 2.5rem;
                font-weight: 800;
                font-family: var(--font-display);
                line-height: 1;
              ">
            24+
          </div>
          <div class="header-stat-label" style="
                font-size: 0.85rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                margin-top: 0.5rem;
              ">
            Guru Profesional
          </div>
        </div>
        <div class="header-stat-divider" style="width: 1px; background: rgba(255, 255, 255, 0.15)"></div>
        <div style="text-align: center">
          <div class="header-stat-num" style="
                font-size: 2.5rem;
                font-weight: 800;
                font-family: var(--font-display);
                line-height: 1;
              ">
            <span id="stat-k3">7</span>
          </div>
          <div class="header-stat-label" style="
                font-size: 0.85rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                margin-top: 0.5rem;
              ">
            Staff Karyawan
          </div>
        </div>
        <div class="header-stat-divider" style="width: 1px; background: rgba(255, 255, 255, 0.15)"></div>
        <div style="text-align: center">
          <div class="header-stat-num" style="
                font-size: 2.5rem;
                font-weight: 800;
                font-family: var(--font-display);
                line-height: 1;
              ">
            7
          </div>
          <div class="header-stat-label" style="
                font-size: 0.85rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                margin-top: 0.5rem;
              ">
            Konsentrasi Keahlian
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- STICKY NAV & SEARCH -->
  <div class="sticky-nav-container">
    <div class="container">
      <div style="
            display: flex;
            justify-content: center;
            gap: 0.8rem;
            flex-wrap: wrap;
          ">
        <a class="filter-btn" href="#pimpinan">Pimpinan</a>
        <a class="filter-btn" href="#k3">Kepala Konsentrasi</a>
        <a class="filter-btn" href="#guru">Guru</a>
        <a class="filter-btn" href="#tendik">Staff Karyawan</a>
      </div>
      <div class="search-wrapper">
        <input aria-label="Cari guru" class="search-input" id="guru-search" placeholder="Cari nama atau jabatan guru..."
          type="text" />
        <div aria-live="polite" class="sr-only" id="search-live-region" style="
              position: absolute;
              width: 1px;
              height: 1px;
              overflow: hidden;
              clip: rect(0, 0, 0, 0);
            "></div>
      </div>
    </div>
  </div>
  <!-- 3. PIMPINAN SEKOLAH -->
  <section class="container" id="pimpinan" style="margin-bottom: 5rem; scroll-margin-top: 150px">
    <div style="text-align: center; margin-top: 3rem; margin-bottom: 3rem">
      <div class="badge-primary" style="margin-bottom: 1rem">
        Manajemen Sekolah
      </div>
      <h2 class="section-title">Pimpinan Utama Sekolah</h2>
      <div style="
            width: 60px;
            height: 4px;
            background: var(--secondary);
            margin: 1rem auto 0;
            border-radius: 2px;
          "></div>
    </div>
    <!-- Struktur 1: Layout 2 Card (Kepsek: Foto di Kiri | Wakasek: Foto di Kanan) -->
    <div class="struktur1-grid" id="pimpinan-utama-container"></div>
    <!-- Guru Pemimpin Lainnya dengan Struktur 2 (Scrollbar Menyamping) -->
    <div style="margin-top: 3.5rem">
      <div style="
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.2rem;
            flex-wrap: wrap;
            gap: 0.5rem;
          ">
        <h3 style="
              font-family: var(--font-head);
              font-size: 1.25rem;
              font-weight: 800;
              color: var(--primary-dark);
              display: flex;
              align-items: center;
              gap: 0.5rem;
            ">
          Guru Pemimpin &amp; Waka Lainnya
        </h3>
      </div>
      <div class="struktur2-scroll-wrapper">
        <div class="struktur2-scroll-container" id="wakasek-container"></div>
      </div>
    </div>
  </section>
  <!-- KEPALA KONSENTRASI KEAHLIAN -->
  <section class="container" id="k3" style="margin-bottom: 5rem; scroll-margin-top: 150px">
    <div style="
          display: flex;
          align-items: center;
          justify-content: space-between;
          margin-bottom: 1.5rem;
          flex-wrap: wrap;
          gap: 1rem;
        ">
      <div>
        <div class="badge-primary" style="margin-bottom: 0.5rem">
          Ketua Program
        </div>
        <h2 class="section-title" style="text-align: left">
          Kepala Konsentrasi Keahlian
        </h2>
        <p style="color: var(--text-muted); margin-top: 0.3rem">
          Penanggung jawab tiap program keahlian vokasi
        </p>
      </div>
    </div>
    <div class="struktur2-scroll-wrapper">
      <div class="struktur2-scroll-container" id="k3-container"></div>
    </div>
  </section>
  <!-- 4. GURU & PENDIDIK -->
  <section class="container" id="guru" style="margin-bottom: 5rem; scroll-margin-top: 150px">
    <div style="
          display: flex;
          align-items: center;
          justify-content: space-between;
          margin-bottom: 1.5rem;
          flex-wrap: wrap;
          gap: 1rem;
        ">
      <div>
        <div class="badge-primary" style="margin-bottom: 0.5rem">
          Tenaga Pengajar
        </div>
        <h2 class="section-title" style="text-align: left">
          Guru &amp; Pendidik
        </h2>
        <p style="color: var(--text-muted); margin-top: 0.3rem">
          Pendidik inspiratif bidang keahlian dan mata pelajaran umum
        </p>
      </div>
    </div>
    <div class="struktur2-scroll-wrapper">
      <div class="struktur2-scroll-container" id="guru-container"></div>
    </div>
  </section>
  <!-- 5. TENAGA KEPENDIDIKAN -->
  <section class="container" id="tendik" style="margin-bottom: 5rem; scroll-margin-top: 150px">
    <div style="
          display: flex;
          align-items: center;
          justify-content: space-between;
          margin-bottom: 1.5rem;
          flex-wrap: wrap;
          gap: 1rem;
        ">
      <div>
        <div class="badge-primary" style="margin-bottom: 0.5rem">
          Staff Karyawan & Petugas
        </div>
        <h2 class="section-title" style="text-align: left">
          Staff Karyawan
        </h2>
        <p style="color: var(--text-muted); margin-top: 0.3rem">
          Staf Karyawan &amp; administrasi sekolah
        </p>
      </div>
    </div>
    <div class="struktur2-scroll-wrapper">
      <div class="struktur2-scroll-container" id="tendik-container"></div>
    </div>
  </section>
  <noscript>
    <div class="container" style="
          padding: 2rem;
          background: #fff3cd;
          color: #856404;
          border-radius: 8px;
          margin-bottom: 2rem;
        ">
      <strong>Perhatian:</strong> JavaScript dinonaktifkan di browser Anda.
      Berikut adalah daftar guru dan tenaga kependidikan SMKS Muhammadiyah 1
      Genteng:

      <h3 style="margin-top: 1.5rem">Pimpinan Sekolah</h3>
      <ul style="padding-left: 1.5rem">
        <li><strong>Wuri Handayani, S.E</strong> - BENDAHARA SEKOLAH</li>
        <li><strong>Misrok, A.Md</strong> - KEPALA TU</li>
        <li><strong>Nur Rohman, M.Pd</strong> - MUTU</li>
        <li>
          <strong>Wahid Wahyudi, S.Ag., M.Pd</strong> - PEMBINA UTAMA (PU)
        </li>
        <li><strong>Drei herba Ta'abudi. M.Hum</strong> - WAKA HUMAS</li>
        <li><strong>Siti Muawanah, S.Pd.</strong> - WAKA ISMUBA</li>
        <li><strong>Muh. Najib Rosi, S.Pd</strong> - WAKA KESISWAAN</li>
        <li><strong>Latifah ambarwati, S.Pd</strong> - WAKA KURIKULUM</li>
        <li><strong>Shulhi Firdaus, S.Kom</strong> - WAKA SAPRAS</li>
        <li><strong>Aan Cahyanto Sri Setyo, M.Pd</strong> - WAKIL KS</li>
      </ul>
      <h3 style="margin-top: 1.5rem">Kepala Konsentrasi Keahlian</h3>
      <ul style="padding-left: 1.5rem">
        <li>
          <strong>Dedy Wijanarko, SST.,Par.,S.Pd</strong> - Ketua Program
        </li>
        <li><strong>Dinda Nurmawati, S.Kom</strong> - Ketua Program</li>
        <li><strong>Marita NurLailaty, S.Pd</strong> - Ketua Program</li>
        <li>
          <strong>Moh. Ihya' Nur Ulumuddin, S.Kom.</strong> - Ketua Program
        </li>
        <li><strong>Suci Fitria N., S.Pd</strong> - Ketua Program</li>
        <li><strong>Teguh Santosa, S.Kom</strong> - Ketua Program</li>
        <li><strong>Tri Wahyu S, S.Pd</strong> - Ketua Program</li>
      </ul>
      <h3 style="margin-top: 1.5rem">Guru &amp; Pendidik</h3>
      <ul style="padding-left: 1.5rem">
        <li>
          <strong>Ainun Nisa, S.E</strong> - Kewirausahaan / Bisnis Digital
        </li>
        <li><strong>Akmal, S.Kom.</strong> - Produktif Kejuruan IT</li>
        <li>
          <strong>Ana Fitriani, S.Tr.Par.</strong> - Produktif Perhotelan
        </li>
        <li><strong>Anis Soraya, S.Pd.</strong> - Mata Pelajaran Umum</li>
        <li>
          <strong>Devi Ariya Sinta, S.Tr. Par</strong> - Guru Mata Pelajaran
        </li>
        <li>
          <strong>Dina Istiningrum, S.Pd.</strong> - Mata Pelajaran Umum
        </li>
        <li><strong>Dwi Puspitasari, S.Pd</strong> - Mata Pelajaran Umum</li>
        <li>
          <strong>Dwi Santi Y, S.Sos.,S.Pd.,M.Pd</strong> - Mata Pelajaran
          Umum
        </li>
        <li><strong>Endah Dila K., S.Kom</strong> - Produktif Kejuruan IT</li>
        <li><strong>Hafidz Azhari, S.Pd.</strong> - Mata Pelajaran Umum</li>
        <li><strong>Hamamatul Baidhok,S,Pd</strong> - Guru Mata Pelajaran</li>
        <li><strong>Irva Maftukha, S.Pd</strong> - Mata Pelajaran Umum</li>
        <li><strong>Karyono, S.Pd.I</strong> - Pendidikan Agama Islam</li>
        <li><strong>Kukuh Hartanto, S.Pd</strong> - Mata Pelajaran Umum</li>
        <li><strong>Ledy Kus Raharjo, S.Pd</strong> - Mata Pelajaran Umum</li>
        <li>
          <strong>Liya ayu Destiana, S.Tr.Par</strong> - Produktif Perhotelan
        </li>
        <li><strong>Lutfia Rachmah, S.Psi</strong> - Guru Mata Pelajaran</li>
        <li><strong>M.Saifulloh, S.Kom</strong> - Produktif Kejuruan IT</li>
        <li>
          <strong>Muhammad Andri Subakti, S.Pd.</strong> - Mata Pelajaran Umum
        </li>
        <li>
          <strong>Nalida Rahmi Sekar Arum, S.Pd.</strong> - Mata Pelajaran
          Umum
        </li>
        <li><strong>Nuraini Latifa, S.Pd</strong> - Mata Pelajaran Umum</li>
        <li><strong>Rausyan Risyda, S.Pd</strong> - Mata Pelajaran Umum</li>
        <li>
          <strong>Rifki Ahmad Fauzi Hasan, S.Tr.Par</strong> - Produktif
          Perhotelan
        </li>
        <li>
          <strong>Rita Andria Betrix, S.Pd</strong> - Mata Pelajaran Umum
        </li>
        <li><strong>Serli Nur Aini, S.Pd</strong> - Mata Pelajaran Umum</li>
        <li><strong>Siti Nur Rohmah, S.Pd</strong> - Mata Pelajaran Umum</li>
        <li><strong>Sri Wahyuni, S.Pd</strong> - Mata Pelajaran Umum</li>
        <li><strong>Ulfatun Nikmah, S.Pd</strong> - Mata Pelajaran Umum</li>
        <li>
          <strong>Warokoh Ibnu Noval, S.Pd</strong> - Mata Pelajaran Umum
        </li>
      </ul>
      <h3 style="margin-top: 1.5rem">Staff Karyawan</h3>
      <ul style="padding-left: 1.5rem">
        <li><strong>Agus Supriyono</strong> - Staff Karyawan</li>
        <li><strong>Andi Sukono</strong> - Staff Karyawan</li>
        <li><strong>Ariel Nuristian Putra</strong> - Staff Karyawan</li>
        <li><strong>Beni Putra Iskandar</strong> - Staff Karyawan</li>
        <li><strong>Bibit Wahyudi</strong> - Staff Karyawan</li>
        <li>
          <strong>Cheppy Sukmawardhana, S.T.</strong> - Staff Karyawan
        </li>
        <li><strong>Darmaji</strong> - Staff Karyawan</li>
        <li><strong>Didit Eko Priyantoro</strong> - Staff Karyawan</li>
        <li><strong>Edy Kuswanto</strong> - Staff Karyawan</li>
        <li><strong>Fandie Eko Prasetiyo</strong> - Staff Karyawan</li>
        <li><strong>Nama menyusul</strong> - Staff Karyawan</li>
        <li><strong>Nama menyusul</strong> - Staff Karyawan</li>
        <li><strong>Moch. Afif Aliyansyah</strong> - Staff Karyawan</li>
        <li>
          <strong>Prayoga Krisna Febri Aji</strong> - Staff Karyawan
        </li>
        <li><strong>Rahmat Viky Susanto</strong> - Staff Karyawan</li>
        <li><strong>Rudi Hariyanto</strong> - Staff Karyawan</li>
      </ul>
    </div>
  </noscript>
  <button aria-label="Kembali ke atas" id="backToTopBtn" title="Kembali ke atas">
    <svg fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
      <path d="m18 15-6-6-6 6"></path>
    </svg>
  </button>
  <!-- FOOTER -->

@endsection
