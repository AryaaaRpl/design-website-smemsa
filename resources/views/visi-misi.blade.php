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
    <div class="container reveal" data-reveal>
      <div style="
            padding: 0.4rem 0;
            font-size: 0.85rem;
            font-weight: 700;
            color: #a16207;
            margin-bottom: 1.2rem;
          ">
        SMKS Muhammadiyah 1 Genteng
      </div>
      <h1 class="page-title" data-reveal>Visi, Misi &amp; Tujuan</h1>
      <p class="page-subtitle" data-reveal>
        Arah dan landasan utama SMKS Muhammadiyah 1 Genteng dalam mencetak
        generasi Islam yang berkemajuan, kompeten, dan berjiwa wirausaha.
      </p>
    </div>
  </header>
  <!-- VISI SECTION -->
  <section class="container visi-section">
    <div class="reveal" data-reveal>
      <div class="visi-card-wrapper" style="
            background: linear-gradient(135deg, #1e40af 0%, #16296b 100%);
            color: #ffffff;
            border-radius: var(--radius-xl);
            padding: 3.5rem 3rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 40px -10px rgba(30, 64, 175, 0.3);
          ">
        <span class="visi-label" style="
              color: var(--secondary);
              padding: 0.3rem 0;
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
    <div class="misi-header reveal" data-reveal style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem">
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
      <div class="misi-card reveal" data-reveal style="
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
      <div class="misi-card reveal" data-reveal style="
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
      <div class="misi-card reveal" data-reveal style="
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
      <div class="misi-card reveal" data-reveal style="
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
      <div class="misi-card reveal" data-reveal style="
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
      <div class="reveal" data-reveal style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem">
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
        <div class="tujuan-card reveal" data-reveal>
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
        <div class="tujuan-card reveal" data-reveal>
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
        <div class="tujuan-card reveal" data-reveal>
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
        <div class="tujuan-card reveal" data-reveal>
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
    <div class="reveal" data-reveal style="text-align: center; max-width: 700px; margin: 0 auto 3rem">
      <span class="visi-label">Program Unggulan</span>
      <h2 class="font-head" style="font-size: 2.5rem; color: var(--primary); margin-top: 0.5rem">
        Konsentrasi Keahlian
      </h2>
      <p style="color: var(--text-muted); margin-top: 0.5rem">
        Daftar konsentrasi keahlian yang diselenggarakan di SMKS Muhammadiyah
        1 Genteng sesuai data gambar rujukan.
      </p>
    </div>
    <div class="majors-grid reveal" data-reveal style="justify-content: center">
      @forelse ($majors as $major)
      <a href="{{ route('jurusan.show', $major) }}" class="major-chip">
        <div class="major-chip-img-wrapper">
          <img alt="{{ $major->code }} Logo" class="major-chip-img" src="{{ $major->logo_url }}" />
        </div>
        <span>{{ $major->name }}</span>
      </a>
      @empty
      <!-- Tampilan saat belum ada data jurusan -->
      <div class="content-empty">
        <h3 class="content-empty-title">Data jurusan belum tersedia</h3>
        <p class="content-empty-desc">Informasi konsentrasi keahlian sedang disiapkan. Silakan kembali lagi nanti.</p>
      </div>
      @endforelse
    </div>
  </section>
  <!-- FOOTER -->

@push('scripts')
  <script>
    (function () {
      function initVisiMisi() {
        if (typeof gsap !== "undefined") {
          if (typeof ScrollTrigger !== "undefined") {
            gsap.registerPlugin(ScrollTrigger);
          }

          // Timeline Progress Bar ScrollTrigger Animation for Tujuan Section
          // Di HP garis progress disembunyikan (visi-misi.css), jadi animasinya tidak perlu dijalankan.
          const tujuanBar = document.getElementById("tujuan-bar");
          if (tujuanBar && window.matchMedia("(min-width: 769px)").matches) {
            gsap.to(tujuanBar, {
              height: "100%",
              ease: "none",
              scrollTrigger: {
                trigger: ".tujuan-box",
                start: "top 75%",
                end: "bottom 70%",
                scrub: 0.5,
              },
            });
          }

          // Parallax for Header Pattern
          const headerPattern = document.querySelector(".header-bg-pattern");
          if (headerPattern) {
            gsap.to(headerPattern, {
              y: 100,
              rotation: 15,
              ease: "none",
              scrollTrigger: {
                trigger: ".page-header",
                start: "top top",
                end: "bottom top",
                scrub: true,
              },
            });
          }
        }
      }

      if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initVisiMisi);
      } else {
        initVisiMisi();
      }
    })();
  </script>
@endpush
@endsection
