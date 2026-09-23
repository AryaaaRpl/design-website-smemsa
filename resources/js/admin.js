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
