/* ==========================================================================
   BERANDA - SLIDER VERTIKAL TESTIMONI ALUMNI
   Otomatis / panah bawah: slide lama naik, slide berikutnya masuk dari bawah.
   Panah atas: kebalikannya (slide sebelumnya masuk dari atas).
   Berhenti saat kursor/fokus di kartu & saat kartu tidak terlihat di layar.
   ========================================================================== */

(function () {
  const slider = document.getElementById("testi-slider");
  if (!slider) return;

  const slides = Array.from(slider.querySelectorAll(".testi-slide"));
  const card = slider.closest(".testi-card");
  const prevBtn = card ? card.querySelector("[data-testi-prev]") : null;
  const nextBtn = card ? card.querySelector("[data-testi-next]") : null;
  const counter = card ? card.querySelector(".testi-counter-current") : null;
  const interval = Number(slider.dataset.interval) || 5000;
  const DURATION = 800; // sama dengan durasi transisi di CSS

  // Hanya 1 testimoni: tampil diam tanpa animasi.
  if (slides.length < 2) return;

  let current = 0;
  let timer = null;
  let isHovered = false;
  let isVisible = false;
  let isAnimating = false; // selama slide berpindah, klik/otomatis diabaikan

  // direction: 1 = berikutnya (masuk dari bawah), -1 = sebelumnya (masuk dari atas)
  function show(next, direction) {
    if (next === current || isAnimating) return;
    isAnimating = true;

    const leaving = slides[current];
    const entering = slides[next];
    const backward = direction < 0;

    // Mundur: taruh slide baru di atas dulu tanpa animasi, baru dianimasikan masuk.
    if (backward) {
      entering.classList.add("no-transition", "from-top");
      void entering.offsetWidth;
      entering.classList.remove("no-transition");
    }

    leaving.classList.remove("is-active");
    leaving.classList.add(backward ? "is-leaving-down" : "is-leaving");
    leaving.setAttribute("aria-hidden", "true");

    entering.classList.add("is-active");
    entering.removeAttribute("aria-hidden");

    // Setelah transisi selesai, kembalikan slide lama ke posisi awal (bawah) tanpa animasi.
    setTimeout(function () {
      leaving.classList.add("no-transition");
      leaving.classList.remove("is-leaving", "is-leaving-down");
      void leaving.offsetWidth;
      leaving.classList.remove("no-transition");
      entering.classList.remove("from-top");
      isAnimating = false;
    }, DURATION);

    if (counter) counter.textContent = String(next + 1).padStart(2, "0");

    current = next;
  }

  function step(direction) {
    show((current + direction + slides.length) % slides.length, direction);
  }

  function start() {
    stop();
    if (isHovered || !isVisible || document.hidden) return;
    timer = setInterval(function () {
      step(1);
    }, interval);
  }

  function stop() {
    clearInterval(timer);
    timer = null;
  }

  // Panah atas/bawah, lalu hitung ulang jeda otomatisnya.
  if (prevBtn) {
    prevBtn.addEventListener("click", function () {
      step(-1);
      start();
    });
  }
  if (nextBtn) {
    nextBtn.addEventListener("click", function () {
      step(1);
      start();
    });
  }

  // Berhenti saat kursor atau fokus keyboard ada di kartu (agar bisa selesai membaca).
  if (card) {
    card.addEventListener("mouseenter", function () {
      isHovered = true;
      stop();
    });
    card.addEventListener("mouseleave", function () {
      isHovered = false;
      start();
    });
    card.addEventListener("focusin", function () {
      isHovered = true;
      stop();
    });
    card.addEventListener("focusout", function () {
      isHovered = false;
      start();
    });
  }

  // Mulai hanya saat kartu terlihat di layar.
  new IntersectionObserver(
    function (entries) {
      isVisible = entries[0].isIntersecting;
      isVisible ? start() : stop();
    },
    { threshold: 0.3 },
  ).observe(slider);

  document.addEventListener("visibilitychange", function () {
    document.hidden ? stop() : start();
  });
})();
