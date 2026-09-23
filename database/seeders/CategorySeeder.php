<?php

namespace Database\Seeders;

use App\Enums\CategoryType;
use App\Models\Category;
use Illuminate\Database\Seeder;

/**
 * Kategori awal, diambil dari label & filter di halaman berita dan prestasi.
 */
class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            CategoryType::Post->value => [
                'akademik' => 'Akademik & TEFA',
                'industri' => 'Kerja Sama Industri',
                'kegiatan' => 'Kegiatan Siswa',
                'prestasi' => 'Prestasi Kejuaraan',
                'pengumuman' => 'Pengumuman & Profil',
            ],
            CategoryType::Achievement->value => [
                'teknologi' => 'Teknologi',
                'bela-diri' => 'Bela Diri',
                'seni' => 'Seni',
                'akademik' => 'Akademik',
                'esports' => 'E-Sports',
            ],
        ];

        foreach ($categories as $type => $items) {
            foreach ($items as $slug => $name) {
                Category::updateOrCreate(['type' => $type, 'slug' => $slug], ['name' => $name]);
            }
        }
    }
}
