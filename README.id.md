# Website Resmi SMKS Muhammadiyah 1 Genteng

[English Version](README.md)

Platform web terintegrasi untuk SMKS Muhammadiyah 1 Genteng (SMEMSA) yang berfungsi sebagai profil digital resmi sekolah, pusat informasi publik, sistem pendaftaran siswa baru online (SPMB), katalog layanan unit usaha (BLUD), dan bursa kerja khusus (BKK).

---

## Masalah yang Diselesaikan

- **Informasi yang Tercecer**: Menggantikan informasi sekolah yang tersebar tidak resmi dengan sumber terpusat dan terverifikasi untuk profil sekolah, konsentrasi keahlian, prestasi, ekstrakurikuler, direktori guru, dan fasilitas.
- **Pendaftaran Siswa Masih Manual**: Mengatasi kendala administrasi berkas fisik melalui alur pendaftaran mandiri calon siswa berbasis web dengan pengisian formulir bertahap, unggah berkas, dan pemantauan status seleksi.
- **Keterbatasan Promosi Unit Produksi Sekolah**: Menyediakan etalase digital untuk produk Teaching Factory dan jasa BLUD sekolah yang terhubung langsung ke WhatsApp pemesanan.
- **Penyaluran Kerja Alumni**: Menjembatani lulusan dengan industri mitra secara langsung melalui papan informasi lowongan kerja BKK.

---

## Peran Pengguna dan Cara Penggunaan

### 1. Masyarakat Umum dan Calon Siswa Baru
- **Melihat Program Keahlian**: Buka menu `/jurusan` untuk melihat detail konsentrasi keahlian vokasi, kurikulum industri, dan prospek kerja.
- **Pendaftaran Siswa Baru (SPMB Online)**:
  - Buka halaman `/spmb` untuk membaca alur pendaftaran, rincian biaya, dan skema beasiswa.
  - Buat akun calon siswa melalui `/rpl-smemsa-2026/pendaftar/daftar`.
  - Masuk ke portal melalui `/rpl-smemsa-2026/pendaftar/masuk` untuk melengkapi data diri, mengunggah berkas persyaratan, mengirim formulir, dan memantau status kelulusan.
- **Tanya Jawab Cepat**: Gunakan tombol widget asisten chat di pojok layar untuk mendapatkan jawaban otomatis seputar sekolah dengan pengalihan ke WhatsApp narahubung.
- **Unit Usaha & Lowongan Kerja**: Lihat katalog produk di `/blud` dan info loker di `/bkk`.

### 2. Administrator dan Panitia Sekolah
- **Masuk Panel Admin**: Akses portal login khusus administrator (`/rpl-smemsa-space/admin/login/...`).
- **Pengelolaan Data**:
  - Memverifikasi berkas pendaftar, mencetak/mengekspor data, dan mengelola status pendaftaran.
  - Menambah dan memperbarui berita, prestasi, lowongan BKK, unit usaha, direktori guru, serta konsentrasi keahlian.
  - Mengatur konfigurasi instansi (nomor kontak panitia, informasi akreditasi, statistik sekolah, dan rincian pembiayaan) melalui modul pengaturan.

---

## Teknologi yang Digunakan

- **Backend**: Laravel 13, PHP 8.5
- **Frontend**: Blade Templates, Tailwind CSS / Vanilla CSS, Modern JavaScript
- **Database**: SQLite / MySQL
- **Optimasi Aset**: Format gambar WebP dan font lokal self-hosted

---

## Panduan Instalasi Lokal

1. **Pasang Dependensi**:
   ```bash
   composer install
   npm install
   ```

2. **Pengaturan Lingkungan (.env)**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Migrasi dan Pengisian Data Awal**:
   ```bash
   php artisan migrate --seed
   ```

4. **Kompilasi Aset dan Jalankan Server**:
   ```bash
   npm run build
   php artisan serve
   ```

5. **Menjalankan Pengujian Otomatis**:
   ```bash
   php artisan test
   ```
