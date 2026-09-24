// Buka/tutup sidebar di layar kecil
const sidebar = document.getElementById('admin-sidebar');
const backdrop = document.getElementById('sidebar-backdrop');
const toggle = document.getElementById('sidebar-toggle');

function toggleSidebar() {
    sidebar.classList.toggle('open');
    backdrop.classList.toggle('open');
}

if (sidebar && toggle) {
    toggle.addEventListener('click', toggleSidebar);
    backdrop.addEventListener('click', toggleSidebar);
}

// Tampilkan/sembunyikan elemen sesuai checkbox: <input type="checkbox" data-toggle-target="id-elemen">
document.querySelectorAll('input[type="checkbox"][data-toggle-target]').forEach((checkbox) => {
    const target = document.getElementById(checkbox.dataset.toggleTarget);

    checkbox.addEventListener('change', () => {
        if (target) target.hidden = !checkbox.checked;
    });
});

// Konfirmasi sebelum submit: <form data-confirm="Pesan konfirmasi">
document.querySelectorAll('form[data-confirm]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        if (!confirm(form.dataset.confirm)) {
            event.preventDefault();
        }
    });
});

// Pemilih titik denah (form fasilitas): klik denah untuk mengisi X/Y.
document.querySelectorAll('[data-map-picker]').forEach((picker) => {
    const svg = picker.querySelector('svg');
    const marker = picker.querySelector('[data-map-marker]');
    const form = picker.closest('form');
    const inputX = form.querySelector('[data-map-x]');
    const inputY = form.querySelector('[data-map-y]');
    const clearBtn = form.querySelector('[data-map-clear]');

    function showMarker(x, y) {
        marker.setAttribute('cx', x);
        marker.setAttribute('cy', y);
        marker.style.display = '';
    }

    svg.addEventListener('click', (event) => {
        // Ubah posisi klik di layar menjadi koordinat denah (viewBox 1000 x 800).
        const point = svg.createSVGPoint();
        point.x = event.clientX;
        point.y = event.clientY;
        const { x, y } = point.matrixTransform(svg.getScreenCTM().inverse());

        inputX.value = Math.round(Math.min(Math.max(x, 0), 1000));
        inputY.value = Math.round(Math.min(Math.max(y, 0), 800));
        showMarker(inputX.value, inputY.value);
    });

    // Angka X/Y diketik manual: titik ikut berpindah.
    [inputX, inputY].forEach((input) => {
        input.addEventListener('input', () => {
            if (inputX.value !== '' && inputY.value !== '') {
                showMarker(inputX.value, inputY.value);
            }
        });
    });

    clearBtn?.addEventListener('click', () => {
        inputX.value = '';
        inputY.value = '';
        marker.style.display = 'none';
    });
});
