<?php

namespace Database\Seeders;

use App\Enums\CategoryType;
use App\Models\Achievement;
use App\Models\Category;
use Illuminate\Database\Seeder;

/**
 * Prestasi awal, dipindahkan dari data statis JavaScript halaman prestasi.
 * Jalankan setelah CategorySeeder.
 */
class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = Category::ofType(CategoryType::Achievement)->pluck('id', 'slug');

        $achievements = [
            [
                'slug' => 'me-awards',
                'category' => 'akademik',
                'title' => 'Juara Umum Muhammadiyah Education Awards (ME Awards) Nasional 2026',
                'field_label' => 'Akademik & Vokasi',
                'level' => 'nasional',
                'rank' => 'JUARA UMUM TINGKAT NASIONAL',
                'achieved_at' => '2026-03-01',
                'location' => 'Universitas Muhammadiyah Malang / Nasional',
                'organizer' => 'Pimpinan Wilayah Muhammadiyah & Majelis Dikdasmen Nasional',
                'excerpt' => 'Mengungguli ratusan sekolah kejuruan se-Indonesia dalam kompetisi riset inovasi digital, robotika, seni budaya, dan kepemimpinan Islami.',
                'image' => 'assets/juara-me-awards.jpg',
                'is_featured' => true,
                'description' => "SMKS Muhammadiyah 1 Genteng berhasil menorehkan sejarah gemilang dengan dinobatkan sebagai Juara Umum Tingkat Nasional dalam perhelatan akbar Muhammadiyah Education Awards (ME Awards) 2026.\n\n"
                    ."Prestasi ini diraih berkat akumulasi medali emas dan perak pada berbagai cabang perlombaan bergengsi, meliputi Lomba Inovasi Robotika Vokasi, Desain Aplikasi Digital Software, Pidato Bahasa Asing, Seni Budaya, dan Tata Kelola Sekolah Kejuruan Unggul.\n\n"
                    .'Pencapaian ini membuktikan komitmen civitas akademika SMEMSA dalam mengintegrasikan keahlian sains teknologi abad ke-21 dengan penanaman akhlakul karimah yang berwawasan global.',
            ],
            [
                'slug' => 'inovasi-rpl',
                'category' => 'teknologi',
                'title' => 'Juara 1 Lomba Inovasi Digital Nasional (Tim Pengembang Perangkat Lunak & Gim)',
                'field_label' => 'Teknologi IT',
                'level' => 'nasional',
                'rank' => 'MEDALI EMAS NASIONAL',
                'achieved_at' => '2026-05-01',
                'location' => 'Jakarta / Nasional',
                'organizer' => 'Kementerian Pendidikan & Asosiasi Industri Software House',
                'excerpt' => "Pengembangan software terintegrasi 'Smart Vocational Cloud' untuk monitoring presensi RFID dan portofolio kompetensi BNSP siswa.",
                'image' => null,
                'description' => "Tim siswa konsentrasi keahlian Pengembang Perangkat Lunak & Gim (PPLG) SMKS Muhammadiyah 1 Genteng berhasil meraih Juara 1 Nasional dalam kompetisi inovasi perangkat lunak terapan.\n\n"
                    ."Produk yang dikembangkan adalah 'Smart Vocational Management System', aplikasi cloud terintegrasi untuk absensi RFID real-time, monitoring unit produksi Teaching Factory, dan tracking sertifikasi BNSP siswa.",
            ],
            [
                'slug' => 'taekwondo',
                'category' => 'bela-diri',
                'title' => 'Dua Atlet Taekwondo Smemsa Raih Juara 3 Kejurprov Pelajar se-Jatim',
                'field_label' => 'Bela Diri',
                'level' => 'provinsi',
                'rank' => 'MEDALI PERUNGGU PROVINSI',
                'achieved_at' => '2026-06-01',
                'location' => 'Malang, Jawa Timur',
                'organizer' => 'Pengurus Provinsi Taekwondo Indonesia (TI) Jawa Timur',
                'excerpt' => 'Dua atlet pelajar binaan ekstrakurikuler bela diri SMEMSA sukses merebut podium ketiga pada kejuaraan provinsi di GOR Ken Arok Malang.',
                'image' => null,
                'description' => "Dua atlet pelajar SMKS Muhammadiyah 1 Genteng sukses merebut medali perunggu pada ajang Kejuaraan Provinsi (Kejurprov) Taekwondo Antar Pelajar se-Jawa Timur yang diselenggarakan di GOR Ken Arok, Malang.\n\n"
                    .'Melalui latihan disiplin intensif di bawah naungan ekstrakurikuler bela diri sekolah, atlet binaan SMEMSA mampu bersaing secara tangguh menghadapi atlet-atlet unggulan dari berbagai kota besar di Jawa Timur.',
            ],
            [
                'slug' => 'karaoke',
                'category' => 'seni',
                'title' => 'Dua Siswi Smemsa Borong Juara Festival Vokal Pelajar Berbakat',
                'field_label' => 'Seni Musik',
                'level' => 'kabupaten',
                'rank' => 'JUARA FESTIVAL SENI',
                'achieved_at' => '2026-06-01',
                'location' => 'Banyuwangi',
                'organizer' => 'Dinas Kebudayaan & Pariwisata Kabupaten Banyuwangi',
                'excerpt' => 'Harmonisasi nada dan olah vokal memukau mengantarkan delegasi siswi SMEMSA memboyong piala juara festival musik pelajar daerah.',
                'image' => 'assets/berita/lomba-karaoke.jpg',
                'description' => "Penampilan vokal yang memukau dan harmonisasi nada yang matang mengantarkan dua siswi SMEMSA memboyong piala juara pada festival pencarian bakat vokal pelajar tingkat kabupaten Banyuwangi.\n\n"
                    .'Sekolah memberikan apresiasi tinggi bagi pengembangan bakat seni dan kepercayaan diri siswa sebagai penyeimbang keterampilan teknis vokasi.',
            ],
            [
                'slug' => 'silat',
                'category' => 'bela-diri',
                'title' => 'Juara 1 Open Competition Panji Laras Kategori Seni Tunggal IPSI',
                'field_label' => 'Pencak Silat',
                'level' => 'regional',
                'rank' => 'JUARA 1 SENI TUNGGAL',
                'achieved_at' => '2025-11-01',
                'location' => 'Banyuwangi',
                'organizer' => 'Ikatan Pencak Silat Indonesia (IPSI) Kabupaten Banyuwangi',
                'excerpt' => 'Pesilat Tapak Suci SMEMSA mendominasi kompetisi seni tunggal IPSI dengan keindahan jurus dan presisi gerakan berstandar nasional.',
                'image' => null,
                'description' => "Pesilat Tapak Suci Putera Muhammadiyah SMEMSA berhasil menyabet Juara 1 kategori Seni Tunggal Putra pada Kejuaraan Terbuka Panji Laras se-Kabupaten Banyuwangi.\n\n"
                    .'Gerakan jurus yang presisi, ketegasan sikap, dan penghayatan gerak seni bela diri tradisional mengantarkan pesilat sekolah memperoleh skor tertinggi dari dewan juri IPSI.',
            ],
            [
                'slug' => 'esports',
                'category' => 'esports',
                'title' => 'Juara 1 MPL Student League & Delegasi Grand Final Tingkat Nasional',
                'field_label' => 'E-Sports',
                'level' => 'nasional',
                'rank' => 'JUARA 1 & DELEGASI NASIONAL',
                'achieved_at' => '2025-10-01',
                'location' => 'Universitas Muhammadiyah Malang & Karesidenan',
                'organizer' => 'Indonesia Esports Association (IESPA) Jawa Timur',
                'excerpt' => 'Kerja sama taktis dan kepiawaian strategi tim e-sports sekolah membawa SMEMSA lolos melaju ke babak Grand Final nasional Universitas Muhammadiyah Malang.',
                'image' => null,
                'description' => "Tim E-Sports SMKS Muhammadiyah 1 Genteng membuktikan keunggulan strategi, koordinasi tim, dan ketangkasan kognitif dengan menjuarai kualifikasi MPL Student League regional.\n\n"
                    .'Prestasi ini mengantarkan tim mewakili karesidenan ke babak Grand Final tingkat nasional di Universitas Muhammadiyah Malang.',
            ],
            [
                'slug' => 'lks-tkj',
                'category' => 'teknologi',
                'title' => 'Juara 1 Lomba Kompetensi Siswa (LKS) IT Network System Administration',
                'field_label' => 'Teknologi IT',
                'level' => 'provinsi',
                'rank' => 'MEDALI EMAS LKS WILAYAH',
                'achieved_at' => '2025-08-01',
                'location' => 'Jember & Banyuwangi',
                'organizer' => 'Musyawarah Kerja Kepala Sekolah (MKKS) & Dinas Pendidikan Jatim',
                'excerpt' => 'Konfigurasi routing enterprise, virtualization server, dan network security mengantarkan siswa TJKT SMEMSA ke posisi puncak LKS.',
                'image' => null,
                'description' => "Siswa konsentrasi keahlian Teknik Komputer dan Jaringan (TJKT) SMEMSA meraih Juara 1 pada ajang Lomba Kompetensi Siswa (LKS) bidang IT Network System Administration.\n\n"
                    .'Kemampuan konfigurasi server Linux, firewall, dan routing Cisco secara cepat dan aman di bawah batasan waktu ketat mengesankan para penguji dari kalangan praktisi industri telekomunikasi.',
            ],
            [
                'slug' => 'animasi-dkv',
                'category' => 'seni',
                'title' => 'Pemenang Karya Terbaik Festival Film Pendek Animasi 2D Pelajar Vokasi',
                'field_label' => 'Desain & Animasi',
                'level' => 'nasional',
                'rank' => 'KARYA TERBAIK NASIONAL',
                'achieved_at' => '2025-09-01',
                'location' => 'Yogyakarta',
                'organizer' => 'Asosiasi Industri Animasi & Konten Kreatif Indonesia (AINAKI)',
                'excerpt' => 'Karya animasi edukasi bertema kearifan lokal karya siswa DKV berhasil menyabet penghargaan Best Storytelling & Visual Appeal.',
                'image' => null,
                'description' => "Siswa konsentrasi Desain Komunikasi Visual (DKV) SMEMSA menciptakan film pendek animasi 2D yang memadukan cerita edukasi karakter dengan visual grafis modern.\n\n"
                    .'Karya ini terpilih sebagai salah satu karya terbaik di antara ratusan submisi pelajar SMK se-Indonesia dalam festival animasi nasional di Yogyakarta.',
            ],
            [
                'slug' => 'robotika-otomasi',
                'category' => 'teknologi',
                'title' => 'Juara 2 National Vocational Robotic Competition (Line Follower Micro)',
                'field_label' => 'Robotika',
                'level' => 'nasional',
                'rank' => 'JUARA 2 NASIONAL',
                'achieved_at' => '2024-12-01',
                'location' => 'Semarang',
                'organizer' => 'Federasi Robotika Indonesia & Polines',
                'excerpt' => 'Robot line follower mikrokontroler presisi tinggi hasil rancangan siswa Teknik Mekatronika meraih waktu tercepat kedua di lintasan sirkuit nasional.',
                'image' => null,
                'description' => "Tim Robotika SMKS Muhammadiyah 1 Genteng merancang robot lintasan otomatis berkecepatan tinggi dengan algoritma PID terkalibrasi presisi.\n\n"
                    .'Kompetisi ini menguji integrasi sensor optik, pemrograman embedded C, dan perancangan sirkuit PCB mandiri siswa.',
            ],
            [
                'slug' => 'debat-bahasa',
                'category' => 'akademik',
                'title' => 'Best Speaker & Juara 2 English Debate Championship Pelajar',
                'field_label' => 'Bahasa & Debat',
                'level' => 'provinsi',
                'rank' => 'BEST SPEAKER PROVINSI',
                'achieved_at' => '2024-11-01',
                'location' => 'Universitas Muhammadiyah Malang',
                'organizer' => 'English Teachers Association (MGMP) Jawa Timur',
                'excerpt' => 'Keterampilan argumentasi kritis dalam bahasa Inggris mengenai isu global vokasi dan teknologi membawa siswa SMEMSA meraih gelar Best Speaker.',
                'image' => null,
                'description' => "Kemampuan komunikasi bahasa internasional dan daya nalar kritis siswa SMEMSA terbukti unggul dalam kompetisi debat bahasa Inggris tingkat Jawa Timur.\n\n"
                    .'Dukungan program bilingual dan native speaking club sekolah menjadi fondasi utama keberhasilan ini.',
            ],
            [
                'slug' => 'otomotif-tbsm',
                'category' => 'teknologi',
                'title' => 'Juara 1 Kontes Keterampilan Mekanik Sepeda Motor Honda se-Karesidenan',
                'field_label' => 'Otomotif',
                'level' => 'regional',
                'rank' => 'JUARA 1 MEKANIK TERBAIK',
                'achieved_at' => '2024-10-01',
                'location' => 'Jember',
                'organizer' => 'PT Mitra Pinasthika Mulia (MPM Honda Motor Jatim)',
                'excerpt' => 'Ketepatan diagnosa sistem injeksi PGM-FI dan kecepatan overhaul mesin membawa siswa TBSM meraih predikat mekanik pelajar terbaik.',
                'image' => null,
                'description' => "Siswa Teknik & Bisnis Sepeda Motor (TBSM) SMEMSA unjuk kebolehan dalam uji kompetensi pemecahan masalah mesin injeksi (troubleshooting) standar bengkel resmi AHASS.\n\n"
                    .'Pencapaian ini membuka kesempatan langsung bagi siswa untuk memperoleh golden ticket rekrutmen mekanik resmi sebelum lulus.',
            ],
            [
                'slug' => 'tapak-suci-jatim',
                'category' => 'bela-diri',
                'title' => 'Juara Umum 2 Kejuaraan Daerah Tapak Suci Putera Muhammadiyah',
                'field_label' => 'Pencak Silat',
                'level' => 'provinsi',
                'rank' => 'JUARA UMUM 2 KEJURDA',
                'achieved_at' => '2024-08-01',
                'location' => 'Banyuwangi',
                'organizer' => 'Pimpinan Wilayah Tapak Suci Jawa Timur',
                'excerpt' => 'Kontingen pesilat SMEMSA membawa pulang 4 medali emas, 3 perak, dan 2 perunggu dalam kejuaraan tanding dan seni antar perguruan.',
                'image' => 'assets/berita/juara-tapak-suci.jpg',
                'description' => "Kontingen atlet Tapak Suci SMKS Muhammadiyah 1 Genteng tampil perkasa pada Kejuaraan Daerah dengan memborong berbagai kelas tanding dan seni beregu.\n\n"
                    .'Kombinasi ketahanan fisik, penguasaan jurus, dan akhlak sportivitas islami menjadi kunci keberhasilan pesilat sekolah.',
            ],
        ];

        foreach ($achievements as $achievement) {
            $category = $achievement['category'];
            unset($achievement['category']);

            Achievement::updateOrCreate(
                ['slug' => $achievement['slug']],
                $achievement + [
                    'category_id' => $categoryIds[$category] ?? null,
                    'is_featured' => $achievement['is_featured'] ?? false,
                ],
            );
        }
    }
}
