<?php

namespace Database\Seeders;

use App\Enums\EmploymentType;
use App\Enums\VacancyStatus;
use App\Models\Applicant;
use App\Models\Faq;
use App\Models\JobVacancy;
use App\Models\Major;
use App\Models\Partner;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

/**
 * Data contoh (dummy) tambahan untuk data yang masih sedikit.
 * Hanya MENAMBAH baris baru (dicocokkan lewat nama/pertanyaan/slug/email), data lama tidak disentuh.
 * Berita & prestasi sengaja tidak ditambah. Jalankan setelah seeder utama (butuh data jurusan).
 */
class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->testimonials();
        $this->faqs();
        $this->vacancies();
        $this->applicant();
    }

    /**
     * Testimoni alumni: setiap jurusan minimal 3 testimoni.
     */
    private function testimonials(): void
    {
        $majorIds = Major::pluck('id', 'slug');

        $testimonials = [
            ['rpl', 'Fajar Setiawan', 2023, 'Mobile App Developer', 'CV Kode Kreatif Banyuwangi', 'Proyek aplikasi di kelas XII jadi portofolio pertama saya. Klien pertama saya justru datang dari hasil pameran karya siswa PPLG.'],
            ['rpl', 'Salsabila Rahmawati', 2024, 'QA Engineer', 'PT Solusi Teknologi Jawa', 'Kebiasaan menguji program sebelum dikumpulkan yang diajarkan guru PPLG ternyata jadi pekerjaan utama saya sekarang.'],
            ['tkj', 'Dimas Arya Saputra', 2023, 'Network Engineer', 'PT Lintas Data Nusantara', 'Praktik konfigurasi router dan server di lab TJKT membuat saya tidak canggung saat pertama kali menangani jaringan kantor klien.'],
            ['tkj', 'Wahyu Hidayat', 2025, 'Teknisi IT Support', 'RSUD Genteng', 'Sertifikasi kompetensi dari LSP sekolah sangat membantu. HRD langsung percaya kemampuan saya merawat komputer dan jaringan.'],
            ['dkv', 'Aulia Nur Fadilah', 2024, 'Graphic Designer', 'Studio Rupa Kreatif', 'Tugas branding UMKM lokal di DKV melatih saya berkomunikasi dengan klien sungguhan, bukan sekadar mendesain untuk nilai.'],
            ['dkv', 'Bagas Pratama', 2023, 'Video Editor', 'Banyuwangi TV', 'Peralatan kamera dan editing di sekolah membuat saya terbiasa dengan alur produksi video sebelum masuk dunia kerja.'],
            ['dkv', 'Citra Ayu Lestari', 2025, 'Ilustrator Lepas', 'Freelance', 'Guru DKV mendorong saya mengunggah karya secara rutin. Dari situ pesanan ilustrasi mulai berdatangan sejak kelas XI.'],
            ['bd', 'Rina Oktaviani', 2024, 'Admin Marketplace', 'Toko Batik Gandrung Online', 'Praktik mengelola toko daring di kelas Bisnis Digital membuat saya paham cara menaikkan penjualan lewat foto dan deskripsi produk.'],
            ['bd', 'Yoga Firmansyah', 2023, 'Pemilik Usaha', 'Kopi Kebun Genteng', 'Rencana bisnis yang saya susun saat tugas kewirausahaan kini sudah jadi kedai kopi dengan tiga karyawan.'],
            ['bd', 'Melati Kusuma Wardani', 2025, 'Social Media Specialist', 'PT Promosi Digital Indonesia', 'Belajar membuat konten dan membaca data iklan di BD langsung terpakai di hari pertama saya bekerja.'],
            ['akl', 'Siti Nurhaliza', 2024, 'Staf Akuntansi', 'KSPPS BMT Mentari Genteng', 'Praktik dengan aplikasi akuntansi di sekolah membuat saya cepat beradaptasi dengan sistem pembukuan di kantor.'],
            ['akl', 'Ilham Ramadhan', 2023, 'Kasir & Admin Keuangan', 'Swalayan Sumber Rejeki', 'Ketelitian mencatat transaksi yang dilatih di AKL membuat saya dipercaya memegang laporan kas harian.'],
            ['akl', 'Dewi Anggraini', 2025, 'Staf Pajak', 'Konsultan Pajak Mitra Usaha', 'Materi perpajakan dan sertifikasi kompetensi jadi nilai tambah saat melamar ke kantor konsultan pajak.'],
            ['mplb', 'Nabila Zahra', 2024, 'Staf Administrasi', 'Kantor Kecamatan Genteng', 'Kemampuan mengelola arsip dan surat menyurat dari MPLB langsung terpakai di pekerjaan pelayanan publik.'],
            ['mplb', 'Rafi Akbar Maulana', 2023, 'Customer Service', 'Bank BRI Unit Genteng', 'Latihan komunikasi dan pelayanan prima di sekolah membuat saya percaya diri melayani nasabah setiap hari.'],
            ['mplb', 'Laila Safitri', 2025, 'Sekretaris', 'PT Agro Tani Banyuwangi', 'Praktik kerja lapangan di perkantoran mitra sekolah memberi saya gambaran nyata tugas sekretaris sebelum lulus.'],
            ['ph', 'Kevin Saputra', 2023, 'Room Attendant', 'Aston Banyuwangi Hotel', 'Standar kebersihan kamar yang dilatih di Edotel sama persis dengan standar hotel berbintang tempat saya bekerja.'],
            ['ph', 'Putri Ayu Ningsih', 2025, 'Food & Beverage Service', 'Ketapang Indah Resort', 'Melayani tamu restoran sekolah membuat saya terbiasa bekerja cepat dan tetap ramah saat suasana ramai.'],
        ];

        foreach ($testimonials as $index => [$major, $name, $year, $role, $company, $quote]) {
            Testimonial::firstOrCreate(
                ['name' => $name],
                [
                    'major_id' => $majorIds[$major] ?? null,
                    'graduation_year' => $year,
                    'role' => $role,
                    'company' => $company,
                    'quote' => $quote,
                    'is_published' => true,
                    'sort_order' => 10 + $index,
                ],
            );
        }
    }

    private function faqs(): void
    {
        $faqs = [
            ['Dokumen apa saja yang perlu disiapkan untuk mendaftar?', 'Siapkan scan Kartu Keluarga, akta kelahiran, rapor SMP/MTs semester terakhir, pas foto terbaru, dan sertifikat prestasi (jika ada). Semua dokumen diunggah lewat dashboard pendaftar.'],
            ['Apakah pendaftaran bisa dilakukan sepenuhnya secara online?', 'Bisa. Buat akun pendaftar, lengkapi formulir dan unggah dokumen di dashboard. Panitia akan menghubungi lewat WhatsApp untuk jadwal tes dan daftar ulang.'],
            ['Apakah ada tes masuk untuk calon siswa baru?', 'Ada tes minat bakat dan wawancara singkat untuk membantu menempatkan calon siswa di konsentrasi keahlian yang paling sesuai.'],
            ['Apakah sekolah menyediakan asrama?', 'Sekolah belum menyediakan asrama, namun panitia dapat membantu memberikan informasi tempat kos di sekitar sekolah yang aman untuk siswa.'],
            ['Bagaimana cara mengetahui status pendaftaran saya?', 'Status pendaftaran dapat dipantau kapan saja melalui dashboard pendaftar setelah login menggunakan email dan kata sandi yang didaftarkan.'],
        ];

        $next = (int) Faq::max('sort_order');

        foreach ($faqs as $index => [$question, $answer]) {
            Faq::firstOrCreate(
                ['question' => $question],
                ['answer' => $answer, 'is_published' => true, 'sort_order' => $next + $index + 1],
            );
        }
    }

    /**
     * Lowongan kerja BKK. Perusahaan tanpa logo disimpan sebagai mitra yang tidak tampil di daftar logo (sama seperti BkkSeeder).
     */
    private function vacancies(): void
    {
        $vacancies = [
            ['CV Kode Kreatif Banyuwangi', 'Staff IT Support', EmploymentType::FullTime, 'Banyuwangi'],
            ['Studio Rupa Kreatif', 'Desainer Grafis Junior', EmploymentType::Contract, 'Genteng, Banyuwangi'],
            ['KSPPS BMT Mentari Genteng', 'Teller & Admin Keuangan', EmploymentType::FullTime, 'Genteng, Banyuwangi'],
            ['Aston Banyuwangi Hotel', 'Magang Housekeeping', EmploymentType::Internship, 'Banyuwangi'],
        ];

        foreach ($vacancies as $index => [$company, $position, $type, $location]) {
            $partner = Partner::firstOrCreate(
                ['name' => $company],
                ['slug' => str($company)->slug(), 'sort_order' => 200 + $index, 'is_active' => false],
            );

            JobVacancy::firstOrCreate(
                ['slug' => str($position)->slug()],
                [
                    'partner_id' => $partner->id,
                    'position' => $position,
                    'employment_type' => $type,
                    'location' => $location,
                    'status' => VacancyStatus::Open,
                    'closes_at' => today()->addDays(45),
                ],
            );
        }
    }

    /**
     * Akun pendaftar SPMB contoh: belum mengisi formulir apa pun (tanpa data pendaftaran).
     */
    private function applicant(): void
    {
        Applicant::firstOrCreate(
            ['email' => 'pendaftar@smemsa.test'],
            ['password' => 'pendaftar123'],
        );
    }
}
