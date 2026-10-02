<?php

namespace Database\Seeders;

use App\Models\Scholarship;
use Illuminate\Database\Seeder;

/**
 * 9 skema beasiswa dari halaman SPMB sebelumnya (data statis).
 */
class ScholarshipSeeder extends Seeder
{
    public function run(): void
    {
        $scholarships = [
            ['Voucher Early Bird', '100 Pendaftar Pertama', 'amber', 'Khusus 100 pendaftar pertama pada gelombang awal. <em>Potongan langsung pada biaya PSM Tahun Pertama (Kelas X) & dapat dikombinasikan dengan beasiswa prestasi/alumni.</em>', 'PSM Thn Pertama (Kelas X)', 'Potongan Rp 1.000.000', 'highlight'],
            ['Beasiswa Alumni Muhammadiyah – SD', 'Jalur Alumni', 'blue', 'Bagi calon peserta didik yang merupakan <strong>alumni SD / MI Muhammadiyah</strong>.', 'Sekali (Daftar Ulang)', 'Potongan Rp 200.000', 'nominal'],
            ['Beasiswa Alumni Muhammadiyah – SMP', 'Jalur Alumni', 'blue', 'Bagi calon peserta didik lulusan dari <strong>SMP / MTs Muhammadiyah</strong>.', 'Sekali (Daftar Ulang)', 'Potongan Rp 500.000', 'nominal'],
            ['Beasiswa Orang Tua Alumni SMK', 'Keluarga Alumni', 'slate', 'Bagi calon siswa yang <strong>orang tuanya merupakan alumni SMK Muhammadiyah</strong>.', 'Sekali (Daftar Ulang)', 'Potongan Rp 500.000', 'nominal'],
            ['Beasiswa Berprestasi', 'Akademik & Non-Akademik', 'blue', 'Bagi siswa dengan <strong>prestasi akademik atau non-akademik</strong> (kejuaraan olahraga/seni/sains).', 'Sekali (Daftar Ulang)', 'Potongan Rp 500.000', 'nominal'],
            ['Beasiswa Tidak Mampu (Afirmasi)', 'KIP / PKH / SKTM', 'blue', 'Bagi siswa dari <strong>keluarga kurang mampu</strong> (pemegang KIP/PKH/SKTM kelurahan).', 'Berlaku 3 Tahun', 'Potongan 50% / Tahun', 'discount'],
            ['Beasiswa Yatim atau Piatu', 'Sosial Afirmasi', 'blue', 'Bagi calon siswa dengan <strong>salah satu orang tua (ayah atau ibu) telah wafat</strong>.', 'Berlaku 3 Tahun', 'Potongan 50% / Tahun', 'discount'],
            ['Beasiswa Yatim Piatu', 'Bebas Biaya 100%', 'green', 'Bagi calon siswa yang <strong>kedua orang tuanya telah wafat</strong>. Bebas biaya pendidikan 100% selama 3 tahun.', 'Berlaku 3 Tahun Penuh', 'Gratis 100% (Bebas Biaya 3 Thn)', 'free'],
            ['Beasiswa Hafidz 30 Juz', 'Bebas Biaya 100%', 'green', "Bagi penghafal <strong>Al-Qur'an 30 Juz</strong> dengan syahadah resmi. Bebas biaya pendidikan 100% selama 3 tahun.", 'Berlaku 3 Tahun Penuh', 'Gratis 100% (Bebas Biaya 3 Thn)', 'free'],
        ];

        foreach ($scholarships as $index => [$name, $tag, $color, $description, $period, $amount, $tone]) {
            Scholarship::updateOrCreate(['name' => $name], [
                'tag' => $tag, 'tag_color' => $color, 'description' => $description,
                'period' => $period, 'amount' => $amount, 'tone' => $tone, 'sort_order' => $index + 1,
            ]);
        }
    }
}
