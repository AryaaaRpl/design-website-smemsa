/* ==========================================================================
   ANIMASI MUNCUL (satu untuk semua halaman publik)
   Elemen ber-atribut data-reveal naik halus + memudar masuk saat terlihat, sekali saja.
   Gaya ada di app.css (.js [data-reveal]). Kartu yang masuk layar bersamaan muncul berurutan.
   ========================================================================== */
const revealObserver = 'IntersectionObserver' in window
  ? new IntersectionObserver((entries) => {
      let order = 0;
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.style.transitionDelay = `${Math.min(order++, 5) * 80}ms`;
        entry.target.classList.add('is-visible');
        revealObserver.unobserve(entry.target);
        // Selesai: lepas penanda agar transisi hover milik elemen itu sendiri kembali berlaku.
        const el = entry.target;
        el.addEventListener('transitionend', function done(event) {
          if (event.target !== el) return; // abaikan transisi milik elemen di dalamnya
          el.removeEventListener('transitionend', done);
          el.removeAttribute('data-reveal');
          el.style.transitionDelay = '';
        });
      });
    }, { rootMargin: '0px 0px -8% 0px' })
  : null;

// Pantau elemen di dalam root; dipanggil ulang untuk isi yang dimuat lewat JS (contoh: katalog prestasi).
window.revealIn = (root = document) => {
  root.querySelectorAll('[data-reveal]:not(.is-visible)').forEach((el) => {
    // Sudah di dalam elemen beranimasi: ikut induknya saja (tidak dobel).
    if (el.parentElement?.closest('[data-reveal]')) return el.removeAttribute('data-reveal');
    revealObserver ? revealObserver.observe(el) : el.classList.add('is-visible');
  });
};

window.revealIn();
