/* ==========================================================================
   EKSTRAKURIKULER - ANIMASI KARTU
   Tanpa GSAP: IntersectionObserver + transisi CSS (lihat .reveal-item di
   ekstrakurikuler.css). Lebih ringan di HP dan tidak menunggu library animasi.
   ========================================================================== */

(function () {
  const items = document.querySelectorAll(".reveal-item");
  if (!items.length) return;

  if (!("IntersectionObserver" in window)) {
    items.forEach((item) => item.classList.add("is-visible"));
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("is-visible");
        observer.unobserve(entry.target);
      });
    },
    { rootMargin: "0px 0px -10% 0px" },
  );

  items.forEach((item) => observer.observe(item));
})();
