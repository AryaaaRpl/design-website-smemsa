/* ==========================================================================
   PRESTASI & PENGHARGAAN - CATALOG, FILTERS & MODAL LOGIC
   ========================================================================== */

(function () {
  // ==========================================
  // 1. DATA PRESTASI DARI DATABASE (dikirim oleh AchievementController)
  // ==========================================
  const awardsList = window.awardsData || [];

  // Escape teks sebelum dimasukkan ke HTML (data berasal dari input admin).
  function escapeHtml(value) {
    return String(value ?? "")
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

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
        const hasImage = Boolean(item.imageUrl);
        const headerClass = hasImage
          ? "award-card-header has-image"
          : "award-card-header";
        const headerStyle = hasImage
          ? ` style="background-image: url('${escapeHtml(item.imageUrl)}');"`
          : "";

        return `
          <article class="award-card" onclick="openAwardModal('${escapeHtml(item.id)}')" role="button" tabindex="0" aria-label="Detail prestasi: ${escapeHtml(item.title)}">
            <div class="${headerClass}"${headerStyle}>
              <div class="award-card-tags-row">
                <span class="${badgeClass}">${escapeHtml(item.badge)}</span>
                <span class="award-year-tag">${escapeHtml(item.year)}</span>
              </div>
              <div class="award-headline-typo">${escapeHtml(item.categoryLabel)}</div>
            </div>
            <div class="award-card-body">
              <div>
                <div class="award-sub-meta">
                  <span>${escapeHtml(item.dateStr)}</span>
                  <span>&bull;</span>
                  <span>${escapeHtml(item.location)}</span>
                </div>
                <h3 class="award-card-title">${escapeHtml(item.title)}</h3>
                <p class="award-card-desc">${escapeHtml(item.excerpt)}</p>
              </div>
              <div class="award-card-footer">
                <span class="award-organizer" title="${escapeHtml(item.org)}">${escapeHtml(item.org)}</span>
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
              <div class="timeline-item-card" onclick="openAwardModal('${escapeHtml(item.id)}')" role="button" tabindex="0" aria-label="${escapeHtml(item.title)}">
                <div class="timeline-card-content">
                  <div style="display:flex; align-items:center; gap:0.6rem; margin-bottom:0.3rem;">
                    <span class="${badgeClass}" style="font-size:0.72rem;">${escapeHtml(item.badge)}</span>
                    <span style="font-size:0.8rem; color:var(--text-subtle);">${escapeHtml(item.dateStr)} &bull; ${escapeHtml(item.location)}</span>
                  </div>
                  <h3>${escapeHtml(item.title)}</h3>
                  <p style="font-size:0.9rem; color:var(--text-muted); line-height:1.6; margin-bottom:0.4rem;">${escapeHtml(item.excerpt)}</p>
                  <span style="font-size:0.8rem; color:var(--text-subtle);">${escapeHtml(item.org)}</span>
                </div>
                <span class="award-view-link" style="white-space:nowrap;">Lihat &rarr;</span>
              </div>
            `;
          })
          .join("");

        return `
          <div class="timeline-year-block">
            <div class="timeline-year-marker">${escapeHtml(yr)}</div>
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
