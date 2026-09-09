<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    SMKS Muhammadiyah 1 Genteng - Pusat Keunggulan Vokasi & Karakter Islami
  </title>
  <meta name="description"
    content="Website Resmi SMKS Muhammadiyah 1 Genteng (SMEMSA / SMEMSA Genteng) Banyuwangi. SMK Pusat Keunggulan, Akreditasi A BAN-S/M, Berlisensi LSP-P1 BNSP, dengan 7 Konsentrasi Keahlian Industri." />

  <!-- Open Graph / WhatsApp Preview Meta Tags -->
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://smksmuh1gtg.com/" />
  <meta property="og:title" content="SMKS Muhammadiyah 1 Genteng - Good Skill, Good Attitude" />
  <meta property="og:description"
    content="SMK Pusat Keunggulan di Genteng Banyuwangi. Terakreditasi A, LSP-P1 BNSP, Kelas Industri Dudika, dan 7 Konsentrasi Keahlian Unggulan." />
  <meta property="og:image" content="assets/logo.png" />

  <!-- Structured Data (JSON-LD) for School -->
  <script type="application/ld+json">
      {
        "@@context": "https://schema.org",
        "@@type": "School",
        "name": "SMKS Muhammadiyah 1 Genteng",
        "alternateName": ["SMEMSA", "SMEMSA Genteng"],
        "url": "https://smksmuh1gtg.com",
        "logo": "assets/logo.png",
        "image": "assets/logo.png",
        "description": "Sekolah Menengah Kejuruan Pusat Keunggulan di Genteng Banyuwangi dengan 7 Konsentrasi Keahlian Industri dan Lisensi LSP-P1 BNSP.",
        "address": {
          "@@type": "PostalAddress",
          "streetAddress": "Jl. KH Imam Bahri No.10, Dusun Krajan, Genteng Wetan",
          "addressLocality": "Genteng, Banyuwangi",
          "addressRegion": "Jawa Timur",
          "postalCode": "68465",
          "addressCountry": "ID"
        },
        "telephone": "+62-333-845605",
        "email": "smkmuhi.genteng1968@gmail.com"
      }
    </script>

  <!-- Typography: Plus Jakarta Sans with display=swap -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
    rel="stylesheet" />

    @php
    $path = trim(request()->path(), '/');
    if (empty($path) || $path === '/') {
        $pageCss = 'index';
    } else {
        $pageCss = str_replace('/', '-', $path);
    }
  @endphp

  @if (file_exists(resource_path('css/pages/' . $pageCss . '.css')))
    @vite(['resources/css/app.css', 'resources/css/pages/' . $pageCss . '.css', 'resources/js/app.js'])
  @else
    @vite(['resources/css/app.css', 'resources/css/pages/index.css', 'resources/js/app.js'])
  @endif
  @stack('styles')
</head>

<body>
  <!-- 1. FLOATING ISLAND NAVBAR WITH GLASSMORPHISM 2.0 -->
    @include('partials.navbar')
    @yield('content')
    @include('partials.footer')

  <!-- 14. CHATBOT AI ASISTEN VIRTUAL -->
  <button class="chatbot-btn" id="chatbot-toggle" aria-label="Buka Asisten AI">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
      stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
      class="lucide lucide-message-circle-more-icon lucide-message-circle-more">
      <path
        d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719" />
      <path d="M8 12h.01" />
      <path d="M12 12h.01" />
      <path d="M16 12h.01" />
    </svg>
  </button>
  <div class="chat-panel" id="chat-panel" data-lenis-prevent>
    <div class="chat-header">
      <span>Asisten AI SMEMSA</span>
      <span style="
            font-size: 0.75rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.2rem 0.5rem;
            border-radius: 10px;
          ">Online</span>
    </div>
    <div class="chat-body" id="chat-body" data-lenis-prevent>
      <div class="chat-msg bot">
        Assalamu'alaikum! Saya asisten AI resmi SMKS Muhammadiyah 1 Genteng.
        Ada yang bisa saya bantu terkait info 7 jurusan, alur pendaftaran SPMB,
        sertifikasi LSP-P1 BNSP, fasilitas, atau loker BKK?
      </div>
    </div>
    <div class="chat-quick-pills">
      <button class="chat-pill" onclick="sendQuickMsg('Info 7 Jurusan')">
        Info 7 Jurusan
      </button>
      <button class="chat-pill" onclick="sendQuickMsg('Alur Pendaftaran SPMB')">
        Alur SPMB
      </button>
      <button class="chat-pill" onclick="sendQuickMsg('Info LSP-P1 BNSP')">
        LSP-P1 BNSP
      </button>
      <button class="chat-pill" onclick="sendQuickMsg('Lowongan BKK')">
        Lowongan BKK
      </button>
    </div>
    <div class="chat-input-bar">
      <input type="text" id="chat-input-text" placeholder="Ketik pertanyaan Anda..." />
      <button onclick="handleChatSubmit()">Kirim</button>
    </div>
  </div>

  <!-- GSAP, ScrollTrigger & Lenis Smooth Scroll -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

  <!-- STANDARDIZED ACCESSIBLE NAVBAR & DRAWER SCRIPT (INITIALIZED FIRST) -->
  <script>
    (function () {
      function initNavigation() {
        var hamburgerBtn =
          document.querySelector("#hamburger-btn") ||
          document.querySelector(".hamburger") ||
          document.querySelector(".nav-toggle");
        var drawerCloseBtn =
          document.querySelector("#drawer-close-btn") ||
          document.querySelector(".drawer-close");
        var mobileDrawer =
          document.querySelector("#mobile-drawer") ||
          document.querySelector(".mobile-drawer");
        var mobileOverlay =
          document.querySelector("#mobile-overlay") ||
          document.querySelector(".mobile-overlay");

        function openDrawer() {
          if (mobileDrawer) mobileDrawer.classList.add("active");
          if (mobileOverlay) mobileOverlay.classList.add("active");
          document.body.style.overflow = "hidden";
          if (hamburgerBtn)
            hamburgerBtn.setAttribute("aria-expanded", "true");
          if (window.lenis) window.lenis.stop();
        }

        function closeDrawer() {
          if (mobileDrawer) mobileDrawer.classList.remove("active");
          if (mobileOverlay) mobileOverlay.classList.remove("active");
          document.body.style.overflow = "";
          if (hamburgerBtn)
            hamburgerBtn.setAttribute("aria-expanded", "false");
          if (window.lenis) window.lenis.start();
        }

        if (hamburgerBtn) {
          hamburgerBtn.removeEventListener("click", openDrawer);
          hamburgerBtn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            if (mobileDrawer && mobileDrawer.classList.contains("active")) {
              closeDrawer();
            } else {
              openDrawer();
            }
          });
        }

        if (drawerCloseBtn) {
          drawerCloseBtn.removeEventListener("click", closeDrawer);
          drawerCloseBtn.addEventListener("click", function (e) {
            e.preventDefault();
            closeDrawer();
          });
        }

        if (mobileOverlay) {
          mobileOverlay.removeEventListener("click", closeDrawer);
          mobileOverlay.addEventListener("click", function (e) {
            e.preventDefault();
            closeDrawer();
          });
        }

        // Close on drawer link click
        if (mobileDrawer) {
          var drawerLinks = mobileDrawer.querySelectorAll("a");
          drawerLinks.forEach(function (link) {
            link.addEventListener("click", function () {
              closeDrawer();
            });
          });
        }

        // Escape key listener
        document.addEventListener("keydown", function (e) {
          if (e.key === "Escape") {
            closeDrawer();
            if (typeof closeItemModal === "function") closeItemModal();
            if (typeof closeNewsModal === "function") closeNewsModal();
            if (typeof closeAwardModal === "function") closeAwardModal();
            if (typeof closeMajorModal === "function") closeMajorModal();
            if (typeof closeBludModal === "function") closeBludModal();
          }
        });
      }

      if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initNavigation);
      } else {
        initNavigation();
      }
    })();
  </script>

  <script src="https://unpkg.com/lenis@1.1.20/dist/lenis.min.js"></script>

  <script>
    // 1. Initialize Lenis Smooth Scroll
    const lenis = new Lenis({
      duration: 1.2,
      easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
      smoothWheel: true,
      smoothTouch: false,
      wheelMultiplier: 1,
      touchMultiplier: 2,
      infinite: false,
    });

    // Synchronize Lenis with GSAP ScrollTrigger
    lenis.on("scroll", ScrollTrigger.update);

    gsap.ticker.add((time) => {
      lenis.raf(time * 1000);
    });

    gsap.ticker.lagSmoothing(0);

    // Smooth Scroll for anchor links using Lenis
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener("click", function (e) {
        const targetId = this.getAttribute("href");
        if (targetId && targetId !== "#" && targetId.length > 1) {
          const targetEl = document.querySelector(targetId);
          if (targetEl) {
            e.preventDefault();
            lenis.scrollTo(targetEl, { offset: -70, duration: 1.2 });
            // Close mobile drawer if open
            closeMobileDrawer();
          }
        }
      });
    });

    // 2. Navbar Scrolled Island Effect
    const mainNav = document.getElementById("main-nav");
    window.addEventListener("scroll", () => {
      if (window.scrollY > 40) {
        mainNav.classList.add("scrolled");
      } else {
        mainNav.classList.remove("scrolled");
      }
    });

    // 3. Mobile Drawer Logic
    const hamburgerBtn = document.getElementById("hamburger-btn");
    const drawerCloseBtn = document.getElementById("drawer-close-btn");
    const mobileDrawer = document.getElementById("mobile-drawer");
    const mobileOverlay = document.getElementById("mobile-overlay");

    function openMobileDrawer() {
      if (mobileDrawer) mobileDrawer.classList.add("active");
      if (mobileOverlay) mobileOverlay.classList.add("active");
      document.body.style.overflow = "hidden";
      if (hamburgerBtn) hamburgerBtn.setAttribute("aria-expanded", "true");
      if (typeof lenis !== "undefined" && lenis) lenis.stop();
    }

    function closeMobileDrawer() {
      if (mobileDrawer) mobileDrawer.classList.remove("active");
      if (mobileOverlay) mobileOverlay.classList.remove("active");
      document.body.style.overflow = "";
      if (hamburgerBtn) hamburgerBtn.setAttribute("aria-expanded", "false");
      if (typeof lenis !== "undefined" && lenis) lenis.start();
    }

    /* Listener navbar DIHAPUS di sini — sudah ditangani initNavigation()
       yang memakai toggle. Dua listener pada tombol yang sama membuat
       drawer langsung terbuka lagi setiap kali ditutup. Fungsi
       openMobileDrawer/closeMobileDrawer tetap ada karena masih
       dipanggil dari handler anchor Lenis. */

    // 4. Hero Hub Tabs
    function switchHubTab(tabName, btn) {
      document
        .querySelectorAll(".hub-nav-tab")
        .forEach((b) => b.classList.remove("active"));
      document
        .querySelectorAll(".hub-tab-panel")
        .forEach((p) => p.classList.remove("active"));

      btn.classList.add("active");
      const target = document.getElementById("hub-panel-" + tabName);
      if (target) target.classList.add("active");
    }

    // 5. Hero Quick Search / Filter Jurusan
    function handleHeroSearch() {
      const query = (
        document.getElementById("hero-search-input")?.value || ""
      )
        .toLowerCase()
        .trim();
      if (!query) return;

      const jurusanSection = document.getElementById("jurusan");
      if (jurusanSection) {
        if (typeof lenis !== "undefined" && lenis) {
          lenis.scrollTo(jurusanSection, { offset: -70, duration: 1.2 });
        } else {
          jurusanSection.scrollIntoView({ behavior: "smooth" });
        }
      }

      if (
        query.includes("code") ||
        query.includes("web") ||
        query.includes("rpl") ||
        query.includes("software") ||
        query.includes("aplikasi") ||
        query.includes("flutter")
      ) {
        selectMajorPathway("rpl");
      } else if (
        query.includes("jaringan") ||
        query.includes("tkj") ||
        query.includes("network") ||
        query.includes("server") ||
        query.includes("wifi") ||
        query.includes("fiber")
      ) {
        selectMajorPathway("tkj");
      } else if (
        query.includes("desain") ||
        query.includes("video") ||
        query.includes("dkv") ||
        query.includes("multimedia") ||
        query.includes("foto") ||
        query.includes("animasi")
      ) {
        selectMajorPathway("dkv");
      } else if (
        query.includes("bisnis") ||
        query.includes("digital") ||
        query.includes("bd") ||
        query.includes("marketing") ||
        query.includes("toko") ||
        query.includes("shopee")
      ) {
        selectMajorPathway("bd");
      } else if (
        query.includes("akuntansi") ||
        query.includes("uang") ||
        query.includes("akl") ||
        query.includes("pajak") ||
        query.includes("bank")
      ) {
        selectMajorPathway("akl");
      } else if (
        query.includes("kantor") ||
        query.includes("mplb") ||
        query.includes("admin") ||
        query.includes("arsip") ||
        query.includes("sekretaris")
      ) {
        selectMajorPathway("mplb");
      } else if (
        query.includes("hotel") ||
        query.includes("ph") ||
        query.includes("wisata") ||
        query.includes("hospitality") ||
        query.includes("edutel")
      ) {
        selectMajorPathway("ph");
      } else if (
        query.includes("motor") ||
        query.includes("tbsm") ||
        query.includes("bengkel") ||
        query.includes("honda") ||
        query.includes("ahass") ||
        query.includes("otomotif")
      ) {
        selectMajorPathway("tbsm");
      }
    }

    document
      .getElementById("hero-search-input")
      ?.addEventListener("keypress", (e) => {
        if (e.key === "Enter") handleHeroSearch();
      });

    // 6. KONSENTRASI KEAHLIAN: SATU SUMBER DATA TERPADU (7 JURUSAN LENGKAP)
    const majorsData = [
      {
        key: "rpl",
        code: "PPLG",
        num: "01",
        title: "Pengembang Perangkat Lunak & Gim",
        badge: "ALUR PENDIDIKAN VOKASI • PPLG",
        tefa: "Software House TEFA SMEMSA & Lab iMac Cloud",
        certSummary: "LSP-P1 BNSP Junior Web Developer & Cloud Database",
        logo: "assets/major/PPLG-removebg-preview.png",
        foto: "assets/major-person/rpl.png",
        desc: "Mencetak software engineer berkarakter Islami yang menguasai ekosistem web modern, mobile app development, backend cloud, dan siap terjun ke industri teknologi.",
        kompetensi: [
          "Web Modern (HTML5, CSS3, JS, Laravel/Node)",
          "Mobile Application (Flutter & Kotlin)",
          "Database SQL & Firebase Cloud Server",
        ],
        tempatPraktik: {
          title: "Software House TEFA SMEMSA",
          items: [
            "Pengerjaan proyek sistem informasi & aplikasi web klien.",
            "Lab iMac & Workstation gigabit standar industri.",
          ],
          box: "Portofolio live production sebelum wisuda.",
        },
        sertifikasi: {
          title: "LSP-P1 BNSP & Cloud",
          items: [
            "Skema Junior Web Developer & Programmer (BNSP).",
            "Sertifikasi Internasional Cloud & Database.",
          ],
          box: "Sertifikat Garuda Emas resmi diakui ASEAN.",
        },
        setelahLulus: {
          title: "Mitra Dudika & Karir",
          items: [
            "Mitra: Semesta Multitekno, Hummatech, Jagoan Hosting.",
            "Karir: Frontend/Backend Developer, QA, IT Support.",
          ],
          box: "Penyaluran via BKK & inkubasi startup.",
        },
      },
      {
        key: "tkj",
        code: "TJKT",
        num: "02",
        title: "Teknik Jaringan Komputer & Telekomunikasi",
        badge: "ALUR PENDIDIKAN VOKASI • TJKT",
        tefa: "ISP & Network Operations Center (NOC) TEFA",
        certSummary: "LSP-P1 BNSP Network Administrator & MikroTik MTCNA",
        logo: "assets/major/TJKT-removebg-preview.png",
        foto: "assets/major-person/tkj.png",
        desc: "Spesialisasi arsitektur jaringan skala enterprise, instalasi fiber optic backbone, administrasi server Linux/Cloud, dan protokol pertahanan cyber security.",
        kompetensi: [
          "Routing-Switching Enterprise (Cisco & MikroTik)",
          "Instalasi & Splicing Kabel Fiber Optic (FTTH/OTDR)",
          "Administrasi Cloud Server Linux & Virtualisasi",
        ],
        tempatPraktik: {
          title: "TEFA Network Operation Center",
          items: [
            "Pengelolaan infrastruktur internet sekolah 24/7.",
            "Lab Fiber Optic & Cisco Router Rack industri.",
          ],
          box: "Troubleshooting jaringan live production.",
        },
        sertifikasi: {
          title: "MikroTik & BNSP",
          items: [
            "LSP-P1 BNSP: Network Administrator Madya & FO.",
            "Sertifikasi Internasional MikroTik (MTCNA).",
          ],
          box: "Diakui oleh asosiasi APJII seluruh Indonesia.",
        },
        setelahLulus: {
          title: "Mitra Dudika & Karir",
          items: [
            "Mitra: PT Telkom Indonesia, Telkomsel, Lintasarta.",
            "Karir: Network Engineer, Cloud Admin, Teknisi FO.",
          ],
          box: "Prioritas rekrutmen ISP regional Jawa Timur.",
        },
      },
      {
        key: "dkv",
        code: "DKV",
        num: "03",
        title: "Desain Komunikasi Visual",
        badge: "ALUR PENDIDIKAN VOKASI • DKV",
        tefa: "Studio Creative Agency & Multimedia Lab",
        certSummary: "LSP-P1 BNSP Desainer Grafis & Adobe Certified Pro",
        logo: "assets/major/dkv.png",
        foto: "assets/major-person/dkv.png",
        desc: "Pusat eksplorasi visual komersial, produksi video sinematik, animasi motion graphics 2D/3D, branding periklanan, dan perancangan antarmuka digital UI/UX.",
        kompetensi: [
          "Desain Komersial, Brand Identity & Ilustrasi Vektor",
          "Videografi Sinematik, Lighting & Audio Engineering",
          "User Interface & UX Design (Figma & Prototyping)",
        ],
        tempatPraktik: {
          title: "Studio Creative Agency TEFA",
          items: [
            "Pesanan video profil korporat & foto produk UMKM.",
            "Studio Green Screen & Broadcast Audio Suite.",
          ],
          box: "Produksi konten bernilai jual komersial tinggi.",
        },
        sertifikasi: {
          title: "Adobe Certified & BNSP",
          items: [
            "LSP-P1 BNSP: Desainer Grafis Muda & Multimedia.",
            "Sertifikasi Adobe Certified Professional (Ps, Ai, Pr).",
          ],
          box: "Standar kompetensi industri periklanan kreatif.",
        },
        setelahLulus: {
          title: "Mitra Dudika & Karir",
          items: [
            "Mitra: Studio Kinetik, Citra Visual, Radar Banyuwangi.",
            "Karir: UI/UX Designer, Motion Animator, Creative Director.",
          ],
          box: "Portofolio aktif Behance/Dribbble siap kerja.",
        },
      },
      {
        key: "bd",
        code: "BD",
        num: "04",
        title: "Bisnis Digital",
        badge: "ALUR PENDIDIKAN VOKASI • BISNIS DIGITAL",
        tefa: "SMEMSA E-Commerce Hub & Live Studio TEFA",
        certSummary: "LSP-P1 BNSP Toko Daring & Meta Certified Marketing",
        logo: "assets/major/logo bdp.png",
        foto: "assets/major-person/BD.png",
        desc: "Mengolaborasikan strategi niaga modern dengan teknologi: manajemen marketplace omnichannel, paid digital ads (Meta & Google), live commerce selling, dan analitik data pasar.",
        kompetensi: [
          "Manajemen Marketplace (Shopee, TikTok Shop, Tokopedia)",
          "Digital Ads Marketing (Meta Ads, Google Ads & TikTok)",
          "Live Commerce Broadcasting & Copywriting Persuasif",
        ],
        tempatPraktik: {
          title: "SMEMSA E-Commerce Hub TEFA",
          items: [
            "Studio Live Streaming komersial penjualan harian.",
            "Mini Fulfillment Center: pergudangan & ekspedisi.",
          ],
          box: "Praktik omzet nyata dan kalkulasi profit harian.",
        },
        sertifikasi: {
          title: "Digital Marketing BNSP",
          items: [
            "LSP-P1 BNSP: Pengelola Toko Daring & Digital Marketer.",
            "Meta Certified Digital Marketing Associate.",
          ],
          box: "Legalitas kompetensi resmi agensi pemasaran.",
        },
        setelahLulus: {
          title: "Mitra Dudika & Karir",
          items: [
            "Mitra: Astra International (Digital), JNE, Brand Fashion.",
            "Karir: E-Commerce Specialist, Ads Optimizer, Live Host.",
          ],
          box: "Banyak siswa beromzet mandiri sebelum lulus.",
        },
      },
      {
        key: "akl",
        code: "AKL",
        num: "05",
        title: "Akuntansi & Keuangan Lembaga",
        badge: "ALUR PENDIDIKAN VOKASI • AKL",
        tefa: "Bank Mini Syariah SMEMSA & Tax Center TEFA",
        certSummary: "LSP-P1 BNSP Teknisi Akuntansi & Accurate Professional",
        logo: "assets/major/logo AKL.png",
        foto: "assets/major-person/ak.png",
        desc: "Membina teknisi akuntansi handal yang menguasai software akuntansi komputer, perpajakan digital (e-Faktur/e-SPT), audit laporan korporasi, dan layanan perbankan syariah.",
        kompetensi: [
          "Software Komputer Akuntansi (Accurate & MYOB)",
          "Perpajakan Digital (e-SPT, e-Faktur, PPh 21/23/PPN)",
          "Penyusunan Laporan Keuangan Manufaktur & UMKM",
        ],
        tempatPraktik: {
          title: "Bank Mini Syariah TEFA",
          items: [
            "Layanan tabungan siswa & simulasi teller perbankan riil.",
            "Tax Center: konsultasi & pengisian SPT tahunan.",
          ],
          box: "Standar SOP Teller & CS perbankan nasional.",
        },
        sertifikasi: {
          title: "Teknisi Akuntansi BNSP",
          items: [
            "LSP-P1 BNSP: Teknisi Akuntansi Yunior & Pajak Terapan.",
            "Sertifikasi Software Accurate Professional.",
          ],
          box: "Diakui kantor akuntan publik & perbankan.",
        },
        setelahLulus: {
          title: "Mitra Dudika & Karir",
          items: [
            "Mitra: Bank Jatim Syariah, BSI, BMT Genteng, KAP.",
            "Karir: Junior Accountant, Tax Officer, Teller Bank, Payroll.",
          ],
          box: "Jalur prioritas rekrutmen institusi keuangan.",
        },
      },
      {
        key: "mplb",
        code: "MPLB",
        num: "06",
        title: "Manajemen Perkantoran",
        badge: "ALUR PENDIDIKAN VOKASI • MPLB",
        tefa: "SMEMSA Office Service & Executive Meeting Room",
        certSummary: "LSP-P1 BNSP Administrative Assistant & Digital Office",
        logo: "assets/major/mp.jpeg",
        emoji: "🏢",
        foto: "assets/major-person/mp.png",
        desc: "Mencetak staf administrasi eksekutif dan sekretaris cekatan dengan kemampuan public relations prima, otomasi perkantoran digital cloud, dan keprotokolan formal.",
        kompetensi: [
          "Otomasi Kantor Digital (Google Workspace & ERP Admin)",
          "Manajemen Kearsipan Elektronik Modern (E-Records)",
          "Komunikasi Bisnis Internasional & Public Relations",
        ],
        tempatPraktik: {
          title: "SMEMSA Office Service TEFA",
          items: [
            "Pusat persuratan terpadu & resepsionis sekolah.",
            "Executive Meeting Simulator: tata ruang rapat korporat.",
          ],
          box: "Membiasakan etika kantor eksekutif sejak dini.",
        },
        sertifikasi: {
          title: "Administrasi Perkantoran BNSP",
          items: [
            "LSP-P1 BNSP: Executive Administrative Assistant & Arsip.",
            "Sertifikasi Digital Office Professional.",
          ],
          box: "Standarisasi kesekretariatan instansi & BUMN.",
        },
        setelahLulus: {
          title: "Mitra Dudika & Karir",
          items: [
            "Mitra: Instansi Pemerintah Daerah, PT Pelindo, Notaris.",
            "Karir: Sekretaris Eksekutif, Front Office Manager, HR Admin.",
          ],
          box: "Terserap cepat di BUMN dan korporasi swasta.",
        },
      },
      {
        key: "ph",
        code: "PH",
        num: "07",
        title: "Perhotelan",
        badge: "ALUR PENDIDIKAN VOKASI • PERHOTELAN",
        tefa: "Edutel Hotel SMEMSA & Mockup Suite Room TEFA",
        certSummary: "LSP-P1 BNSP Front Office Receptionist & CHSE",
        logo: "assets/major/PH.png",
        emoji: "🏨",
        foto: "assets/major-person/PH.png",
        desc: "Menyiapkan tenaga hospitality internasional: keahlian reservasi Front Office, tata graha Housekeeping bintang lima, food & beverage service, serta etiket perjamuan formal.",
        kompetensi: [
          "Property Management System (Front Office Reservation)",
          "Housekeeping Bintang Lima & Standard Bed Making",
          "Food & Beverage Service, Table Manner & Banquet",
        ],
        tempatPraktik: {
          title: "Edutel Hotel SMEMSA TEFA",
          items: [
            "Fasilitas penginapan riil beroperasi melayani tamu umum.",
            "Mockup Suite Room, Bar Resto & Commercial Laundry.",
          ],
          box: "Pengalaman melayani tamu standar hotel bintang 5.",
        },
        sertifikasi: {
          title: "Hospitality BNSP & CHSE",
          items: [
            "LSP-P1 BNSP: Front Office Receptionist & Housekeeper.",
            "Sertifikasi Kebersihan & Keselamatan Hotel (CHSE).",
          ],
          box: "Diakui jaringan hotel internasional & kapal pesiar.",
        },
        setelahLulus: {
          title: "Mitra Dudika & Karir",
          items: [
            "Mitra: Hotel Ketapang Indah, Dialoog Banyuwangi, Aston.",
            "Karir: Front Desk Agent, Housekeeper, F&B Captain, GRO.",
          ],
          box: "Peluang magang hotel resort Bali & kapal pesiar.",
        },
      },
    ];

    let activeMajorKey = "rpl";
    let hoverDebounceTimer = null;
    let preloadedImages = [];

    // B.2 PRELOAD SEMUA FOTO JURUSAN AGAR TIDAK ADA KEDIP SAAT HOVER
    function preloadMajorImages() {
      majorsData.forEach((m) => {
        if (m.foto) {
          const img = new Image();
          img.src = m.foto;
          preloadedImages.push(img);
        }
      });
    }

    // Render 8 Baris Jurusan dengan Aksesibilitas & Debounce Hover 120ms (B.1)
    function renderMajorTabList() {
      const container = document.getElementById("major-tablist-container");
      if (!container) return;

      container.innerHTML = majorsData
        .map(
          (m, index) => `
                <button class="major-nav-item ${m.key === activeMajorKey ? "active" : ""}"
                        id="tab-btn-${m.key}"
                        role="tab"
                        aria-selected="${m.key === activeMajorKey ? "true" : "false"}"
                        aria-controls="major-tabpanel-container"
                        tabindex="${m.key === activeMajorKey ? "0" : "-1"}"
                        onclick="handleMajorClick('${m.key}')"
                        onfocus="handleMajorFocus('${m.key}')"
                        onkeydown="handleMajorTabKey(event, ${index})"
                        onmouseenter="handleMajorMouseEnter('${m.key}')"
                        onmouseleave="handleMajorMouseLeave()">
                    <span class="major-nav-num">${m.num}</span>
                    <div class="major-nav-content">
                        <div class="major-nav-top">
                            <h4 class="major-nav-name">${m.title}</h4>
                            <span class="major-nav-code">${m.code}</span>
                        </div>
                        <p class="major-nav-tefa">TEFA: ${m.tefa}</p>
                    </div>
                    <span class="major-nav-chevron">&rarr;</span>
                </button>
            `,
        )
        .join("");
    }

    // B.1 Debounce 120ms untuk Mouse Enter
    function handleMajorMouseEnter(majorKey) {
      clearTimeout(hoverDebounceTimer);
      if (window.innerWidth > 900 && majorKey !== activeMajorKey) {
        hoverDebounceTimer = setTimeout(() => {
          selectMajorPathway(majorKey);
        }, 120);
      }
    }

    function handleMajorMouseLeave() {
      clearTimeout(hoverDebounceTimer);
    }

    // Klik & Focus mengganti SEKETIKA tanpa jeda debounce
    /* Kembalikan panel ke kolom aslinya saat layar melebar ke desktop */
    let majorLayoutTimer;
    window.addEventListener("resize", function () {
      clearTimeout(majorLayoutTimer);
      majorLayoutTimer = setTimeout(function () {
        const panel = document.getElementById("major-tabpanel-container");
        const grid = document.querySelector(".majors-content-grid")
          || document.querySelector(".majors-list-col")?.parentNode;
        if (!panel || !grid) return;
        if (window.innerWidth > 900 && panel.parentNode !== grid) {
          grid.appendChild(panel);
        }
      }, 200);
    });

    function handleMajorClick(majorKey) {
      clearTimeout(hoverDebounceTimer);
      selectMajorPathway(majorKey);
    }

    function handleMajorFocus(majorKey) {
      clearTimeout(hoverDebounceTimer);
      if (majorKey !== activeMajorKey) {
        selectMajorPathway(majorKey);
      }
    }

    // Navigasi Keyboard Panah Atas & Bawah antar Jurusan (A11y)
    function handleMajorTabKey(event, currentIndex) {
      let nextIndex = currentIndex;
      if (event.key === "ArrowDown" || event.key === "ArrowRight") {
        event.preventDefault();
        nextIndex = (currentIndex + 1) % majorsData.length;
      } else if (event.key === "ArrowUp" || event.key === "ArrowLeft") {
        event.preventDefault();
        nextIndex =
          (currentIndex - 1 + majorsData.length) % majorsData.length;
      } else if (event.key === "Home") {
        event.preventDefault();
        nextIndex = 0;
      } else if (event.key === "End") {
        event.preventDefault();
        nextIndex = majorsData.length - 1;
      } else {
        return;
      }

      const nextMajor = majorsData[nextIndex];
      if (nextMajor) {
        selectMajorPathway(nextMajor.key);
        const nextBtn = document.getElementById(`tab-btn-${nextMajor.key}`);
        if (nextBtn) nextBtn.focus();
      }
    }

    // Lompat dari Hero Search / Chips
    function jumpToMajor(majorKey) {
      const section = document.getElementById("jurusan");
      if (section) {
        if (typeof lenis !== "undefined" && lenis) {
          lenis.scrollTo(section, { offset: -70, duration: 1.0 });
        } else {
          section.scrollIntoView({ behavior: "smooth" });
        }
      }
      selectMajorPathway(majorKey);
    }

    let pathwaySwitchTimeout = null;

    // B.3 Pilih Jurusan & Update Panel dengan Transisi Cepat (250ms) dan Overwrite Tween
    function selectMajorPathway(majorKey) {
      const major = majorsData.find((m) => m.key === majorKey);
      if (!major) return;

      activeMajorKey = majorKey;

      // 1. Update State Tombol Tab
      document.querySelectorAll(".major-nav-item").forEach((btn) => {
        const isActive = btn.id === `tab-btn-${majorKey}`;
        btn.classList.toggle("active", isActive);
        btn.setAttribute("aria-selected", isActive ? "true" : "false");
        btn.setAttribute("tabindex", isActive ? "0" : "-1");
      });

      // 2. Update Label Tabpanel
      const panelContainer = document.getElementById(
        "major-tabpanel-container",
      );
      if (panelContainer) {
        panelContainer.setAttribute("aria-labelledby", `tab-btn-${majorKey}`);
      }

      // 3. Update Konten Panel dengan Transisi Cepat (Maks 250ms)
      const pathwayView = document.getElementById("major-pathway-view");
      if (!pathwayView) return;

      // Batalkan timeout sebelumnya jika ada pergantian cepat
      if (pathwaySwitchTimeout) clearTimeout(pathwaySwitchTimeout);

      // Jika GSAP aktif, hentikan tween berjalan
      if (typeof gsap !== "undefined") {
        gsap.killTweensOf(pathwayView);
      }

      pathwayView.classList.add("anim-switching");

      pathwaySwitchTimeout = setTimeout(() => {
        const photoEl = document.getElementById("panel-student-photo");
        const cornerLogoEl = document.getElementById("panel-figure-logo");
        const fallbackEl = document.getElementById("panel-figure-fallback");
        const fallbackCodeEl = document.getElementById("panel-fallback-code");
        const codeEl = document.getElementById("panel-major-code");
        const titleEl = document.getElementById("panel-major-title");
        const descEl = document.getElementById("panel-major-desc");
        const tefaNameEl = document.getElementById("panel-tefa-name");
        const certNameEl = document.getElementById("panel-cert-name");
        const stage1El = document.getElementById("panel-flow-stage1");
        const stage2El = document.getElementById("panel-flow-stage2");
        const stage2Box = document.getElementById("panel-flow-stage2-box");
        const stage3El = document.getElementById("panel-flow-stage3");
        const stage3Box = document.getElementById("panel-flow-stage3-box");
        const stage4El = document.getElementById("panel-flow-stage4");
        const stage4Box = document.getElementById("panel-flow-stage4-box");

        // Foto Siswa & Fallback
        if (photoEl) {
          if (major.foto) {
            photoEl.style.display = "block";
            photoEl.src = major.foto;
            photoEl.alt = `Siswa Berseragam ${major.title}`;
            if (fallbackEl) fallbackEl.style.display = "none";
          } else {
            photoEl.style.display = "none";
            if (fallbackEl) {
              fallbackEl.style.display = "flex";
              if (fallbackCodeEl) fallbackCodeEl.textContent = major.code;
            }
          }

          if (major.key === "rpl") {
            photoEl.removeAttribute("loading");
          } else {
            photoEl.setAttribute("loading", "lazy");
          }
        }

        // Logo Pojok Figur
        if (cornerLogoEl) {
          if (major.logo) {
            cornerLogoEl.innerHTML = `<img src="${major.logo}" alt="Logo ${major.code}" width="28" height="28" onerror="this.closest('.card') ? this.closest('.card').classList.add('no-image') : null; this.remove();">`;
          } else if (major.emoji) {
            cornerLogoEl.innerHTML = `<span class="corner-emoji">${major.emoji}</span>`;
          } else {
            cornerLogoEl.innerHTML = `<span class="corner-emoji">🎓</span>`;
          }
        }

        // Identitas Kanan
        if (codeEl) codeEl.textContent = major.code;
        if (titleEl) titleEl.textContent = major.title;
        if (descEl) descEl.textContent = major.desc;
        if (tefaNameEl) tefaNameEl.textContent = major.tefa;
        if (certNameEl) certNameEl.textContent = major.certSummary;

        // Alur 4 Tahap
        if (stage1El) {
          stage1El.innerHTML = major.kompetensi
            .map((c) => `<li>${c}</li>`)
            .join("");
        }
        if (stage2El) {
          stage2El.innerHTML = major.tempatPraktik.items
            .map((t) => `<li>${t}</li>`)
            .join("");
        }
        if (stage2Box) stage2Box.textContent = major.tempatPraktik.box;

        if (stage3El) {
          stage3El.innerHTML = major.sertifikasi.items
            .map((s) => `<li>${s}</li>`)
            .join("");
        }
        if (stage3Box) stage3Box.textContent = major.sertifikasi.box;

        if (stage4El) {
          stage4El.innerHTML = major.setelahLulus.items
            .map((l) => `<li>${l}</li>`)
            .join("");
        }
        if (stage4Box) stage4Box.textContent = major.setelahLulus.box;

        pathwayView.classList.remove("anim-switching");

        /* MOBILE: panel dipindahkan tepat DI BAWAH baris jurusan yang
           diketuk, sehingga bekerja seperti akordeon. Pengguna tidak
           perlu menggulir naik-turun untuk berpindah jurusan. */
        if (window.innerWidth <= 900) {
          setTimeout(() => {
            const panel = document.getElementById("major-tabpanel-container");
            const item = document.getElementById("tab-btn-" + majorKey);
            if (panel && item && item.parentNode) {
              if (item.nextElementSibling !== panel) {
                item.parentNode.insertBefore(panel, item.nextElementSibling);
              }
              // Gulir hanya sedikit, cukup agar panel terlihat
              const rect = panel.getBoundingClientRect();
              if (rect.top < 0 || rect.top > window.innerHeight * 0.6) {
                if (typeof lenis !== "undefined" && lenis) {
                  lenis.scrollTo(item, { offset: -90, duration: 0.6 });
                } else {
                  item.scrollIntoView({ behavior: "smooth", block: "start" });
                }
              }
            }
          }, 50);
        }
      }, 125);
    }

    // Inisialisasi awal saat load
    preloadMajorImages();
    renderMajorTabList();
    selectMajorPathway("rpl");

    // 7. AI Chatbot Logic
    const chatbotToggle = document.getElementById("chatbot-toggle");
    const chatPanel = document.getElementById("chat-panel");
    const chatBody = document.getElementById("chat-body");
    const chatInput = document.getElementById("chat-input-text");

    if (chatbotToggle) {
      chatbotToggle.addEventListener("click", () => {
        chatPanel.classList.toggle("active");
      });
    }

    function appendMsg(text, sender) {
      const div = document.createElement("div");
      div.className = `chat-msg ${sender}`;
      div.innerText = text;
      chatBody.appendChild(div);
      chatBody.scrollTop = chatBody.scrollHeight;
    }

    function getBotResponse(input) {
      const text = input.toLowerCase();
      if (
        text.includes("jurusan") ||
        text.includes("prodi") ||
        text.includes("keahlian")
      ) {
        return "SMEMSA Genteng memiliki 7 Konsentrasi Keahlian Unggulan Industri:\n1. PPLG (Pengembang Perangkat Lunak & Gim)\n2. TJKT (Teknik Jaringan Komputer & Telekomunikasi)\n3. DKV (Desain Komunikasi Visual)\n4. BD (Bisnis Digital)\n5. AKL (Akuntansi & Keuangan Lembaga)\n6. MPLB (Manajemen Perkantoran)\n7. PH (Perhotelan)";
      } else if (
        text.includes("spmb") ||
        text.includes("daftar") ||
        text.includes("syarat") ||
        text.includes("biaya") ||
        text.includes("alur") ||
        text.includes("jadwal")
      ) {
        return "Alur Pendaftaran SPMB SMEMSA TA 2026/2027:\n\n🌐 ALUR ONLINE (Praktis & Cepat):\n1. Akses halaman Pendaftaran di website/menu SPMB.\n2. Isi data diri & pilih konsentrasi keahlian impian.\n3. Upload berkas (Rapor/SKL, KK, Akta).\n4. Cetak Kartu Pendaftaran & konfirmasi via WA Panitia.\n\n🏫 ALUR OFFLINE (Langsung di Sekolah):\n1. Datang ke Sekretariat SPMB SMEMSA Genteng (Jl. KH Imam Bahri No.10).\n2. Dampingi oleh Tim Admin pendaftaran untuk pengisian form.\n3. Verifikasi berkas cetak & pengukuran seragam di tempat.\n4. Menerima bukti pendaftaran resmi & informasi orientasi.";
      } else if (
        text.includes("loker") ||
        text.includes("bkk") ||
        text.includes("kerja") ||
        text.includes("magang") ||
        text.includes("lowongan")
      ) {
        return "🔥 Lowongan Kerja Terbaru Bursa Kerja Khusus (BKK) SMEMSA:\n\n1. Web & Mobile Developer - PT Digital Kreatif Nusantara (Malang)\n   • Gaji: Rp 4.200.000 - Rp 6.000.000 / bln\n   • Kualifikasi: Lulusan PPLG, paham JS/Laravel/Flutter.\n\n2. Junior Network & Cloud Support - PT Telkomsel Infrastructure (Surabaya)\n   • Gaji: Rp 4.500.000 - Rp 5.800.000 / bln\n   • Kualifikasi: Lulusan TJKT, menguasai MikroTik / Fiber Optic.\n\n3. Graphic & Motion Designer - Studio Visual Kinetik (Banyuwangi)\n   • Gaji: Rp 3.200.000 - Rp 4.500.000 / bln\n   • Kualifikasi: Lulusan DKV, mahir Adobe Ps/Ai/Pr.\n\n4. E-Commerce & Social Media Host - PT Astra Digital Commerce (Surabaya)\n   • Gaji: Rp 3.800.000 - Rp 5.000.000 / bln\n   • Kualifikasi: Lulusan BD/MPLB, komunikatif & mahir Live Streaming.\n\n5. Front Office & Hospitality Staff - Hotel Ketapang Indah / Dialoog Resort\n   • Gaji: Rp 3.500.000 - Rp 4.800.000 / bln\n   • Kualifikasi: Lulusan PH, penampilan menarik, bahasa Inggris aktif.\n\n💼 Pendaftaran & penyerahan berkas langsung melalui Kantor BKK SMEMSA!";
      } else if (
        text.includes("lsp") ||
        text.includes("bnsp") ||
        text.includes("sertifikat")
      ) {
        return "SMEMSA memiliki Lembaga Sertifikasi Profesi Pihak Kesatu (LSP-P1) berlisensi resmi BNSP. Setiap lulusan dibekali Ijazah + Sertifikat Kompetensi Garuda Emas berstandar nasional.";
      } else if (text.includes("kepala") || text.includes("wahid")) {
        return "Kepala Sekolah SMKS Muhammadiyah 1 Genteng adalah Bapak Wahid Wahyudi, S.E., M.M.";
      } else if (text.includes("fasilitas") || text.includes("lab")) {
        return "Fasilitas unggulan meliputi Lab iMac PPLG, TEFA NOC & Fiber Optic TJKT, Studio Creative DKV, Live E-Commerce Hub BD, Bank Mini Syariah AKL, Executive Office MPLB, dan Edutel Hotel PH.";
      } else {
        return "Terima kasih atas pertanyaannya! Silakan tanya mengenai Info 7 Jurusan, Alur SPMB (Online/Offline), Lowongan Kerja BKK, atau Sertifikasi LSP-P1 BNSP. Anda juga bisa menghubungi Panitia via WA di 0822-4135-6668.";
      }
    }

    function handleChatSubmit() {
      const text = chatInput.value.trim();
      if (!text) return;
      appendMsg(text, "user");
      chatInput.value = "";
      setTimeout(() => {
        appendMsg(getBotResponse(text), "bot");
      }, 400);
    }

    function sendQuickMsg(text) {
      appendMsg(text, "user");
      setTimeout(() => {
        appendMsg(getBotResponse(text), "bot");
      }, 400);
    }

    if (chatInput) {
      chatInput.addEventListener("keypress", (e) => {
        if (e.key === "Enter") handleChatSubmit();
      });
    }

    // 8. GSAP ScrollTrigger Animations
    gsap.registerPlugin(ScrollTrigger);

    // Counter Numbers Animation
    const counters = document.querySelectorAll(".counter-value");
    counters.forEach((counter) => {
      const target = parseInt(counter.getAttribute("data-target"));
      ScrollTrigger.create({
        trigger: counter,
        start: "top 90%",
        once: true,
        onEnter: () => {
          let zero = { val: 0 };
          gsap.to(zero, {
            val: target,
            duration: 2,
            ease: "power2.out",
            onUpdate: () => {
              counter.innerHTML = Math.floor(zero.val);
            },
          });
        },
      });
    });

    /* =====================================================================
           TEXT SCROLL ANIMATION (skiper31-style)
           Kata demi kata memudar masuk seiring scroll, di-scrub oleh Lenis.
           ===================================================================== */
    const prefersReducedMotion = window.matchMedia(
      "(prefers-reduced-motion: reduce)",
    ).matches;

    // Pecah teks menjadi <span class="sr-word"> per kata (spasi dipertahankan)
    function splitIntoWords(el) {
      if (el.dataset.srSplit === "true")
        return Array.from(el.querySelectorAll(".sr-word"));
      const words = el.textContent.trim().split(/\s+/);
      el.textContent = "";
      const frag = document.createDocumentFragment();
      words.forEach((w, i) => {
        const span = document.createElement("span");
        span.className = "sr-word";
        span.textContent = w;
        frag.appendChild(span);
        if (i < words.length - 1)
          frag.appendChild(document.createTextNode(" "));
      });
      el.appendChild(frag);
      el.dataset.srSplit = "true";
      return Array.from(el.querySelectorAll(".sr-word"));
    }

    // Reveal mandiri (elemen yang tidak berada di dalam section ter-pin)
    document.querySelectorAll("[data-scroll-reveal]").forEach((el) => {
      if (el.closest(".sinergi-section") || el.closest("#sinergi")) return; // ditangani timeline pinned di bawah
      const words = splitIntoWords(el);
      if (prefersReducedMotion) return;

      gsap.to(words, {
        opacity: 1,
        filter: "blur(0px)",
        y: 0,
        ease: "none",
        stagger: 0.6,
        scrollTrigger: {
          trigger: el,
          start: "top 85%",
          end: "bottom 60%",
          once: true,
          scrub: 0.8,
        },
      });
    });

    /* =====================================================================
           HERO SECTION ANIMATIONS
           ===================================================================== */
    if (!prefersReducedMotion) {
      const heroTL = gsap.timeline({ defaults: { ease: "power3.out" } });

      // Left column texts
      const leftEls = [
        ".hero-text-col .badge",
        ".hero-text-col .hero-headline",
        ".hero-text-col .hero-lead",
        ".hero-text-col .hero-actions",
      ];
      heroTL.from(leftEls, {
        opacity: 0,
        x: -24,
        duration: 0.8,
        stagger: 0.1,
      });

      // Right column images
      const rightEls = [".hero-students-img"];
      heroTL.from(
        rightEls,
        {
          opacity: 0,
          y: 30,
          duration: 0.8,
          stagger: 0.12,
        },
        "-=0.6",
      );
    }

    /* =====================================================================
           SCROLL PARALLAX ENGINE
           Pakai atribut: data-parallax="0.25"  (positif = lebih lambat/turun,
           negatif = berlawanan arah). Nilai = fraksi dari tinggi section.
           ===================================================================== */
    function initParallax() {
      if (prefersReducedMotion) return;

      document.querySelectorAll("[data-parallax]").forEach((layer) => {
        const speed = parseFloat(layer.dataset.parallax) || 0;
        const section = layer.closest("section") || layer.parentElement;

        gsap.fromTo(
          layer,
          { yPercent: -speed * 50 },
          {
            yPercent: speed * 50,
            ease: "none",
            scrollTrigger: {
              trigger: section,
              start: "top bottom",
              end: "bottom top",
              scrub: 1,
            },
          },
        );
      });
    }
    initParallax();

    // Depth reveal untuk kartu: naik + skala halus, berurutan
    [
      ".major-path-card",
      ".why-bento-card",
      ".step-card",
      ".product-bento",
      ".article-card",
      ".stat-card",
    ].forEach((sel) => {
      const items = document.querySelectorAll(sel);
      if (!items.length || prefersReducedMotion) return;

      ScrollTrigger.batch(items, {
        start: "top 85%",
        once: true,
        onEnter: (batch) =>
          gsap.fromTo(
            batch,
            { opacity: 0, y: 40, scale: 0.98 },
            {
              opacity: 1,
              y: 0,
              scale: 1,
              duration: 0.65,
              stagger: 0.08,
              ease: "power3.out",
              clearProps: "transform",
            },
          ),
      });
    });

    // 8. TIGA PILAR SINERGI VOKASI - GSAP PINNED SCROLLTRIGGER ANIMATION
    const synergyStage = document.getElementById("synergy-stage");
    if (synergyStage && !prefersReducedMotion) {
      // Split quote text into word spans using existing splitIntoWords()
      const quoteEl = document.getElementById("synergy-main-quote");
      const quoteWords = quoteEl ? splitIntoWords(quoteEl) : [];

      // Initial states via GSAP (so content stays visible if JS disabled)
      gsap.set(["#node-vokasi", "#node-islami", "#node-bnsp"], {
        opacity: 0,
        scale: 0.3,
        svgOrigin: "250 160",
      });
      gsap.set(["#line-top-right", "#line-right-left", "#line-left-top"], {
        strokeDashoffset: 400,
      });
      gsap.set("#synergy-center-star", {
        opacity: 0,
        scale: 0,
        rotation: 0,
        svgOrigin: "250 160",
      });
      gsap.set("#synergy-star-aura", {
        opacity: 0,
        scale: 0.2,
        svgOrigin: "250 160",
      });
      gsap.set("#synergy-kicker", { opacity: 0, y: 14 });
      gsap.set(quoteWords, { opacity: 0.15, filter: "blur(2px)", y: 6 });
      gsap.set("#synergy-closing", { opacity: 0, y: 12 });
      gsap.set("#synergy-action-btn", { opacity: 0, y: 12 });
      gsap.set("#synergy-progress-bar", { width: "0%" });

      // Master Timeline: Pinned and Scrubbed on #sinergi
      const synergyTL = gsap.timeline({
        scrollTrigger: {
          trigger: "#sinergi",
          start: "top top",
          end: "+=200%",
          pin: true,
          scrub: 1,
          anticipatePin: 1,
          onUpdate: (self) => {
            // Progres rail tipis di bawah section
            const bar = document.getElementById("synergy-progress-bar");
            if (bar) bar.style.width = self.progress * 100 + "%";
          },
        },
      });

      // 1. Tiga node muncul berurutan (Keahlian Vokasi, Karakter Islami, Sertifikasi BNSP)
      synergyTL
        .to("#node-vokasi", {
          opacity: 1,
          scale: 1,
          duration: 0.6,
          ease: "back.out(1.7)",
        })
        .to(
          "#node-islami",
          { opacity: 1, scale: 1, duration: 0.6, ease: "back.out(1.7)" },
          "-=0.3",
        )
        .to(
          "#node-bnsp",
          { opacity: 1, scale: 1, duration: 0.6, ease: "back.out(1.7)" },
          "-=0.3",
        );

      // 2. Garis segitiga sinergi tergambar menghubungkan ketiga node
      synergyTL.to(
        ["#line-top-right", "#line-right-left", "#line-left-top"],
        {
          strokeDashoffset: 0,
          duration: 1.0,
          stagger: 0.2,
          ease: "power2.inOut",
        },
      );

      // Jeda agar garis & segitiga sempat terbaca (+=0.3)
      // 3. Node & garis menyusut ke pusat lalu melebur
      synergyTL
        .to(
          ["#node-vokasi", "#node-islami", "#node-bnsp"],
          {
            scale: 0,
            opacity: 0,
            duration: 0.7,
            ease: "power2.in",
          },
          "+=0.3",
        )
        .to(
          ["#line-top-right", "#line-right-left", "#line-left-top"],
          {
            opacity: 0,
            duration: 0.5,
            ease: "power2.in",
          },
          "<",
        );

      // 4. Bintang lahir di pusat: skala 0 -> 1, garis luar + aura halus menyala (opacity 0.45)
      synergyTL
        .to(
          "#synergy-star-aura",
          {
            opacity: 0.45,
            scale: 1,
            duration: 0.8,
            ease: "power2.out",
          },
          "-=0.2",
        )
        .to(
          "#synergy-center-star",
          {
            opacity: 1,
            scale: 1.0,
            duration: 0.8,
            ease: "back.out(2)",
          },
          "<",
        );

      // Jeda agar kelahiran bintang sempat terbaca (+=0.3)
      // 5. Bintang membesar, berputar 22 derajat, opacity turun jadi 0.22 (scale 1.8), aura opacity 0.18 (scale 1.3)
      synergyTL
        .to(
          "#synergy-center-star",
          {
            scale: 1.8,
            rotation: 22,
            opacity: 0.22,
            duration: 1.0,
            ease: "power1.inOut",
          },
          "+=0.3",
        )
        .to(
          "#synergy-star-aura",
          {
            scale: 1.3,
            opacity: 0.18,
            duration: 1.0,
            ease: "power1.inOut",
          },
          "<",
        );

      // 6. Kicker "Tiga Pilar, Satu Tujuan" muncul
      synergyTL.to(
        "#synergy-kicker",
        {
          opacity: 1,
          y: 0,
          duration: 0.5,
          ease: "power2.out",
        },
        "-=0.4",
      );

      // 7. Kalimat utama tampil kata demi kata (.sr-word)
      if (quoteWords.length > 0) {
        synergyTL.to(
          quoteWords,
          {
            opacity: 1,
            filter: "blur(0px)",
            y: 0,
            ease: "none",
            stagger: 0.08,
            duration: 1.4,
          },
          "-=0.2",
        );
      }

      // 8. Kalimat penutup memudar masuk
      synergyTL.to(
        "#synergy-closing",
        {
          opacity: 1,
          y: 0,
          duration: 0.6,
          ease: "power2.out",
        },
        "-=0.3",
      );

      // 9. Tombol Ajakan Menuju Jurusan Tampil di Akhir
      synergyTL.to(
        "#synergy-action-btn",
        {
          opacity: 1,
          y: 0,
          duration: 0.5,
          ease: "power2.out",
        },
        "+=0.1",
      );
    } else if (prefersReducedMotion) {
      // If reduced motion: make everything fully visible without pinning
      const quoteEl = document.getElementById("synergy-main-quote");
      if (quoteEl) splitIntoWords(quoteEl);
      document.querySelectorAll(".sr-word").forEach((w) => {
        w.style.opacity = "1";
        w.style.filter = "none";
        w.style.transform = "none";
      });
      gsap.set(
        [
          "#node-vokasi",
          "#node-islami",
          "#node-bnsp",
          "#synergy-center-star",
          "#synergy-star-aura",
          "#synergy-kicker",
          "#synergy-closing",
          "#synergy-action-btn",
        ],
        {
          opacity: 1,
          scale: 1,
          y: 0,
        },
      );
      const bar = document.getElementById("synergy-progress-bar");
      if (bar) bar.style.width = "100%";
    }

    // 9. Prestasi Section GSAP ScrollTrigger & Parallax
    const timelineBar = document.getElementById("timeline-bar");
    if (timelineBar) {
      gsap.to(timelineBar, {
        height: "100%",
        ease: "none",
        scrollTrigger: {
          trigger: ".timeline-box",
          start: "top 75%",
          end: "bottom 70%",
          scrub: 0.5,
        },
      });
    }

    // Stagger Reveal for Timeline Cards
    ScrollTrigger.batch(".prestasi-item", {
      onEnter: (batch) =>
        gsap.fromTo(
          batch,
          { opacity: 0, x: -30 },
          {
            opacity: 1,
            x: 0,
            duration: 0.8,
            stagger: 0.18,
            ease: "power2.out",
          },
        ),
      start: "top 85%",
      once: true,
    });

    // Parallax 3D Card Effect on Scroll
    const testiCard = document.getElementById("testi-parallax-card");
    if (testiCard) {
      gsap.fromTo(
        testiCard,
        { y: 60, rotationY: -4, rotationX: 4 },
        {
          y: -40,
          rotationY: 2,
          rotationX: -2,
          ease: "none",
          scrollTrigger: {
            trigger: ".achievements-section",
            start: "top bottom",
            end: "bottom top",
            scrub: 1.2,
          },
        },
      );
    }

    // Infinite Partner Marquee
    // Refresh posisi ScrollTrigger setelah font & gambar selesai dimuat,
    // supaya perhitungan parallax tidak meleset.
    window.addEventListener("load", () => ScrollTrigger.refresh());
    if (document.fonts && document.fonts.ready) {
      document.fonts.ready.then(() => ScrollTrigger.refresh());
    }

    gsap.to(".marquee-track", {
      xPercent: -50,
      ease: "none",
      duration: 22,
      repeat: -1,
    });

    /* ======================================================================
           X. RENDER BLUD PRODUCTS & INTERACTIVE MODAL
           ====================================================================== */
    const bludProducts = [
      {
        id: "eners-perfume",
        name: "Eners Perfume",
        subtitle: "Parfum Badan Premium Vokasi",
        jurusan: "Perhotelan (PH)",
        badge: "Teaching Factory • Perhotelan",
        desc: "Parfum badan eksklusif formulasi siswa Perhotelan SMEMSA Genteng.",
        detail: "Eners Perfume adalah produk unggulan hasil riset & praktik siswa Konsentrasi Keahlian Perhotelan. Menggunakan bibit parfum pilihan standar internasional, aman di kulit, tidak meninggalkan noda di pakaian, dan diracik dalam lingkungan lab Teaching Factory yang higienis.",
        varian: ["Bubblegum", "Taylor Swift", "Scandalous", "Baccarat"],
        kemasan: "Eau de Parfum 35 mL",
        highlight: "Siswa dilatih dalam manajemen produksi, kontrol kualitas (QC), kemasan estetik, hingga strategi pemasaran langsung ke kustomer.",
        foto: "assets/produk/produk-parfum-ph.webp",
        icon: "🌸",
        gradient: "linear-gradient(135deg, #064e3b 0%, #047857 100%)"
      },
      {
        id: "eners-perfume-laundry",
        name: "Eners Perfume Laundry",
        subtitle: "Pewangi Laundry Standar Hospitalitas",
        jurusan: "Perhotelan (PH)",
        badge: "Unit Usaha BLUD • Housekeeping",
        desc: "Parfum laundry konsentrat tinggi untuk pakaian segar & harum tahan lama.",
        detail: "Diformulasikan khusus oleh tim Teaching Factory Housekeeping Perhotelan untuk kebutuhan laundry hotel dan masyarakat umum. Menghasilkan keharuman serat kain yang bertahan berhari-hari tanpa merusak tekstur pakaian.",
        varian: ["Snappy Fresh", "Sakura Blossom"],
        kemasan: "250 mL & 1 Liter",
        highlight: "Standardisasi kebersihan hotel bintang, diproduksi dan dikelola oleh siswa Perhotelan sebagai unit bisnis nyata.",
        foto: "assets/produk/produk-ph.webp",
        icon: "🧺",
        gradient: "linear-gradient(135deg, #0284c7 0%, #0369a1 100%)"
      },
      {
        id: "catet-coffee",
        name: "Catet Coffee",
        subtitle: "Kopi Sangrai Komunitas IT SMEMSA",
        jurusan: "PPLG & TJKT (Kolaborasi)",
        badge: "Kolaborasi Lintas Jurusan IT",
        desc: "Kopi bubuk nusantara racikan spesial untuk menemani jam coding & produktivitas.",
        detail: "Catet Coffee merupakan produk wirausaha hasil kolaborasi siswa PPLG dan TJKT. Dipilih dari biji kopi arabika/robusta kualitas terbaik yang disangrai dengan profil sangrai sedang (medium roast), sangat cocok untuk penikmat kopi saat belajar dan bekerja.",
        catatan: "Cocok untuk French Press, V60, Vietnam Drip, dan Espresso Machine",
        kemasan: "30 gram (Sachet) & 100 gram (Pouch)",
        highlight: "Melatih siswa dalam sinergi antar-jurusan: PPLG menangani desain branding & website e-commerce, TJKT mengelola operasional & jaringan logistik.",
        foto: "assets/produk/produk-rpl-tkjt-kopi.webp",
        icon: "☕",
        gradient: "linear-gradient(135deg, #78350f 0%, #92400e 100%)"
      },
      {
        id: "drasina",
        name: "Drasina",
        subtitle: "Snack Ladrang Daun Sirih Cina",
        jurusan: "Bisnis Digital (BD)",
        badge: "Inovasi Kuliner • Bisnis Digital",
        desc: "Camilan renyah kaya khasiat herbal alami buatan siswa Bisnis Digital.",
        detail: "Drasina (Ladrang Sirih Cina) adalah kreasi kuliner sehat berbasis tanaman herbal Daun Sirih Cina. Mengombinasikan rasa gurih renyah tanpa bahan pengawet sintesis dengan khasiat tinggi antioksidan untuk kesehatan tubuh.",
        rasa: "Gurih Original & Pedas Manis",
        kemasan: "200 gram Standup Pouch",
        highlight: "Platform pembelajaran langsung siswa Bisnis Digital dalam riset produk, riset pasar, TikTok Live Selling, Shopee, & digital ads marketing.",
        foto: "assets/produk/produk-snack-bd.webp",
        icon: "🌱",
        gradient: "linear-gradient(135deg, #15803d 0%, #166534 100%)"
      },
      {
        id: "totebag-daur-ulang",
        name: "Totebag Daur Ulang Banner",
        subtitle: "Eco-Fashion Upcycling Bag",
        jurusan: "Desain Komunikasi Visual (DKV)",
        badge: "Creative Eco-Design • DKV",
        desc: "Tas daur ulang ramah lingkungan bermaterial flexi banner bekas event.",
        detail: "Produk ideasi ramah lingkungan dari siswa DKV yang mengolah limbah baliho/banner menjadi totebag bergaya urban, waterproof, dan berdaya tahan ekstra tinggi. Setiap tas memiliki corak grafis unik yang tidak ada duanya.",
        material: "Flexi Banner Recycled + Heavy Webbing Strap",
        fitur: "Tahan Air, Kapasitas Besar, Jahitan Kuat Double Stitch",
        highlight: "Mengasah kesadaran ekologis siswa DKV, keterampilan jahit industri kreatif, branding eco-friendly, dan katalogisasi visual komersial.",
        foto: 'assets/tefa/totenbag.jpeg',
        icon: "🛍️",
        gradient: "linear-gradient(135deg, #4338ca 0%, #3730a3 100%)"
      },
      {
        id: "icaremu",
        name: "iCareMu",
        subtitle: "Platform Digital Health & Care",
        jurusan: "Pengembang Perangkat Lunak & Gim (PPLG)",
        badge: "Software TEFA Project • PPLG",
        desc: "Aplikasi digital layanan kesehatan & konseling terpadu karya siswa PPLG.",
        detail: "iCareMu adalah produk perangkat lunak aplikasi berbasis web dan mobile yang dikembangkan oleh tim TEFA PPLG. Menyediakan fitur reservasi konsultasi, pencatatan rekam medis sederhana, dan notifikasi pengingat kesehatan mandiri.",
        platform: "Web App & Responsive Mobile UI",
        fitur: "Dashboard Pasien/Konselor, Multi-User Auth, Realtime Notification",
        highlight: "Siswa mempraktikkan SDLC (Software Development Life Cycle) modern, framework Laravel/Flutter, API integration, dan database Security.",
        foto: null,
        icon: "📱",
        gradient: "linear-gradient(135deg, #0d9488 0%, #0f766e 100%)"
      },
      {
        id: "minducare",
        name: "MinduCare",
        subtitle: "Aplikasi EdTech & Self-Assessment System",
        jurusan: "Pengembang Perangkat Lunak & Gim (PPLG)",
        badge: "EdTech Innovation • PPLG",
        desc: "Sistem aplikasi pencatatan perkembangan karakter & pendampingan konseling.",
        detail: "MinduCare diciptakan untuk mendukung sistem bimbingan dan konseling berbasis digital. Mengakomodasi fitur modul evaluasi mandiri, jurnal harian, dan analitik perkembangan siswa yang aman dan privat bagi guru pembimbing.",
        platform: "Cloud-Based Web Application",
        fitur: "Self-Assessment Survey, Analytics Charts, Encrypted Notes",
        highlight: "Siswa PPLG mengasah kemampuan UI/UX design, arsitektur database relasional, serta pengujian sistem (QA Testing) sebelum komersialisasi.",
        foto: null,
        icon: "💡",
        gradient: "linear-gradient(135deg, #6366f1 0%, #4f46e5 100%)"
      },
      {
        id: "jasa-reparasi-pc",
        name: "Jasa Reparasi & Instalasi Komputer",
        subtitle: "Layanan Service Hardware & Networking",
        jurusan: "Teknik Jaringan Komputer & Telekomunikasi (TJKT)",
        badge: "NOC TEFA Service • TJKT",
        desc: "Layanan profesional perbaikan PC, Laptop, Install OS, & Maintenance Jaringan.",
        detail: "Unit pelayanan teknis komersial dari TEFA TJKT. Melayani perawatan hardware komputer, pembersihan debu thermal paste, perbaikan kerusakan software/OS, instalasi driver, hingga setting jaringan Wi-Fi dan LAN untuk rumah & kantor.",
        layanan: "Servis PC/Laptop, Install Windows/Linux, Diagnostic Hardware, Splicing FO",
        garansi: "Garansi Service 30 Hari & Konsultasi Gratis",
        highlight: "Dikerjakan langsung oleh teknisi siswa bersertifikat LSP-P1 BNSP Network Administrator di bawah bimbingan instruktur profesional industri.",
        foto: 'assets/tefa/jasa-reparasi-komputer.webp',
        icon: "🛠️",
        gradient: "linear-gradient(135deg, #b45309 0%, #78350f 100%)"
      }
    ];

    function renderBludProducts() {
      const container = document.getElementById("blud-container");
      if (!container) return;

      let html = "";
      bludProducts.forEach((prod, index) => {
        let imageHtml = "";
        if (prod.foto) {
          imageHtml = `<div style="position: relative; overflow: hidden; border-radius: var(--radius-sm); margin-bottom: 1.2rem;">
            <img src="${prod.foto}" alt="${prod.name}" width="400" height="300" loading="lazy" style="width: 100%; height: 220px; object-fit: cover; border-radius: var(--radius-sm); transition: transform 0.4s ease;" onerror="this.closest('.product-bento') ? this.closest('.product-bento').classList.add('no-image') : null; this.remove();">
          </div>`;
        } else {
          imageHtml = `<div style="width: 100%; height: 220px; border-radius: var(--radius-sm); background: ${prod.gradient || 'linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%)'}; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.5rem; text-align: center; margin-bottom: 1.2rem; box-shadow: inset 0 2px 10px rgba(0,0,0,0.1);">
            <span style="font-size: 3rem; margin-bottom: 0.5rem;">${prod.icon || '💼'}</span>
            <h4 style="color: #fff; font-family: var(--font-display); font-size: 1.2rem; line-height: 1.3; font-weight: 800; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">${prod.name}</h4>
          </div>`;
        }

        let detailsHtml = "";
        if (prod.desc)
          detailsHtml += `<p style="font-size: 0.92rem; color: #cbd5e1; margin-bottom: 0.6rem; line-height: 1.5;">${prod.desc}</p>`;

        let specSummary = "";
        if (prod.kemasan) specSummary += `<span style="font-size: 0.82rem; color: #a8a29e; display: block; margin-bottom: 0.2rem;">📦 <strong>Kemasan:</strong> ${prod.kemasan}</span>`;
        if (prod.varian) {
          const vStr = Array.isArray(prod.varian) ? prod.varian.join(", ") : prod.varian;
          specSummary += `<span style="font-size: 0.82rem; color: #a8a29e; display: block; margin-bottom: 0.2rem;">🎨 <strong>Varian:</strong> ${vStr}</span>`;
        }

        html += `
          <div class="product-bento" style="padding: 1.5rem; justify-content: space-between; cursor: pointer;" onclick="openBludModal(${index})">
            <div>
              ${imageHtml}
              <div class="blud-learner-tag">💼 Dikelola siswa ${prod.jurusan}</div>
              <h3 class="font-head" style="font-size:1.25rem; color:#ffffff; margin: 0.4rem 0 0.6rem; line-height: 1.3;">${prod.name}</h3>
              ${detailsHtml}
              ${specSummary}
            </div>
          </div>
        `;
      });

      container.innerHTML = html;
    }

    function openBludModal(index) {
      const prod = bludProducts[index];
      if (!prod) return;

      const overlay = document.getElementById("blud-modal-overlay");
      const bgImg = document.getElementById("blud-modal-bg-img");
      const iconEmoji = document.getElementById("blud-modal-icon-emoji");
      const iconImg = document.getElementById("blud-modal-icon-img");
      const banner = document.getElementById("blud-modal-banner");

      if (prod.foto) {
        bgImg.src = prod.foto;
        bgImg.style.display = "block";
        iconImg.src = prod.foto;
        iconImg.style.display = "block";
        iconEmoji.style.display = "none";
      } else {
        bgImg.style.display = "none";
        iconImg.style.display = "none";
        iconEmoji.innerText = prod.icon || "💼";
        iconEmoji.style.display = "inline-block";
      }

      if (prod.gradient) {
        banner.style.background = prod.gradient;
      } else {
        banner.style.background = "linear-gradient(135deg, #064e3b 0%, #047857 100%)";
      }

      document.getElementById("blud-modal-tag").innerText = prod.badge || `💼 Dikelola siswa ${prod.jurusan}`;
      document.getElementById("blud-modal-title").innerText = prod.name;
      document.getElementById("blud-modal-desc").innerText = prod.detail || prod.desc;

      // Populate spec chips
      const chipsContainer = document.getElementById("blud-modal-chips");
      chipsContainer.innerHTML = "";

      if (prod.jurusan) {
        chipsContainer.innerHTML += `<span class="blud-modal-chip">🎓 <strong>Pengelola:</strong> ${prod.jurusan}</span>`;
      }
      if (prod.kemasan) {
        chipsContainer.innerHTML += `<span class="blud-modal-chip">📦 <strong>Kemasan:</strong> ${prod.kemasan}</span>`;
      }
      if (prod.varian && Array.isArray(prod.varian)) {
        chipsContainer.innerHTML += `<span class="blud-modal-chip">🎨 <strong>Varian:</strong> ${prod.varian.join(", ")}</span>`;
      } else if (prod.varian) {
        chipsContainer.innerHTML += `<span class="blud-modal-chip">🎨 <strong>Varian:</strong> ${prod.varian}</span>`;
      }
      if (prod.rasa) {
        chipsContainer.innerHTML += `<span class="blud-modal-chip">😋 <strong>Rasa:</strong> ${prod.rasa}</span>`;
      }
      if (prod.catatan) {
        chipsContainer.innerHTML += `<span class="blud-modal-chip">💡 <strong>Penyajian:</strong> ${prod.catatan}</span>`;
      }
      if (prod.material) {
        chipsContainer.innerHTML += `<span class="blud-modal-chip">🧵 <strong>Material:</strong> ${prod.material}</span>`;
      }
      if (prod.fitur) {
        chipsContainer.innerHTML += `<span class="blud-modal-chip">⚡ <strong>Fitur:</strong> ${prod.fitur}</span>`;
      }
      if (prod.platform) {
        chipsContainer.innerHTML += `<span class="blud-modal-chip">💻 <strong>Platform:</strong> ${prod.platform}</span>`;
      }
      if (prod.layanan) {
        chipsContainer.innerHTML += `<span class="blud-modal-chip">🛠️ <strong>Cakupan:</strong> ${prod.layanan}</span>`;
      }
      if (prod.garansi) {
        chipsContainer.innerHTML += `<span class="blud-modal-chip">🛡️ <strong>Garansi:</strong> ${prod.garansi}</span>`;
      }

      document.getElementById("blud-modal-highlight").innerText = prod.highlight || "Unit produksi BLUD memberikan pengalaman mengelola wirausaha nyata bagi siswa SMEMSA Genteng.";

      overlay.classList.add("active");
      const modalCard = document.getElementById("blud-modal-card");
      if (modalCard) modalCard.scrollTop = 0;

      document.body.style.overflow = "hidden";
      document.documentElement.style.overflow = "hidden";

      if (typeof lenis !== "undefined" && lenis) lenis.stop();
      else if (window.lenis) window.lenis.stop();
    }

    function closeBludModal() {
      const overlay = document.getElementById("blud-modal-overlay");
      if (overlay) overlay.classList.remove("active");
      document.body.style.overflow = "";
      document.documentElement.style.overflow = "";

      if (typeof lenis !== "undefined" && lenis) lenis.start();
      else if (window.lenis) window.lenis.start();
    }

    function closeBludModalOnOverlay(e) {
      if (e.target.id === "blud-modal-overlay") {
        closeBludModal();
      }
    }

    /* DATA UNIT USAHA SEKOLAH (TEFA & BLUD) */
    const unitUsahaData = [
      {
        title: "SMEMSA Print Studio",
        subtitle: "Percetakan & Merchandise Komersial",
        tag: "💼 Dikelola DKV & Bisnis Digital",
        icon: "🖨️",
        gradient: "linear-gradient(135deg, #064e3b 0%, #047857 100%)",
        desc: "Layanan percetakan digital profesional dan cetak merchandise berstandar industri. Melayani pesanan cetak banner outdoor/indoor, sablon kaos custom, mug suvenir, ID card institusi, hingga perlengkapan promosi usaha.",
        specs: [
          { label: "Pengelola", val: "Konsentrasi Keahlian DKV & Bisnis Digital" },
          { label: "Produk Utama", val: "Banner, Kaos Sablon, Mug, ID Card, Brosur" },
          { label: "Fasilitas", val: "Mesin Digital Print High-Res & Press Heat Studio" },
          { label: "Layanan", val: "Pemesanan Satuan & Partai Besar (Grosir)" }
        ],
        highlight: "Siswa terlibat langsung dalam proses pra-cetak (setting layout), proses produksi print/sablon, finishing, quality check, hingga manajemen transaksi finansial bisnis."
      },
      {
        title: "SMEMSA Tech Solutions",
        subtitle: "Service Center Hardware & Software House",
        tag: "💼 Dikelola TJKT & PPLG",
        icon: "🔧",
        gradient: "linear-gradient(135deg, #0284c7 0%, #0369a1 100%)",
        desc: "Pusat pelayanan teknologi terpadu yang melayani perbaikan laptop/PC, instalasi sistem operasi & jaringan Wi-Fi/LAN, hingga jasa pembuatan website e-commerce dan aplikasi digital untuk instansi & UMKM.",
        specs: [
          { label: "Pengelola", val: "Konsentrasi Keahlian TJKT & PPLG" },
          { label: "Layanan Tech", val: "Service Laptop/PC, Fiber Optic, Web Dev, UI/UX" },
          { label: "Standar", val: "Teknisi Terakreditasi BNSP & Supervisor DUDIKA" },
          { label: "Garansi", val: "Garansi Service 30 Hari & Support Teknis" }
        ],
        highlight: "Memberikan pengalaman nyata bagi siswa TJKT dan PPLG untuk menangani trouble-shooting perangkat nyata pelanggan dan meng-hosting aplikasi produksi."
      },
      {
        title: "SMEMSA Hospitality Hub",
        subtitle: "Mini Hotel (Edutel) & Express Laundry",
        tag: "💼 Dikelola Perhotelan & MPLB",
        icon: "🏨",
        gradient: "linear-gradient(135deg, #b45309 0%, #78350f 100%)",
        desc: "Unit bisnis hospitalitas yang mengoperasikan kamar penginapan mini hotel (Edutel) standar bintang, layanan laundry pakaian harum & higienis, serta persewaan ruang rapat (meeting room) terpadu.",
        specs: [
          { label: "Pengelola", val: "Konsentrasi Keahlian Perhotelan & MPLB" },
          { label: "Fasilitas", val: "Kamar AC Edutel, Laundry Commercial, Meeting Room" },
          { label: "Standar Service", val: "SOP Standard Hotel Bintang & Public Service" },
          { label: "Operasional", val: "Resepsionis 24 Jam & Layanan Housekeeping" }
        ],
        highlight: "Siswa mempraktikkan langsung manajemen front office, penerimaan tamu, tata graha (housekeeping), hingga tata kelola administrasi perkantoran modern."
      },
      {
        title: "SMEMSA Mart & Business Center",
        subtitle: "Ritel, POS Kasir & Mini Market Sekolah",
        tag: "💼 Dikelola Bisnis Digital & AKL",
        icon: "🛍️",
        gradient: "linear-gradient(135deg, #15803d 0%, #166534 100%)",
        desc: "Pusat ritel komersial yang menyediakan kebutuhan ATK, produk makanan/minuman olahan siswa, hingga barang konsumsi harian berbasis sistem kasir modern (Point of Sale).",
        specs: [
          { label: "Pengelola", val: "Konsentrasi Keahlian Bisnis Digital & AKL" },
          { label: "Sistem", val: "POS Multi-Kasir & Barcode Scanner System" },
          { label: "Produk", val: "ATK, Snack TEFA, Produk UMKM Mitra, Minuman" },
          { label: "Manajemen", val: "Pencatatan Keuangan & Stok Realtime AKL" }
        ],
        highlight: "Mengasah keterampilan siswa dalam transaksi ritel, perancangan visual merchandising, pencatatan neraca akuntansi ritel, serta layanan pelanggan ramah."
      }
    ];

    function openUnitUsahaModal(index) {
      const unit = unitUsahaData[index];
      if (!unit) return;

      const overlay = document.getElementById("unit-usaha-modal-overlay");
      const banner = document.getElementById("unit-usaha-modal-banner");
      const iconEmoji = document.getElementById("unit-usaha-modal-icon-emoji");

      iconEmoji.innerText = unit.icon || "🏢";
      banner.style.background = unit.gradient || "linear-gradient(135deg, #064e3b 0%, #047857 100%)";

      document.getElementById("unit-usaha-modal-tag").innerText = unit.tag || "🏢 Unit Usaha Sekolah";
      document.getElementById("unit-usaha-modal-title").innerText = unit.title;
      document.getElementById("unit-usaha-modal-desc").innerText = unit.desc;

      const chipsContainer = document.getElementById("unit-usaha-modal-chips");
      chipsContainer.innerHTML = "";

      if (unit.specs && Array.isArray(unit.specs)) {
        unit.specs.forEach(s => {
          chipsContainer.innerHTML += `<span class="blud-modal-chip">⚡ <strong>${s.label}:</strong> ${s.val}</span>`;
        });
      }

      document.getElementById("unit-usaha-modal-highlight").innerText = unit.highlight || "Unit usaha sekolah memberikan wadah praktik vokasi nyata bagi siswa SMEMSA Genteng.";

      overlay.classList.add("active");
      const modalCard = document.getElementById("unit-usaha-modal-card");
      if (modalCard) modalCard.scrollTop = 0;

      document.body.style.overflow = "hidden";
      document.documentElement.style.overflow = "hidden";

      if (typeof lenis !== "undefined" && lenis) lenis.stop();
      else if (window.lenis) window.lenis.stop();
    }

    function closeUnitUsahaModal() {
      const overlay = document.getElementById("unit-usaha-modal-overlay");
      if (overlay) overlay.classList.remove("active");
      document.body.style.overflow = "";
      document.documentElement.style.overflow = "";

      if (typeof lenis !== "undefined" && lenis) lenis.start();
      else if (window.lenis) window.lenis.start();
    }

    function closeUnitUsahaModalOnOverlay(e) {
      if (e.target.id === "unit-usaha-modal-overlay") {
        closeUnitUsahaModal();
      }
    }

    function filterIndexNews(category, element) {
      const filterLinks = document.querySelectorAll(".news-filter-link");
      filterLinks.forEach(link => link.classList.remove("active"));
      if (element) {
        element.classList.add("active");
      }

      const articles = document.querySelectorAll(".news-cards-grid .article-card");
      articles.forEach(article => {
        const itemCat = article.getAttribute("data-category");
        if (category === "all" || itemCat === category) {
          article.style.display = "flex";
        } else {
          article.style.display = "none";
        }
      });
    }

    renderBludProducts();
  </script>
</body>

</html>