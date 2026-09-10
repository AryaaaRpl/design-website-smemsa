@extends('layouts.app')

@section('content')

  <!-- 2. PAGE HEADER -->
  <header class="page-header" style="margin-bottom: 4rem">
    <div class="hero-bg-art" aria-hidden="true">
      <img src="{{ asset('assets/guru/trio.jpeg') }}" alt="" class="hero-bg-img" />
      <div class="hero-bg-overlay"></div>
    </div>
    <div class="container" style="position: relative; z-index: 2;">
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

@push('scripts')
  <script>
    const guruData = [
      {
        nama: "Wuri Handayani, S.E",
        jabatan: "BENDAHARA SEKOLAH",
        kategori: "pimpinan",
        foto: "assets/guru/kategori-pimpinan/BENDAHARA SEKOLAH - Wuri Handayani, S.E.webp",
      },
      {
        nama: "Misrok, A.Md",
        jabatan: "KEPALA TU",
        kategori: "pimpinan",
        foto: "assets/guru/kategori-pimpinan/KEPALA TU - Misrok, A.Md.webp",
      },
      {
        nama: "Nur Rohman, M.Pd",
        jabatan: "MUTU",
        kategori: "pimpinan",
        foto: "assets/guru/kategori-pimpinan/MUTU - Nur Rohman, M.Pd.webp",
      },
      {
        nama: "Wahid Wahyudi, S.Ag., M.Pd",
        jabatan: "PEMBINA UTAMA (PU)",
        kategori: "pimpinan",
        foto: "assets/PAK-WAHID-AI-e1781064934191.png",
      },
      {
        nama: "Drei herba Ta'abudi. M.Hum",
        jabatan: "WAKA HUMAS",
        kategori: "pimpinan",
        foto: "assets/guru/kategori-pimpinan/WAKA HUMAS - Drei herba Ta'abudi. M.Hum.webp",
      },
      {
        nama: "Siti Muawanah, S.Pd.",
        jabatan: "WAKA ISMUBA",
        kategori: "pimpinan",
        foto: "assets/guru/kategori-pimpinan/WAKA ISMUBA - Siti Muawanah, S.Pd..webp",
      },
      {
        nama: "Muh. Najib Rosi, S.Pd",
        jabatan: "WAKA KESISWAAN",
        kategori: "pimpinan",
        foto: "assets/guru/kategori-pimpinan/WAKA KESISWAAN - Muh. Najib Rosi, S.Pd.webp",
      },
      {
        nama: "Latifah ambarwati, S.Pd",
        jabatan: "WAKA KURIKULUM",
        kategori: "pimpinan",
        foto: "assets/guru/kategori-pimpinan/WAKA KURIKULUM - Latifah ambarwati, S.Pd.webp",
      },
      {
        nama: "Shulhi Firdaus, S.Kom",
        jabatan: "WAKA SAPRAS",
        kategori: "pimpinan",
        foto: "assets/guru/kategori-pimpinan/WAKA SAPRAS- Shulhi Firdaus, S.Kom.webp",
      },
      {
        nama: "Aan Cahyanto Sri Setyo, M.Pd",
        jabatan: "WAKIL KS",
        kategori: "pimpinan",
        foto: "assets/guru/kategori-pimpinan/WAKIL KS - Aan Cahyanto Sri Setyo, M.Pd.webp",
      },
      {
        nama: "Dedy Wijanarko, SST.,Par.,S.Pd",
        jabatan: "Ketua Program",
        kategori: "k3",
        foto: "assets/guru/kategori-k3/Dedy Wijanarko, SST.,Par.,S.Pd.webp",
      },
      {
        nama: "Dinda Nurmawati, S.Kom",
        jabatan: "Ketua Program",
        kategori: "k3",
        foto: "assets/guru/kategori-k3/Dinda Nurmawati, S.Kom.webp",
      },
      {
        nama: "Marita NurLailaty, S.Pd",
        jabatan: "Ketua Program",
        kategori: "k3",
        foto: "assets/guru/kategori-k3/Marita NurLailaty, S.Pd.webp",
      },
      {
        nama: "Moh. Ihya' Nur Ulumuddin, S.Kom.",
        jabatan: "Ketua Program",
        kategori: "k3",
        foto: "assets/guru/kategori-k3/Moh. Ihya' Nur Ulumuddin, S.Kom..webp",
      },
      {
        nama: "Suci Fitria N., S.Pd",
        jabatan: "Ketua Program",
        kategori: "k3",
        foto: "assets/guru/kategori-k3/Suci Fitria N., S.Pd.webp",
      },
      {
        nama: "Teguh Santosa, S.Kom",
        jabatan: "Ketua Program",
        kategori: "k3",
        foto: "assets/guru/kategori-k3/Teguh Santosa, S.Kom.webp",
      },
      {
        nama: "Tri Wahyu S, S.Pd",
        jabatan: "Ketua Program",
        kategori: "k3",
        foto: "assets/guru/kategori-k3/Tri Wahyu S, S.Pd.webp",
      },
      {
        nama: "Ainun Nisa, S.E",
        jabatan: "Kewirausahaan / Bisnis Digital",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Ainun Nisa, S.E.webp",
      },
      {
        nama: "Akmal, S.Kom.",
        jabatan: "Produktif Kejuruan IT",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Akmal, S.Kom..webp",
      },
      {
        nama: "Ana Fitriani, S.Tr.Par.",
        jabatan: "Produktif Perhotelan",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Ana Fitriani, S.Tr.Par..webp",
      },
      {
        nama: "Anis Soraya, S.Pd.",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Anis Soraya, S.Pd..webp",
      },
      {
        nama: "Devi Ariya Sinta, S.Tr. Par",
        jabatan: "Guru Mata Pelajaran",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Devi Ariya Sinta, S.Tr. Par.webp",
      },
      {
        nama: "Dina Istiningrum, S.Pd.",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Dina Istiningrum, S.Pd..webp",
      },
      {
        nama: "Dwi Puspitasari, S.Pd",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Dwi Puspitasari, S.Pd.webp",
      },
      {
        nama: "Dwi Santi Y, S.Sos.,S.Pd.,M.Pd",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Dwi Santi Y, S.Sos.,S.Pd.,M.Pd.webp",
      },
      {
        nama: "Endah Dila K., S.Kom",
        jabatan: "Produktif Kejuruan IT",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Endah Dila K., S.Kom.webp",
      },
      {
        nama: "Hafidz Azhari, S.Pd.",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Hafidz Azhari, S.Pd..webp",
      },
      {
        nama: "Hamamatul Baidhok,S,Pd",
        jabatan: "Guru Mata Pelajaran",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Hamamatul Baidhok,S,Pd.webp",
      },
      {
        nama: "Irva Maftukha, S.Pd",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Irva Maftukha, S.Pd.webp",
      },
      {
        nama: "Karyono, S.Pd.I",
        jabatan: "Pendidikan Agama Islam",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Karyono, S.Pd.I.webp",
      },
      {
        nama: "Kukuh Hartanto, S.Pd",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Kukuh Hartanto, S.Pd.webp",
      },
      {
        nama: "Ledy Kus Raharjo, S.Pd",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Ledy Kus Raharjo, S.Pd.webp",
      },
      {
        nama: "Liya ayu Destiana, S.Tr.Par",
        jabatan: "Produktif Perhotelan",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Liya ayu Destiana, S.Tr.Par.webp",
      },
      {
        nama: "Lutfia Rachmah, S.Psi",
        jabatan: "Guru Mata Pelajaran",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Lutfia Rachmah, S.Psi.webp",
      },
      {
        nama: "M.Saifulloh, S.Kom",
        jabatan: "Produktif Kejuruan IT",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/M.Saifulloh, S.Kom.webp",
      },
      {
        nama: "Muhammad Andri Subakti, S.Pd.",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Muhammad Andri Subakti, S.Pd..webp",
      },
      {
        nama: "Nalida Rahmi Sekar Arum, S.Pd.",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Nalida Rahmi Sekar Arum, S.Pd..webp",
      },
      {
        nama: "Nuraini Latifa, S.Pd",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Nuraini Latifa, S.Pd.webp",
      },
      {
        nama: "Rausyan Risyda, S.Pd",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Rausyan Risyda, S.Pd.webp",
      },
      {
        nama: "Rifki Ahmad Fauzi Hasan, S.Tr.Par",
        jabatan: "Produktif Perhotelan",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Rifki Ahmad Fauzi Hasan, S.Tr.Par.webp",
      },
      {
        nama: "Rita Andria Betrix, S.Pd",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Rita Andria Betrix, S.Pd.webp",
      },
      {
        nama: "Serli Nur Aini, S.Pd",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Serli Nur Aini, S.Pd.webp",
      },
      {
        nama: "Siti Nur Rohmah, S.Pd",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Siti Nur Rohmah, S.Pd.webp",
      },
      {
        nama: "Sri Wahyuni, S.Pd",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Sri Wahyuni, S.Pd.webp",
      },
      {
        nama: "Ulfatun Nikmah, S.Pd",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Ulfatun Nikmah, S.Pd.webp",
      },
      {
        nama: "Warokoh Ibnu Noval, S.Pd",
        jabatan: "Mata Pelajaran Umum",
        kategori: "guru",
        foto: "assets/guru/kategori-guru/Warokoh Ibnu Noval, S.Pd.webp",
      },
      {
        nama: "Agus Supriyono",
        jabatan: "Staff Karyawan",
        kategori: "tendik",
        foto: "assets/guru/kategori-karyawan/Agus Supriyono.webp",
      },
      {
        nama: "Andi Sukono",
        jabatan: "Staff Karyawan",
        kategori: "tendik",
        foto: "assets/guru/kategori-karyawan/Andi Sukono.webp",
      },
      {
        nama: "Ariel Nuristian Putra",
        jabatan: "Staff Karyawan",
        kategori: "tendik",
        foto: "assets/guru/kategori-karyawan/Ariel Nuristian Putra.webp",
      },
      {
        nama: "Beni Putra Iskandar",
        jabatan: "Staff Karyawan",
        kategori: "tendik",
        foto: "assets/guru/kategori-karyawan/Beni Putra Iskandar.webp",
      },
      {
        nama: "Bibit Wahyudi",
        jabatan: "Staff Karyawan",
        kategori: "tendik",
        foto: "assets/guru/kategori-karyawan/Bibit Wahyudi.webp",
      },
      {
        nama: "Cheppy Sukmawardhana, S.T.",
        jabatan: "Staff Karyawan",
        kategori: "tendik",
        foto: "assets/guru/kategori-karyawan/Cheppy Sukmawardhana, S.T..webp",
      },
      {
        nama: "Darmaji",
        jabatan: "Staff Karyawan",
        kategori: "tendik",
        foto: "assets/guru/kategori-karyawan/Darmaji.webp",
      },
      {
        nama: "Didit Eko Priyantoro",
        jabatan: "Staff Karyawan",
        kategori: "tendik",
        foto: "assets/guru/kategori-karyawan/Didit Eko Priyantoro.webp",
      },
      {
        nama: "Edy Kuswanto",
        jabatan: "Staff Karyawan",
        kategori: "tendik",
        foto: "assets/guru/kategori-karyawan/Edy Kuswanto.webp",
      },
      {
        nama: "Fandie Eko Prasetiyo",
        jabatan: "Staff Karyawan",
        kategori: "tendik",
        foto: "assets/guru/kategori-karyawan/Fandie Eko Prasetiyo.webp",
      },
      {
        nama: "Nama menyusul",
        jabatan: "Staff Karyawan",
        kategori: "tendik",
        foto: "assets/guru/kategori-karyawan/IMGL4229.webp",
      },
      {
        nama: "Nama menyusul",
        jabatan: "Staff Karyawan",
        kategori: "tendik",
        foto: "assets/guru/kategori-karyawan/IMGL4284.webp",
      },
      {
        nama: "Moch. Afif Aliyansyah",
        jabatan: "Staff Karyawan",
        kategori: "tendik",
        foto: "assets/guru/kategori-karyawan/Moch. Afif Aliyansyah.webp",
      },
      {
        nama: "Prayoga Krisna Febri Aji",
        jabatan: "Staff Karyawan",
        kategori: "tendik",
        foto: "assets/guru/kategori-karyawan/Prayoga Krisna Febri Aji.webp",
      },
      {
        nama: "Rahmat Viky Susanto",
        jabatan: "Staff Karyawan",
        kategori: "tendik",
        foto: "assets/guru/kategori-karyawan/Rahmat Viky Susanto.webp",
      },
      {
        nama: "Rudi Hariyanto",
        jabatan: "Staff Karyawan",
        kategori: "tendik",
        foto: "assets/guru/kategori-karyawan/Rudi Hariyanto.webp",
      },
    ];

    function createFallbackImage(name) {
      let n = name !== "Nama menyusul" ? name : "NN";
      const initials = n
        .split(" ")
        .map((part) => part[0])
        .slice(0, 2)
        .join("")
        .toUpperCase();
      return `<div style="width:100%; height:100%; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #fff; font-family: var(--font-display); font-weight: 800;">${initials}</div>`;
    }

    function createCardHTML(guru) {
      let imgHTML = `<img src="/${guru.foto}" alt="Foto ${guru.nama}, ${guru.jabatan}" class="guru-img" loading="lazy" onerror="this.outerHTML=createFallbackImage('${guru.nama.replace(/'/g, "\\'")}')">`;

      let badgeHTML = "";
      let linkHTML = "";
      if (guru.kategori === "k3") {
        let major =
          guru.jabatan !== "Ketua Program" ? guru.jabatan : "Konsentrasi";
        if (guru.nama.includes("Dinda")) major = "PPLG";
        else if (guru.nama.includes("Dedy")) major = "Perhotelan";
        else if (guru.nama.includes("Marita")) major = "AKL";
        else if (guru.nama.includes("Ihya")) major = "DKV";
        else if (guru.nama.includes("Suci")) major = "Bisnis Digital";
        else if (guru.nama.includes("Teguh")) major = "TJKT";
        else if (guru.nama.includes("Tri Wahyu")) major = "MPLB";
        else major = guru.jabatan;

        badgeHTML = `<div style="position: absolute; top: 1rem; right: 1rem; background: var(--secondary); color: #fff; padding: 0.3rem 0.8rem; border-radius: 20px; font-weight: 700; font-size: 0.75rem; z-index: 10;">${major}</div>`;
        linkHTML = `<a href="index.html#jurusan" style="display: block; font-size: 0.75rem; color: var(--secondary); font-weight: 700; margin-top: 0.5rem;">Lihat alur karier jurusan ini &rarr;</a>`;
      }

      return `
            <div class="guru-card">
                <div class="guru-img-wrap">
                    ${badgeHTML}
                    ${imgHTML}
                    <div class="guru-overlay"></div>
                </div>
                <div class="guru-info">
                    <div class="guru-name">${guru.nama}</div>
                    <div class="guru-jabatan">${guru.kategori === "k3" ? "Kepala Konsentrasi " + (guru.jabatan !== "Ketua Program" ? guru.jabatan : "") : guru.jabatan}</div>
                    ${linkHTML}
                </div>
            </div>`;
    }

    function renderGuru(dataToRender = guruData) {
      const utamaContainer = document.getElementById(
        "pimpinan-utama-container",
      );
      const wakasekContainer = document.getElementById("wakasek-container");
      const k3Container = document.getElementById("k3-container");
      const guruContainer = document.getElementById("guru-container");
      const tendikContainer = document.getElementById("tendik-container");

      let kepsekCardHTML = "";
      let wakasekCardHTML = "";
      let wakasekHTML = "";
      let k3HTML = "";
      let guruHTML = "";
      let tendikHTML = "";

      if (utamaContainer) utamaContainer.innerHTML = "";

      dataToRender.forEach((guru) => {
        if (guru.kategori === "pimpinan") {
          if (
            guru.nama.includes("Wahid Wahyudi") ||
            guru.nama.includes("Aan Cahyanto")
          ) {
            let isKepsek = guru.nama.includes("Wahid Wahyudi");
            let quote = isKepsek
              ? "Berkomitmen mencetak lulusan yang kompeten di bidangnya, berkarakter Islami, dan siap bersaing di era digital melalui pendidikan vokasi yang bermutu."
              : "Mengawal seluruh program unggulan dengan kedisiplinan dan inovasi tiada henti untuk pencapaian keunggulan bersama.";
            let title = isKepsek
              ? "Kepala SMKS Muhammadiyah 1 Genteng"
              : "Wakil Kepala Sekolah";

            if (isKepsek) {
              kepsekCardHTML = `
                  <div class="struktur1-card kepsek-card">
                    <div class="struktur1-img-wrap">
                      <img src="${guru.foto}" alt="Foto ${guru.nama}" class="struktur1-img" onerror="this.closest('.card') ? this.closest('.card').classList.add('no-image') : null; this.remove();">
                    </div>
                    <div class="struktur1-body">
                      <div class="struktur1-name">${guru.nama}</div>
                      <div class="struktur1-role">${title}</div>
                      <div class="struktur1-desc">"${quote}"</div>
                    </div>
                  </div>`;
            } else {
              wakasekCardHTML = `
                  <div class="struktur1-card wakasek-card">
                    <div class="struktur1-body">
                      <div class="struktur1-name">${guru.nama}</div>
                      <div class="struktur1-role">${title}</div>
                      <div class="struktur1-desc">"${quote}"</div>
                    </div>
                    <div class="struktur1-img-wrap">
                      <img src="${guru.foto}" alt="Foto ${guru.nama}" class="struktur1-img" onerror="this.closest('.card') ? this.closest('.card').classList.add('no-image') : null; this.remove();">
                    </div>
                  </div>`;
            }
          } else {
            wakasekHTML += createCardHTML(guru);
          }
        } else if (guru.kategori === "k3") {
          k3HTML += createCardHTML(guru);
        } else if (guru.kategori === "guru") {
          guruHTML += createCardHTML(guru);
        } else if (guru.kategori === "tendik") {
          tendikHTML += createCardHTML(guru);
        }
      });

      if (utamaContainer) {
        utamaContainer.innerHTML = kepsekCardHTML + wakasekCardHTML;
      }
      if (wakasekContainer)
        wakasekContainer.innerHTML =
          wakasekHTML ||
          '<p style="color:var(--text-muted); font-size:0.9rem; padding:1rem;">Tidak ada profil ditemukan.</p>';
      if (k3Container)
        k3Container.innerHTML =
          k3HTML ||
          '<p style="color:var(--text-muted); font-size:0.9rem; padding:1rem;">Tidak ada profil ditemukan.</p>';
      if (guruContainer)
        guruContainer.innerHTML =
          guruHTML ||
          '<p style="color:var(--text-muted); font-size:0.9rem; padding:1rem;">Tidak ada profil ditemukan.</p>';
      if (tendikContainer)
        tendikContainer.innerHTML =
          tendikHTML ||
          '<p style="color:var(--text-muted); font-size:0.9rem; padding:1rem;">Tidak ada profil ditemukan.</p>';

      // --- MULAI AUTO-SCROLL CAROUSEL ---
      if (window.autoScrollInstances) {
        window.autoScrollInstances.forEach((rafId) => cancelAnimationFrame(rafId));
      }
      window.autoScrollInstances = [];

      if (window.autoScrollAbortController) {
        window.autoScrollAbortController.abort();
      }
      window.autoScrollAbortController = new AbortController();
      const signal = window.autoScrollAbortController.signal;

      const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

      function setupAutoScroll(containerId, speed, reverse = false, isSearch = false) {
        const container = document.getElementById(containerId);
        if (!container || container.innerHTML.includes("Tidak ada profil ditemukan")) return;

        const wrapper = container.closest(".struktur2-scroll-wrapper");
        if (!wrapper) return;

        let btn = wrapper.querySelector(".auto-scroll-btn");
        if (isSearch) {
          if (btn) btn.remove();
          return;
        }

        // Gandakan konten untuk efek infinite scroll
        const originalChildren = Array.from(container.children);
        if (originalChildren.length === 0) return;

        originalChildren.forEach(child => {
          const clone = child.cloneNode(true);
          clone.setAttribute("aria-hidden", "true");
          container.appendChild(clone);
        });

        if (prefersReducedMotion || window.innerWidth < 768) return;

        if (!btn) {
          btn = document.createElement("button");
          btn.className = "auto-scroll-btn";
          btn.style.cssText = "position:absolute; top:10px; right:10px; width:44px; height:44px; border-radius:50%; background:var(--primary); color:#fff; border:none; z-index:10; cursor:pointer; display:flex; align-items:center; justify-content:center; box-shadow:var(--shadow-card); transition:var(--transition);";
          wrapper.appendChild(btn);
        }
        let isPausedByBtn = false;

        function updateBtn() {
          if (isPausedByBtn) {
            btn.setAttribute("aria-label", "Lanjutkan gulir otomatis");
            btn.innerHTML = `<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>`;
          } else {
            btn.setAttribute("aria-label", "Jeda gulir otomatis");
            btn.innerHTML = `<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M6 4h4v16H6zm8 0h4v16h-4z"/></svg>`;
          }
        }
        updateBtn();

        let state = {
          hovered: false,
          focused: false,
          interacting: false,
        };
        let interactionTimeout;

        container.classList.add('is-autoscroll');

        function togglePause() {
          isPausedByBtn = !isPausedByBtn;
          updateBtn();
          if (isPausedByBtn) {
            container.classList.remove('is-autoscroll');
          } else {
            container.classList.add('is-autoscroll');
          }
        }

        btn.addEventListener("click", togglePause, { signal });

        wrapper.addEventListener("mouseenter", () => { state.hovered = true; }, { signal });
        wrapper.addEventListener("mouseleave", () => { state.hovered = false; }, { signal });
        wrapper.addEventListener("focusin", () => { state.focused = true; }, { signal });
        wrapper.addEventListener("focusout", () => { state.focused = false; }, { signal });

        let isDragging = false;
        let startX;
        let startScrollLeft;

        const interactionStart = () => {
          state.interacting = true;
          container.classList.remove('is-autoscroll');
          clearTimeout(interactionTimeout);
        };

        const mouseStart = (e) => {
          interactionStart();
          isDragging = true;
          startX = e.pageX;
          startScrollLeft = container.scrollLeft;
          container.style.cursor = 'grabbing';
        };

        const mouseMove = (e) => {
          if (!isDragging) return;
          e.preventDefault();
          const walk = (e.pageX - startX) * 1.5;
          container.scrollLeft = startScrollLeft - walk;
          pos = container.scrollLeft;
        };

        const interactionEnd = () => {
          isDragging = false;
          container.style.cursor = '';
          interactionTimeout = setTimeout(() => {
            state.interacting = false;
            if (!isPausedByBtn) {
              container.classList.add('is-autoscroll');
            }
          }, 2000);
        };

        wrapper.addEventListener("mousedown", mouseStart, { signal });
        wrapper.addEventListener("mousemove", mouseMove, { signal });
        wrapper.addEventListener("mouseup", interactionEnd, { signal });
        wrapper.addEventListener("mouseleave", () => {
          if (isDragging) interactionEnd();
          state.hovered = false;
        }, { signal });

        wrapper.addEventListener("touchstart", interactionStart, { passive: true, signal });
        wrapper.addEventListener("touchend", interactionEnd, { passive: true, signal });
        wrapper.addEventListener("touchcancel", interactionEnd, { passive: true, signal });

        // Calculate exact reset point distance
        const firstOriginal = originalChildren[0];
        const firstClone = container.children[originalChildren.length];
        // Determine the pixel distance we need to travel for a full loop
        let resetPoint = 0;

        let raf;
        function step() {
          if (resetPoint === 0 && firstClone && firstOriginal) {
            // wait for layout to be ready
            const dist = firstClone.offsetLeft - firstOriginal.offsetLeft;
            if (dist > 0) {
              resetPoint = dist;
              if (reverse) pos = resetPoint;
            }
          }

          const shouldPause = isPausedByBtn || state.hovered || state.focused || state.interacting || document.visibilityState !== 'visible';

          if (!shouldPause && resetPoint > 0) {
            pos += reverse ? -speed : speed;
            if (pos >= resetPoint) pos -= resetPoint;
            if (pos < 0) pos += resetPoint;
            container.scrollLeft = pos;
          }
          raf = requestAnimationFrame(step);
        }

        let pos = 0; // will be set correctly when resetPoint is found
        raf = requestAnimationFrame(step);
        window.autoScrollInstances.push(raf);
      }

      requestAnimationFrame(() => {
        const isSearch = dataToRender !== guruData;
        setupAutoScroll("wakasek-container", 0.4, false, isSearch);
        setupAutoScroll("k3-container", 0.4, true, isSearch);
        setupAutoScroll("guru-container", 0.4, false, isSearch);
        setupAutoScroll("tendik-container", 0.4, true, isSearch);
      });
      // --- SELESAI AUTO-SCROLL CAROUSEL ---

      // Update stats
      const statGuru = document.getElementById("stat-guru");
      const statTendik = document.getElementById("stat-tendik");
      const statK3 = document.getElementById("stat-k3");

      if (statGuru)
        statGuru.innerText = dataToRender.filter(
          (g) => g.kategori === "guru" || g.kategori === "pimpinan",
        ).length;
      if (statTendik)
        statTendik.innerText = dataToRender.filter(
          (g) => g.kategori === "tendik",
        ).length;
      if (statK3)
        statK3.innerText = dataToRender.filter(
          (g) => g.kategori === "k3",
        ).length;
    }

    document.addEventListener("DOMContentLoaded", () => {
      renderGuru();

      const searchInput = document.getElementById("guru-search");
      const ariaLive = document.getElementById("search-live-region");
      if (searchInput) {
        searchInput.addEventListener("input", (e) => {
          const q = e.target.value.toLowerCase();
          const filtered = guruData.filter(
            (g) =>
              g.nama.toLowerCase().includes(q) ||
              g.jabatan.toLowerCase().includes(q),
          );
          renderGuru(filtered);

          if (ariaLive) {
            ariaLive.innerText = `Menampilkan ${filtered.length} profil`;
          }
        });
      }

      // Back to top
      const btt = document.getElementById("backToTopBtn");
      if (btt) {
        window.addEventListener("scroll", () => {
          if (window.scrollY > 600) {
            btt.style.display = "flex";
            btt.style.opacity = "1";
          } else {
            btt.style.opacity = "0";
            setTimeout(() => {
              if (window.scrollY <= 600) btt.style.display = "none";
            }, 300);
          }
        });
        btt.addEventListener("click", () => {
          if (window.lenis) lenis.scrollTo(0);
          else window.scrollTo({ top: 0, behavior: "smooth" });
        });
      }

      // Fix sticky chips
      document.querySelectorAll(".filter-btn").forEach((btn) => {
        btn.addEventListener("click", (e) => {
          e.preventDefault();
          const target = document.querySelector(btn.getAttribute("href"));
          if (target) {
            if (window.lenis) lenis.scrollTo(target, { offset: -500 });
            else target.scrollIntoView({ behavior: "smooth" });
          }
        });
      });
    });
  </script>
@endpush

@endsection
