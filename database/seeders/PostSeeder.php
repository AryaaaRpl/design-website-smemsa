<?php

namespace Database\Seeders;

use App\Enums\CategoryType;
use App\Enums\PostStatus;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

/**
 * Berita awal, dipindahkan dari data statis halaman berita & beranda.
 * Jalankan setelah CategorySeeder.
 */
class PostSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = Category::ofType(CategoryType::Post)->pluck('id', 'slug');

        $posts = [
            [
                'slug' => 'smks-muhi-genteng-raih-juara-umum-me-awards-2026',
                'category' => 'prestasi',
                'title' => 'SMKS MUHI Genteng Raih Juara Umum ME Awards Tingkat Nasional 2026',
                'excerpt' => 'Delegasi SMKS Muhammadiyah 1 Genteng berhasil menorehkan prestasi gemilang dengan memboyong trofi Juara Umum dalam perhelatan akbar ME Awards 2026.',
                'body' => "Prestasi bersejarah kembali ditorehkan oleh civitas akademika SMKS Muhammadiyah 1 Genteng. Pada ajang bergengsi Muhammadiyah Education Awards (ME Awards) 2026 yang digelar di Surabaya, kontingen SMKS MUHI berhasil menyabet predikat tertinggi sebagai Juara Umum Nasional.\n\n"
                    ."Kemenangan gemilang ini didapatkan setelah perwakilan peserta didik berhasil mendominasi medali emas dan perak di berbagai cabang kompetisi, meliputi Lomba Inovasi Robotika Vokasi, Desain Aplikasi Digital, Pidato Bahasa Asing, dan Manajemen Sekolah Kejuruan Unggul.\n\n"
                    .'Kepala Sekolah menyampaikan rasa syukur mendalam atas dedikasi para guru pembina dan kerja keras seluruh siswa yang pantang menyerah dalam berinovasi dan mengharumkan almamater di tingkat nasional.',
                'thumbnail' => 'assets/juara-me-awards.jpg',
                'location' => 'Surabaya',
                'byline' => 'Tim Jurnalistik',
                'is_featured' => true,
                'published_at' => '2026-06-18 08:00:00',
            ],
            [
                'slug' => 'pengenalan-jurusan-siswa-baru-2026',
                'category' => 'kegiatan',
                'title' => 'SMKS Muhammadiyah 1 Genteng Gelar Pengenalan Jurusan untuk Siswa Baru',
                'excerpt' => 'Ratusan siswa diajak lab tour interaktif dan simulasi dunia kerja agar memiliki arah yang jelas serta mentalitas juara.',
                'body' => "SMKS Muhammadiyah 1 Genteng menyelenggarakan agenda Pengenalan Jurusan secara interaktif untuk seluruh siswa baru tahun ajaran 2026/2027.\n\n"
                    .'Ratusan siswa diajak melakukan tour laboratorium ke masing-masing Teaching Factory (TEFA) jurusan serta mendengarkan pemaparan prospek karier industri langsung dari Kepala Konsentrasi Keahlian agar memiliki peta jalan belajar yang jelas.',
                'thumbnail' => 'assets/berita/mpls.jpeg',
                'location' => 'Kampus MUHI',
                'byline' => 'Tim Kesiswaan MUHI',
                'published_at' => '2026-06-17 08:00:00',
            ],
            [
                'slug' => 'juara-3-kejurprov-taekwondo-antar-pelajar',
                'category' => 'prestasi',
                'title' => 'Dua Siswa SMEMSA Sabet Juara 3 Kejurprov Taekwondo Antar Pelajar',
                'excerpt' => 'Ibellino Novendra dan Ahmad Husaini sukses mengharumkan nama sekolah di tingkat Provinsi Jawa Timur.',
                'body' => "Dua atlet binaan SMKS Muhammadiyah 1 Genteng atas nama Ibellino Novendra dan Ahmad Husaini sukses menyabet juara 3 pada Kejuaraan Provinsi (Kejurprov) Taekwondo Antar Pelajar Jawa Timur.\n\n"
                    .'Capaian prestasi ini menambah deretan piala kejuaraan cabang olahraga bela diri yang berhasil dibawa pulang ke Kampus SMEMSA Genteng.',
                'thumbnail' => 'assets/berita/juara-tapak-suci.jpg',
                'location' => 'Malang, Jatim',
                'byline' => 'Pembina Ekstrakurikuler',
                'published_at' => '2026-06-15 08:00:00',
            ],
            [
                'slug' => 'juara-lomba-karaoke-indonesia-berbakat',
                'category' => 'prestasi',
                'title' => 'Siswi SMEMSA Raih Juara 1 & 2 Lomba Karaoke Indonesia Berbakat',
                'excerpt' => 'Chelsea Princes F. dan Rennyyu Galuh Sivanni tampil gemilang di tingkat Kabupaten Banyuwangi.',
                'body' => "Dua siswi SMKS Muhammadiyah 1 Genteng, Chelsea Princes F. dan Rennyyu Galuh Sivanni, tampil memukau dan berhasil memborong trofi Juara 1 dan Juara 2 dalam ajang Lomba Karaoke Indonesia Berbakat tingkat Kabupaten Banyuwangi.\n\n"
                    .'Keduanya menunjukkan bakat vokal luar biasa yang dikembangkan melalui fasilitas ekstrakurikuler seni musik sekolah.',
                'thumbnail' => 'assets/berita/lomba-karaoke.jpg',
                'location' => 'Banyuwangi',
                'byline' => 'Tim Seni MUHI',
                'published_at' => '2026-06-14 08:00:00',
            ],
            [
                'slug' => 'pembekalan-pkl-siswa-kelas-xi',
                'category' => 'kegiatan',
                'title' => 'Pembekalan Intensif Praktik Kerja Lapangan (PKL) Siswa Kelas XI',
                'excerpt' => 'Membekali peserta didik dengan pengetahuan, etos kerja, dan kesadaran hukum sebelum terjun ke DUDIKA.',
                'body' => "Pokja Hubungan Industri SMKS Muhammadiyah 1 Genteng memberikan pembekalan intensif selama 3 hari bagi seluruh siswa Kelas XI yang akan diberangkatkan menuju perusahaan DUDIKA mitra.\n\n"
                    .'Materi pembekalan berfokus pada etika profesionalitas kerja, budaya K3 (Keselamatan dan Kesehatan Kerja), kedisiplinan industri, serta penulisan laporan PKL berbasis portofolio.',
                'thumbnail' => 'assets/berita/pembekalan-pkl.jpg',
                'location' => 'Aula MUHI',
                'byline' => 'Pokja Humas & DUDIKA',
                'published_at' => '2026-06-13 08:00:00',
            ],
        ];

        foreach ($posts as $post) {
            $category = $post['category'];
            unset($post['category']);

            Post::updateOrCreate(
                ['slug' => $post['slug']],
                $post + [
                    'category_id' => $categoryIds[$category] ?? null,
                    'status' => PostStatus::Published,
                    'is_featured' => $post['is_featured'] ?? false,
                ],
            );
        }
    }
}
