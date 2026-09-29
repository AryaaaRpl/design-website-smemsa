/* ==========================================================================
   SCRIPT BERSAMA SEMUA HALAMAN PUBLIK (dipindah dari layouts/app.blade.php)
   Dimuat dengan defer SETELAH gsap, ScrollTrigger & lenis, SEBELUM script halaman (Vite).
   Data dari server dibaca dari window.SITE_DATA (ditulis di layout).
   ========================================================================== */

// ---------- Navbar & drawer HP ----------
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
        if (typeof closeAwardModal === "function") closeAwardModal();
        if (typeof closeMajorModal === "function") closeMajorModal();
      }
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initNavigation);
  } else {
    initNavigation();
  }
})();

// ---------- Lenis, animasi, beranda, chatbot, back-to-top ----------
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
}, { passive: true });

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

// 6. KONSENTRASI KEAHLIAN: DATA DARI DATABASE (dikirim oleh HomeController)
const majorsData = window.SITE_DATA.majors;

let activeMajorKey = majorsData[0]?.key ?? null;
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
                ${m.logo ? `<img class="major-nav-logo" src="${m.logo}" alt="Logo ${m.code}" width="20" height="20" loading="lazy" />` : ""}
                <div class="major-nav-content">
                    <div class="major-nav-top">
                        <h4 class="major-nav-name">${m.title}</h4>
                        <span class="major-nav-code">${m.code}</span>
                    </div>
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

// HP/tablet (<= 900px): daftar jurusan bekerja sebagai dropdown (akordeon).
// Awalnya semua tertutup; panel hanya muncul setelah jurusan diketuk.
const isMajorsMobile = () => window.innerWidth <= 900;

function collapseMajorPanel() {
  document.getElementById("major-tabpanel-container")?.classList.add("is-collapsed");
  document.querySelectorAll(".major-nav-item").forEach((btn) => {
    btn.classList.remove("active");
    btn.setAttribute("aria-selected", "false");
  });
}

function isMajorPanelOpen() {
  return !document.getElementById("major-tabpanel-container")?.classList.contains("is-collapsed");
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
    // Desktop selalu menampilkan panel jurusan yang aktif.
    if (window.innerWidth > 900 && !isMajorPanelOpen()) {
      panel.classList.remove("is-collapsed");
      selectMajorPathway(activeMajorKey);
    }
  }, 200);
});

// Laptop: klik membuka halaman detail jurusan (hover tetap mengganti panel).
// HP/tablet: ketuk membuka panel di bawah jurusan; ketuk lagi untuk menutup.
function handleMajorClick(majorKey) {
  clearTimeout(hoverDebounceTimer);
  const major = majorsData.find((m) => m.key === majorKey);
  if (!isMajorsMobile() && major && major.url) {
    window.location.href = major.url;
    return;
  }
  if (isMajorsMobile() && majorKey === activeMajorKey && isMajorPanelOpen()) {
    collapseMajorPanel();
    return;
  }
  selectMajorPathway(majorKey);
}

function handleMajorFocus(majorKey) {
  clearTimeout(hoverDebounceTimer);
  // Di HP, fokus (termasuk dari ketukan) tidak membuka panel; hanya klik yang membuka.
  if (isMajorsMobile()) return;
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

  // Isi panel dengan data jurusan terpilih.
  const applyMajorContent = () => {
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

      if (major.key === majorsData[0]?.key) {
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
    const detailLinkEl = document.getElementById("panel-detail-link");
    if (detailLinkEl && major.url) detailLinkEl.href = major.url;

    // Alur 4 Tahap (data dari admin: teks di-escape, daftar kosong diberi keterangan)
    const renderStepList = (items) => {
      if (!items || items.length === 0) {
        return "<li>Informasi segera tersedia</li>";
      }
      return items
        .map((item) => {
          const li = document.createElement("li");
          li.textContent = item;
          return li.outerHTML;
        })
        .join("");
    };

    if (stage1El) stage1El.innerHTML = renderStepList(major.kompetensi);

    if (stage2El) stage2El.innerHTML = renderStepList(major.tempatPraktik.items);
    if (stage2Box) stage2Box.textContent = major.tempatPraktik.box || "Teaching Factory";

    if (stage3El) stage3El.innerHTML = renderStepList(major.sertifikasi.items);
    if (stage3Box) stage3Box.textContent = major.sertifikasi.box || "LSP-P1 BNSP";

    if (stage4El) stage4El.innerHTML = renderStepList(major.setelahLulus.items);
    if (stage4Box) stage4Box.textContent = major.setelahLulus.box || "Mitra Industri & Karir";
  };

  // HP: isi diganti dulu selagi tersembunyi, panel dipindah di bawah jurusan,
  // lalu muncul dengan SATU animasi masuk (tanpa pudar-keluar lebih dulu).
  if (isMajorsMobile()) {
    pathwayView.classList.remove("anim-switching");
    applyMajorContent();
    openMajorPanelUnder(majorKey);
    playMajorPanelEnter(pathwayView);
    return;
  }

  // Desktop: pudar-keluar, ganti isi, lalu pudar-masuk (tidak berubah).
  pathwayView.classList.add("anim-switching");

  pathwaySwitchTimeout = setTimeout(() => {
    applyMajorContent();
    pathwayView.classList.remove("anim-switching");
  }, 125);
}

// Putar ulang animasi masuk panel di HP (lihat .mobile-enter di index.css).
function playMajorPanelEnter(view) {
  view.classList.remove("mobile-enter");
  void view.offsetWidth; // paksa browser mengulang animasi dari awal
  view.classList.add("mobile-enter");
}

/* MOBILE: panel dipindahkan SEKETIKA tepat di bawah jurusan yang diketuk (akordeon).
   Jurusan yang diketuk "dikunci" di posisi layarnya: jika panel lama di atasnya
   hilang, posisi gulir dikoreksi instan sehingga tidak ada lompatan dan panel
   langsung terlihat di bawah jari pengguna. */
const MAJOR_NAV_OFFSET = 90; // tinggi navbar mengambang + sedikit jarak

function scrollPageTo(top, smooth) {
  if (typeof lenis !== "undefined" && lenis) {
    lenis.scrollTo(top, smooth ? { duration: 0.5 } : { immediate: true, force: true });
  } else {
    window.scrollTo({ top, behavior: smooth ? "smooth" : "auto" });
  }
}

function openMajorPanelUnder(majorKey) {
  const panel = document.getElementById("major-tabpanel-container");
  const item = document.getElementById("tab-btn-" + majorKey);
  if (!panel || !item) return;

  const topBefore = item.getBoundingClientRect().top;

  if (item.nextElementSibling !== panel) {
    item.parentNode.insertBefore(panel, item.nextElementSibling);
  }
  panel.classList.remove("is-collapsed");

  // 1. Kunci posisi: kembalikan jurusan yang diketuk ke titik layar semula.
  const shift = item.getBoundingClientRect().top - topBefore;
  if (shift !== 0) scrollPageTo(window.scrollY + shift, false);

  // 2. Jika jurusan terlalu ke bawah (panel tidak akan terlihat) atau tertutup navbar,
  //    geser halus sampai jurusan tepat di bawah navbar.
  const top = item.getBoundingClientRect().top;
  if (top < MAJOR_NAV_OFFSET || top > window.innerHeight * 0.45) {
    scrollPageTo(window.scrollY + top - MAJOR_NAV_OFFSET, true);
  }
}

// Inisialisasi awal saat load
// Foto jurusan di-preload setelah halaman selesai dimuat agar tidak berebut
// bandwidth dengan gambar hero (konten pertama yang dilihat pengunjung).
if (document.readyState === "complete") {
  preloadMajorImages();
} else {
  window.addEventListener("load", preloadMajorImages, { once: true });
}
renderMajorTabList();
if (isMajorsMobile()) {
  collapseMajorPanel();
} else {
  document.getElementById("major-tabpanel-container")?.classList.remove("is-collapsed");
  selectMajorPathway(activeMajorKey);
}

// 7. AI Chatbot Logic
const chatbotToggle = document.getElementById("chatbot-toggle");
const chatPanel = document.getElementById("chat-panel");
const chatBody = document.getElementById("chat-body");
const chatInput = document.getElementById("chat-input-text");

if (chatbotToggle) {
  chatbotToggle.addEventListener("click", () => {
    const isActive = chatPanel.classList.toggle("active");
    chatbotToggle.classList.toggle("active", isActive);
    chatbotToggle.setAttribute("aria-label", isActive ? "Tutup Asisten AI" : "Buka Asisten AI");
  });
}

function appendMsg(text, sender) {
  const div = document.createElement("div");
  div.className = `chat-msg ${sender}`;
  div.innerText = text;
  chatBody.appendChild(div);
  chatBody.scrollTop = chatBody.scrollHeight;
}

// Daftar jurusan untuk jawaban chatbot, dari database.
const chatMajors = window.SITE_DATA.chatMajors;

function chatMajorsAnswer() {
  if (chatMajors.length === 0) {
    return "Informasi konsentrasi keahlian sedang disiapkan. Silakan hubungi Panitia via WA di " + window.SITE_DATA.spmbWhatsapp + ".";
  }

  const list = chatMajors.map((m, i) => `${i + 1}. ${m.code} (${m.name})`).join("\n");
  return `SMEMSA Genteng memiliki ${chatMajors.length} Konsentrasi Keahlian Unggulan Industri:\n${list}`;
}

// Lowongan BKK yang sedang dibuka, untuk jawaban chatbot (dari database).
const chatVacancies = window.SITE_DATA.chatVacancies;

function chatVacanciesAnswer() {
  if (chatVacancies.length === 0) {
    return "Saat ini belum ada lowongan kerja yang dibuka di BKK SMEMSA. Pantau terus halaman BKK untuk info lowongan terbaru!";
  }

  const list = chatVacancies
    .map((v, i) => `${i + 1}. ${v.position} - ${v.company}${v.location ? ` (${v.location})` : ""}\n   • Tipe: ${v.type}`)
    .join("\n\n");

  return `🔥 Lowongan Kerja Terbaru Bursa Kerja Khusus (BKK) SMEMSA:\n\n${list}\n\nInfo lengkap & cara melamar ada di halaman BKK SMEMSA.`;
}

function getBotResponse(input) {
  const text = input.toLowerCase();
  if (
    text.includes("jurusan") ||
    text.includes("prodi") ||
    text.includes("keahlian")
  ) {
    return chatMajorsAnswer();
  } else if (
    text.includes("spmb") ||
    text.includes("daftar") ||
    text.includes("syarat") ||
    text.includes("biaya") ||
    text.includes("alur") ||
    text.includes("jadwal")
  ) {
    return "Alur Pendaftaran SPMB SMEMSA TA " + window.SITE_DATA.spmbAcademicYear + ":\n\n🌐 ALUR ONLINE (Praktis & Cepat):\n1. Akses halaman Pendaftaran di website/menu SPMB.\n2. Isi data diri & pilih konsentrasi keahlian impian.\n3. Upload berkas (Rapor/SKL, KK, Akta).\n4. Cetak Kartu Pendaftaran & konfirmasi via WA Panitia.\n\n🏫 ALUR OFFLINE (Langsung di Sekolah):\n1. Datang ke Sekretariat SPMB SMEMSA Genteng (" + window.SITE_DATA.address + ").\n2. Dampingi oleh Tim Admin pendaftaran untuk pengisian form.\n3. Verifikasi berkas cetak & pengukuran seragam di tempat.\n4. Menerima bukti pendaftaran resmi & informasi orientasi.";
  } else if (
    text.includes("loker") ||
    text.includes("bkk") ||
    text.includes("kerja") ||
    text.includes("magang") ||
    text.includes("lowongan")
  ) {
    return chatVacanciesAnswer();
  } else if (
    text.includes("lsp") ||
    text.includes("bnsp") ||
    text.includes("sertifikat")
  ) {
    return "SMEMSA memiliki Lembaga Sertifikasi Profesi Pihak Kesatu (LSP-P1) berlisensi resmi BNSP. Setiap lulusan dibekali Ijazah + Sertifikat Kompetensi Garuda Emas berstandar nasional.";
  } else if (text.includes("kepala") || text.includes("wahid")) {
    return window.SITE_DATA.principalAnswer;
  } else if (text.includes("fasilitas") || text.includes("lab")) {
    return "Fasilitas unggulan meliputi Lab iMac PPLG, TEFA NOC & Fiber Optic TJKT, Studio Creative DKV, Live E-Commerce Hub BD, Bank Mini Syariah AKL, Executive Office MPLB, dan Edutel Hotel PH.";
  } else {
    return "Terima kasih atas pertanyaannya! Silakan tanya mengenai Info Jurusan, Alur SPMB (Online/Offline), Lowongan Kerja BKK, atau Sertifikasi LSP-P1 BNSP. Anda juga bisa menghubungi Panitia via WA di " + window.SITE_DATA.spmbWhatsapp + ".";
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

/* ANTREAN ANIMASI (performa): pembuatan animasi di bawah layar dijalankan
   berurutan dalam potongan kecil (maks. ~40ms), lalu browser diberi jeda
   untuk merespons. Urutan & hasil akhirnya sama; HP tidak "macet" saat memuat. */
const animationQueue = [];
const queueAnimation = (job) => animationQueue.push(job);
function flushAnimationQueue() {
  const startedAt = performance.now();
  while (animationQueue.length && performance.now() - startedAt < 40) {
    animationQueue.shift()();
  }
  if (animationQueue.length) setTimeout(flushAnimationQueue, 0);
}

// Counter Numbers Animation
queueAnimation(() => document.querySelectorAll(".counter-value").forEach((counter) => {
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
}));

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
document.querySelectorAll("[data-scroll-reveal]").forEach((el) => queueAnimation(() => {
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
}));

/* =====================================================================
       HERO SECTION ANIMATIONS
       ===================================================================== */
// Hanya di halaman yang punya hero beranda (mencegah peringatan "GSAP target not found").
if (!prefersReducedMotion && document.querySelector(".hero-text-col")) {
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

    // Lapisan di hero (terlihat saat halaman dibuka) dibuat langsung;
    // lapisan di section lain masuk antrean.
    const create = () => gsap.fromTo(
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

    if (section.getBoundingClientRect().top < window.innerHeight) create();
    else queueAnimation(create);
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
].forEach((sel) => queueAnimation(() => {
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
}));

// 8. TIGA PILAR SINERGI VOKASI - GSAP PINNED SCROLLTRIGGER ANIMATION
queueAnimation(() => {
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
});

// 9. Prestasi Section GSAP ScrollTrigger & Parallax
queueAnimation(() => {
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
});

// Infinite Partner Marquee
// Refresh posisi ScrollTrigger setelah font & gambar selesai dimuat,
// supaya perhitungan parallax tidak meleset.
// Cukup SATU kali setelah gambar (load) DAN font sama-sama siap: setiap refresh
// mengukur ulang semua trigger (mahal, memicu forced reflow).
Promise.all([
  new Promise((resolve) => (document.readyState === "complete" ? resolve() : window.addEventListener("load", resolve, { once: true }))),
  document.fonts && document.fonts.ready ? document.fonts.ready : Promise.resolve(),
]).then(() => ScrollTrigger.refresh());

// Marquee mitra hanya ada di beranda.
if (document.querySelector(".marquee-track")) {
  gsap.to(".marquee-track", {
    xPercent: -50,
    ease: "none",
    duration: 50,
    repeat: -1,
  });
}

// Jalankan antrean animasi (lihat ANTREAN ANIMASI di atas).
flushAnimationQueue();

function filterIndexNews(category, element) {
  const filterLinks = document.querySelectorAll(".news-filter-link");
  filterLinks.forEach(link => link.classList.remove("active"));
  if (element) {
    element.classList.add("active");
  }

  const articles = document.querySelectorAll(".news-cards-grid .article-card");
  let visibleCount = 0;
  articles.forEach(article => {
    const itemCat = article.getAttribute("data-category");
    if (category === "all" || itemCat === category) {
      article.style.display = "flex";
      visibleCount++;
    } else {
      article.style.display = "none";
    }
  });

  // Keterangan jika kategori ini tidak punya berita di antara berita terbaru.
  const emptyState = document.getElementById("home-news-empty");
  if (emptyState) emptyState.hidden = visibleCount > 0;
}

// Global Back to Top Button
(function () {
  const btt = document.getElementById("backToTopBtn");
  if (btt) {
    window.addEventListener("scroll", function () {
      if (window.scrollY > 400) {
        btt.classList.add("show");
      } else {
        btt.classList.remove("show");
      }
    }, { passive: true });

    btt.addEventListener("click", function () {
      if (typeof lenis !== "undefined" && lenis) {
        lenis.scrollTo(0);
      } else if (window.lenis) {
        window.lenis.scrollTo(0);
      } else {
        window.scrollTo({ top: 0, behavior: "smooth" });
      }
    });
  }
})();
