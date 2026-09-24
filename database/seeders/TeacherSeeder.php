<?php

namespace Database\Seeders;

use App\Enums\TeacherCategory;
use App\Models\Major;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Data awal guru & staf, dipindahkan dari data statis halaman guru.
 * Foto memakai versi .webp; jika tidak ada versi webp, memakai file aslinya.
 * Jalankan setelah MajorSeeder (Kepala Konsentrasi terhubung ke jurusan).
 */
class TeacherSeeder extends Seeder
{
    /**
     * Kutipan kartu besar Kepala Sekolah & Wakil Kepala Sekolah.
     */
    private const QUOTES = [
        'kepsek' => 'Berkomitmen mencetak lulusan yang kompeten di bidangnya, berkarakter Islami, dan siap bersaing di era digital melalui pendidikan vokasi yang bermutu.',
        'wakasek' => 'Mengawal seluruh program unggulan dengan kedisiplinan dan inovasi tiada henti untuk pencapaian keunggulan bersama.',
    ];

    public function run(): void
    {
        $majorIds = Major::pluck('id', 'slug');

        // [nama, jabatan, kategori, foto, slug jurusan]
        $teachers = [
            ['Wuri Handayani, S.E', 'BENDAHARA SEKOLAH', TeacherCategory::Leadership, 'assets/guru/kategori-pimpinan/BENDAHARA SEKOLAH - Wuri Handayani, S.E.webp', null],
            ['Misrok, A.Md', 'KEPALA TU', TeacherCategory::Leadership, 'assets/guru/kategori-pimpinan/KEPALA TU - Misrok, A.Md.webp', null],
            ['Nur Rohman, M.Pd', 'MUTU', TeacherCategory::Leadership, 'assets/guru/kategori-pimpinan/MUTU - Nur Rohman, M.Pd.webp', null],
            ['Wahid Wahyudi, S.Ag., M.Pd', 'PEMBINA UTAMA (PU)', TeacherCategory::Principal, 'assets/PAK-WAHID-AI-e1781064934191.png', null],
            ['Drei herba Ta\'abudi. M.Hum', 'WAKA HUMAS', TeacherCategory::Leadership, 'assets/guru/kategori-pimpinan/WAKA HUMAS - Drei herba Ta\'abudi. M.Hum.webp', null],
            ['Siti Muawanah, S.Pd.', 'WAKA ISMUBA', TeacherCategory::Leadership, 'assets/guru/kategori-pimpinan/WAKA ISMUBA - Siti Muawanah, S.Pd..webp', null],
            ['Muh. Najib Rosi, S.Pd', 'WAKA KESISWAAN', TeacherCategory::Leadership, 'assets/guru/kategori-pimpinan/WAKA KESISWAAN - Muh. Najib Rosi, S.Pd.webp', null],
            ['Latifah ambarwati, S.Pd', 'WAKA KURIKULUM', TeacherCategory::Leadership, 'assets/guru/kategori-pimpinan/WAKA KURIKULUM - Latifah ambarwati, S.Pd.webp', null],
            ['Shulhi Firdaus, S.Kom', 'WAKA SAPRAS', TeacherCategory::Leadership, 'assets/guru/kategori-pimpinan/WAKA SAPRAS- Shulhi Firdaus, S.Kom.webp', null],
            ['Aan Cahyanto Sri Setyo, M.Pd', 'WAKIL KS', TeacherCategory::VicePrincipal, 'assets/guru/kategori-pimpinan/WAKIL KS - Aan Cahyanto Sri Setyo, M.Pd.webp', null],
            ['Dedy Wijanarko, SST.,Par.,S.Pd', 'Ketua Program', TeacherCategory::HeadOfMajor, 'assets/guru/kategori-k3/Dedy Wijanarko, SST.,Par.,S.Pd.webp', 'ph'],
            ['Dinda Nurmawati, S.Kom', 'Ketua Program', TeacherCategory::HeadOfMajor, 'assets/guru/kategori-k3/Dinda Nurmawati, S.Kom.webp', 'rpl'],
            ['Marita NurLailaty, S.Pd', 'Ketua Program', TeacherCategory::HeadOfMajor, 'assets/guru/kategori-k3/Marita NurLailaty, S.Pd.webp', 'akl'],
            ['Moh. Ihya\' Nur Ulumuddin, S.Kom.', 'Ketua Program', TeacherCategory::HeadOfMajor, 'assets/guru/kategori-k3/Moh. Ihya\' Nur Ulumuddin, S.Kom..webp', 'dkv'],
            ['Suci Fitria N., S.Pd', 'Ketua Program', TeacherCategory::HeadOfMajor, 'assets/guru/kategori-k3/Suci Fitria N., S.Pd.webp', 'bd'],
            ['Teguh Santosa, S.Kom', 'Ketua Program', TeacherCategory::HeadOfMajor, 'assets/guru/kategori-k3/Teguh Santosa, S.Kom.webp', 'tkj'],
            ['Tri Wahyu S, S.Pd', 'Ketua Program', TeacherCategory::HeadOfMajor, 'assets/guru/kategori-k3/Tri Wahyu S, S.Pd.webp', 'mplb'],
            ['Ainun Nisa, S.E', 'Kewirausahaan / Bisnis Digital', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Ainun Nisa, S.E.webp', null],
            ['Akmal, S.Kom.', 'Produktif Kejuruan IT', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Akmal, S.Kom..webp', null],
            ['Ana Fitriani, S.Tr.Par.', 'Produktif Perhotelan', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Ana Fitriani, S.Tr.Par..webp', null],
            ['Anis Soraya, S.Pd.', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Anis Soraya, S.Pd..webp', null],
            ['Devi Ariya Sinta, S.Tr. Par', 'Guru Mata Pelajaran', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Devi Ariya Sinta, S.Tr. Par.webp', null],
            ['Dina Istiningrum, S.Pd.', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Dina Istiningrum, S.Pd..webp', null],
            ['Dwi Puspitasari, S.Pd', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Dwi Puspitasari, S.Pd.webp', null],
            ['Dwi Santi Y, S.Sos.,S.Pd.,M.Pd', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Dwi Santi Y, S.Sos.,S.Pd.,M.Pd.webp', null],
            ['Endah Dila K., S.Kom', 'Produktif Kejuruan IT', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Endah Dila K., S.Kom.webp', null],
            ['Hafidz Azhari, S.Pd.', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Hafidz Azhari, S.Pd..webp', null],
            ['Hamamatul Baidhok,S,Pd', 'Guru Mata Pelajaran', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Hamamatul Baidhok,S,Pd.webp', null],
            ['Irva Maftukha, S.Pd', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Irva Maftukha, S.Pd.webp', null],
            ['Karyono, S.Pd.I', 'Pendidikan Agama Islam', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Karyono, S.Pd.I.webp', null],
            ['Kukuh Hartanto, S.Pd', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Kukuh Hartanto, S.Pd.webp', null],
            ['Ledy Kus Raharjo, S.Pd', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Ledy Kus Raharjo, S.Pd.webp', null],
            ['Liya ayu Destiana, S.Tr.Par', 'Produktif Perhotelan', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Liya ayu Destiana, S.Tr.Par.webp', null],
            ['Lutfia Rachmah, S.Psi', 'Guru Mata Pelajaran', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Lutfia Rachmah, S.Psi.webp', null],
            ['M.Saifulloh, S.Kom', 'Produktif Kejuruan IT', TeacherCategory::Teacher, 'assets/guru/kategori-guru/M.Saifulloh, S.Kom.webp', null],
            ['Muhammad Andri Subakti, S.Pd.', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Muhammad Andri Subakti, S.Pd..webp', null],
            ['Nalida Rahmi Sekar Arum, S.Pd.', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Nalida Rahmi Sekar Arum, S.Pd..webp', null],
            ['Nuraini Latifa, S.Pd', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Nuraini Latifa, S.Pd.webp', null],
            ['Rausyan Risyda, S.Pd', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Rausyan Risyda, S.Pd.webp', null],
            ['Rifki Ahmad Fauzi Hasan, S.Tr.Par', 'Produktif Perhotelan', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Rifki Ahmad Fauzi Hasan, S.Tr.Par.webp', null],
            ['Rita Andria Betrix, S.Pd', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Rita Andria Betrix, S.Pd.webp', null],
            ['Serli Nur Aini, S.Pd', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Serli Nur Aini, S.Pd.webp', null],
            ['Siti Nur Rohmah, S.Pd', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Siti Nur Rohmah, S.Pd.webp', null],
            ['Sri Wahyuni, S.Pd', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Sri Wahyuni, S.Pd.webp', null],
            ['Ulfatun Nikmah, S.Pd', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Ulfatun Nikmah, S.Pd.webp', null],
            ['Warokoh Ibnu Noval, S.Pd', 'Mata Pelajaran Umum', TeacherCategory::Teacher, 'assets/guru/kategori-guru/Warokoh Ibnu Noval, S.Pd.webp', null],
            ['Agus Supriyono', 'Staff Karyawan', TeacherCategory::Staff, 'assets/guru/kategori-karyawan/Agus Supriyono.webp', null],
            ['Andi Sukono', 'Staff Karyawan', TeacherCategory::Staff, 'assets/guru/kategori-karyawan/Andi Sukono.webp', null],
            ['Ariel Nuristian Putra', 'Staff Karyawan', TeacherCategory::Staff, 'assets/guru/kategori-karyawan/Ariel Nuristian Putra.webp', null],
            ['Beni Putra Iskandar', 'Staff Karyawan', TeacherCategory::Staff, 'assets/guru/kategori-karyawan/Beni Putra Iskandar.webp', null],
            ['Bibit Wahyudi', 'Staff Karyawan', TeacherCategory::Staff, 'assets/guru/kategori-karyawan/Bibit Wahyudi.webp', null],
            ['Cheppy Sukmawardhana, S.T.', 'Staff Karyawan', TeacherCategory::Staff, 'assets/guru/kategori-karyawan/Cheppy Sukmawardhana, S.T..webp', null],
            ['Darmaji', 'Staff Karyawan', TeacherCategory::Staff, 'assets/guru/kategori-karyawan/Darmaji.webp', null],
            ['Didit Eko Priyantoro', 'Staff Karyawan', TeacherCategory::Staff, 'assets/guru/kategori-karyawan/Didit Eko Priyantoro.webp', null],
            ['Edy Kuswanto', 'Staff Karyawan', TeacherCategory::Staff, 'assets/guru/kategori-karyawan/Edy Kuswanto.webp', null],
            ['Fandie Eko Prasetiyo', 'Staff Karyawan', TeacherCategory::Staff, 'assets/guru/kategori-karyawan/Fandie Eko Prasetiyo.webp', null],
            ['Nama menyusul', 'Staff Karyawan', TeacherCategory::Staff, 'assets/guru/kategori-karyawan/IMGL4229.webp', null],
            ['Nama menyusul', 'Staff Karyawan', TeacherCategory::Staff, 'assets/guru/kategori-karyawan/IMGL4284.webp', null],
            ['Moch. Afif Aliyansyah', 'Staff Karyawan', TeacherCategory::Staff, 'assets/guru/kategori-karyawan/Moch. Afif Aliyansyah.webp', null],
            ['Prayoga Krisna Febri Aji', 'Staff Karyawan', TeacherCategory::Staff, 'assets/guru/kategori-karyawan/Prayoga Krisna Febri Aji.webp', null],
            ['Rahmat Viky Susanto', 'Staff Karyawan', TeacherCategory::Staff, 'assets/guru/kategori-karyawan/Rahmat Viky Susanto.webp', null],
            ['Rudi Hariyanto', 'Staff Karyawan', TeacherCategory::Staff, 'assets/guru/kategori-karyawan/Rudi Hariyanto.webp', null],
        ];

        foreach ($teachers as $index => [$name, $position, $category, $photo, $majorSlug]) {
            // Slug diberi nomor urut agar nama yang sama (misal "Nama menyusul") tetap unik.
            $slug = Str::slug($name).'-'.($index + 1);

            Teacher::updateOrCreate(['slug' => $slug], [
                'name' => $name,
                'position' => $position,
                'category' => $category,
                'quote' => self::QUOTES[$category->value] ?? null,
                'photo' => $photo,
                'major_id' => $majorSlug ? ($majorIds[$majorSlug] ?? null) : null,
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }
    }
}
