/* ==========================================================================
   BERANDA - SLIDER VERTIKAL TESTIMONI ALUMNI
   Slide lama bergeser turun, slide berikutnya masuk dari atas.
   Berhenti saat kursor/fokus di kartu & saat kartu tidak terlihat di layar.
   ========================================================================== */

(function () {
  const slider = document.getElementById("testi-slider");
  if (!slider) return;

  const slides = Array.from(slider.querySelectorAll(".testi-slide"));
  const card = slider.closest(".testi-card");
  const dots = card ? Array.from(card.querySelectorAll(".testi-dot")) : [];
  const interval = Number(slider.dataset.interval) || 5000;
  const DURATION = 800; // sama dengan durasi transisi di CSS

  // Hanya 1 testimoni: tampil diam tanpa animasi.
  if (slides.length < 2) return;

  let current = 0;
  let timer = null;
  let isHovered = false;
  let isVisible = false;

  function show(next) {
    if (next === current) return;

    const leaving = slides[current];
    const entering = slides[next];

    // Slide lama turun ke bawah.
    leaving.classList.remove("is-active");
    leaving.classList.add("is-leaving");
    leaving.setAttribute("aria-hidden", "true");

    // Slide baru masuk dari atas.
    entering.classList.add("is-active");
    entering.removeAttribute("aria-hidden");

    // Setelah transisi selesai, slide lama dikembalikan ke atas tanpa animasi.
    setTimeout(function () {
      leaving.classList.add("no-transition");
      leaving.classList.remove("is-leaving");
      void leaving.offsetWidth;
      leaving.classList.remove("no-transition");
    }, DURATION);

    dots.forEach(function (dot, i) {
      dot.classList.toggle("is-active", i === next);
    });

    current = next;
  }

  function start() {
    stop();
    if (isHovered || !isVisible || document.hidden) return;
    timer = setInterval(function () {
      show((current + 1) % slides.length);
    }, interval);
  }

  function stop() {
    clearInterval(timer);
    timer = null;
  }

  // Klik indikator: lompat ke testimoni tertentu, lalu hitung ulang jedanya.
  dots.forEach(function (dot) {
    dot.addEventListener("click", function () {
      show(Number(dot.dataset.index));
      start();
    });
  });

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
