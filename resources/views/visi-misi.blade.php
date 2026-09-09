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
  <div class="modal-overlay" id="major-modal-overlay" onclick="closeMajorModalOnOverlay(event)" data-lenis-prevent>
    <div class="major-modal-card" id="major-modal-card" data-lenis-prevent>
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

@push('scripts')
  <script>
    (function () {
      function initVisiMisi() {
        if (typeof gsap !== "undefined") {
          if (typeof ScrollTrigger !== "undefined") {
            gsap.registerPlugin(ScrollTrigger);
          }

          // Simple Reveal Animation
          gsap.utils.toArray(".reveal").forEach((elem) => {
            gsap.fromTo(elem, 
              { opacity: 0, y: 30 },
              {
                scrollTrigger: {
                  trigger: elem,
                  start: "top 85%",
                },
                y: 0,
                opacity: 1,
                duration: 0.8,
                ease: "power2.out",
                clearProps: "transform"
              }
            );
          });

          // Timeline Progress Bar ScrollTrigger Animation for Tujuan Section
          const tujuanBar = document.getElementById("tujuan-bar");
          if (tujuanBar) {
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

    // ==========================================
    // DATA KONSENTRASI KEAHLIAN & MODAL LOGIC
    // ==========================================
    const visiMisiMajorsData = {
      rpl: {
        title: "Pengembang Perangkat Lunak & Gim (PPLG)",
        tag: "PPLG / Software Engineering",
        icon: "/assets/major/PPLG-removebg-preview.png",
        gradient: "linear-gradient(135deg, #064e3b 0%, #0d7056 100%)",
        desc: "Konsentrasi keahlian yang berfokus pada analisis kebutuhan, desain arsitektur perangkat lunak, pemrograman web dan mobile modern, manajemen basis data, serta pengujian sistem. Siswa dilatih langsung mengerjakan proyek riil sesuai standar industri software house.",
        skills: [
          "Fullstack Web Development",
          "Mobile App (Flutter/Android)",
          "Database SQL & NoSQL",
          "API Integration",
          "Git & Github Workflow",
          "Clean Architecture",
        ],
        career:
          "Software Engineer, Web Developer, Frontend/Backend Developer, Mobile Developer, Database Administrator, QA System Tester.",
      },
      tkj: {
        title: "Teknik Jaringan Komputer & Telekomunikasi (TJKT)",
        tag: "TJKT / Network & Cloud Infrastructure",
        icon: "/assets/major/TJKT-removebg-preview.png",
        gradient: "linear-gradient(135deg, #064e3b 0%, #0369a1 100%)",
        desc: "Mempelajari perancangan, instalasi, dan pemeliharaan infrastruktur jaringan komputer enterprise, fiber optik, administrasi Cloud & Linux server, serta sistem keamanan siber (cybersecurity) untuk mendukung transformasi digital industri.",
        skills: [
          "Routing & Switching (MikroTik MTCNA / Cisco)",
          "Linux Enterprise & Cloud Server",
          "Fiber Optic Splicing & OTDR",
          "Network Security & Firewall",
          "Wireless Network Deployment",
        ],
        career:
          "Network Administrator, Cloud Infrastructure Engineer, Fiber Optic Specialist, IT Support Specialist, System Administrator.",
      },
      bd: {
        title: "Bisnis Digital",
        tag: "Digital Commerce & Marketing Strategy",
        icon: "/assets/major/logo bdp.png",
        gradient: "linear-gradient(135deg, #d97706 0%, #b45309 100%)",
        desc: "Mempersiapkan wirausahawan digital dan praktisi e-commerce yang menguasai marketplace optimization, riset pasar digital, social media marketing, strategi SEO/SEM, copywriting promosi, serta pengelolaan toko daring modern.",
        skills: [
          "E-Commerce & Marketplace Management",
          "Social Media Advertising (Meta/Tiktok Ads)",
          "SEO & Content Marketing",
          "Digital Analytics",
          "Copywriting & Branding",
        ],
        career:
          "Digital Marketer, E-Commerce Specialist, Social Media Strategist, Digital Business Consultant, Marketplace Operations Lead.",
      },
      mplb: {
        title: "Manajemen Perkantoran & Layanan Bisnis (MPLB)",
        tag: "Corporate Management & Digital Administration",
        icon: "/assets/major/mp.jpeg",
        gradient: "linear-gradient(135deg, #064e3b 0%, #0f766e 100%)",
        desc: "Membekali siswa keterampilan administrasi perkantoran modern, digital document archiving, korespondensi bisnis formal, manajemen rapat, tata kelola kehumasan, serta kemampuan komunikasi profesional berstandar internasional.",
        skills: [
          "Digital Office Administration",
          "Digital Archiving & Cloud Storage",
          "Business Correspondence",
          "Public Relations & Event Handling",
          "Customer Relationship Management",
        ],
        career:
          "Administrative Officer, Executive Secretary, Public Relations Staff, Customer Service Specialist, HR Administration Staff.",
      },
      akl: {
        title: "Akuntansi & Keuangan Lembaga (AKL)",
        tag: "Financial Accounting & Islamic Banking",
        icon: "/assets/major/logo AKL.png",
        gradient: "linear-gradient(135deg, #064e3b 0%, #15803d 100%)",
        desc: "Fokus pada penguasaan pembukuan keuangan, perpajakan, audit laporan keuangan, komputer akuntansi (MYOB/Accurate), serta dasar-dasar operasional perbankan syariah yang presisi dan transparan.",
        skills: [
          "Komputer Akuntansi (MYOB/Accurate)",
          "Laporan Keuangan & Audit",
          "Perpajakan (PPh & PPN)",
          "Operasional Perbankan Syariah",
          "Spreadsheet Analytics",
        ],
        career:
          "Junior Accountant, Tax Staff, Bank Teller & Customer Service, Financial Analyst Assistant, Bookkeeper.",
      },
      hotel: {
        title: "Perhotelan",
        tag: "Tourism & Hotel Hospitality Industry",
        icon: "/assets/major/PH.png",
        gradient: "linear-gradient(135deg, #b45309 0%, #d97706 100%)",
        desc: "Mengasah keahlian pelayanan prima berstandar bintang lima, tata kelola front office, tata graha (housekeeping), pelayanan makanan & minuman (food & beverage), serta etika keramahtamahan internasional.",
        skills: [
          "Front Office Operations",
          "Housekeeping & Room Service",
          "Food & Beverage Service",
          "Hospitality Ethics & Communication",
          "Hotel Property Management System",
        ],
        career:
          "Front Desk Agent, Guest Relation Officer, Housekeeping Supervisor, F&B Service Specialist, Hotel Event Coordinator.",
      },
      dkv: {
        title: "Desain Komunikasi Visual (DKV)",
        tag: "Creative Media & Visual Communication",
        icon: "/assets/major/dkv.png",
        gradient: "linear-gradient(135deg, #7c2d12 0%, #ea580c 100%)",
        desc: "Eksplorasi kreativitas visual tanpa batas meliputi desain grafis profesional, ilustrasi digital, videografi sinematik, animasi 2D/3D, motion graphics, audio production, dan konten promosi multimedia komersial.",
        skills: [
          "Adobe Illustrator & Photoshop",
          "Premiere Pro & After Effects",
          "Motion Graphics 2D/3D",
          "Cinematography & Lighting",
          "Brand Identity Design",
        ],
        career:
          "Graphic Designer, Video Editor, Motion Graphic Artist, Videographer/Cinematographer, UI/UX Designer, Creative Director.",
      },
      boga: {
        title: "Tata Boga / Kuliner",
        tag: "Culinary Arts & Bakery Production",
        icon: "/assets/major/SMEMSA Chibi-chibi.png",
        gradient: "linear-gradient(135deg, #d97706 0%, #ca8a04 100%)",
        desc: "Mempelajari seni pengolahan masakan nusantara dan internasional (kontinental), bakery & pastry, pengolahan makanan sehat, hygiene sanitasi halal, serta manajemen usaha katering komersial berstandar industri.",
        skills: [
          "Bakery & Pastry Production",
          "Indonesian & Continental Cuisine",
          "Food Plating & Presentation",
          "Hygiene & Halal Food Sanitation",
          "Catering Business Management",
        ],
        career:
          "Pastry Chef, Commis Chef, Baker, Food Stylist, Restaurant/Catering Entrepreneur, F&B Supervisor.",
      },
      tbsm: {
        title: "Teknik & Bisnis Sepeda Motor (TBSM)",
        tag: "Automotive Engineering & Workshop Management",
        icon: "/assets/major/SMEMSA Chibi-chibi.png",
        gradient: "linear-gradient(135deg, #1c1917 0%, #064e3b 100%)",
        desc: "Mencetak teknisi otomotif roda dua profesional dengan keahlian perawatan mesin injeksi, kelistrikan kendaraan, sistem transmisi otomatis/manual, serta manajemen bengkel berstandar resmi Astra Honda Authorized Service Station (AHASS).",
        skills: [
          "EFI & Injection Diagnostic Tools",
          "Engine Overhaul & Tune-Up",
          "Motorcycle Electrical Systems",
          "Brake & Suspension Maintenance",
          "Workshop Management",
        ],
        career:
          "Automotive Technician, Service Advisor Bengkel Resmi, Diagnostic Specialist, Sparepart Officer, Wirausaha Bengkel Motor Mandiri.",
      },
    };

    function openMajorModal(majorKey) {
      const data = visiMisiMajorsData[majorKey];
      if (!data) return;

      document.getElementById("modal-tag").innerText = data.tag;
      document.getElementById("modal-title").innerText = data.title;
      document.getElementById("modal-desc").innerText = data.desc;

      const modalIconImg = document.getElementById("modal-icon-img");
      if (modalIconImg) {
        modalIconImg.src = data.icon;
        modalIconImg.alt = data.title + " Logo";
      }

      document.getElementById("modal-banner").style.background =
        data.gradient;
      document.getElementById("modal-career").innerText = data.career;

      // Populate skills
      const skillsContainer = document.getElementById("modal-skills");
      skillsContainer.innerHTML = "";
      data.skills.forEach((skill) => {
        const chip = document.createElement("span");
        chip.className = "modal-skill-chip";
        chip.innerText = skill;
        skillsContainer.appendChild(chip);
      });

      const modalOverlay = document.getElementById("major-modal-overlay");
      modalOverlay.classList.add("active");
      document.body.style.overflow = "hidden";
    }

    function closeMajorModal() {
      const modalOverlay = document.getElementById("major-modal-overlay");
      if (modalOverlay) modalOverlay.classList.remove("active");
      document.body.style.overflow = "";
    }

    function closeMajorModalOnOverlay(e) {
      if (e.target.id === "major-modal-overlay") {
        closeMajorModal();
      }
    }

    // Close modal on Escape key
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") {
        closeMajorModal();
        if (typeof closeMobileDrawer === "function") closeMobileDrawer();
      }
    });

  </script>
@endpush
@endsection
