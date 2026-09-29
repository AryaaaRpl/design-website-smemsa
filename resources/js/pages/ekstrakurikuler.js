/* ==========================================================================
   EKSTRAKURIKULER - ANIMASI KARTU (detail program di /ekstrakurikuler/{slug})
   ========================================================================== */

(function () {
  function initEkskulAnimations() {
    if (typeof gsap !== "undefined") {
      // 1. Header Reveal (halaman detail ekstrakurikuler tidak punya elemen ini)
      const headerReveal = document.querySelectorAll(".page-header .reveal-item");
      if (headerReveal.length) {
        gsap.to(headerReveal, {
          y: 0,
          opacity: 1,
          duration: 1,
          ease: "power3.out",
        });
      }

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
