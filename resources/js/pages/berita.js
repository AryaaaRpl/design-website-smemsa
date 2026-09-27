/* ==========================================================================
   BERITA - PENCARIAN & FILTER KATEGORI
   Semua kartu sudah ada di halaman, jadi pencarian dan filter berjalan
   langsung di browser tanpa memuat ulang. Teks pencarian tiap kartu sudah
   disiapkan server di atribut data-search (huruf kecil) agar pencocokan cepat.
   Detail berita dibuka di halaman sendiri (/berita/{slug}).
   ========================================================================== */

(function () {
  const grid = document.getElementById('news-grid');
  const input = document.getElementById('news-search-input');
  const filter = document.getElementById('news-filter');
  if (!grid || !input || !filter) return;

  const noResult = document.getElementById('news-no-result');
  const cards = Array.from(grid.querySelectorAll('.news-card')).map((el) => ({
    el,
    category: el.dataset.category,
    text: el.dataset.search,
  }));

  let activeCategory = 'all';
  let frame = 0;

  function apply() {
    frame = 0;
    const query = input.value.trim().toLowerCase();
    let visible = 0;

    for (const card of cards) {
      const match = (activeCategory === 'all' || card.category === activeCategory)
        && (query === '' || card.text.includes(query));
      // Hanya ubah DOM jika status tampil berubah.
      if (card.el.hidden === match) card.el.hidden = !match;
      if (match) visible++;
    }

    noResult.hidden = visible > 0;
    scrollToResults();
  }

  // Jika bilah sticky sedang menempel (daftar sudah tergulir), kembalikan ke awal hasil.
  const bar = document.querySelector('.news-sticky-bar');
  function scrollToResults() {
    const barBottom = bar.getBoundingClientRect().bottom;
    const gridTop = grid.getBoundingClientRect().top;
    if (gridTop >= barBottom) return;

    const offset = -(barBottom + 16);
    if (window.lenis) window.lenis.scrollTo(grid, { offset, immediate: true });
    else window.scrollTo({ top: window.scrollY + gridTop + offset });
  }

  // Satu kali proses per frame layar, walau pengguna mengetik cepat.
  input.addEventListener('input', () => {
    if (!frame) frame = requestAnimationFrame(apply);
  });

  filter.addEventListener('click', (event) => {
    const button = event.target.closest('.filter-btn');
    if (!button) return;

    filter.querySelector('.filter-btn.active')?.classList.remove('active');
    button.classList.add('active');
    activeCategory = button.dataset.category;
    apply();
  });
})();
