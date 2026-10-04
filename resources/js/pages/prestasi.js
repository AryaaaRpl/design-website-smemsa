/* ==========================================================================
   PRESTASI & PENGHARGAAN - KATALOG (PAGINASI SERVER) & TAMPILAN
   Pencarian, filter kategori/tahun, dan paginasi (18 per halaman) diproses
   di server. Script ini memuat ulang isi katalog tanpa refresh halaman.
   Kartu membuka halaman detail /prestasi/{slug}.
   Tanpa JavaScript, semua kontrol tetap berfungsi sebagai form/link biasa.
   ========================================================================== */

(function () {
  const form = document.getElementById("award-filter-form");
  const results = document.getElementById("award-catalog-results");
  const catalog = document.getElementById("katalog-prestasi");

  let pendingRequest = null;

  // ==========================================
  // 1. MEMUAT KATALOG TANPA REFRESH
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
        window.revealIn?.(results);
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

})();
