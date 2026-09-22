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

// Konfirmasi sebelum submit: <form data-confirm="Pesan konfirmasi">
document.querySelectorAll('form[data-confirm]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        if (!confirm(form.dataset.confirm)) {
            event.preventDefault();
        }
    });
});
