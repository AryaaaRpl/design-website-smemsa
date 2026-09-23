/* ==========================================================================
   BERITA - FILTER KATEGORI & MODAL DETAIL
   Data berita dikirim dari database lewat window.newsDatabase.
   ========================================================================== */

(function () {
  const overlay = document.getElementById('news-modal-overlay');

  window.openNewsModal = function (newsKey) {
    const data = (window.newsDatabase || {})[newsKey];
    if (!data || !overlay) return;

    const img = document.getElementById('modal-news-img');
    if (img) {
      img.src = data.img || '';
      img.alt = data.title;
    }

    document.getElementById('modal-news-category').innerText = data.category;
    document.getElementById('modal-news-date').innerText = data.date;
    document.getElementById('modal-news-title').innerText = data.title;
    // Body sudah di-escape di server (Post::bodyHtml), aman dipasang sebagai HTML.
    document.getElementById('modal-news-body').innerHTML = data.body;

    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  };

  window.closeNewsModal = function () {
    if (!overlay) return;
    overlay.classList.remove('active');
    document.body.style.overflow = '';
  };

  window.closeNewsModalOnOverlay = function (event) {
    if (event.target.id === 'news-modal-overlay') {
      window.closeNewsModal();
    }
  };

  window.filterCategory = function (category, button) {
    document.querySelectorAll('.filter-btn').forEach((btn) => btn.classList.remove('active'));
    if (button) button.classList.add('active');

    document.querySelectorAll('.news-card').forEach((card) => {
      const match = category === 'all' || card.getAttribute('data-category') === category;
      card.style.display = match ? 'flex' : 'none';
    });
  };

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') window.closeNewsModal();
  });
})();
