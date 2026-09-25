<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

/**
 * Testimoni alumni. Data pertama dipindahkan dari kartu statis beranda,
 * dua data berikutnya adalah contoh (dummy) yang bisa diganti/dihapus di admin.
 * Jalankan setelah MajorSeeder.
 */
class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $majorIds = Major::pluck('id', 'slug');

        $testimonials = [
            [
                'name' => 'Ahmad Rizqi Pratama',
                'major' => 'rpl',
                'graduation_year' => 2025,
                'role' => 'Junior Web Developer',
                'company' => 'PT Digital Kreatif Nusantara',
                'quote' => 'Magang di jurusan PPLG membuat saya langsung diterima kerja sebagai junior developer di software house mitra sekolah, dua minggu setelah kelulusan!',
            ],
            [
                'name' => 'Nadia Putri Lestari',
                'major' => 'ph',
                'graduation_year' => 2024,
                'role' => 'Front Office Agent',
                'company' => 'Hotel Ketapang Indah',
                'quote' => 'Praktik langsung di Edotel SMEMSA melatih saya melayani tamu sungguhan. Saat wawancara kerja, pengalaman itu yang paling ditanyakan.',
            ],
            [
                'name' => 'Rizal Maulana',
                'major' => 'tkj',
                'graduation_year' => 2024,
                'role' => 'Teknisi Jaringan',
                'company' => 'PT Telkom Indonesia (Witel Jatim)',
                'quote' => 'Sertifikasi MikroTik dan praktik fiber optic di TEFA TJKT jadi bekal utama saya lolos rekrutmen teknisi jaringan sebelum wisuda.',
            ],
        ];

        foreach ($testimonials as $index => $data) {
            $majorSlug = $data['major'];
            unset($data['major']);

            Testimonial::updateOrCreate(
                ['name' => $data['name']],
                $data + [
                    'major_id' => $majorIds[$majorSlug] ?? null,
                    'is_published' => true,
                    'sort_order' => $index + 1,
                ],
            );
        }
    }
}
