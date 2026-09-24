/* ==========================================================================
   FASILITAS & TEFA - DENAH INTERAKTIF, PANEL DETAIL & MODAL
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

    /* ---------- Bottom sheet (HP) ---------- */
    function openSheet() {
      if (!sheetQuery.matches || !panel) return;
      panel.classList.add("is-open");
      if (panelBackdrop) panelBackdrop.hidden = false;
      document.body.style.overflow = "hidden";
    }

    function closeSheet() {
      if (!panel) return;
      panel.classList.remove("is-open");
      if (panelBackdrop) panelBackdrop.hidden = true;
      document.body.style.overflow = "";
    }

    if (panelClose) panelClose.addEventListener("click", closeSheet);
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

    // Animasi muncul titik denah (sekali, saat denah terlihat).
    if (typeof gsap !== "undefined" && typeof ScrollTrigger !== "undefined") {
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
     MODAL DETAIL (daftar TEFA & grid fasilitas unggulan)
     ========================================================================== */
  const MODAL_GRADIENTS = {
    tefa: "linear-gradient(135deg, #b45309 0%, #eab308 100%)",
    fasilitas: "linear-gradient(135deg, #1e40af 0%, #3b82f6 100%)",
  };

  window.openItemModal = function (id) {
    const data = FACILITIES[id];
    if (!data) return;

    const banner = document.getElementById("modal-banner");
    const icon = document.getElementById("modal-icon");
    const tag = document.getElementById("modal-tag");
    const title = document.getElementById("modal-title");
    const desc = document.getElementById("modal-desc");
    const featuresContainer = document.getElementById("modal-features");
    const highlight = document.getElementById("modal-highlight");

    if (banner) banner.style.background = MODAL_GRADIENTS[data.kind];
    if (icon) icon.innerText = data.icon;
    if (tag) tag.innerText = (data.kicker || "Fasilitas Unggulan").toUpperCase();
    if (title) title.innerText = data.full;
    if (desc) desc.innerText = data.desc;
    if (highlight) highlight.innerText = data.highlight || "-";

    if (featuresContainer) {
      featuresContainer.innerHTML = "";
      data.tools.forEach(function (feat) {
        const chip = document.createElement("span");
        chip.className = "modal-feature-chip";
        chip.innerText = feat;
        featuresContainer.appendChild(chip);
      });
    }

    const modalOverlay = document.getElementById("facility-modal-overlay");
    if (modalOverlay) {
      modalOverlay.classList.add("active");
      document.body.style.overflow = "hidden";
    }
  };

  window.closeItemModal = function () {
    const modalOverlay = document.getElementById("facility-modal-overlay");
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

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && window.closeItemModal) window.closeItemModal();
  });

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initMapAndDenah);
  } else {
    initMapAndDenah();
  }
})();
