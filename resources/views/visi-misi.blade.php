@extends('layouts.app')

@section('content')

  <!-- HEADER -->
  <header class="page-header">
    <!-- Geometric Star SVG Pattern -->
    <svg class="header-bg-pattern" viewbox="0 0 100 100">
      <path d="M50 0 L60 40 L100 50 L60 60 L50 100 L40 60 L0 50 L40 40 Z" fill="none" stroke="var(--primary)"
        stroke-width="2"></path>
      <circle cx="50" cy="50" fill="none" r="30" stroke="var(--secondary)" stroke-dasharray="2 2" stroke-width="1">
      </circle>
    </svg>
    <div class="container reveal">
      <div style="
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--primary-surface);
            border: 1px solid var(--border-light);
            padding: 0.4rem 1rem;
            border-radius: var(--radius-full);
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1.2rem;
          ">
        SMKS Muhammadiyah 1 Genteng
      </div>
      <h1 class="page-title">Visi, Misi &amp; Tujuan</h1>
      <p class="page-subtitle">
        Arah dan landasan utama SMKS Muhammadiyah 1 Genteng dalam mencetak
        generasi Islam yang berkemajuan, kompeten, dan berjiwa wirausaha.
      </p>
    </div>
  </header>
  <!-- VISI SECTION -->
  <section class="container visi-section">
    <div class="reveal">
      <div class="visi-card-wrapper" style="
            background: linear-gradient(135deg, #1e40af 0%, #16296b 100%);
            color: #ffffff;
            border-radius: var(--radius-xl);
            padding: 3.5rem 3rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 40px -10px rgba(30, 64, 175, 0.3);
          ">
        <div style="
              position: absolute;
              right: -20px;
              bottom: -20px;
              opacity: 0.08;
              font-size: 15rem;
              font-family: var(--font-head);
              font-weight: 800;
              line-height: 1;
              pointer-events: none;
            ">
          VISI
        </div>
        <span class="visi-label" style="
              color: var(--secondary);
              display: inline-block;
              background: rgba(234, 179, 8, 0.15);
              padding: 0.3rem 1rem;
              border-radius: var(--radius-full);
              font-size: 0.85rem;
              letter-spacing: 2px;
            ">VISI SEKOLAH</span>
        <blockquote class="visi-statement" style="
              color: #ffffff;
              margin-top: 1.5rem;
              font-size: 2.2rem;
              font-weight: 700;
              line-height: 1.4;
            ">
          "Terwujudnya Peserta Didik Islami, Berkemajuan, Kompeten dan Berjiwa
          Wirausaha."
        </blockquote>
      </div>
    </div>
  </section>
  <!-- MISI SECTION -->
  <section class="container misi-section" style="padding-bottom: 6rem">
    <div class="misi-header reveal" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem">
      <span class="visi-label">Misi Lembaga</span>
      <h2 class="font-head" style="font-size: 2.5rem; color: var(--primary); margin-top: 0.5rem">
        Misi Sekolah
      </h2>
      <p style="color: var(--text-muted); margin-top: 0.5rem">
        Langkah-langkah strategis untuk mewujudkan Visi SMKS Muhammadiyah 1
        Genteng.
      </p>
    </div>
    <div class="misi-cards-container" style="
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
          gap: 1.5rem;
        ">
      <div class="misi-card reveal" style="
            background: var(--bg-main);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-lg);
            padding: 2rem;
            transition: var(--transition);
            box-shadow: var(--shadow-card);
            position: relative;
            overflow: hidden;
          ">
        <div style="
              font-size: 2rem;
              font-weight: 800;
              color: var(--primary);
              opacity: 0.15;
              position: absolute;
              top: 1rem;
              right: 1.5rem;
            ">
          01
        </div>
        <div style="
              width: 48px;
              height: 48px;
              background: var(--primary-surface);
              border-radius: var(--radius-sm);
              color: var(--primary);
              display: flex;
              align-items: center;
              justify-content: center;
              font-size: 1.25rem;
              font-weight: 800;
              margin-bottom: 1.25rem;
            ">
          1
        </div>
        <p style="
              font-size: 1.05rem;
              font-weight: 500;
              color: var(--text-dark);
              line-height: 1.7;
            ">
          Menerapkan karakter utama pendidikan Al-Islam dan Kemuhammadiyahan
          yang holistik dalam semua mata pelajaran.
        </p>
      </div>
      <div class="misi-card reveal" style="
            background: var(--bg-main);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-lg);
            padding: 2rem;
            transition: var(--transition);
            box-shadow: var(--shadow-card);
            position: relative;
            overflow: hidden;
          ">
        <div style="
              font-size: 2rem;
              font-weight: 800;
              color: var(--primary);
              opacity: 0.15;
              position: absolute;
              top: 1rem;
              right: 1.5rem;
            ">
          02
        </div>
        <div style="
              width: 48px;
              height: 48px;
              background: var(--primary-surface);
              border-radius: var(--radius-sm);
              color: var(--primary);
              display: flex;
              align-items: center;
              justify-content: center;
              font-size: 1.25rem;
              font-weight: 800;
              margin-bottom: 1.25rem;
            ">
          2
        </div>
        <p style="
              font-size: 1.05rem;
              font-weight: 500;
              color: var(--text-dark);
              line-height: 1.7;
            ">
          Melakukan sinkronisasi dengan dunia kerja dan dunia industri untuk
          memenuhi kebutuhan dunia kerja dan mengembangkan potensi didik.
        </p>
      </div>
      <div class="misi-card reveal" style="
            background: var(--bg-main);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-lg);
            padding: 2rem;
            transition: var(--transition);
            box-shadow: var(--shadow-card);
            position: relative;
            overflow: hidden;
          ">
        <div style="
              font-size: 2rem;
              font-weight: 800;
              color: var(--primary);
              opacity: 0.15;
              position: absolute;
              top: 1rem;
              right: 1.5rem;
            ">
          03
        </div>
        <div style="
              width: 48px;
              height: 48px;
              background: var(--primary-surface);
              border-radius: var(--radius-sm);
              color: var(--primary);
              display: flex;
              align-items: center;
              justify-content: center;
              font-size: 1.25rem;
              font-weight: 800;
              margin-bottom: 1.25rem;
            ">
          3
        </div>
        <p style="
              font-size: 1.05rem;
              font-weight: 500;
              color: var(--text-dark);
              line-height: 1.7;
            ">
          Melakukan transformasi, berdaya saing global, dan berbasis teknologi
          informasi dan digitalisasi.
        </p>
      </div>
      <div class="misi-card reveal" style="
            background: var(--bg-main);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-lg);
            padding: 2rem;
            transition: var(--transition);
            box-shadow: var(--shadow-card);
            position: relative;
            overflow: hidden;
          ">
        <div style="
              font-size: 2rem;
              font-weight: 800;
              color: var(--primary);
              opacity: 0.15;
              position: absolute;
              top: 1rem;
              right: 1.5rem;
            ">
          04
        </div>
        <div style="
              width: 48px;
              height: 48px;
              background: var(--primary-surface);
              border-radius: var(--radius-sm);
              color: var(--primary);
              display: flex;
              align-items: center;
              justify-content: center;
              font-size: 1.25rem;
              font-weight: 800;
              margin-bottom: 1.25rem;
            ">
          4
        </div>
        <p style="
              font-size: 1.05rem;
              font-weight: 500;
              color: var(--text-dark);
              line-height: 1.7;
            ">
          Mengimplementasikan tata kelola modern yang transparan dan akuntabel
          serta pendidikan yang inklusif.
        </p>
      </div>
      <div class="misi-card reveal" style="
            background: var(--bg-main);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-lg);
            padding: 2rem;
            transition: var(--transition);
            box-shadow: var(--shadow-card);
            position: relative;
            overflow: hidden;
          ">
        <div style="
              font-size: 2rem;
              font-weight: 800;
              color: var(--primary);
              opacity: 0.15;
              position: absolute;
              top: 1rem;
              right: 1.5rem;
            ">
          05
        </div>
        <div style="
              width: 48px;
              height: 48px;
              background: var(--primary-surface);
              border-radius: var(--radius-sm);
              color: var(--primary);
              display: flex;
              align-items: center;
              justify-content: center;
              font-size: 1.25rem;
              font-weight: 800;
              margin-bottom: 1.25rem;
            ">
          5
        </div>
        <p style="
              font-size: 1.05rem;
              font-weight: 500;
              color: var(--text-dark);
              line-height: 1.7;
            ">
          Meningkatkan kolaborasi dan kemitraan antar Lembaga Pendidikan baik
          internal dan eksternal Muhammadiyah serta dunia kerja.
        </p>
      </div>
    </div>
  </section>
  <!-- TUJUAN SECTION -->
  <section class="tujuan-section section-padding bg-alt" style="padding: 6rem 0">
    <div class="container">
      <div class="reveal" style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem">
        <span class="visi-label">Tujuan Institusi</span>
        <h2 class="font-head" style="font-size: 2.5rem; color: var(--primary); margin-top: 0.5rem">
          Tujuan Sekolah
        </h2>
        <p style="color: var(--text-muted); margin-top: 0.5rem">
          Komitmen nyata pembinaan peserta didik di SMKS Muhammadiyah 1
          Genteng.
        </p>
      </div>
      <div class="tujuan-box">
        <div class="tujuan-progress-line">
          <div class="tujuan-progress-bar" id="tujuan-bar"></div>
        </div>
        <div class="tujuan-card reveal">
          <div class="tujuan-icon">1</div>
          <p style="
                font-size: 1.05rem;
                color: var(--text-dark);
                line-height: 1.7;
                margin: 0;
              ">
            Mempersiapkan peserta didik yang berakidah Islam dalam beriman dan
            bertaqwa kepada Allah SWT dengan perilaku akhlak mulia.
          </p>
        </div>
        <div class="tujuan-card reveal">
          <div class="tujuan-icon">2</div>
          <p style="
                font-size: 1.05rem;
                color: var(--text-dark);
                line-height: 1.7;
                margin: 0;
              ">
            Membiasakan peserta didik untuk beradaptasi dengan perkembangan
            ilmu pengetahuan dan teknologi, dan menerapkan teknologi informasi
            dan digital dalam pembelajaran.
          </p>
        </div>
        <div class="tujuan-card reveal">
          <div class="tujuan-icon">3</div>
          <p style="
                font-size: 1.05rem;
                color: var(--text-dark);
                line-height: 1.7;
                margin: 0;
              ">
            Mempersiapkan peserta didik agar lebih ulet, Tangguh, produktif,
            mandiri dan gigih dalam berkompetisi, serta dapat beradaptasi di
            masyarakat dan mengembangkan sikap profesional dalam kompetensi
            yang diminatinya.
          </p>
        </div>
        <div class="tujuan-card reveal">
          <div class="tujuan-icon">4</div>
          <p style="
                font-size: 1.05rem;
                color: var(--text-dark);
                line-height: 1.7;
                margin: 0;
              ">
            Membekali peserta didik agar bisa menjadi wirausahawan muda yang
            ulet, tangguh dan pantang menyerah sesuai dengan syariah.
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- KONSENTRASI KEAHLIAN (EX-SIDEBAR SEPERTI DI GAMBAR) -->
  <section class="majors-section container" style="padding: 6rem 0">
    <div class="reveal" style="text-align: center; max-width: 700px; margin: 0 auto 3rem">
      <span class="visi-label">Program Unggulan</span>
      <h2 class="font-head" style="font-size: 2.5rem; color: var(--primary); margin-top: 0.5rem">
        Konsentrasi Keahlian
      </h2>
      <p style="color: var(--text-muted); margin-top: 0.5rem">
        Daftar konsentrasi keahlian yang diselenggarakan di SMKS Muhammadiyah
        1 Genteng sesuai data gambar rujukan.
      </p>
    </div>
    <div class="majors-grid reveal" style="justify-content: center">
      <button class="major-chip" onclick="openMajorModal('rpl')">
        <div class="major-chip-img-wrapper">
          <img alt="PPLG Logo" class="major-chip-img" src="{{ asset('assets/major/PPLG-removebg-preview.png') }}" />
        </div>
        <span>Pengembang Perangkat Lunak & Gim</span>
      </button>
      <button class="major-chip" onclick="openMajorModal('tkj')">
        <div class="major-chip-img-wrapper">
          <img alt="TJKT Logo" class="major-chip-img" src="{{ asset('assets/major/TJKT-removebg-preview.png') }}" />
        </div>
        <span>Teknik Komputer dan Jaringan</span>
      </button>
      <button class="major-chip" onclick="openMajorModal('bd')">
        <div class="major-chip-img-wrapper">
          <img alt="Bisnis Digital Logo" class="major-chip-img" src="{{ asset('assets/major/logo bdp.png') }}" />
        </div>
        <span>Bisnis Digital</span>
      </button>
      <button class="major-chip" onclick="openMajorModal('mplb')">
        <div class="major-chip-img-wrapper">
          <img alt="MPLB Logo" class="major-chip-img" src="{{ asset('assets/major/mp.jpeg') }}" />
        </div>
        <span>Manajemen Perkantoran</span>
      </button>
      <button class="major-chip" onclick="openMajorModal('akl')">
        <div class="major-chip-img-wrapper">
          <img alt="AKL Logo" class="major-chip-img" src="{{ asset('assets/major/logo AKL.png') }}" />
        </div>
        <span>Akuntansi</span>
      </button>
      <button class="major-chip" onclick="openMajorModal('hotel')">
        <div class="major-chip-img-wrapper">
          <img alt="Perhotelan Logo" class="major-chip-img" src="{{ asset('assets/major/PH.png') }}" />
        </div>
        <span>Perhotelan</span>
      </button>
      <button class="major-chip" onclick="openMajorModal('dkv')">
        <div class="major-chip-img-wrapper">
          <img alt="DKV Logo" class="major-chip-img" src="{{ asset('assets/major/dkv.png') }}" />
        </div>
        <span>Desain Komunikasi Visual</span>
      </button>
    </div>
  </section>
  <!-- INTERACTIVE DETAIL MODAL -->
  <div class="modal-overlay" id="major-modal-overlay" onclick="closeMajorModalOnOverlay(event)">
    <div class="major-modal-card" id="major-modal-card">
      <!-- Modal Header Banner with Animated Icon -->
      <div class="modal-banner" id="modal-banner">
        <div class="modal-banner-icon" id="modal-icon">
          <img alt="Major Logo" id="modal-icon-img" src="{{ asset('assets/major/PPLG-removebg-preview.png') }}" />
        </div>
        <button aria-label="Tutup Detail Jurusan" class="modal-close-btn" onclick="closeMajorModal()">
          ×
        </button>
      </div>
      <!-- Modal Content Body -->
      <div class="modal-body">
        <span class="modal-tag" id="modal-tag">PPLG / Software Engineering</span>
        <h3 class="modal-title" id="modal-title">
          Pengembang Perangkat Lunak & Gim (PPLG)
        </h3>
        <p class="modal-desc" id="modal-desc">
          Fokus pada pengembangan aplikasi web modern, mobile apps, database
          arsitektur, dan logika komputasi. Siswa dibekali kemampuan membangun
          solusi software siap pakai untuk ekosistem industri digital.
        </p>
        <div class="modal-skills-box">
          <div class="modal-section-title">
            <span>🛠️</span> Kompetensi &amp; Tools Unggulan:
          </div>
          <div class="modal-chips-row" id="modal-skills">
            <span class="modal-skill-chip">Web &amp; Mobile Dev</span>
            <span class="modal-skill-chip">SQL &amp; NoSQL Database</span>
            <span class="modal-skill-chip">API Integration</span>
            <span class="modal-skill-chip">Git &amp; Version Control</span>
          </div>
        </div>
        <div class="modal-career-box">
          <div class="modal-section-title" style="color: var(--primary); margin-bottom: 0.4rem">
            <span>🚀</span> Peluang &amp; Prospek Karir:
          </div>
          <div class="modal-career-text" id="modal-career">
            Software Engineer, Web Developer, Mobile App Developer, Database
            Administrator, QA Tester.
          </div>
        </div>
        <div class="modal-footer-cta">
          <span style="font-size: 0.85rem; color: var(--text-muted)">Terlisensi <strong>LSP BNSP</strong> • Kelas
            Industri</span>
          <a href="/spmb" style="
                background: var(--primary);
                color: #ffffff;
                padding: 0.65rem 1.4rem;
                border-radius: 50px;
                font-family: var(--font-head);
                font-weight: 700;
                font-size: 0.9rem;
                text-decoration: none;
              ">
            Daftar SPMB Jurusan Ini →
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- FOOTER -->

@endsection
