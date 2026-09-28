/* ==========================================================================
   PRESTASI & PENGHARGAAN - KATALOG (PAGINASI SERVER), TAMPILAN & MODAL
   Pencarian, filter kategori/tahun, dan paginasi (18 per halaman) diproses
   di server. Script ini memuat ulang isi katalog tanpa refresh halaman,
   mengatur tampilan grid/linimasa, dan membuka modal detail.
   Tanpa JavaScript, semua kontrol tetap berfungsi sebagai form/link biasa.
   ========================================================================== */

(function () {
  const form = document.getElementById("award-filter-form");
  const results = document.getElementById("award-catalog-results");
  const catalog = document.getElementById("katalog-prestasi");

  let currentView = "grid";
  let awardsList = [];
  let pendingRequest = null;

  // Data modal untuk prestasi yang sedang tampil (disisipkan server di dalam katalog).
  function readAwardsData() {
    const el = document.getElementById("awards-page-data");
    try {
      awardsList = el ? JSON.parse(el.textContent) : [];
    } catch (e) {
      awardsList = [];
    }
  }

  // ==========================================
  // 1. TAMPILAN GRID / LINIMASA
  // ==========================================
  function applyView() {
    const grid = document.getElementById("awards-grid-container");
    const timeline = document.getElementById("awards-timeline-container");
    if (grid) grid.style.display = currentView === "grid" ? "grid" : "none";
    if (timeline) timeline.style.display = currentView === "timeline" ? "block" : "none";

    [["view-grid-btn", "grid"], ["view-timeline-btn", "timeline"]].forEach(([id, view]) => {
      const btn = document.getElementById(id);
      if (!btn) return;
      btn.classList.toggle("active", currentView === view);
      btn.setAttribute("aria-pressed", currentView === view ? "true" : "false");
    });
  }

  window.switchCatalogView = function (viewType) {
    currentView = viewType;
    applyView();
  };

  // ==========================================
  // 2. MEMUAT KATALOG TANPA REFRESH
  // ==========================================
  // Samakan kontrol filter dengan URL (kategori aktif, tahun, kata kunci).
  function syncControls(url) {
    const params = new URL(url, window.location.origin).searchParams;
    const category = params.get("kategori") || "";

    document.querySelectorAll(".category-chip").forEach((chip) => {
      const isActive = (chip.value || "") === category;
      chip.classList.toggle("active", isActive);
      chip.setAttribute("aria-pressed", isActive ? "true" : "false");
    });

    const hidden = document.getElementById("award-category-input");
    if (hidden) hidden.value = category;

    const yearSelect = document.getElementById("award-year-filter");
    if (yearSelect) yearSelect.value = params.get("tahun") || "";

    const searchInput = document.getElementById("award-search-input");
    if (searchInput && document.activeElement !== searchInput) {
      searchInput.value = params.get("cari") || "";
    }
  }

  function scrollToCatalog() {
    if (!catalog || catalog.getBoundingClientRect().top >= 0) return;
    const top = window.scrollY + catalog.getBoundingClientRect().top - 90;
    if (window.lenis) window.lenis.scrollTo(top, { duration: 0.6 });
    else window.scrollTo({ top, behavior: "smooth" });
  }

  function loadCatalog(url, { push = true, scroll = false } = {}) {
    if (!results) {
      window.location.href = url;
      return;
    }

    if (pendingRequest) pendingRequest.abort();
    pendingRequest = new AbortController();
    results.classList.add("is-loading");

    fetch(url, {
      headers: { "X-Requested-With": "XMLHttpRequest" },
      signal: pendingRequest.signal,
    })
      .then((response) => {
        if (!response.ok) throw new Error("HTTP " + response.status);
        return response.text();
      })
      .then((html) => {
        results.innerHTML = html;
        readAwardsData();
        applyView();
        syncControls(url);
        if (push) history.pushState({ catalog: true }, "", url);
        if (scroll) scrollToCatalog();
      })
      .catch((error) => {
        // Permintaan dibatalkan karena ada permintaan baru: abaikan. Selain itu, muat halaman biasa.
        if (error.name !== "AbortError") window.location.href = url;
      })
      .finally(() => results.classList.remove("is-loading"));
  }

  // Bangun URL dari form (kosong dibuang; halaman kembali ke 1 saat filter berubah).
  function urlFromForm(submitter) {
    const data = new FormData(form, submitter || undefined);
    const params = new URLSearchParams();
    const category = data.getAll("kategori").pop(); // tombol kategori yang diklik menimpa nilai aktif
    if (data.get("cari")) params.set("cari", String(data.get("cari")).trim());
    if (category) params.set("kategori", category);
    if (data.get("tahun")) params.set("tahun", data.get("tahun"));

    const query = params.toString();
    return form.action.split("#")[0] + (query ? "?" + query : "") + "#katalog-prestasi";
  }

  if (form) {
    form.addEventListener("submit", (event) => {
      event.preventDefault();
      loadCatalog(urlFromForm(event.submitter));
    });

    // Pencarian langsung saat mengetik (jeda 400ms setelah berhenti mengetik).
    const searchInput = document.getElementById("award-search-input");
    let searchTimer = null;
    if (searchInput) {
      searchInput.addEventListener("input", () => {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => loadCatalog(urlFromForm()), 400);
      });
    }
  }

  // Link paginasi & "Atur Ulang Filter" di dalam katalog.
  if (results) {
    results.addEventListener("click", (event) => {
      const link = event.target.closest("a[data-catalog-link]");
      if (!link || event.ctrlKey || event.metaKey || event.shiftKey) return;
      event.preventDefault();
      loadCatalog(link.href, { scroll: true });
    });
  }

  // Tombol kembali/maju browser.
  window.addEventListener("popstate", () => {
    loadCatalog(window.location.href, { push: false });
  });

  // ==========================================
  // 3. MODAL DETAIL
  // ==========================================
  window.openAwardModal = function (awardId) {
    const item = awardsList.find((a) => a.id === awardId);
    if (!item) return;

    const catEl = document.getElementById("modal-award-cat");
    const locEl = document.getElementById("modal-award-location");
    const titleEl = document.getElementById("modal-award-title");
    const orgEl = document.getElementById("modal-award-org");
    const descEl = document.getElementById("modal-award-desc");
    const modalOverlay = document.getElementById("award-modal-overlay");

    if (catEl) catEl.innerText = item.categoryLabel;
    if (locEl) locEl.innerText = `${item.location} • ${item.year}`;
    if (titleEl) titleEl.innerText = item.title;
    if (orgEl) orgEl.innerText = item.org;
    // fullDesc sudah di-escape di server (Achievement::toCatalogArray).
    if (descEl) descEl.innerHTML = item.fullDesc;

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

  // Kartu bisa dibuka dengan keyboard (Enter / Spasi).
  document.addEventListener("keydown", (e) => {
    const card = e.target.closest && e.target.closest(".award-card, .timeline-item-card, .pinnacle-card");
    if (card && (e.key === "Enter" || e.key === " ")) {
      e.preventDefault();
      card.click();
    }
  });

  // ==========================================
  // 4. ANIMASI TEKS PRESTASI UNGGULAN
  // ==========================================
  function initWordReveal() {
    const revealTarget = document.getElementById("pinnacle-text-reveal");
    if (revealTarget && typeof gsap !== "undefined") {
      const escapeHtml = (value) =>
        value.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
      const words = revealTarget.innerText.split(" ");
      revealTarget.innerHTML = words
        .map(
          (w) =>
            `<span class="reveal-word" style="opacity: 0.25; display: inline-block; transition: opacity 0.2s;">${escapeHtml(w)}</span>`,
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
    readAwardsData();
    applyView();
    initWordReveal();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initPrestasiPage);
  } else {
    initPrestasiPage();
  }
})();
