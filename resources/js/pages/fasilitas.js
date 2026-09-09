/* ==========================================================================
   FASILITAS & TEFA - INTERACTIVE MAP, DATA & MODAL LOGIC
   ========================================================================== */

(function () {
  const LOCATIONS = [
    /* ---------- TEACHING FACTORY ---------- */
    {
      id: "tefa-dkv",
      photo: "assets/view/view-1.png",
      photoAlt: "Foto Tefa DKV SMEMSA Printing",
      kind: "tefa",
      x: 849,
      y: 485,
      mark: "DKV",
      kicker: "Teaching Factory · DKV",
      loc: "Sekolah Utara — Tenggara",
      name: "Tefa SMEMSA Printing",
      full: "Tefa SMEMSA Printing (DKV)",
      desc: "Unit produksi percetakan dan merchandise komersial yang mengerjakan pesanan nyata dari sekolah, instansi, dan masyarakat umum.",
      tools: [
        "Digital Press A3+",
        "Mesin Cetak Offset",
        "Cutting & Laminasi",
        "Sablon DTF & Merchandise",
      ],
      highlight:
        "Siswa terlibat langsung dari penawaran harga, pra-cetak, finishing, hingga penyerahan produk ke pelanggan.",
    },
    {
      id: "tefa-surya",
      photo: "assets/view/view-3.png",
      photoAlt: "Foto Surya Mart Swalayan Sekolah",
      kind: "tefa",
      x: 783,
      y: 485,
      mark: "SM",
      kicker: "Teaching Factory · Bisnis Digital",
      loc: "Sekolah Utara — Tenggara",
      name: "Surya Mart",
      full: "Surya Mart (Bisnis Digital)",
      desc: "Minimarket ritel sekolah yang dikelola langsung oleh siswa Bisnis Digital, melayani kebutuhan harian seluruh warga sekolah.",
      tools: [
        "Sistem Kasir POS",
        "Manajemen Stok & FIFO",
        "Display Produk Ritel",
        "Laporan Penjualan Harian",
      ],
      highlight:
        "Siswa mempraktikkan inventory control, kasir barcode, dan customer handling secara langsung.",
    },
    {
      id: "tefa-pegadaian",
      photo: "assets/view/view-2.png",
      photoAlt: "Foto Agen Pegadaian Mentari",
      kind: "tefa",
      x: 718,
      y: 485,
      mark: "PGD",
      kicker: "Teaching Factory · Manajemen Perkantoran",
      loc: "Sekolah Utara — Tenggara",
      name: "Agen Pegadaian Mentari",
      full: "Agen Pegadaian Mentari SMEMSA",
      desc: "Kemitraan resmi dengan PT Pegadaian untuk layanan tabungan emas, multi-payment, dan transaksi mikro bagi masyarakat.",
      tools: [
        "Loket Transaksi Resmi",
        "Sistem Online Pegadaian",
        "Administrasi Dokumen",
        "Pelayanan Nasabah",
      ],
      highlight:
        "Siswa MPLB mempraktikkan etika front-office dan transaksi keuangan legal berstandar BUMN.",
    },
    {
      id: "tefa-bms",
      photo: "assets/view/view-4.png",
      photoAlt: "Foto Bank Mini Sekolah",
      kind: "tefa",
      x: 656,
      y: 485,
      mark: "BMS",
      kicker: "Teaching Factory · Akuntansi",
      loc: "Sekolah Utara — Tenggara",
      name: "Bank Mini Sekolah",
      full: "Bank Mini Sekolah (BMS) BTM",
      desc: "Lembaga keuangan mikro sekolah untuk tabungan harian siswa, kas ekstrakurikuler, dan simulasi perbankan syariah.",
      tools: [
        "Aplikasi Core Banking",
        "Mesin Hitung Uang",
        "Buku Tabungan Barcode",
        "Simulasi Teller & CS",
      ],
      highlight:
        "Siswa AKL membukukan ribuan transaksi riil setiap semester dengan pembukuan ganda.",
    },
    {
      id: "tefa-edotel",
      photo: "assets/view/view-1.png",
      photoAlt: "Foto Front Office Edotel SMEMSA",
      kind: "tefa",
      x: 260,
      y: 697,
      mark: "EDO",
      kicker: "Teaching Factory · Perhotelan",
      loc: "Sekolah Selatan",
      name: "Edotel SMEMSA",
      full: "Edotel SMEMSA (Guest House)",
      desc: "Fasilitas penginapan edukatif dengan 3 unit kamar berstandar hotel, lobby, dan ruang pertemuan untuk tamu sekolah maupun umum.",
      tools: [
        "Front Office",
        "Home Stay 1–3",
        "Sistem Reservasi",
        "Housekeeping",
      ],
      highlight:
        "Siswa Perhotelan mempraktikkan resepsionis dan housekeeping pada tamu sungguhan.",
    },
    {
      id: "tefa-laundry",
      photo: "assets/view/view-5.png",
      photoAlt: "Foto Lab Laundry Sun Wash",
      kind: "tefa",
      x: 312,
      y: 697,
      mark: "LDR",
      kicker: "Teaching Factory · Perhotelan",
      loc: "Sekolah Selatan",
      name: "Lab. Laundry",
      full: "Lab. Laundry (Sun Wash)",
      desc: "Unit binatu profesional yang melayani linen hotel maupun pakaian warga sekitar, sekaligus menjadi ruang praktik pengelolaan tekstil.",
      tools: [
        "Mesin Cuci Industri",
        "Pengering & Setrika Uap",
        "Sortir Linen",
        "Layanan Pelanggan",
      ],
      highlight:
        "Melengkapi rantai layanan eDotel — siswa belajar operasional binatu komersial.",
    },
    /* ---------- FASILITAS ---------- */
    {
      id: "fac-masjid",
      photo: "assets/view/view-5.png",
      photoAlt: "Foto Masjid Namiroh",
      kind: "fasilitas",
      x: 366,
      y: 108,
      mark: "MSJ",
      kicker: "Fasilitas · Ibadah",
      loc: "Sekolah Utara — Tengah",
      name: "Masjid Namiroh",
      full: "Masjid Namiroh",
      desc: "Pusat kegiatan ibadah dan pembinaan keislaman warga sekolah, meliputi salat berjamaah, kajian rutin, dan kegiatan keagamaan.",
      tools: [
        "Ruang Salat Utama",
        "Tempat Wudu",
        "Area Kajian",
        "Koleksi Islami",
      ],
      highlight:
        "Pusat pembinaan akhlak Islami berkemajuan di lingkungan sekolah.",
    },
    {
      id: "fac-lapangan",
      photo: "assets/view/view-2.png",
      photoAlt: "Foto Lapangan Utama",
      kind: "fasilitas",
      x: 322,
      y: 320,
      mark: "LAP",
      kicker: "Fasilitas · Olahraga",
      loc: "Sekolah Utara — Tengah",
      name: "Lapangan Utama",
      full: "Lapangan Utama Multi-Fungsi",
      desc: "Lapangan serbaguna untuk basket, futsal, dan voli yang juga digunakan sebagai tempat upacara serta latihan Hizbul Wathan dan Tapak Suci.",
      tools: [
        "Lapangan Multi-Fungsi",
        "Ring Basket",
        "Area Upacara",
        "Latihan Kepanduan",
      ],
      highlight:
        "Pusat kegiatan ekstrakurikuler fisik dan pembinaan kedisiplinan.",
    },
    {
      id: "fac-perpus",
      photo: "assets/view/view-4.png",
      photoAlt: "Foto Ruang Perpustakaan",
      kind: "fasilitas",
      x: 300,
      y: 465,
      mark: "PRP",
      kicker: "Fasilitas · Literasi",
      loc: "Sekolah Utara — Barat Daya",
      name: "Perpustakaan",
      full: "Ruang Perpustakaan",
      desc: "Koleksi cetak dan digital dengan ruang baca serta area diskusi kelompok untuk mendukung proyek kejuruan siswa.",
      tools: [
        "Katalog Koleksi",
        "Ruang Baca",
        "Area Diskusi",
        "Referensi Kejuruan",
      ],
      highlight:
        "Ruang kerja favorit siswa saat menggarap proyek akhir kejuruan.",
    },
    {
      id: "fac-lab",
      photo: "assets/view/view-3.png",
      photoAlt: "Foto Deret Laboratorium Komputer",
      kind: "fasilitas",
      x: 146,
      y: 321,
      mark: "LAB",
      kicker: "Fasilitas · Teknologi",
      loc: "Sekolah Utara — Sisi Barat",
      name: "Deret Laboratorium",
      full: "Deret Ruang Laboratorium",
      desc: "Rangkaian ruang praktik untuk pemrograman, desain grafis, konfigurasi jaringan, dan penguasaan aplikasi perangkat lunak.",
      tools: [
        "PC Spesifikasi Praktik",
        "Software Berlisensi",
        "Jaringan Lab",
        "Proyektor",
      ],
      highlight:
        "Digunakan bergantian oleh siswa PPLG, TJKT, dan Bisnis Digital sepanjang hari.",
    },
    {
      id: "fac-rps",
      photo: "assets/view/view-1.png",
      photoAlt: "Foto Ruang Praktik Siswa",
      kind: "fasilitas",
      x: 915,
      y: 152,
      mark: "RPS",
      kicker: "Fasilitas · Praktik",
      loc: "Sekolah Utara — Timur Laut",
      name: "Ruang Praktik Siswa (RPS)",
      full: "Ruang Praktik Siswa (RPS 1–3)",
      desc: "Tiga ruang praktik kejuruan berukuran besar untuk kegiatan produktif yang membutuhkan peralatan dan area kerja luas.",
      tools: [
        "Area Kerja Luas",
        "Peralatan Kejuruan",
        "Meja Praktik",
        "Penyimpanan Alat",
      ],
      highlight:
        "Ruang praktik utama untuk kegiatan produktif berskala besar.",
    },
    {
      id: "fac-ballroom",
      photo: "assets/view/view-4.png",
      photoAlt: "Foto SMEMSA Ballroom",
      kind: "fasilitas",
      x: 312,
      y: 740,
      mark: "BLR",
      kicker: "Fasilitas · Acara",
      loc: "Sekolah Selatan",
      name: "Ballroom",
      full: "SMEMSA Ballroom",
      desc: "Aula berkapasitas besar untuk wisuda, seminar, dan pelatihan industri — juga disewakan untuk acara masyarakat sekitar.",
      tools: [
        "Tata Suara",
        "Panggung",
        "Area Resepsi",
        "Ruang Persiapan",
      ],
      highlight:
        "Menjadi ruang praktik langsung siswa Perhotelan dalam manajemen event.",
    },
    {
      id: "fac-uks",
      photo: "assets/view/view-2.png",
      photoAlt: "Foto Ruang UKS",
      kind: "fasilitas",
      x: 236,
      y: 228,
      mark: "UKS",
      kicker: "Fasilitas · Kesehatan",
      loc: "Sekolah Utara — Tengah",
      name: "Ruang UKS",
      full: "Ruang UKS",
      desc: "Unit Kesehatan Sekolah untuk penanganan pertama, pemeriksaan berkala, dan basis kegiatan PMR.",
      tools: [
        "Ruang Periksa",
        "Perlengkapan P3K",
        "Tempat Istirahat",
        "Basis PMR",
      ],
      highlight:
        "Bekerja sama dengan BK dalam program layanan kesehatan siswa.",
    },
    {
      id: "fac-admin",
      photo: "assets/view/view-1.png",
      photoAlt: "Foto Ruang Administrasi dan Pimpinan",
      kind: "fasilitas",
      x: 539,
      y: 132,
      mark: "ADM",
      kicker: "Fasilitas · Administrasi",
      loc: "Sekolah Utara — Tengah",
      name: "Kepala Sekolah & Tata Usaha",
      full: "R. Kepala Sekolah & Tata Usaha",
      desc: "Pusat administrasi dan pimpinan sekolah, meliputi layanan surat-menyurat, data siswa, serta penerimaan tamu.",
      tools: [
        "Ruang Pimpinan",
        "Layanan Administrasi",
        "Ruang Tamu",
        "Arsip Sekolah",
      ],
      highlight:
        "Titik pertama bagi tamu dan orang tua yang berkunjung ke sekolah.",
    },
  ];

  const locationToFacilityMap = {
    "tefa-dkv": "tefa-printing",
    "tefa-surya": "major-bd",
    "tefa-pegadaian": "tefa-pegadaian",
    "tefa-bms": "tefa-bank",
    "tefa-edotel": "tefa-edotel",
    "tefa-laundry": "tefa-edotel",
    "fac-lab": "fac-lab",
    "fac-perpus": "fac-perpus",
    "fac-ballroom": "fac-ballroom",
    "fac-lapangan": "fac-sport",
  };

  function scrollToRelatedFacility(locationId) {
    const targetId = locationToFacilityMap[locationId];
    if (!targetId) return;

    let card = document.querySelector('.facilities-grid [onclick*="' + targetId + '"], .tefa-grid [onclick*="' + targetId + '"]');
    if (!card) return;

    document
      .querySelectorAll(".fac-card, .tefa-item")
      .forEach(function (el) {
        el.classList.remove("highlighted-card");
      });
    card.classList.add("highlighted-card");

    setTimeout(function () {
      card.classList.remove("highlighted-card");
    }, 3000);
  }

  function initMapAndDenah() {
    const SVG_NS = "http://www.w3.org/2000/svg";
    const layer = document.getElementById("hotspot-layer");
    const indexGrid = document.getElementById("indexGrid");
    const panelEmpty = document.getElementById("panelEmpty");
    const panelContent = document.getElementById("panelContent");

    let currentFilter = "all";

    function select(id) {
      const loc = LOCATIONS.find(function (l) {
        return l.id === id;
      });
      if (!loc) return;

      document.querySelectorAll(".hotspot").forEach(function (h) {
        h.classList.toggle("is-active", h.dataset.id === id);
      });

      if (panelEmpty) panelEmpty.hidden = true;
      if (panelContent) {
        panelContent.hidden = false;
        const hasPhoto = Boolean(loc.photo);
        const photoTag = hasPhoto
          ? '<img src="' +
            loc.photo +
            '" alt="' +
            (loc.photoAlt || loc.full) +
            '" loading="lazy" decoding="async" width="1200" height="700" onerror="this.remove(); this.closest(\'.panel-visual\').classList.remove(\'.has-photo\');">'
          : "";

        panelContent.innerHTML =
          '<div class="panel-visual' +
          (hasPhoto ? " has-photo" : "") +
          '">' +
          photoTag +
          '<span class="panel-kicker">' +
          loc.kicker +
          "</span>" +
          (hasPhoto ? '<span class="photo-note">Foto contoh</span>' : "") +
          '<span class="p-mark">' +
          loc.mark +
          "</span>" +
          "</div>" +
          '<div class="panel-body">' +
          '<h3 class="panel-title">' +
          loc.full +
          "</h3>" +
          '<div class="panel-loc">' +
          loc.loc +
          "</div>" +
          '<p class="panel-desc">' +
          loc.desc +
          "</p>" +
          '<div class="panel-subhead">Sarana Utama</div>' +
          '<div class="chip-row">' +
          loc.tools
            .map(function (t) {
              return '<span class="chip">' + t + "</span>";
            })
            .join("") +
          "</div>" +
          '<div class="panel-highlight">' +
          loc.highlight +
          "</div>" +
          "</div>";

        if (typeof gsap !== "undefined") {
          try {
            gsap.fromTo(
              panelContent,
              { opacity: 0, y: 14 },
              { opacity: 1, y: 0, duration: 0.45, ease: "power2.out" },
            );
          } catch (e) {}
        }
      }

      scrollToRelatedFacility(id);
    }

    // Render Hotspots & Index
    if (layer && layer.children.length === 0) {
      LOCATIONS.forEach(function (loc, i) {
        const g = document.createElementNS(SVG_NS, "g");
        g.setAttribute(
          "class",
          "hotspot" + (loc.kind === "tefa" ? " is-tefa" : ""),
        );
        g.setAttribute("data-id", loc.id);
        g.setAttribute("data-kind", loc.kind);
        g.setAttribute("tabindex", "0");
        g.setAttribute("role", "button");
        g.setAttribute("aria-label", loc.full);

        const halo = document.createElementNS(SVG_NS, "circle");
        halo.setAttribute("class", "hs-halo");
        halo.setAttribute("cx", loc.x);
        halo.setAttribute("cy", loc.y);
        halo.setAttribute("r", 27);

        const dot = document.createElementNS(SVG_NS, "circle");
        dot.setAttribute("class", "hs-dot");
        dot.setAttribute("cx", loc.x);
        dot.setAttribute("cy", loc.y);
        dot.setAttribute("r", 13);

        const num = document.createElementNS(SVG_NS, "text");
        num.setAttribute("class", "hs-num");
        num.setAttribute("x", loc.x);
        num.setAttribute("y", loc.y);
        num.textContent = i + 1;

        g.append(halo, dot, num);
        layer.appendChild(g);

        g.addEventListener("click", function () {
          select(loc.id);
        });
        g.addEventListener("keydown", function (e) {
          if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            select(loc.id);
          }
        });
      });
    }

    if (indexGrid && indexGrid.children.length === 0) {
      LOCATIONS.forEach(function (loc, i) {
        const btn = document.createElement("button");
        btn.className =
          "index-btn" + (loc.kind === "tefa" ? " is-tefa" : "");
        btn.dataset.id = loc.id;
        btn.dataset.kind = loc.kind;
        btn.innerHTML =
          '<span class="index-badge">' +
          (i + 1) +
          "</span>" +
          '<span class="index-name">' +
          loc.name +
          "</span>";
        btn.addEventListener("click", function () {
          select(loc.id);
        });
        indexGrid.appendChild(btn);
      });
    }

    // Filter Buttons
    document.querySelectorAll(".filter-btn").forEach(function (btn) {
      btn.addEventListener("click", function () {
        currentFilter = btn.dataset.filter;
        document.querySelectorAll(".filter-btn").forEach(function (b) {
          b.classList.remove("active");
          b.setAttribute("aria-pressed", "false");
        });
        btn.classList.add("active");
        btn.setAttribute("aria-pressed", "true");

        document.querySelectorAll(".hotspot").forEach(function (h) {
          const show =
            currentFilter === "all" || h.dataset.kind === currentFilter;
          h.classList.toggle("is-dimmed", !show);
          h.setAttribute("tabindex", show ? "0" : "-1");
        });
        document.querySelectorAll(".index-btn").forEach(function (b) {
          const show =
            currentFilter === "all" || b.dataset.kind === currentFilter;
          b.classList.toggle("is-hidden", !show);
        });
      });
    });

    // Trigger map hotspot animation safely
    if (
      typeof gsap !== "undefined" &&
      typeof ScrollTrigger !== "undefined"
    ) {
      try {
        gsap.from(".hotspot", {
          opacity: 0,
          scale: 0,
          svgOrigin: "500 400",
          duration: 0.55,
          stagger: 0.05,
          ease: "back.out(2)",
          scrollTrigger: {
            trigger: ".map-stage",
            start: "top 85%",
            once: true,
          },
        });
      } catch (e) {}
    }
  }

  /* ==========================================================================
     DATA FASILITAS & TEFA MODAL LOGIC
     ========================================================================== */
  const facilitiesData = {
    "tefa-printing": {
      tag: "TEACHING FACTORY • DKV",
      title: "Tefa SMEMSA Printing & Creative Production",
      icon: "🖨️",
      gradient: "linear-gradient(135deg, #1e40af 0%, #3b82f6 100%)",
      desc: "Unit produksi percetakan komersial yang melayani kebutuhan cetak offset, digital printing skala besar, sablon merchandise, banner promosi, serta branding kit industri.",
      features: [
        "Digital Press & Offset Machine",
        "Large Format Outdoor & Indoor Plotter",
        "Mesin Cutting Stiker Presisi",
        "Workshop Sablon & Merchandise",
        "Sistem Manajemen Order Online",
      ],
      highlight:
        "Siswa DKV terlibat langsung dalam alur kerja industri nyata mulai dari kalkulasi biaya cetak, pra-cetak, finishing packaging, hingga customer handling.",
    },
    "tefa-edotel": {
      tag: "TEACHING FACTORY • PERHOTELAN",
      title: "Edotel SMEMSA & Sun Wash Laundry",
      icon: "🏨",
      gradient: "linear-gradient(135deg, #b45309 0%, #eab308 100%)",
      desc: "Fasilitas hotel edukasi berstandar bintang dengan kamar representatif, lobby lounge, dan layanan binatu profesional Sun Wash yang melayani tamu umum dan corporate.",
      features: [
        "Standard & Deluxe Hotel Rooms",
        "Front Desk Booking System",
        "Industrial Laundry & Dry Cleaning Machine",
        "Housekeeping Amenities Standard",
        "Layanan Room Service",
      ],
      highlight:
        "Memberikan siswa konsentrasi Perhotelan kompetensi operasional real-world dalam tata graha, pelayanan resepsionis, dan manajemen reservasi kamar hotel.",
    },
    "tefa-pegadaian": {
      tag: "TEACHING FACTORY • MANAJEMEN PERKANTORAN",
      title: "Agen Pegadaian Mentari SMEMSA",
      icon: "💳",
      gradient: "linear-gradient(135deg, #16296b 0%, #1e40af 100%)",
      desc: "Kantor layanan keuangan mikro kemitraan resmi dengan PT Pegadaian (Persero). Melayani transaksi tabungan emas, pembayaran tagihan multi-payment, dan pembiayaan terpadu.",
      features: [
        "Aplikasi Sistem Transaksi Pegadaian",
        "Counter Teller Pelayanan Publik",
        "Digital Document Verification",
        "Standard Pelayanan Prima Frontliner",
        "Cash Flow Auditing",
      ],
      highlight:
        "Siswa jurusan MPLB dilatih mengoperasikan sistem administrasi keuangan resmi dan mempraktikkan etika komunikasi bisnis profesional kepada nasabah.",
    },
    "tefa-bank": {
      tag: "TEACHING FACTORY • AKUNTANSI",
      title: "Bank Mini Sekolah (BMS) BTM SMEMSA",
      icon: "🏦",
      gradient: "linear-gradient(135deg, #1e40af 0%, #2563eb 100%)",
      desc: "Lembaga keuangan mikro syariah internal sekolah yang mengelola tabungan harian siswa, kas ekstrakurikuler, serta simulasi pembiayaan syariah berbasis aplikasi komputer akuntansi.",
      features: [
        "Software Core Banking Syariah",
        "Mesin Hitung Uang & Detektor Uang Palsu",
        "Simulasi Pembukuan GL & Neraca",
        "Buku Tabungan Berbasis Barcode",
        "SOP Teller & Customer Service",
      ],
      highlight:
        "Menjadi sarana praktikum akuntansi perbankan real-time sehingga lulusan memiliki keunggulan kompetitif saat terjun ke dunia industri perbankan nasional.",
    },
    "tefa-tekaje": {
      tag: "TEACHING FACTORY • TJKT",
      title: "Tefa Tekaje Solution & ISP Support",
      icon: "🌐",
      gradient: "linear-gradient(135deg, #0f172a 0%, #1e40af 100%)",
      desc: "Unit layanan jasa instalasi jaringan fiber optik, perakitan PC server, konfigurasi perangkat jaringan MikroTik/Cisco, dan maintenance perangkat IT untuk instansi sekolah maupun mitra.",
      features: [
        "Splicer Fiber Optik & OTDR Tester",
        "Server Rack & Enterprise Switch",
        "Toolkit Maintenance Komputer Lengkap",
        "Jasa Perbaikan Hardware & Software",
        "Monitoring Bandwidth Management",
      ],
      highlight:
        "Mengasah kesiapan mental teknisi jaringan siswa untuk menangani troubleshooting jaringan riil dan sertifikasi kompetensi industri internasional.",
    },
    "fac-lab": {
      tag: "FASILITAS AKADEMIK",
      title: "Laboratorium Komputer & Server Enterprise",
      icon: "💻",
      gradient: "linear-gradient(135deg, #16296b 0%, #1e40af 100%)",
      desc: "Laboratorium berpendingin udara dengan ratusan unit PC berspesifikasi tinggi, terkoneksi jaringan gigabit LAN, dan didukung server lokal untuk praktikum coding, simulasi cloud, dan ujian berbasis komputer.",
      features: [
        "PC Core i7 & RAM 16GB",
        "Akses Jaringan Gigabit & VLAN",
        "Dedicated Local & Cloud Server",
        "Smart TV Interactive Board",
        "Full AC & Ergonomic Setup",
      ],
      highlight:
        "Memastikan proses pembelajaran coding, database, dan simulasi jaringan berjalan lancar tanpa kendala teknis.",
    },
    "fac-studio": {
      tag: "FASILITAS KREATIF",
      title: "Studio Desain Komunikasi Visual & Podcast",
      icon: "🎨",
      gradient: "linear-gradient(135deg, #7c3aed 0%, #9333ea 100%)",
      desc: "Fasilitas produksi konten kreatif dengan ruang kedap suara, pencahayaan studio sinematik (Godox/Aputure), kamera 4K, backdrop green screen, dan set rekaman podcast profesional.",
      features: [
        "Set Pencahayaan Studio Multi-Point",
        "Kamera Cinema 4K & Audio Wireless Mic",
        "Soundproofing Acoustic Wall",
        "Workstation Video Editing RTX Series",
        "Green Screen Cyclorama",
      ],
      highlight:
        "Menyediakan ruang eksplorasi total bagi talenta muda perfilman, videografi, animasi, dan siaran podcast digital.",
    },
    "fac-perpus": {
      tag: "FASILITAS LITERASI",
      title: "Perpustakaan Digital & Ruang Riset",
      icon: "📚",
      gradient: "linear-gradient(135deg, #1e40af 0%, #3b82f6 100%)",
      desc: "Pusat sumber belajar modern yang menggabungkan ribuan koleksi buku fisik kejuruan, e-book reader, pojok baca lesehan yang nyaman, dan workstation penelusuran referensi ilmiah online.",
      features: [
        "Katalog Online E-Library",
        "Koleksi Buku Referensi Kejuruan & Agama",
        "E-Reader Kiosk Station",
        "Ruang Diskusi & Silent Study Zone",
        "Koneksi Wi-Fi Dedicated",
      ],
      highlight:
        "Membangun budaya riset mandiri dan kebiasaan membaca komprehensif bagi seluruh warga sekolah.",
    },
    "fac-wifi": {
      tag: "INFRASTRUKTUR DIGITAL",
      title: "Infrastruktur Wi-Fi Fiber Optik 1 Gbps",
      icon: "📶",
      gradient: "linear-gradient(135deg, #0f172a 0%, #1e40af 100%)",
      desc: "Jaringan backbone fiber optik terintegrasi dengan puluhan access point enterprise di setiap ruang kelas, bengkel TEFA, dan area publik sekolah dengan alokasi bandwidth merata dan aman.",
      features: [
        "Backbone Fiber Optik 1 Gbps",
        "Access Point Wi-Fi 6 Enterprise",
        "Firewall & Content Filtering Aman",
        "Bandwidth Management QoS",
        "Coverage 100% Area Sekolah",
      ],
      highlight:
        "Memfasilitasi blended learning, akses sumber belajar digital internasional, dan riset teknologi terkini secara instan.",
    },
    "fac-sport": {
      tag: "SARANA OLAHRAGA",
      title: "Sport Center & Gelanggang Olahraga",
      icon: "⚽",
      gradient: "linear-gradient(135deg, #eab308 0%, #ca8a04 100%)",
      desc: "Kompleks sarana olahraga representatif dengan lapangan multifungsi untuk futsal, bola voli, bola basket, badminton, serta area latihan seni bela diri Tapak Suci.",
      features: [
        "Lapangan Futsal & Basket Standar",
        "Lapangan Voli & Bulutangkis Indoor",
        "Matras & Perlengkapan Bela Diri Tapak Suci",
        "Tribun Penonton & Ruang Ganti",
        "Peralatan Olahraga Lengkap",
      ],
      highlight:
        "Menjaga kebugaran jasmani, sportivitas, dan melahirkan bibit atlet berprestasi di tingkat kabupaten hingga nasional.",
    },
    "fac-ballroom": {
      tag: "SARANA AUDITORIUM",
      title: "SMEMSA Ball Room & Convention Hall",
      icon: "🏛️",
      gradient: "linear-gradient(135deg, #1e40af 0%, #16296b 100%)",
      desc: "Auditorium megah berkapasitas ratusan orang dengan tata suara panggung konser, videotron LED screen besar, dan pendingin ruangan sentral untuk acara wisuda, seminar, dan festival budaya.",
      features: [
        "Kapasitas hingga 800+ Kursi",
        "Videotron P2.5 High Definition",
        "Line Array Audio System Pro",
        "Panggung Teater & Lighting System",
        "Full Central Air Conditioning",
      ],
      highlight:
        "Gedung serbaguna prestisius untuk memfasilitasi berbagai perhelatan akbar tingkat daerah maupun provinsi.",
    },
    "major-rpl": {
      tag: "KONSENTRASI KEAHLIAN",
      title: "Pengembang Perangkat Lunak & Gim (PPLG)",
      icon: "💻",
      gradient: "linear-gradient(135deg, #16296b 0%, #1e40af 100%)",
      desc: "Kurikulum vokasi pemrograman tingkat lanjut: fullstack web development, mobile application, database management, dan integrasi API.",
      features: [
        "Fullstack JavaScript / PHP / Python",
        "Flutter & Android Development",
        "Cloud Deployment & DevOps",
        "Project Based Learning Software House",
      ],
      highlight:
        "Lulusan siap berkarir sebagai Software Developer atau melanjutkan kuliah di bidang Ilmu Komputer dan Informatika.",
    },
    "major-tkj": {
      tag: "KONSENTRASI KEAHLIAN",
      title: "Teknik Jaringan Komputer & Telekomunikasi (TJKT)",
      icon: "🌐",
      gradient: "linear-gradient(135deg, #0f172a 0%, #1e40af 100%)",
      desc: "Penguasaan administrasi server Linux, konfigurasi routing MikroTik/Cisco bersertifikasi MTCNA, instalasi serat optik, dan keamanan siber dasar.",
      features: [
        "Sertifikasi MTCNA & Cisco Academy",
        "Fiber Optic Installation Lab",
        "Network Security & Penetration Testing",
        "Cloud & Virtualization (Proxmox/Docker)",
      ],
      highlight:
        "Lulusan dibekali sertifikasi industri yang diakui secara global untuk bekerja di ISP dan enterprise data center.",
    },
    "major-bd": {
      tag: "KONSENTRASI KEAHLIAN",
      title: "Bisnis Digital (BD)",
      icon: "💼",
      gradient: "linear-gradient(135deg, #b45309 0%, #eab308 100%)",
      desc: "Strategi pemasaran era digital: e-commerce operations, optimasi SEO/SEM, paid advertising, content marketing, dan analisis analitik toko online.",
      features: [
        "E-Commerce Platform Management",
        "Social Media Marketing & Meta Ads",
        "Content Creation & Copywriting",
        "Surya Mart Retail Management System",
      ],
      highlight:
        "Praktik langsung mengelola Surya Mart dan platform digital marketing dengan target omset nyata.",
    },
    "major-mplb": {
      tag: "KONSENTRASI KEAHLIAN",
      title: "Manajemen Perkantoran & Layanan Bisnis (MPLB)",
      icon: "🏢",
      gradient: "linear-gradient(135deg, #1e40af 0%, #3b82f6 100%)",
      desc: "Standarisasi tata kelola perkantoran modern, korespondensi bisnis digital, arsip elektronik, dan standard pelayanan frontliner profesional.",
      features: [
        "Digital Archiving System",
        "Modern Office Administration",
        "Agen Pegadaian Frontline Operation",
        "Public Relations & Public Speaking",
      ],
      highlight:
        "Pengalaman kerja nyata di Agen Pegadaian Mentari SMEMSA dan ruang Tata Usaha terakreditasi.",
    },
    "major-akl": {
      tag: "KONSENTRASI KEAHLIAN",
      title: "Akuntansi & Keuangan Lembaga (AKL)",
      icon: "📊",
      gradient: "linear-gradient(135deg, #16296b 0%, #2563eb 100%)",
      desc: "Pendidikan akuntansi berbasis software industri: Accurate Accounting, MYOB, perpajakan digital, dan simulasi perbankan syariah.",
      features: [
        "Accurate Online & MYOB Specialist",
        "Tax Administration (E-Faktur & SPT)",
        "Bank Mini Sekolah Operational Practicum",
        "Financial Statement Auditing",
      ],
      highlight:
        "Pengelolaan harian tabungan siswa pada Bank Mini Sekolah melatih ketelitian akuntansi tingkat tinggi.",
    },
    "major-hotel": {
      tag: "KONSENTRASI KEAHLIAN",
      title: "Perhotelan",
      icon: "🏨",
      gradient: "linear-gradient(135deg, #92400e 0%, #eab308 100%)",
      desc: "Operasional hotel berstandar internasional meliputi front office, housekeeping room division, laundry management, dan customer experience prima.",
      features: [
        "Edotel SMEMSA Real-World Operation",
        "Laundry Sun Wash Practical Unit",
        "Hotel Reservation System",
        "Hospitality Grooming & Communication",
      ],
      highlight:
        "Siswa mengoperasikan Edotel dan Sun Wash Laundry secara mandiri dengan bimbingan praktisi hotel bintang.",
    },
    "major-dkv": {
      tag: "KONSENTRASI KEAHLIAN",
      title: "Desain Komunikasi Visual (DKV)",
      icon: "🎬",
      gradient: "linear-gradient(135deg, #7c3aed 0%, #9333ea 100%)",
      desc: "Eksplorasi visual komprehensif: grafis periklanan, videografi sinematik, fotografi komersial, motion graphic, dan cetak produksi.",
      features: [
        "Adobe Creative Cloud Suite",
        "Studio Podcast & Cinema 4K Cam",
        "Tefa SMEMSA Printing Production Workflow",
        "Branding & Packaging Design",
      ],
      highlight:
        "Portofolio karya riil dari klien komersial Tefa Printing menjadi bekal karir unggul bagi siswa.",
    },
    "major-boga": {
      tag: "KONSENTRASI KEAHLIAN",
      title: "Kuliner / Tata Boga",
      icon: "🍰",
      gradient: "linear-gradient(135deg, #b45309 0%, #f59e0b 100%)",
      desc: "Seni pengolahan kuliner nusantara dan internasional, pastry and bakery, sanitasi higienis makanan, dan tata hidang banquet catering.",
      features: [
        "Kitchen Standard Restoran & Hotel",
        "Pastry & Bakery Oven Suite",
        "Food Costing & Entrepreneurship",
        "Banquet Catering Handling",
      ],
      highlight:
        "Penguasaan teknik memasak profesional dengan peluang wirausaha kuliner yang luas.",
    },
    "major-tbsm": {
      tag: "KONSENTRASI KEAHLIAN",
      title: "Teknik Sepeda Motor (TBSM)",
      icon: "🏍️",
      gradient: "linear-gradient(135deg, #0f172a 0%, #dc2626 100%)",
      desc: "Teknologi otomotif roda dua modern: sistem injeksi elektronik (PGM-FI), overhaul mesin, kelistrikan bodi, dan manajemen bengkel resmi.",
      features: [
        "Diagnostic Scanner Otomotif",
        "Hydraulic Lift Workshop Station",
        "Engine Overhaul & Fuel Injection Lab",
        "Bengkel Servis Mitra Industri",
      ],
      highlight:
        "Kurikulum standar bengkel resmi menjamin lulusan siap kerja di jaringan dealer otomotif nasional.",
    },
  };

  window.openItemModal = function (id) {
    const data = facilitiesData[id];
    if (!data) return;

    const banner = document.getElementById("modal-banner");
    const icon = document.getElementById("modal-icon");
    const tag = document.getElementById("modal-tag");
    const title = document.getElementById("modal-title");
    const desc = document.getElementById("modal-desc");
    const featuresContainer = document.getElementById("modal-features");
    const highlight = document.getElementById("modal-highlight");

    if (banner) banner.style.background = data.gradient;
    if (icon) icon.innerText = data.icon;
    if (tag) tag.innerText = data.tag;
    if (title) title.innerText = data.title;
    if (desc) desc.innerText = data.desc;
    if (highlight) highlight.innerText = data.highlight;

    if (featuresContainer) {
      featuresContainer.innerHTML = "";
      data.features.forEach(function (feat) {
        const chip = document.createElement("span");
        chip.className = "modal-feature-chip";
        chip.innerText = feat;
        featuresContainer.appendChild(chip);
      });
    }

    const modalOverlay = document.getElementById(
      "facility-modal-overlay",
    );
    if (modalOverlay) {
      modalOverlay.classList.add("active");
      document.body.style.overflow = "hidden";
    }
  };

  window.closeItemModal = function () {
    const modalOverlay = document.getElementById(
      "facility-modal-overlay",
    );
    if (modalOverlay) {
      modalOverlay.classList.remove("active");
      document.body.style.overflow = "";
    }
  };

  window.closeItemModalOnOverlay = function (e) {
    if (e.target.id === "facility-modal-overlay") {
      window.closeItemModal();
    }
  };

  // Keyboard Escape listener
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      if (window.closeItemModal) window.closeItemModal();
    }
  });

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initMapAndDenah);
  } else {
    initMapAndDenah();
  }
})();
