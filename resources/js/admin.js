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

// Modal bersama (konfirmasi & notifikasi berhasil): <dialog> bawaan dengan animasi masuk & keluar yang sama.
function closeModal(dialog) {
    dialog.classList.remove('is-open');
}

function makeModal(className, html) {
    const dialog = document.createElement('dialog');
    dialog.className = `confirm-modal ${className}`;
    dialog.innerHTML = html;
    document.body.append(dialog);

    // Esc dan klik di luar kotak: tutup dengan animasi yang sama.
    dialog.addEventListener('cancel', (event) => {
        event.preventDefault();
        closeModal(dialog);
    });
    dialog.addEventListener('click', (event) => {
        if (event.target === dialog) closeModal(dialog);
    });
    // Dialog baru benar-benar ditutup setelah animasi keluar selesai.
    dialog.addEventListener('transitionend', (event) => {
        if (event.target === dialog && !dialog.classList.contains('is-open')) dialog.close();
    });

    return dialog;
}

function openModal(dialog, focus) {
    dialog.showModal();
    focus?.focus();
    // Frame berikutnya: kelas is-open memicu transisi masuk.
    requestAnimationFrame(() => requestAnimationFrame(() => dialog.classList.add('is-open')));
}

// Konfirmasi sebelum submit lewat modal: <form data-confirm="Pesan" data-confirm-title="Judul" data-confirm-ok="Ya, ...">
// Form DELETE otomatis memakai tombol merah "Ya, Hapus". Modal dibuat sekali saat pertama dipakai.
let confirmDialog;
let confirmForm;

document.querySelectorAll('form[data-confirm]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();

        if (!confirmDialog) {
            confirmDialog = makeModal('', `
                <div class="confirm-icon" aria-hidden="true">!</div>
                <h2 class="confirm-title"></h2>
                <p class="confirm-message"></p>
                <div class="confirm-actions">
                    <button type="button" class="btn btn-outline" data-cancel>Batal</button>
                    <button type="button" class="btn" data-ok></button>
                </div>`);
            confirmDialog.querySelector('[data-cancel]').addEventListener('click', () => closeModal(confirmDialog));
            confirmDialog.querySelector('[data-ok]').addEventListener('click', () => {
                closeModal(confirmDialog);
                HTMLFormElement.prototype.submit.call(confirmForm);
            });
        }

        const danger = form.querySelector('input[name="_method"]')?.value === 'DELETE';
        const ok = confirmDialog.querySelector('[data-ok]');

        confirmForm = form;
        confirmDialog.classList.toggle('is-danger', danger);
        confirmDialog.querySelector('.confirm-title').textContent = form.dataset.confirmTitle ?? (danger ? 'Hapus Data?' : 'Konfirmasi');
        confirmDialog.querySelector('.confirm-message').textContent = form.dataset.confirm;
        ok.textContent = form.dataset.confirmOk ?? (danger ? 'Ya, Hapus' : 'Ya, Lanjutkan');
        ok.className = `btn ${danger ? 'btn-danger' : 'btn-primary'}`;

        openModal(confirmDialog, ok);
    });
});

// Notifikasi berhasil dari session: <div id="flash-success" data-message="..." data-password="..." hidden>.
// Tertutup sendiri setelah 3 detik, kecuali berisi kata sandi baru (perlu disalin dulu).
const flash = document.getElementById('flash-success');

if (flash) {
    const password = flash.dataset.password;
    const dialog = makeModal('is-success', `
        <div class="confirm-icon" aria-hidden="true">&#10003;</div>
        <h2 class="confirm-title">Berhasil</h2>
        <p class="confirm-message"></p>
        ${password ? '<div class="flash-password"><code></code><button type="button" class="btn btn-outline btn-sm" data-copy>Salin</button></div>' : ''}
        <div class="confirm-actions">
            <button type="button" class="btn btn-success" data-ok>OK</button>
        </div>
        ${password ? '' : '<div class="flash-timer" aria-hidden="true"></div>'}`);
    const ok = dialog.querySelector('[data-ok]');

    dialog.querySelector('.confirm-message').textContent = flash.dataset.message;
    ok.addEventListener('click', () => closeModal(dialog));

    if (password) {
        dialog.querySelector('.flash-password code').textContent = password;
        dialog.querySelector('[data-copy]').addEventListener('click', async (event) => {
            const button = event.currentTarget;

            try {
                await navigator.clipboard.writeText(password);
                button.textContent = 'Tersalin';
            } catch {
                // Tanpa HTTPS clipboard tidak tersedia: blok teksnya agar bisa disalin manual.
                getSelection().selectAllChildren(dialog.querySelector('.flash-password code'));
            }
        });
    } else {
        setTimeout(() => closeModal(dialog), 3000);
    }

    openModal(dialog, ok);
}

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

// Grafik pengunjung (dashboard): di layar sempit, gulir langsung ke data terbaru (paling kanan).
function scrollVisitorPanels() {
    document.querySelectorAll('.visitor-panel').forEach((panel) => {
        panel.scrollLeft = panel.scrollWidth;
    });
}

document.querySelectorAll('input[name="visitor-range"]').forEach((radio) => {
    radio.addEventListener('change', scrollVisitorPanels);
});
scrollVisitorPanels();
