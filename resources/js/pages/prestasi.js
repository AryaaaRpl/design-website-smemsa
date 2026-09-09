/* ==========================================================================
   PRESTASI & PENGHARGAAN - CATALOG, FILTERS & MODAL LOGIC
   ========================================================================== */

(function () {
  // ==========================================
  // 1. DATA PRESTASI & KATALOG (Array of Objects)
  // ==========================================
  const awardsList = [
    {
      id: "me-awards",
      title:
        "Juara Umum Muhammadiyah Education Awards (ME Awards) Nasional 2026",
      category: "akademik",
      categoryLabel: "Akademik & Vokasi",
      level: "nasional",
      badge: "JUARA UMUM TINGKAT NASIONAL",
      year: "2026",
      dateStr: "Maret 2026",
      location: "Universitas Muhammadiyah Malang / Nasional",
      org: "Pimpinan Wilayah Muhammadiyah & Majelis Dikdasmen Nasional",
      excerpt:
        "Mengungguli ratusan sekolah kejuruan se-Indonesia dalam kompetisi riset inovasi digital, robotika, seni budaya, dan kepemimpinan Islami.",
      photo: "assets/juara-me-awards.jpg",
      photoAlt: "Dokumentasi Penyerahan Piala Juara Umum ME Awards 2026",
      fullDesc: `
        <div style="margin-bottom: 1.5rem; border-radius: 14px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
          <img src="assets/juara-me-awards.jpg" alt="Dokumentasi Penyerahan Juara Umum ME Awards" loading="lazy" style="width: 100%; height: auto; display: block;" onerror="this.closest('.card') ? this.closest('.card').classList.add('no-image') : null; this.remove();">
        </div>
        <p>SMKS Muhammadiyah 1 Genteng berhasil menorehkan sejarah gemilang dengan dinobatkan sebagai <strong>Juara Umum Tingkat Nasional</strong> dalam perhelatan akbar Muhammadiyah Education Awards (ME Awards) 2026.</p>
        <p>Prestasi ini diraih berkat akumulasi medali emas dan perak pada berbagai cabang perlombaan bergengsi, meliputi Lomba Inovasi Robotika Vokasi, Desain Aplikasi Digital Software, Pidato Bahasa Asing, Seni Budaya, dan Tata Kelola Sekolah Kejuruan Unggul.</p>
        <p>Pencapaian ini membuktikan komitmen civitas akademika SMEMSA dalam mengintegrasikan keahlian sains teknologi abad ke-21 dengan penanaman akhlakul karimah yang berwawasan global.</p>
      `,
    },
    {
      id: "inovasi-rpl",
      title:
        "Juara 1 Lomba Inovasi Digital Nasional (Tim Pengembang Perangkat Lunak & Gim)",
      category: "teknologi",
      categoryLabel: "Teknologi IT",
      level: "nasional",
      badge: "MEDALI EMAS NASIONAL",
      year: "2026",
      dateStr: "Mei 2026",
      location: "Jakarta / Nasional",
      org: "Kementerian Pendidikan & Asosiasi Industri Software House",
      excerpt:
        "Pengembangan software terintegrasi 'Smart Vocational Cloud' untuk monitoring presensi RFID dan portofolio kompetensi BNSP siswa.",
      photo: "assets/prestasi-placeholder.jpg",
      photoAlt:
        "Foto Tim PPLG SMEMSA meraih Medali Emas Lomba Inovasi Digital",
      fullDesc: `
        <p>Tim siswa konsentrasi keahlian Pengembang Perangkat Lunak & Gim (PPLG) SMKS Muhammadiyah 1 Genteng berhasil meraih <strong>Juara 1 Nasional</strong> dalam kompetisi inovasi perangkat lunak terapan.</p>
        <p>Produk yang dikembangkan adalah <em>'Smart Vocational Management System'</em>, aplikasi cloud terintegrasi untuk absensi RFID real-time, monitoring unit produksi Teaching Factory, dan tracking sertifikasi BNSP siswa.</p>
      `,
    },
    {
      id: "taekwondo",
      title:
        "Dua Atlet Taekwondo Smemsa Raih Juara 3 Kejurprov Pelajar se-Jatim",
      category: "bela-diri",
      categoryLabel: "Bela Diri",
      level: "provinsi",
      badge: "MEDALI PERUNGGU PROVINSI",
      year: "2026",
      dateStr: "Juni 2026",
      location: "Malang, Jawa Timur",
      org: "Pengurus Provinsi Taekwondo Indonesia (TI) Jawa Timur",
      excerpt:
        "Dua atlet pelajar binaan ekstrakurikuler bela diri SMEMSA sukses merebut podium ketiga pada kejuaraan provinsi di GOR Ken Arok Malang.",
      photo: "assets/prestasi-placeholder.jpg",
      photoAlt: "Foto Penyerahan Medali Taekwondo Kejurprov Jatim",
      fullDesc: `
        <p>Dua atlet pelajar SMKS Muhammadiyah 1 Genteng sukses merebut medali perunggu pada ajang Kejuaraan Provinsi (Kejurprov) Taekwondo Antar Pelajar se-Jawa Timur yang diselenggarakan di GOR Ken Arok, Malang.</p>
        <p>Melalui latihan disiplin intensif di bawah naungan ekstrakurikuler bela diri sekolah, atlet binaan SMEMSA mampu bersaing secara tangguh menghadapi atlet-atlet unggulan dari berbagai kota besar di Jawa Timur.</p>
      `,
    },
    {
      id: "karaoke",
      title:
        "Dua Siswi Smemsa Borong Juara Festival Vokal Pelajar Berbakat",
      category: "seni",
      categoryLabel: "Seni Musik",
      level: "kabupaten",
      badge: "JUARA FESTIVAL SENI",
      year: "2026",
      dateStr: "Juni 2026",
      location: "Banyuwangi",
      org: "Dinas Kebudayaan & Pariwisata Kabupaten Banyuwangi",
      excerpt:
        "Harmonisasi nada dan olah vokal memukau mengantarkan delegasi siswi SMEMSA memboyong piala juara festival musik pelajar daerah.",
      photo: "assets/prestasi-placeholder.jpg",
      photoAlt: "Foto Pemenang Festival Seni Suara Pelajar",
      fullDesc: `
        <p>Penampilan vokal yang memukau dan harmonisasi nada yang matang mengantarkan dua siswi SMEMSA memboyong piala juara pada festival pencarian bakat vokal pelajar tingkat kabupaten Banyuwangi.</p>
        <p>Sekolah memberikan apresiasi tinggi bagi pengembangan bakat seni dan kepercayaan diri siswa sebagai penyeimbang keterampilan teknis vokasi.</p>
      `,
    },
    {
      id: "silat",
      title:
        "Juara 1 Open Competition Panji Laras Kategori Seni Tunggal IPSI",
      category: "bela-diri",
      categoryLabel: "Pencak Silat",
      level: "regional",
      badge: "JUARA 1 SENI TUNGGAL",
      year: "2025",
      dateStr: "November 2025",
      location: "Banyuwangi",
      org: "Ikatan Pencak Silat Indonesia (IPSI) Kabupaten Banyuwangi",
      excerpt:
        "Pesilat Tapak Suci SMEMSA mendominasi kompetisi seni tunggal IPSI dengan keindahan jurus dan presisi gerakan berstandar nasional.",
      photo: "assets/prestasi-placeholder.jpg",
      photoAlt: "Foto Pesilat Tapak Suci SMEMSA di Podium Juara",
      fullDesc: `
        <p>Pesilat Tapak Suci Putera Muhammadiyah SMEMSA berhasil menyabet Juara 1 kategori Seni Tunggal Putra pada Kejuaraan Terbuka Panji Laras se-Kabupaten Banyuwangi.</p>
        <p>Gerakan jurus yang presisi, ketegasan sikap, dan penghayatan gerak seni bela diri tradisional mengantarkan pesilat sekolah memperoleh skor tertinggi dari dewan juri IPSI.</p>
      `,
    },
    {
      id: "esports",
      title:
        "Juara 1 MPL Student League & Delegasi Grand Final Tingkat Nasional",
      category: "esports",
      categoryLabel: "E-Sports",
      level: "nasional",
      badge: "JUARA 1 & DELEGASI NASIONAL",
      year: "2025",
      dateStr: "Oktober 2025",
      location: "Universitas Muhammadiyah Malang & Karesidenan",
      org: "Indonesia Esports Association (IESPA) Jawa Timur",
      excerpt:
        "Kerja sama taktis dan kepiawaian strategi tim e-sports sekolah membawa SMEMSA lolos melaju ke babak Grand Final nasional Universitas Muhammadiyah Malang.",
      photo: "assets/prestasi-placeholder.jpg",
      photoAlt: "Foto Tim E-Sports SMEMSA memegang Trofi Juara",
      fullDesc: `
        <p>Tim E-Sports SMKS Muhammadiyah 1 Genteng membuktikan keunggulan strategi, koordinasi tim, dan ketangkasan kognitif dengan menjuarai kualifikasi MPL Student League regional.</p>
        <p>Prestasi ini mengantarkan tim mewakili karesidenan ke babak Grand Final tingkat nasional di Universitas Muhammadiyah Malang.</p>
      `,
    },
    {
      id: "lks-tkj",
      title:
        "Juara 1 Lomba Kompetensi Siswa (LKS) IT Network System Administration",
      category: "teknologi",
      categoryLabel: "Teknologi IT",
      level: "provinsi",
      badge: "MEDALI EMAS LKS WILAYAH",
      year: "2025",
      dateStr: "Agustus 2025",
      location: "Jember & Banyuwangi",
      org: "Musyawarah Kerja Kepala Sekolah (MKKS) & Dinas Pendidikan Jatim",
      excerpt:
        "Konfigurasi routing enterprise, virtualization server, dan network security mengantarkan siswa TJKT SMEMSA ke posisi puncak LKS.",
      photo: "assets/prestasi-placeholder.jpg",
      photoAlt: "Foto Siswa TJKT Juara LKS Network Administration",
      fullDesc: `
        <p>Siswa konsentrasi keahlian Teknik Komputer dan Jaringan (TJKT) SMEMSA meraih Juara 1 pada ajang Lomba Kompetensi Siswa (LKS) bidang IT Network System Administration.</p>
        <p>Kemampuan konfigurasi server Linux, firewall, dan routing Cisco secara cepat dan aman di bawah batasan waktu ketat mengesankan para penguji dari kalangan praktisi industri telekomunikasi.</p>
      `,
    },
    {
      id: "animasi-dkv",
      title:
        "Pemenang Karya Terbaik Festival Film Pendek Animasi 2D Pelajar Vokasi",
      category: "seni",
      categoryLabel: "Desain & Animasi",
      level: "nasional",
      badge: "KARYA TERBAIK NASIONAL",
      year: "2025",
      dateStr: "September 2025",
      location: "Yogyakarta",
      org: "Asosiasi Industri Animasi & Konten Kreatif Indonesia (AINAKI)",
      excerpt:
        "Karya animasi edukasi bertema kearifan lokal karya siswa DKV berhasil menyabet penghargaan Best Storytelling & Visual Appeal.",
      photo: "assets/prestasi-placeholder.jpg",
      photoAlt: "Foto Siswa DKV Pemenang Festival Animasi",
      fullDesc: `
        <p>Siswa konsentrasi Desain Komunikasi Visual (DKV) SMEMSA menciptakan film pendek animasi 2D yang memadukan cerita edukasi karakter dengan visual grafis modern.</p>
        <p>Karya ini terpilih sebagai salah satu karya terbaik di antara ratusan submisi pelajar SMK se-Indonesia dalam festival animasi nasional di Yogyakarta.</p>
      `,
    },
    {
      id: "robotika-otomasi",
      title:
        "Juara 2 National Vocational Robotic Competition (Line Follower Micro)",
      category: "teknologi",
      categoryLabel: "Robotika",
      level: "nasional",
      badge: "JUARA 2 NASIONAL",
      year: "2024",
      dateStr: "Desember 2024",
      location: "Semarang",
      org: "Federasi Robotika Indonesia & Polines",
      excerpt:
        "Robot line follower mikrokontroler presisi tinggi hasil rancangan siswa Teknik Mekatronika meraih waktu tercepat kedua di lintasan sirkuit nasional.",
      photo: "assets/prestasi-placeholder.jpg",
      photoAlt: "Foto Tim Robotika SMEMSA dengan Trofi Robotika",
      fullDesc: `
        <p>Tim Robotika SMKS Muhammadiyah 1 Genteng merancang robot lintasan otomatis berkecepatan tinggi dengan algoritma PID terkalibrasi presisi.</p>
        <p>Kompetisi ini menguji integrasi sensor optik, pemrograman embedded C, dan perancangan sirkuit PCB mandiri siswa.</p>
      `,
    },
    {
      id: "debat-bahasa",
      title: "Best Speaker & Juara 2 English Debate Championship Pelajar",
      category: "akademik",
      categoryLabel: "Bahasa & Debat",
      level: "provinsi",
      badge: "BEST SPEAKER PROVINSI",
      year: "2024",
      dateStr: "November 2024",
      location: "Universitas Muhammadiyah Malang",
      org: "English Teachers Association (MGMP) Jawa Timur",
      excerpt:
        "Keterampilan argumentasi kritis dalam bahasa Inggris mengenai isu global vokasi dan teknologi membawa siswa SMEMSA meraih gelar Best Speaker.",
      photo: "assets/prestasi-placeholder.jpg",
      photoAlt: "Foto Siswa Peraih Best Speaker English Debate",
      fullDesc: `
        <p>Kemampuan komunikasi bahasa internasional dan daya nalar kritis siswa SMEMSA terbukti unggul dalam kompetisi debat bahasa Inggris tingkat Jawa Timur.</p>
        <p>Dukungan program bilingual dan native speaking club sekolah menjadi fondasi utama keberhasilan ini.</p>
      `,
    },
    {
      id: "otomotif-tbsm",
      title:
        "Juara 1 Kontes Keterampilan Mekanik Sepeda Motor Honda se-Karesidenan",
      category: "teknologi",
      categoryLabel: "Otomotif",
      level: "regional",
      badge: "JUARA 1 MEKANIK TERBAIK",
      year: "2024",
      dateStr: "Oktober 2024",
      location: "Jember",
      org: "PT Mitra Pinasthika Mulia (MPM Honda Motor Jatim)",
      excerpt:
        "Ketepatan diagnosa sistem injeksi PGM-FI dan kecepatan overhaul mesin membawa siswa TBSM meraih predikat mekanik pelajar terbaik.",
      photo: "assets/prestasi-placeholder.jpg",
      photoAlt: "Foto Siswa TBSM Juara Kontes Mekanik Honda",
      fullDesc: `
        <p>Siswa Teknik & Bisnis Sepeda Motor (TBSM) SMEMSA unjuk kebolehan dalam uji kompetensi pemecahan masalah mesin injeksi (troubleshooting) standar bengkel resmi AHASS.</p>
        <p>Pencapaian ini membuka kesempatan langsung bagi siswa untuk memperoleh golden ticket rekrutmen mekanik resmi sebelum lulus.</p>
      `,
    },
    {
      id: "tapak-suci-jatim",
      title: "Juara Umum 2 Kejuaraan Daerah Tapak Suci Putera Muhammadiyah",
      category: "bela-diri",
      categoryLabel: "Pencak Silat",
      level: "provinsi",
      badge: "JUARA UMUM 2 KEJURDA",
      year: "2024",
      dateStr: "Agustus 2024",
      location: "Banyuwangi",
      org: "Pimpinan Wilayah Tapak Suci Jawa Timur",
      excerpt:
        "Kontingen pesilat SMEMSA membawa pulang 4 medali emas, 3 perak, dan 2 perunggu dalam kejuaraan tanding dan seni antar perguruan.",
      photo: "assets/prestasi-placeholder.jpg",
      photoAlt: "Foto Kontingen Tapak Suci SMEMSA",
      fullDesc: `
        <p>Kontingen atlet Tapak Suci SMKS Muhammadiyah 1 Genteng tampil perkasa pada Kejuaraan Daerah dengan memborong berbagai kelas tanding dan seni beregu.</p>
        <p>Kombinasi ketahanan fisik, penguasaan jurus, dan akhlak sportivitas islami menjadi kunci keberhasilan pesilat sekolah.</p>
      `,
    },
  ];

  // ==========================================
  // 2. STATE MANAGEMENT & FILTER CONTROLS
  // ==========================================
  let currentCategory = "all";
  let currentYear = "all";
  let searchQuery = "";
  let currentView = "grid";
  const pageSize = 6;
  let displayedCount = pageSize;

  function getFilteredAwards() {
    return awardsList.filter((item) => {
      const matchCategory =
        currentCategory === "all" || item.category === currentCategory;
      const matchYear = currentYear === "all" || item.year === currentYear;
      const query = searchQuery.trim().toLowerCase();
      const matchSearch =
        !query ||
        item.title.toLowerCase().includes(query) ||
        item.org.toLowerCase().includes(query) ||
        item.categoryLabel.toLowerCase().includes(query) ||
        item.location.toLowerCase().includes(query) ||
        item.excerpt.toLowerCase().includes(query);

      return matchCategory && matchYear && matchSearch;
    });
  }

  // Render Catalog Grid View
  function renderGridView(itemsToRender) {
    const gridContainer = document.getElementById("awards-grid-container");
    if (!gridContainer) return;

    if (itemsToRender.length === 0) {
      gridContainer.innerHTML = "";
      return;
    }

    const html = itemsToRender
      .map((item) => {
        const isNational = item.level === "nasional";
        const badgeClass = isNational
          ? "award-badge-pill national"
          : "award-badge-pill";

        return `
          <article class="award-card" onclick="openAwardModal('${item.id}')" role="button" tabindex="0" aria-label="Detail prestasi: ${item.title}">
            <div class="award-card-header">
              <div class="award-card-tags-row">
                <span class="${badgeClass}">${item.badge}</span>
                <span class="award-year-tag">${item.year}</span>
              </div>
              <div class="award-headline-typo">${item.categoryLabel}</div>
            </div>
            <div class="award-card-body">
              <div>
                <div class="award-sub-meta">
                  <span>${item.dateStr}</span>
                  <span>&bull;</span>
                  <span>${item.location}</span>
                </div>
                <h3 class="award-card-title">${item.title}</h3>
                <p class="award-card-desc">${item.excerpt}</p>
              </div>
              <div class="award-card-footer">
                <span class="award-organizer" title="${item.org}">${item.org}</span>
                <span class="award-view-link">Detail &rarr;</span>
              </div>
            </div>
          </article>
        `;
      })
      .join("");

    gridContainer.innerHTML = html;
  }

  // Render Timeline View (Grouped by Year)
  function renderTimelineView(filteredList) {
    const timelineContainer = document.getElementById(
      "awards-timeline-container",
    );
    if (!timelineContainer) return;

    if (filteredList.length === 0) {
      timelineContainer.innerHTML = "";
      return;
    }

    // Group by year descending
    const grouped = {};
    filteredList.forEach((item) => {
      if (!grouped[item.year]) grouped[item.year] = [];
      grouped[item.year].push(item);
    });

    const sortedYears = Object.keys(grouped).sort((a, b) => b - a);

    const html = sortedYears
      .map((yr) => {
        const itemsInYear = grouped[yr]
          .map((item) => {
            const isNational = item.level === "nasional";
            const badgeClass = isNational ? "badge-gold" : "badge-primary";

            return `
              <div class="timeline-item-card" onclick="openAwardModal('${item.id}')" role="button" tabindex="0" aria-label="${item.title}">
                <div class="timeline-card-content">
                  <div style="display:flex; align-items:center; gap:0.6rem; margin-bottom:0.3rem;">
                    <span class="${badgeClass}" style="font-size:0.72rem;">${item.badge}</span>
                    <span style="font-size:0.8rem; color:var(--text-subtle);">${item.dateStr} &bull; ${item.location}</span>
                  </div>
                  <h3>${item.title}</h3>
                  <p style="font-size:0.9rem; color:var(--text-muted); line-height:1.6; margin-bottom:0.4rem;">${item.excerpt}</p>
                  <span style="font-size:0.8rem; color:var(--text-subtle);">${item.org}</span>
                </div>
                <span class="award-view-link" style="white-space:nowrap;">Lihat &rarr;</span>
              </div>
            `;
          })
          .join("");

        return `
          <div class="timeline-year-block">
            <div class="timeline-year-marker">${yr}</div>
            ${itemsInYear}
          </div>
        `;
      })
      .join("");

    timelineContainer.innerHTML = html;
  }

  // Main Refresh Function
  function updateCatalog() {
    const filtered = getFilteredAwards();
    const totalMatching = filtered.length;
    const itemsToShow = filtered.slice(0, displayedCount);

    // Render Views
    const gridContainer = document.getElementById("awards-grid-container");
    const timelineContainer = document.getElementById("awards-timeline-container");
    const emptyState = document.getElementById("catalog-empty-state");
    const countText = document.getElementById("catalog-count-text");
    const loadMoreBtn = document.getElementById("load-more-container");

    if (currentView === "grid") {
      renderGridView(itemsToShow);
      if (gridContainer) gridContainer.style.display = "grid";
      if (timelineContainer) timelineContainer.style.display = "none";
    } else {
      renderTimelineView(itemsToShow);
      if (gridContainer) gridContainer.style.display = "none";
      if (timelineContainer) timelineContainer.style.display = "block";
    }

    // Status count & live region update
    const totalCount = awardsList.length;
    if (totalMatching === 0) {
      if (countText) countText.innerText = `Menampilkan 0 dari ${totalCount} prestasi`;
      if (emptyState) emptyState.classList.add("active");
      if (loadMoreBtn) loadMoreBtn.style.display = "none";
    } else {
      const currentShown = Math.min(displayedCount, totalMatching);
      if (countText) countText.innerText = `Menampilkan ${currentShown} dari ${totalMatching} prestasi (Total ${totalCount} koleksi)`;
      if (emptyState) emptyState.classList.remove("active");

      // Load More Button visibility
      if (loadMoreBtn) {
        if (displayedCount >= totalMatching) {
          loadMoreBtn.style.display = "none";
        } else {
          loadMoreBtn.style.display = "block";
        }
      }
    }
  }

  // Global Event Handlers for Filters
  window.filterByCategory = function (category, btnElement) {
    currentCategory = category;
    displayedCount = pageSize; // reset pagination

    // Update ARIA pressed state
    document.querySelectorAll(".category-chip").forEach((btn) => {
      btn.classList.remove("active");
      btn.setAttribute("aria-pressed", "false");
    });
    if (btnElement) {
      btnElement.classList.add("active");
      btnElement.setAttribute("aria-pressed", "true");
    }

    updateCatalog();
  };

  window.filterByYear = function (year) {
    currentYear = year;
    displayedCount = pageSize;
    updateCatalog();
  };

  window.switchCatalogView = function (viewType) {
    currentView = viewType;
    const gridBtn = document.getElementById("view-grid-btn");
    const timelineBtn = document.getElementById("view-timeline-btn");

    if (viewType === "grid") {
      if (gridBtn) {
        gridBtn.classList.add("active");
        gridBtn.setAttribute("aria-pressed", "true");
      }
      if (timelineBtn) {
        timelineBtn.classList.remove("active");
        timelineBtn.setAttribute("aria-pressed", "false");
      }
    } else {
      if (timelineBtn) {
        timelineBtn.classList.add("active");
        timelineBtn.setAttribute("aria-pressed", "true");
      }
      if (gridBtn) {
        gridBtn.classList.remove("active");
        gridBtn.setAttribute("aria-pressed", "false");
      }
    }

    updateCatalog();
  };

  window.loadMoreAwards = function () {
    displayedCount += pageSize;
    updateCatalog();
  };

  window.resetAllFilters = function () {
    currentCategory = "all";
    currentYear = "all";
    searchQuery = "";
    displayedCount = pageSize;

    const searchInput = document.getElementById("award-search-input");
    if (searchInput) searchInput.value = "";

    const yearSelect = document.getElementById("award-year-filter");
    if (yearSelect) yearSelect.value = "all";

    document.querySelectorAll(".category-chip").forEach((btn) => {
      if (btn.dataset.category === "all") {
        btn.classList.add("active");
        btn.setAttribute("aria-pressed", "true");
      } else {
        btn.classList.remove("active");
        btn.setAttribute("aria-pressed", "false");
      }
    });

    updateCatalog();
  };

  // ==========================================
  // 3. MODAL DIALOG LOGIC
  // ==========================================
  window.openAwardModal = function (awardId) {
    const item = awardsList.find((a) => a.id === awardId);
    if (!item) return;

    const badgeEl = document.getElementById("modal-award-badge");
    const catEl = document.getElementById("modal-award-cat");
    const locEl = document.getElementById("modal-award-location");
    const titleEl = document.getElementById("modal-award-title");
    const orgEl = document.getElementById("modal-award-org");
    const descEl = document.getElementById("modal-award-desc");
    const bannerSubEl = document.getElementById("modal-banner-sub");
    const modalOverlay = document.getElementById("award-modal-overlay");

    if (badgeEl) badgeEl.innerText = item.badge;
    if (catEl) catEl.innerText = item.categoryLabel;
    if (locEl) locEl.innerText = `${item.location} • ${item.year}`;
    if (titleEl) titleEl.innerText = item.title;
    if (orgEl) orgEl.innerText = item.org;
    if (descEl) descEl.innerHTML = item.fullDesc;
    if (bannerSubEl) bannerSubEl.innerText = `Kategori: ${item.categoryLabel} • Tahun ${item.year}`;

    if (modalOverlay) {
      modalOverlay.classList.add("active");
      modalOverlay.setAttribute("aria-hidden", "false");
    }
    document.body.style.overflow = "hidden";
    if (window.lenis) window.lenis.stop();
  };

  window.closeAwardModal = function () {
    const modalOverlay = document.getElementById("award-modal-overlay");
    if (modalOverlay) {
      modalOverlay.classList.remove("active");
      modalOverlay.setAttribute("aria-hidden", "true");
    }
    document.body.style.overflow = "";
    if (window.lenis) window.lenis.start();
  };

  window.closeAwardModalOnOverlay = function (e) {
    if (e.target.id === "award-modal-overlay") {
      window.closeAwardModal();
    }
  };

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      window.closeAwardModal();
    }
  });

  // Word Reveal Animation Fix
  function initWordReveal() {
    const revealTarget = document.getElementById("pinnacle-text-reveal");
    if (revealTarget && typeof gsap !== "undefined") {
      const words = revealTarget.innerText.split(" ");
      revealTarget.innerHTML = words
        .map(
          (w) =>
            `<span class="reveal-word" style="opacity: 0.25; display: inline-block; transition: opacity 0.2s;">${w}</span>`,
        )
        .join(" ");

      const wordSpans = revealTarget.querySelectorAll(".reveal-word");

      if (typeof ScrollTrigger !== "undefined") {
        gsap.to(wordSpans, {
          opacity: 1,
          stagger: 0.05,
          ease: "none",
          scrollTrigger: {
            trigger: ".pinnacle-card",
            start: "top 85%",
            end: "bottom 60%",
            scrub: 0.5,
            onLeave: () => {
              gsap.set(wordSpans, { opacity: 1 });
            },
          },
        });
      }
    }
  }

  function initPrestasiPage() {
    const searchInputEl = document.getElementById("award-search-input");
    if (searchInputEl) {
      searchInputEl.addEventListener("input", (e) => {
        searchQuery = e.target.value;
        displayedCount = pageSize;
        updateCatalog();
      });
    }

    updateCatalog();
    initWordReveal();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initPrestasiPage);
  } else {
    initPrestasiPage();
  }
})();
