# Product Requirements Document (PRD)
## Transformasi Desain HTML ke Framework Laravel (Blade Templating)

**Project Name:** Website SMKS Muhammadiyah 1 Genteng (SMEMSA)
**Document Version:** 1.0
**Status:** Approved for Execution

### 1. Tujuan Proyek
Mentransformasikan desain website statis (HTML/CSS/JS) milik SMKS Muhammadiyah 1 Genteng menjadi arsitektur berbasis framework Laravel menggunakan sistem templating Blade. Tujuannya adalah untuk meningkatkan *maintainability* (kemudahan perawatan), merapikan struktur kode (Clean Code), dan mempersiapkan antarmuka ini agar siap dihubungkan dengan *backend* (fungsionalitas dinamis) di masa depan.

### 2. Lingkup Pekerjaan (Scope)
Pekerjaan ini difokuskan pada ranah *Front-end* di dalam ekosistem Laravel:
1.  **Ekstraksi Layout Utama:** Membuat Master Layout (`app.blade.php`) yang membungkus struktur dasar HTML, `<head>`, import aset, Navbar, dan Footer.
2.  **Pembuatan Partials:** Memisahkan komponen statis yang selalu berulang (seperti Header/Navbar dan Footer) menjadi file *partial* independen.
3.  **Konversi Halaman:** Mengubah 11 file `.html` statis menjadi file `.blade.php` yang terintegrasi (extend) dengan Master Layout.
4.  **Optimasi Clean Code (Blade Components):** Menggunakan fitur Blade Components (opsional namun diprioritaskan) untuk elemen UI yang berulang (misal: Card Berita, Card Guru, Button) agar kode HTML tidak menumpuk.
5.  **Pengaturan Routing Dasar:** Membuat routing pada `routes/web.php` untuk menampilkan halaman-halaman Blade yang sudah dikonversi secara fungsional.

### 3. Halaman yang Dikonversi
Berikut adalah daftar halaman yang masuk dalam lingkup transformasi, diurutkan berdasarkan kompleksitas:
*   **Fundamental:** Navbar, Footer, Meta Tags (Layout & Partials)
*   **Statis Sederhana:** 
    *   `peta-kampus.html`
    *   `visi-misi.html`
    *   `lsp.html`
    *   `bkk.html`
    *   `spmb.html`
*   **Menengah (Berisi List / Grid):**
    *   `ekstrakurikuler.html`
    *   `prestasi.html`
    *   `berita.html`
    *   `guru.html`
*   **Kompleks:**
    *   `fasilitas.html`
    *   `index.html` (Halaman Utama)

### 4. Non-Functional Requirements (NFR)
*   **Clean Code:** Kode Blade harus bersih, terstruktur, menggunakan indentasi yang konsisten, dan menghindari duplikasi kode (DRY - *Don't Repeat Yourself*).
*   **Fungsionalitas Visual:** Hasil transformasi (Blade) **harus 100% identik secara visual** dengan desain HTML aslinya. Tidak boleh ada CSS atau animasi JS yang rusak atau tidak berjalan (misal: Lenis scroll, swiper, parallax).
*   **Modularitas:** Penggunaan `@yield`, `@section`, `@include`, dan `<x-component>` harus dimaksimalkan untuk memisahkan *logic* tampilan.
*   **Asset Pathing:** Semua *resource* statis (CSS, JS, Images dalam folder `assets/`) harus direferensikan menggunakan *helper function* `asset()` bawaan Laravel.

### 5. Asumsi & Ketergantungan
*   Struktur direktori HTML saat ini diasumsikan sudah lengkap (termasuk folder `assets/`).
*   Project Laravel diasumsikan sudah diinisiasi sebelumnya atau akan diinisiasi pada langkah pertama eksekusi (Jika belum ada project Laravel, maka harus di-`create` terlebih dahulu). *Catatan: Saat ini file berada di direktori biasa, perlu dipindahkan atau di-generate environment Laravel-nya.*
*   Tidak ada pembuatan database atau logika CRUD backend pada fase ini. Fokus penuh pada *templating* dan *routing* dasar.

### 6. Rencana Implementasi Tahap Selanjutnya
Setelah PRD ini disetujui dan dieksekusi, struktur kode siap untuk:
*   Pembuatan Database Seeder & Migration.
*   Pembuatan Controller untuk mengirimkan data dinamis dari database ke View (menggantikan teks *dummy*).
*   Integrasi CMS / Admin Panel.
