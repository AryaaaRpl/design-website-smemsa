<?php

namespace Database\Seeders;

use App\Enums\CardStyle;
use App\Models\Extracurricular;
use Illuminate\Database\Seeder;

/**
 * Ekstrakurikuler awal, dipindahkan dari data statis halaman ekstrakurikuler.
 * Slug memakai key lama (hw, paskibra, ...) agar tetap sama dengan desain awal.
 */
class ExtracurricularSeeder extends Seeder
{
    public function run(): void
    {
        $extracurriculars = [
            [
                'slug' => 'hw',
                'name' => 'Hizbul Wathan (HW)',
                'tag' => 'Kepanduan Islami Wajib',
                'card_style' => CardStyle::Featured,
                'image' => 'assets/ekskul/hizbul-wathan.png',
                'modal_image' => 'assets/ekskul/hw.webp',
                'short_description' => 'Diklat Kemah Tamu Penghela Hizbul Wathan sukses diselenggarakan. Ekstrakurikuler wajib kepanduan ini menanamkan kedisiplinan, kemandirian, dan nilai-nilai Islami berwawasan kemanusiaan universal.',
                'description' => "Gerakan Kepanduan Hizbul Wathan (HW) Kafilah SMKS Muhammadiyah 1 Genteng merupakan ekstrakurikuler wajib yang menanamkan kedisiplinan, kemandirian, serta nilai-nilai keislaman yang berwawasan kemanusiaan universal.\n\n"
                    .'Melalui kegiatan kepanduan seperti perkemahan, penjelajahan alam, dan keterampilan pioneering, peserta didik dilatih untuk memiliki fisik yang kuat, mental yang tangguh, serta jiwa kepemimpinan yang berakhlak mulia.',
                'schedule' => 'Jumat, 13:00 - 15:00 WIB',
                'coach_name' => 'Ust. Ramanda Hidayat, S.Pd',
                'location' => 'Lapangan Utama & Halaman Sekolah',
                'audience' => 'Wajib Kelas X & Pilihan Kelas XI',
            ],
            [
                'slug' => 'paskibra',
                'name' => 'Paskibra Pasukan Inti',
                'tag' => 'Kedisiplinan & Patriotisme',
                'card_style' => CardStyle::Tall,
                'image' => 'assets/ekskul/paskibra.jpeg',
                'modal_image' => 'assets/ekskul/paskibra.webp',
                'short_description' => 'Mengajarkan siswa tentang kedisiplinan baris-berbaris presisi, ketahanan mental, serta rasa tanggung jawab kebangsaan yang kokoh.',
                'description' => "Pasukan Pengibar Bendera (Paskibra) merupakan ekstrakurikuler unggulan yang bertujuan menanamkan kedisiplinan tingkat tinggi, ketahanan mental, serta rasa tanggung jawab dan cinta tanah air.\n\n"
                    .'Anggota Paskibra dilatih secara intensif dalam hal Peraturan Baris Berbaris (PBB) formasi presisi, tata upacara bendera, serta etika kepemimpinan. Tim Paskibra selalu menjadi garda terdepan dalam setiap upacara peringatan hari besar nasional di sekolah maupun tingkat kecamatan.',
                'schedule' => 'Selasa & Kamis, 15:30 WIB',
                'coach_name' => 'Bpk. Letda (Purn) Sudirman',
                'location' => 'Lapangan Utama SMEMSA',
                'audience' => 'Semua Tingkat (Seleksi)',
            ],
            [
                'slug' => 'silat',
                'name' => 'Pencak Silat Tapak Suci',
                'tag' => 'Seni Bela Diri Tradisi',
                'image' => 'assets/ekskul/silat.webp',
                'modal_image' => null,
                'short_description' => 'Perguruan bela diri berprestasi nasional yang memadukan keahlian jurus tradisional, pertahanan diri, dan penguatan aqidah.',
                'description' => "Perguruan Seni Bela Diri Indonesia Tapak Suci Putera Muhammadiyah adalah organisasi pencak silat resmi yang mengajarkan keahlian jurus tradisional, pertahanan diri yang efektif, dan penguatan aqidah Islam.\n\n"
                    .'Dengan moto "Dengan Iman dan Akhlak saya menjadi kuat, tanpa Iman dan Akhlak saya menjadi lemah", anggota diajarkan sportivitas, keberanian, serta pembentukan karakter ksatria. Tapak Suci SMEMSA rutin mengikuti dan memenangkan berbagai kejuaraan baik tingkat regional maupun nasional.',
                'achievements' => [
                    'Juara Umum 1 Kejurda Tapak Suci Banyuwangi 2025',
                    'Medali Emas O2SN Tingkat Provinsi Jawa Timur',
                    'Juara 2 Kategori Tanding Kelas C Remaja',
                ],
                'schedule' => 'Rabu & Sabtu, 15:30 WIB',
                'coach_name' => 'Pendekar Muda Surya Nata',
                'location' => 'Aula Terbuka SMEMSA',
                'audience' => 'Terbuka Untuk Umum',
            ],
            [
                'slug' => 'pramuka',
                'name' => 'Gerakan Pramuka',
                'tag' => 'Kepanduan Penegak',
                'image' => 'assets/ekskul/pramuka.jpg',
                'modal_image' => 'assets/ekskul/pramuka.webp',
                'short_description' => 'Fokus pada pembinaan karakter mandiri, survival skills di alam bebas, pioneering, dan pengabdian sosial masyarakat.',
                'description' => "Ekstrakurikuler Pramuka fokus pada pembinaan karakter mandiri, kepemimpinan regu, serta kecakapan hidup (life skills). Kegiatannya meliputi survival di alam bebas, pioneering, semaphore, dan navigasi darat.\n\n"
                    .'Selain keterampilan teknis kepramukaan, anggota juga aktif dalam kegiatan pengabdian masyarakat, bakti sosial, dan penanggulangan bencana ringan, membentuk generasi muda yang tanggap, tangguh, dan peduli sesama.',
                'schedule' => 'Sabtu, 14:00 - 16:30 WIB',
                'coach_name' => 'Kak Budi Santoso, S.Pd',
                'location' => 'Pangkalan SMEMSA',
                'audience' => 'Kelas X & XI',
            ],
            [
                'slug' => 'pmr',
                'name' => 'PMR Wira Unit SMEMSA',
                'tag' => 'Kesehatan & Kemanusiaan',
                'image' => 'assets/ekskul/pmr.jpeg',
                'modal_image' => 'assets/ekskul/pmr.webp',
                'short_description' => 'Pelatihan pertolongan pertama pada kecelakaan (P3K), kesiapsiagaan bencana darurat, dan aksi donor darah sukarela.',
                'description' => "Palang Merah Remaja (PMR) Wira adalah wadah pembinaan generasi muda di bidang kesehatan dan kemanusiaan. Anggota dilatih secara profesional mengenai Pertolongan Pertama Pada Kecelakaan (P3K), perawatan keluarga, hingga evakuasi medis dasar.\n\n"
                    .'PMR SMEMSA aktif menyelenggarakan donor darah rutin bekerja sama dengan PMI Banyuwangi, serta menjadi tim medis siaga dalam setiap kegiatan besar sekolah maupun perlombaan olahraga antar pelajar.',
                'achievements' => [
                    'Juara 1 Lomba Pertolongan Pertama Tingkat Wira Banyuwangi',
                    'Penghargaan Unit PMR Teraktif 2024',
                ],
                'schedule' => 'Senin, 15:30 WIB',
                'coach_name' => 'Ibu Ratna Medika, S.Kep',
                'location' => 'UKS & Ruang Teori',
                'audience' => 'Terbuka Untuk Umum',
            ],
            [
                'slug' => 'olahraga',
                'name' => 'Klub Olahraga Terpadu',
                'tag' => 'Prestasi Atletik',
                'image' => 'assets/ekskul/klub-olahraga.jpeg',
                'modal_image' => 'assets/ekskul/olahraga.webp',
                'short_description' => 'Mewadahi talenta siswa dalam cabang Futsal, Bola Basket, Bola Voli, dan E-Sports untuk bersaing di kejurprov pelajar.',
                'description' => "Klub Olahraga Terpadu mewadahi berbagai talenta peserta didik di bidang olahraga, meliputi Futsal, Bola Voli, Bola Basket, hingga cabang modern seperti E-Sports.\n\n"
                    .'Dengan fasilitas lapangan berstandar dan pelatih berpengalaman, klub ini tidak hanya berfokus pada kebugaran fisik dan teknik permainan, tetapi juga pembentukan mental juara, kerja sama tim (teamwork), dan sportivitas untuk berlaga di kejuaraan tingkat pelajar maupun umum.',
                'schedule' => 'Menyesuaikan Cabang Olahraga',
                'coach_name' => 'Tim Guru Penjasorkes',
                'location' => 'Fasilitas Olahraga SMEMSA',
                'audience' => 'Semua Tingkat (Seleksi)',
            ],
        ];

        foreach ($extracurriculars as $index => $extracurricular) {
            Extracurricular::updateOrCreate(
                ['slug' => $extracurricular['slug']],
                $extracurricular + [
                    'card_style' => CardStyle::Normal,
                    'achievements' => null,
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ],
            );
        }
    }
}
