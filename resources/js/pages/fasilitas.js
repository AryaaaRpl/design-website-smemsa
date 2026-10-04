/* ==========================================================================
   FASILITAS & TEFA - DENAH INTERAKTIF & PANEL DETAIL
   (Kartu TEFA & Sarana Penunjang membuka halaman detail /fasilitas/{slug}.)
   Data dari database lewat window.facilityData & window.facilityMapOrder.
   ========================================================================== */

(function () {
  const FACILITIES = window.facilityData || {};
  const MAP_ORDER = window.facilityMapOrder || [];

  // Lebar layar saat panel detail berubah menjadi bottom sheet.
  const sheetQuery = window.matchMedia("(max-width: 768px)");

  // Escape teks sebelum dimasukkan ke HTML (data berasal dari input admin).
  function escapeHtml(value) {
    return String(value ?? "")
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  /**
   * Muat & decode gambar sebelum ditampilkan, agar animasi panel tidak patah-patah.
   * Tetap lanjut jika gambar gagal/lama dimuat (maks. 1,5 detik).
   */
  function preloadImage(url) {
    if (!url) return Promise.resolve();

    const img = new Image();
    img.src = url;
    const decoded = img.decode ? img.decode().catch(() => {}) : Promise.resolve();
    const timeout = new Promise((resolve) => setTimeout(resolve, 1500));

    return Promise.race([decoded, timeout]);
  }

  /**
   * Beri sorotan singkat pada kartu TEFA/fasilitas yang sama dengan titik terpilih.
   */
  function highlightRelatedCard(id) {
    const card = document.querySelector('[data-facility="' + id + '"]');
    if (!card) return;

    document.querySelectorAll(".fac-card, .tefa-item").forEach(function (el) {
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
    const panel = document.getElementById("panel");
    const panelEmpty = document.getElementById("panelEmpty");
    const panelContent = document.getElementById("panelContent");
    const panelBackdrop = document.getElementById("panelBackdrop");
    const panelClose = document.getElementById("panelClose");

    let currentFilter = "all";
    let selectToken = 0;
    let backdropTimer = null;
    const SHEET_DURATION = 300; // sama dengan transisi .detail-panel di CSS

    /* ---------- Bottom sheet (HP) ---------- */
    function openSheet() {
      if (!sheetQuery.matches || !panel) return;
      panel.classList.add("is-open");
      if (panelBackdrop) {
        clearTimeout(backdropTimer);
        panelBackdrop.hidden = false;
        void panelBackdrop.offsetWidth; // agar transisi memudar berjalan
        panelBackdrop.classList.add("is-visible");
      }
      document.body.style.overflow = "hidden";
    }

    function closeSheet() {
      if (!panel) return;
      panel.classList.remove("is-open");
      if (panelBackdrop) {
        // Latar gelap memudar bersamaan dengan kartu turun, baru disembunyikan.
        panelBackdrop.classList.remove("is-visible");
        clearTimeout(backdropTimer);
        backdropTimer = setTimeout(function () {
          panelBackdrop.hidden = true;
        }, SHEET_DURATION);
      }
      document.body.style.overflow = "";
    }

    if (panelClose) panelClose.addEventListener("click", closeSheet);

    // Geser bar pegangan ke bawah untuk menutup: kartu ikut jari, lepas > 80px = tutup, kurang = kembali.
    const sheetBar = panel && panel.querySelector(".panel-sheet-bar");
    if (sheetBar) {
      let startY = null;
      let dragY = 0;
      sheetBar.addEventListener("touchstart", function (e) {
        if (e.target.closest(".panel-sheet-close")) return;
        startY = e.touches[0].clientY;
        dragY = 0;
        panel.classList.add("is-dragging");
      }, { passive: true });
      sheetBar.addEventListener("touchmove", function (e) {
        if (startY === null) return;
        dragY = Math.max(0, e.touches[0].clientY - startY);
        panel.style.transform = "translateY(" + dragY + "px)";
      }, { passive: true });
      const endDrag = function () {
        if (startY === null) return;
        startY = null;
        panel.classList.remove("is-dragging");
        panel.style.transform = "";
        if (dragY > 80) closeSheet();
      };
      sheetBar.addEventListener("touchend", endDrag);
      sheetBar.addEventListener("touchcancel", endDrag);
    }
    if (panelBackdrop) panelBackdrop.addEventListener("click", closeSheet);
    // Jika layar diperbesar ke ukuran laptop, tutup mode bottom sheet.
    sheetQuery.addEventListener("change", function (e) {
      if (!e.matches) closeSheet();
    });

    /* ---------- Isi panel ---------- */
    function renderPanel(item) {
      const photos = item.photos || [];
      const main = photos[0];
      const hasPhoto = Boolean(main);

      const thumbs =
        photos.length > 1
          ? '<div class="panel-thumbs" role="group" aria-label="Galeri foto">' +
            photos
              .map(function (photo, i) {
                return (
                  '<button type="button" class="panel-thumb' + (i === 0 ? " is-active" : "") + '" data-index="' + i + '" aria-label="Foto ' + (i + 1) + '">' +
                  '<img src="' + escapeHtml(photo.url) + '" alt="" loading="lazy" decoding="async">' +
                  "</button>"
                );
              })
              .join("") +
            "</div>"
          : "";

      panelContent.innerHTML =
        '<div class="panel-visual' + (hasPhoto ? " has-photo" : "") + '">' +
        (hasPhoto
          ? '<img class="panel-photo" src="' + escapeHtml(main.url) + '" alt="Foto ' + escapeHtml(item.full) + '" decoding="async" width="1200" height="700">'
          : "") +
        '<span class="panel-kicker">' + escapeHtml(item.kicker) + "</span>" +
        (hasPhoto && main.caption ? '<span class="photo-note">' + escapeHtml(main.caption) + "</span>" : "") +
        '<span class="p-mark">' + escapeHtml(item.mark) + "</span>" +
        "</div>" +
        thumbs +
        '<div class="panel-body">' +
        '<h3 class="panel-title">' + escapeHtml(item.full) + "</h3>" +
        '<div class="panel-loc">' + escapeHtml(item.loc) + "</div>" +
        '<p class="panel-desc">' + escapeHtml(item.desc) + "</p>" +
        (item.tools.length
          ? '<div class="panel-subhead">Sarana Utama</div><div class="chip-row">' +
            item.tools.map((tool) => '<span class="chip">' + escapeHtml(tool) + "</span>").join("") +
            "</div>"
          : "") +
        (item.highlight ? '<div class="panel-highlight">' + escapeHtml(item.highlight) + "</div>" : "") +
        "</div>";

      // Ganti foto utama saat thumbnail galeri dipilih.
      panelContent.querySelectorAll(".panel-thumb").forEach(function (btn) {
        btn.addEventListener("click", function () {
          const photo = photos[Number(btn.dataset.index)];
          const mainImg = panelContent.querySelector(".panel-photo");
          const note = panelContent.querySelector(".photo-note");
          if (!photo || !mainImg) return;

          preloadImage(photo.url).then(function () {
            mainImg.src = photo.url;
            if (note) note.textContent = photo.caption || "";
          });
          panelContent.querySelectorAll(".panel-thumb").forEach((b) => b.classList.toggle("is-active", b === btn));
        });
      });
    }

    function select(id) {
      const item = FACILITIES[id];
      if (!item || !panelContent) return;

      document.querySelectorAll(".hotspot").forEach(function (h) {
        h.classList.toggle("is-active", h.dataset.id === id);
      });
      document.querySelectorAll(".index-btn").forEach(function (btn) {
        btn.classList.toggle("is-active", btn.dataset.id === id);
      });

      // Klik cepat berturut-turut: hanya pilihan terakhir yang ditampilkan.
      const token = ++selectToken;
      const firstPhoto = item.photos && item.photos[0] ? item.photos[0].url : null;

      openSheet();

      preloadImage(firstPhoto).then(function () {
        if (token !== selectToken) return;

        if (panelEmpty) panelEmpty.hidden = true;
        panelContent.hidden = false;
        renderPanel(item);

        // Animasi ringan via CSS (opacity + transform).
        panelContent.classList.remove("is-entering");
        void panelContent.offsetWidth;
        panelContent.classList.add("is-entering");
      });

      highlightRelatedCard(id);
    }

    /* ---------- Titik denah & Daftar Lengkap ---------- */
    if (layer && layer.children.length === 0) {
      MAP_ORDER.forEach(function (id, i) {
        const item = FACILITIES[id];
        if (!item) return;

        const g = document.createElementNS(SVG_NS, "g");
        g.setAttribute("class", "hotspot" + (item.kind === "tefa" ? " is-tefa" : ""));
        g.setAttribute("data-id", id);
        g.setAttribute("data-kind", item.kind);
        g.setAttribute("tabindex", "0");
        g.setAttribute("role", "button");
        g.setAttribute("aria-label", item.full);

        const halo = document.createElementNS(SVG_NS, "circle");
        halo.setAttribute("class", "hs-halo");
        halo.setAttribute("cx", item.x);
        halo.setAttribute("cy", item.y);
        halo.setAttribute("r", 27);

        const dot = document.createElementNS(SVG_NS, "circle");
        dot.setAttribute("class", "hs-dot");
        dot.setAttribute("cx", item.x);
        dot.setAttribute("cy", item.y);
        dot.setAttribute("r", 13);

        const num = document.createElementNS(SVG_NS, "text");
        num.setAttribute("class", "hs-num");
        num.setAttribute("x", item.x);
        num.setAttribute("y", item.y);
        num.textContent = i + 1;

        g.append(halo, dot, num);
        layer.appendChild(g);

        g.addEventListener("click", function () {
          select(id);
        });
        g.addEventListener("keydown", function (e) {
          if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            select(id);
          }
        });
      });
    }

    if (indexGrid && indexGrid.children.length === 0) {
      MAP_ORDER.forEach(function (id, i) {
        const item = FACILITIES[id];
        if (!item) return;

        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "index-btn" + (item.kind === "tefa" ? " is-tefa" : "");
        btn.dataset.id = id;
        btn.dataset.kind = item.kind;
        btn.innerHTML =
          '<span class="index-badge">' + (i + 1) + "</span>" +
          '<span class="index-name">' + escapeHtml(item.name) + "</span>";
        // Di HP, detail langsung terbuka sebagai bottom sheet (tanpa gulir ke denah).
        btn.addEventListener("click", function () {
          select(id);
        });
        indexGrid.appendChild(btn);
      });
    }

    /* ---------- Filter jenis lokasi ---------- */
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
          const show = currentFilter === "all" || h.dataset.kind === currentFilter;
          h.classList.toggle("is-dimmed", !show);
          h.setAttribute("tabindex", show ? "0" : "-1");
        });
        document.querySelectorAll(".index-btn").forEach(function (b) {
          const show = currentFilter === "all" || b.dataset.kind === currentFilter;
          b.classList.toggle("is-hidden", !show);
        });
      });
    });

    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape") closeSheet();
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initMapAndDenah);
  } else {
    initMapAndDenah();
  }
})();
