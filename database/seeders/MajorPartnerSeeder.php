<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\Partner;
use Illuminate\Database\Seeder;

/**
 * Relasi mitra industri ↔ jurusan (jurusan A bekerja sama dengan mitra B).
 * Disusun dari data mitra di halaman BKK & mitra per jurusan di data jurusan.
 * Jalankan setelah MajorSeeder & BkkSeeder. Bisa diubah di admin Mitra Industri.
 */
class MajorPartnerSeeder extends Seeder
{
    public function run(): void
    {
        // slug jurusan => nama mitra
        $relations = [
            'rpl' => ['PT. Semesta Multitekno', 'PT. Hummatech', 'PT Digital Kreatif Nusantara'],
            'tkj' => ['PT Telkom Indonesia (Witel Jatim)', 'MicroTik Academy', 'PT. Hummatech'],
            'dkv' => ['Ayu Printing', 'PT Digital Kreatif Nusantara', 'Juragan Tas Online'],
            'bd' => ['Alfamart', 'Indomaret', 'CircleK', 'Juragan Tas Online', 'Surya Mart SMKS Muhammadiyah 1 Genteng', 'Deles Spesial Teh Tarik'],
            'akl' => ['Bank BTPN', 'BTN', 'Bank Muamalat', 'Bank Jatim Syariah Genteng', 'Pegadaian'],
            'mplb' => ['Pegadaian', 'PT. Indo Bismar', 'KDS Genteng', 'PT. Sumber Alam Santoso Pratama'],
            'ph' => ['Hotel Ketapang Indah', 'TERAS Hotel & Villa', 'Gold Vitel Surabaya', 'Rays Hotel VIP', 'New Surya Hotel'],
        ];

        $partnerIds = Partner::pluck('id', 'name');

        foreach ($relations as $slug => $names) {
            $major = Major::firstWhere('slug', $slug);

            if (! $major) {
                continue;
            }

            $ids = collect($names)->map(fn (string $name) => $partnerIds[$name] ?? null)->filter()->all();

            // Tambahkan tanpa menghapus relasi yang sudah diatur admin.
            $major->partners()->syncWithoutDetaching($ids);
        }
    }
}
