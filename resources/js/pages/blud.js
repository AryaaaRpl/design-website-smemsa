/**
 * Filter katalog BLUD per unit usaha tanpa memuat ulang halaman.
 * Semua kartu sudah ada di halaman; filter hanya menyembunyikan/menampilkan kartu.
 * URL ikut diperbarui (?unit=...) agar tautan tetap bisa dibagikan.
 */
const filterNav = document.querySelector('.bl-filter');
const catalog = document.getElementById('bl-catalog');

if (filterNav && catalog) {
    const items = catalog.querySelectorAll('.bl-item');
    const emptyState = document.getElementById('bl-catalog-empty');
    const title = document.getElementById('bl-catalog-title');

    filterNav.addEventListener('click', (event) => {
        const link = event.target.closest('a[data-unit]');

        // Biarkan Ctrl/Cmd+klik membuka tab baru seperti biasa.
        if (!link || event.ctrlKey || event.metaKey || event.shiftKey) {
            return;
        }

        event.preventDefault();

        const unit = link.dataset.unit;
        let visibleCount = 0;

        items.forEach((item) => {
            const visible = unit === '' || item.dataset.unit === unit;
            item.hidden = !visible;
            if (visible) visibleCount++;
        });

        filterNav.querySelectorAll('a[data-unit]').forEach((a) => a.classList.toggle('active', a === link));
        title.textContent = link.dataset.title;
        emptyState.hidden = visibleCount > 0;

        const url = new URL(window.location.href);
        unit === '' ? url.searchParams.delete('unit') : url.searchParams.set('unit', unit);
        url.hash = 'katalog';
        history.replaceState(null, '', url);
    });
}
