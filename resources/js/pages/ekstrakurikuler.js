/* ==========================================================================
   EKSTRAKURIKULER - DATA, MODAL & SCROLL ANIMATIONS
   ========================================================================== */

(function () {
  // Data ekstrakurikuler dari database (dikirim oleh ExtracurricularController)
  const EKSKUL_DATA = window.ekskulData || {};

  // Escape teks sebelum dimasukkan ke HTML (data berasal dari input admin).
  function escapeHtml(value) {
    return String(value ?? "")
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  window.openEkskulModal = function (id) {
    const data = EKSKUL_DATA[id];
    if (!data) return;

    const modalHero = document.getElementById("modal-hero");
    const modalBadge = document.getElementById("modal-badge");
    const modalTitle = document.getElementById("modal-title");
    const modalDesc = document.getElementById("modal-desc");
    const infoGrid = document.getElementById("modal-info-grid");
    const achvDiv = document.getElementById("modal-achievements");
    const achvList = document.getElementById("modal-achievements-list");
    const modal = document.getElementById("ekskul-modal");

    if (modalHero) modalHero.src = data.img;
    if (modalBadge) modalBadge.textContent = data.badge;
    if (modalTitle) modalTitle.textContent = data.title;
    if (modalDesc) modalDesc.innerHTML = data.desc;

    if (infoGrid) {
      infoGrid.innerHTML = "";
      const addInfo = (label, value) => {
        if (!value) return;
        const div = document.createElement("div");
        div.className = "info-grid-item";
        div.innerHTML = `<span class="info-grid-label">${label}</span><span class="info-grid-value">${escapeHtml(value)}</span>`;
        infoGrid.appendChild(div);
      };

      addInfo("Jadwal Latihan", data.jadwal);
      addInfo("Pembina", data.pembina);
      addInfo("Tempat Latihan", data.tempat);
      addInfo("Terbuka Untuk", data.kelas);
    }

    if (achvDiv && achvList) {
      if (data.prestasi && data.prestasi.length > 0) {
        achvDiv.style.display = "block";
        achvList.innerHTML = data.prestasi.map((p) => `<li>${escapeHtml(p)}</li>`).join("");
      } else {
        achvDiv.style.display = "none";
        achvList.innerHTML = "";
      }
    }

    document.body.style.overflow = "hidden";
    if (window.lenis) window.lenis.stop();
    if (modal) modal.classList.add("active");
  };

  window.closeEkskulModal = function () {
    const modal = document.getElementById("ekskul-modal");
    if (modal) modal.classList.remove("active");
    document.body.style.overflow = "";
    if (window.lenis) window.lenis.start();
  };

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      const modal = document.getElementById("ekskul-modal");
      if (modal && modal.classList.contains("active")) {
        window.closeEkskulModal();
      }
    }
  });

  function initEkskulAnimations() {
    if (typeof gsap !== "undefined") {
      // 1. Header Reveal
      gsap.to(".page-header .reveal-item", {
        y: 0,
        opacity: 1,
        duration: 1,
        ease: "power3.out",
      });

      if (typeof ScrollTrigger !== "undefined") {
        // 2. Card Reveal & Image Animation Batch
        ScrollTrigger.batch(".ekskul-card", {
          start: "top 85%",
          once: true,
          onEnter: (batch) => {
            gsap.to(batch, {
              opacity: 1,
              y: 0,
              duration: 0.8,
              stagger: 0.15,
              ease: "power2.out",
            });

            batch.forEach((card, index) => {
              let bg = card.querySelector(".card-bg");
              if (bg) {
                gsap.fromTo(
                  bg,
                  { scale: 1.3 },
                  {
                    scale: 1,
                    duration: 1.5,
                    delay: index * 0.15,
                    ease: "power2.out",
                    clearProps: "transform",
                  },
                );
              }
            });
          },
        });

        // 3. Parallax Image Scrubbing
        gsap.utils.toArray(".ekskul-card").forEach((card) => {
          let bg = card.querySelector(".card-bg");
          if (bg) {
            gsap.to(bg, {
              backgroundPosition: "50% 100%",
              ease: "none",
              scrollTrigger: {
                trigger: card,
                start: "top bottom",
                end: "bottom top",
                scrub: true,
              },
            });
          }
        });
      }
    }

    // Standard reveal fallback
    const revealItems = document.querySelectorAll(".reveal-item");
    function reveal() {
      const windowHeight = window.innerHeight;
      const elementVisible = 100;
      revealItems.forEach((item) => {
        const elementTop = item.getBoundingClientRect().top;
        if (elementTop < windowHeight - elementVisible) {
          item.classList.add("active");
        }
      });
    }
    window.addEventListener("scroll", reveal);
    reveal();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initEkskulAnimations);
  } else {
    initEkskulAnimations();
  }
})();
