<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

/**
 * Data awal 7 jurusan, dipindahkan dari data statis JavaScript di beranda.
 * Slug memakai key lama (rpl, tkj, ...) agar tombol pintasan jurusan tetap berfungsi.
 */
class MajorSeeder extends Seeder
{
    public function run(): void
    {
        $majors = [
            [
                'slug' => 'rpl',
                'code' => 'PPLG',
                'short_name' => 'PPLG',
                'name' => 'Pengembang Perangkat Lunak & Gim',
                'tefa_name' => 'Software House TEFA SMEMSA & Lab iMac Cloud',
                'certification_summary' => 'LSP-P1 BNSP Junior Web Developer & Cloud Database',
                'logo' => 'assets/major/PPLG-removebg-preview.png',
                'student_photo' => 'assets/major-person/rpl.png',
                'description' => 'Mencetak software engineer berkarakter Islami yang menguasai ekosistem web modern, mobile app development, backend cloud, dan siap terjun ke industri teknologi.',
                'competencies' => [
                    'Web Modern (HTML5, CSS3, JS, Laravel/Node)',
                    'Mobile Application (Flutter & Kotlin)',
                    'Database SQL & Firebase Cloud Server',
                ],
                'practice_items' => [
                    'Pengerjaan proyek sistem informasi & aplikasi web klien.',
                    'Lab iMac & Workstation gigabit standar industri.',
                ],
                'practice_note' => 'Portofolio live production sebelum wisuda.',
                'certification_items' => [
                    'Skema Junior Web Developer & Programmer (BNSP).',
                    'Sertifikasi Internasional Cloud & Database.',
                ],
                'certification_note' => 'Sertifikat Garuda Emas resmi diakui ASEAN.',
                'career_items' => [
                    'Mitra: Semesta Multitekno, Hummatech, Jagoan Hosting.',
                    'Karir: Frontend/Backend Developer, QA, IT Support.',
                ],
                'career_note' => 'Penyaluran via BKK & inkubasi startup.',
            ],
            [
                'slug' => 'tkj',
                'code' => 'TJKT',
                'short_name' => 'TJKT',
                'name' => 'Teknik Jaringan Komputer & Telekomunikasi',
                'tefa_name' => 'ISP & Network Operations Center (NOC) TEFA',
                'certification_summary' => 'LSP-P1 BNSP Network Administrator & MikroTik MTCNA',
                'logo' => 'assets/major/TJKT-removebg-preview.png',
                'student_photo' => 'assets/major-person/tkj.png',
                'description' => 'Spesialisasi arsitektur jaringan skala enterprise, instalasi fiber optic backbone, administrasi server Linux/Cloud, dan protokol pertahanan cyber security.',
                'competencies' => [
                    'Routing-Switching Enterprise (Cisco & MikroTik)',
                    'Instalasi & Splicing Kabel Fiber Optic (FTTH/OTDR)',
                    'Administrasi Cloud Server Linux & Virtualisasi',
                ],
                'practice_items' => [
                    'Pengelolaan infrastruktur internet sekolah 24/7.',
                    'Lab Fiber Optic & Cisco Router Rack industri.',
                ],
                'practice_note' => 'Troubleshooting jaringan live production.',
                'certification_items' => [
                    'LSP-P1 BNSP: Network Administrator Madya & FO.',
                    'Sertifikasi Internasional MikroTik (MTCNA).',
                ],
                'certification_note' => 'Diakui oleh asosiasi APJII seluruh Indonesia.',
                'career_items' => [
                    'Mitra: PT Telkom Indonesia, Telkomsel, Lintasarta.',
                    'Karir: Network Engineer, Cloud Admin, Teknisi FO.',
                ],
                'career_note' => 'Prioritas rekrutmen ISP regional Jawa Timur.',
            ],
            [
                'slug' => 'dkv',
                'code' => 'DKV',
                'short_name' => 'DKV',
                'name' => 'Desain Komunikasi Visual',
                'tefa_name' => 'Studio Creative Agency & Multimedia Lab',
                'certification_summary' => 'LSP-P1 BNSP Desainer Grafis & Adobe Certified Pro',
                'logo' => 'assets/major/dkv.png',
                'student_photo' => 'assets/major-person/dkv.png',
                'description' => 'Pusat eksplorasi visual komersial, produksi video sinematik, animasi motion graphics 2D/3D, branding periklanan, dan perancangan antarmuka digital UI/UX.',
                'competencies' => [
                    'Desain Komersial, Brand Identity & Ilustrasi Vektor',
                    'Videografi Sinematik, Lighting & Audio Engineering',
                    'User Interface & UX Design (Figma & Prototyping)',
                ],
                'practice_items' => [
                    'Pesanan video profil korporat & foto produk UMKM.',
                    'Studio Green Screen & Broadcast Audio Suite.',
                ],
                'practice_note' => 'Produksi konten bernilai jual komersial tinggi.',
                'certification_items' => [
                    'LSP-P1 BNSP: Desainer Grafis Muda & Multimedia.',
                    'Sertifikasi Adobe Certified Professional (Ps, Ai, Pr).',
                ],
                'certification_note' => 'Standar kompetensi industri periklanan kreatif.',
                'career_items' => [
                    'Mitra: Studio Kinetik, Citra Visual, Radar Banyuwangi.',
                    'Karir: UI/UX Designer, Motion Animator, Creative Director.',
                ],
                'career_note' => 'Portofolio aktif Behance/Dribbble siap kerja.',
            ],
            [
                'slug' => 'bd',
                'code' => 'BD',
                'short_name' => 'Bisnis Digital',
                'name' => 'Bisnis Digital',
                'tefa_name' => 'SMEMSA E-Commerce Hub & Live Studio TEFA',
                'certification_summary' => 'LSP-P1 BNSP Toko Daring & Meta Certified Marketing',
                'logo' => 'assets/major/logo bdp.png',
                'student_photo' => 'assets/major-person/BD.png',
                'description' => 'Mengolaborasikan strategi niaga modern dengan teknologi: manajemen marketplace omnichannel, paid digital ads (Meta & Google), live commerce selling, dan analitik data pasar.',
                'competencies' => [
                    'Manajemen Marketplace (Shopee, TikTok Shop, Tokopedia)',
                    'Digital Ads Marketing (Meta Ads, Google Ads & TikTok)',
                    'Live Commerce Broadcasting & Copywriting Persuasif',
                ],
                'practice_items' => [
                    'Studio Live Streaming komersial penjualan harian.',
                    'Mini Fulfillment Center: pergudangan & ekspedisi.',
                ],
                'practice_note' => 'Praktik omzet nyata dan kalkulasi profit harian.',
                'certification_items' => [
                    'LSP-P1 BNSP: Pengelola Toko Daring & Digital Marketer.',
                    'Meta Certified Digital Marketing Associate.',
                ],
                'certification_note' => 'Legalitas kompetensi resmi agensi pemasaran.',
                'career_items' => [
                    'Mitra: Astra International (Digital), JNE, Brand Fashion.',
                    'Karir: E-Commerce Specialist, Ads Optimizer, Live Host.',
                ],
                'career_note' => 'Banyak siswa beromzet mandiri sebelum lulus.',
            ],
            [
                'slug' => 'akl',
                'code' => 'AKL',
                'short_name' => 'Akuntansi',
                'name' => 'Akuntansi & Keuangan Lembaga',
                'tefa_name' => 'Bank Mini Syariah SMEMSA & Tax Center TEFA',
                'certification_summary' => 'LSP-P1 BNSP Teknisi Akuntansi & Accurate Professional',
                'logo' => 'assets/major/logo AKL.png',
                'student_photo' => 'assets/major-person/ak.png',
                'description' => 'Membina teknisi akuntansi handal yang menguasai software akuntansi komputer, perpajakan digital (e-Faktur/e-SPT), audit laporan korporasi, dan layanan perbankan syariah.',
                'competencies' => [
                    'Software Komputer Akuntansi (Accurate & MYOB)',
                    'Perpajakan Digital (e-SPT, e-Faktur, PPh 21/23/PPN)',
                    'Penyusunan Laporan Keuangan Manufaktur & UMKM',
                ],
                'practice_items' => [
                    'Layanan tabungan siswa & simulasi teller perbankan riil.',
                    'Tax Center: konsultasi & pengisian SPT tahunan.',
                ],
                'practice_note' => 'Standar SOP Teller & CS perbankan nasional.',
                'certification_items' => [
                    'LSP-P1 BNSP: Teknisi Akuntansi Yunior & Pajak Terapan.',
                    'Sertifikasi Software Accurate Professional.',
                ],
                'certification_note' => 'Diakui kantor akuntan publik & perbankan.',
                'career_items' => [
                    'Mitra: Bank Jatim Syariah, BSI, BMT Genteng, KAP.',
                    'Karir: Junior Accountant, Tax Officer, Teller Bank, Payroll.',
                ],
                'career_note' => 'Jalur prioritas rekrutmen institusi keuangan.',
            ],
            [
                'slug' => 'mplb',
                'code' => 'MPLB',
                'short_name' => 'Perkantoran',
                'name' => 'Manajemen Perkantoran',
                'tefa_name' => 'SMEMSA Office Service & Executive Meeting Room',
                'certification_summary' => 'LSP-P1 BNSP Administrative Assistant & Digital Office',
                'logo' => 'assets/major/mp.jpeg',
                'student_photo' => 'assets/major-person/mp.png',
                'description' => 'Mencetak staf administrasi eksekutif dan sekretaris cekatan dengan kemampuan public relations prima, otomasi perkantoran digital cloud, dan keprotokolan formal.',
                'competencies' => [
                    'Otomasi Kantor Digital (Google Workspace & ERP Admin)',
                    'Manajemen Kearsipan Elektronik Modern (E-Records)',
                    'Komunikasi Bisnis Internasional & Public Relations',
                ],
                'practice_items' => [
                    'Pusat persuratan terpadu & resepsionis sekolah.',
                    'Executive Meeting Simulator: tata ruang rapat korporat.',
                ],
                'practice_note' => 'Membiasakan etika kantor eksekutif sejak dini.',
                'certification_items' => [
                    'LSP-P1 BNSP: Executive Administrative Assistant & Arsip.',
                    'Sertifikasi Digital Office Professional.',
                ],
                'certification_note' => 'Standarisasi kesekretariatan instansi & BUMN.',
                'career_items' => [
                    'Mitra: Instansi Pemerintah Daerah, PT Pelindo, Notaris.',
                    'Karir: Sekretaris Eksekutif, Front Office Manager, HR Admin.',
                ],
                'career_note' => 'Terserap cepat di BUMN dan korporasi swasta.',
            ],
            [
                'slug' => 'ph',
                'code' => 'PH',
                'short_name' => 'Perhotelan',
                'name' => 'Perhotelan',
                'tefa_name' => 'Edutel Hotel SMEMSA & Mockup Suite Room TEFA',
                'certification_summary' => 'LSP-P1 BNSP Front Office Receptionist & CHSE',
                'logo' => 'assets/major/PH.png',
                'student_photo' => 'assets/major-person/PH.png',
                'description' => 'Menyiapkan tenaga hospitality internasional: keahlian reservasi Front Office, tata graha Housekeeping bintang lima, food & beverage service, serta etiket perjamuan formal.',
                'competencies' => [
                    'Property Management System (Front Office Reservation)',
                    'Housekeeping Bintang Lima & Standard Bed Making',
                    'Food & Beverage Service, Table Manner & Banquet',
                ],
                'practice_items' => [
                    'Fasilitas penginapan riil beroperasi melayani tamu umum.',
                    'Mockup Suite Room, Bar Resto & Commercial Laundry.',
                ],
                'practice_note' => 'Pengalaman melayani tamu standar hotel bintang 5.',
                'certification_items' => [
                    'LSP-P1 BNSP: Front Office Receptionist & Housekeeper.',
                    'Sertifikasi Kebersihan & Keselamatan Hotel (CHSE).',
                ],
                'certification_note' => 'Diakui jaringan hotel internasional & kapal pesiar.',
                'career_items' => [
                    'Mitra: Hotel Ketapang Indah, Dialoog Banyuwangi, Aston.',
                    'Karir: Front Desk Agent, Housekeeper, F&B Captain, GRO.',
                ],
                'career_note' => 'Peluang magang hotel resort Bali & kapal pesiar.',
            ],
        ];

        foreach ($majors as $index => $major) {
            Major::updateOrCreate(
                ['code' => $major['code']],
                $major + ['sort_order' => $index + 1, 'is_active' => true],
            );
        }
    }
}
