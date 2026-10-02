<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

/**
 * 5 FAQ dari halaman SPMB sebelumnya (data statis).
 */
class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['Kapan periode pendaftaran siswa baru Tahun Ajaran {tahun_ajaran} dibuka?', 'Pendaftaran gelombang awal telah dibuka secara online dan offline. Anda dapat langsung berkonsultasi dan mendaftar melalui sekretariat sekolah atau via WhatsApp resmi panitia.'],
            ['Bagaimana mekanisme cicilan biaya pendidikan (PSM)?', 'Biaya PSM 1 Tahun sebesar {biaya_psm} dapat dicicil 2 kali per semester ({cicilan_psm} per semester) pada Semester Ganjil dan Genap guna memberikan fleksibilitas pembayaran.'],
            ['Berapa lama masa berlaku beasiswa di SMKS Muhammadiyah 1 Genteng?', 'Beasiswa sosial/afirmasi (Yatim Piatu, Yatim/Piatu, Tidak Mampu) dan Beasiswa Hafidz 30 Juz berlaku selama 3 tahun penuh (Kelas X, XI, dan XII). Sedangkan Voucher Early Bird Rp 1.000.000 berlaku khusus untuk pemotongan biaya PSM di tahun pertama (Kelas X).'],
            ['Apakah Voucher 100 Pendaftar Pertama bisa digabung dengan beasiswa lain?', 'Ya, Voucher Early Bird pendaftaran awal dapat dikombinasikan dengan salah satu beasiswa alumni (SMP/SD Muhammadiyah) atau beasiswa prestasi. Untuk beasiswa gratis 100% (Yatim Piatu / Tahfidz 30 Juz), biaya sudah otomatis bebas sepenuhnya.'],
            ['Apakah calon siswa boleh memilih konsentrasi keahlian cadangan?', 'Ya, calon siswa dapat memilih jurusan prioritas utama dan jurusan alternatif cadangan saat mengisi formulir pendaftaran.'],
        ];

        foreach ($faqs as $index => [$question, $answer]) {
            Faq::updateOrCreate(['question' => $question], ['answer' => $answer, 'sort_order' => $index + 1]);
        }
    }
}
