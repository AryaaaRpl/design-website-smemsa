<?php

namespace Database\Seeders;

use App\Models\BusinessUnit;
use App\Models\Major;
use App\Models\Product;
use App\Support\SiteSettings;
use Illuminate\Database\Seeder;

/**
 * Data awal BLUD, dipindahkan dari data statis beranda.
 * Harga & stok hanya contoh, silakan disesuaikan lewat panel admin.
 */
class BludSeeder extends Seeder
{
    public function run(): void
    {
        $whatsapp = app(SiteSettings::class)->whatsapp();

        foreach ($this->units() as $data) {
            $majorCodes = $data['majors'];
            $products = $data['products'];
            unset($data['majors'], $data['products']);

            $unit = BusinessUnit::updateOrCreate(
                ['slug' => $data['slug']],
                [...$data, 'whatsapp' => $whatsapp, 'is_active' => true],
            );
            $unit->majors()->sync(Major::whereIn('code', $majorCodes)->pluck('id'));

            foreach ($products as $index => $product) {
                Product::updateOrCreate(
                    ['slug' => $product['slug']],
                    [...$product, 'business_unit_id' => $unit->id, 'sort_order' => $index + 1, 'is_active' => true],
                );
            }
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function units(): array
    {
        return [
            [
                'name' => 'SMEMSA Print Studio',
                'slug' => 'smemsa-print-studio',
                'tagline' => 'Percetakan & Merchandise',
                'summary' => 'Layanan cetak banner, sablon kaos, mug merchandise, ID card, dan suvenir komersial berstandar industri.',
                'description' => "Layanan percetakan digital dan cetak merchandise berstandar industri. Melayani pesanan cetak banner outdoor/indoor, sablon kaos custom, mug suvenir, ID card institusi, hingga perlengkapan promosi usaha.\n\nSiswa terlibat langsung dalam proses pra-cetak (setting layout), produksi print/sablon, finishing, quality check, hingga pencatatan transaksi.",
                'image' => 'assets/tefa/totenbag.jpeg',
                'features' => ['Cetak Satuan', 'Hasil Presisi', 'Order Digital'],
                'managed_by' => 'siswa',
                'sort_order' => 1,
                'majors' => ['DKV', 'BD'],
                'products' => [
                    [
                        'name' => 'Totebag Daur Ulang Banner',
                        'slug' => 'totebag-daur-ulang-banner',
                        'tagline' => 'Eco-Fashion Upcycling Bag',
                        'summary' => 'Tas daur ulang ramah lingkungan bermaterial flexi banner bekas event.',
                        'description' => 'Produk ramah lingkungan dari siswa DKV yang mengolah limbah baliho/banner menjadi totebag bergaya urban, tahan air, dan kuat. Setiap tas memiliki corak grafis unik yang tidak ada duanya.',
                        'image' => 'assets/tefa/totenbag.jpeg',
                        'type' => 'barang',
                        'price' => 45000,
                        'price_unit' => 'pcs',
                        'stock' => 20,
                        'specs' => [
                            ['label' => 'Material', 'value' => 'Flexi Banner Recycled + Heavy Webbing Strap'],
                            ['label' => 'Fitur', 'value' => 'Tahan Air, Kapasitas Besar, Jahitan Double Stitch'],
                        ],
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Cetak Banner & Spanduk',
                        'slug' => 'cetak-banner-spanduk',
                        'tagline' => 'Digital Printing Outdoor & Indoor',
                        'summary' => 'Cetak banner, spanduk, dan baliho untuk acara maupun promosi usaha.',
                        'description' => 'Layanan cetak banner dan spanduk dengan mesin digital print resolusi tinggi. Kirimkan desain Anda, atau konsultasikan desain dengan tim siswa DKV.',
                        'type' => 'jasa',
                        'price' => 25000,
                        'price_unit' => 'meter persegi',
                        'specs' => [
                            ['label' => 'Bahan', 'value' => 'Flexi 280 gr / 340 gr'],
                            ['label' => 'Pengerjaan', 'value' => '1–2 hari kerja'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'SMEMSA Tech Solutions',
                'slug' => 'smemsa-tech-solutions',
                'tagline' => 'Service Center & Software',
                'summary' => 'Jasa perbaikan komputer/laptop, instalasi jaringan Wi-Fi/LAN, serta pembuatan website & aplikasi UMKM.',
                'description' => "Pusat layanan teknologi yang melayani perbaikan laptop/PC, instalasi sistem operasi & jaringan Wi-Fi/LAN, hingga pembuatan website dan aplikasi digital untuk instansi & UMKM.\n\nDikerjakan langsung oleh siswa TJKT dan PPLG di bawah bimbingan guru produktif.",
                'image' => 'assets/tefa/jasa-reparasi-komputer.webp',
                'features' => ['Teknisi BNSP', 'Garansi Service', 'NOC Center'],
                'managed_by' => 'siswa',
                'sort_order' => 2,
                'majors' => ['TJKT', 'PPLG'],
                'products' => [
                    [
                        'name' => 'Jasa Reparasi & Instalasi Komputer',
                        'slug' => 'jasa-reparasi-instalasi-komputer',
                        'tagline' => 'Layanan Service Hardware & Networking',
                        'summary' => 'Perbaikan PC, laptop, install OS, dan perawatan jaringan.',
                        'description' => 'Layanan teknis dari TEFA TJKT: perawatan hardware komputer, pembersihan debu & thermal paste, perbaikan software/OS, instalasi driver, hingga setting jaringan Wi-Fi dan LAN untuk rumah & kantor.',
                        'image' => 'assets/tefa/jasa-reparasi-komputer.webp',
                        'type' => 'jasa',
                        'price' => 50000,
                        'price_unit' => 'unit',
                        'specs' => [
                            ['label' => 'Cakupan', 'value' => 'Servis PC/Laptop, Install Windows/Linux, Diagnostic Hardware'],
                            ['label' => 'Garansi', 'value' => 'Garansi service 30 hari'],
                        ],
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'iCareMu',
                        'slug' => 'icaremu',
                        'tagline' => 'Platform Digital Health & Care',
                        'summary' => 'Aplikasi layanan kesehatan & konseling terpadu karya siswa PPLG.',
                        'description' => 'iCareMu adalah aplikasi web dan mobile yang dikembangkan tim TEFA PPLG. Menyediakan fitur reservasi konsultasi, pencatatan rekam medis sederhana, dan notifikasi pengingat kesehatan.',
                        'image' => 'assets/produk/icaremu.jpeg',
                        'type' => 'jasa',
                        'price' => 1500000,
                        'price_unit' => 'lisensi',
                        'specs' => [
                            ['label' => 'Platform', 'value' => 'Web App & Responsive Mobile UI'],
                            ['label' => 'Fitur', 'value' => 'Dashboard Pasien/Konselor, Multi-User, Notifikasi'],
                        ],
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'MinduCare',
                        'slug' => 'minducare',
                        'tagline' => 'Aplikasi EdTech & Self-Assessment',
                        'summary' => 'Aplikasi pencatatan perkembangan karakter & pendampingan konseling.',
                        'description' => 'MinduCare mendukung bimbingan dan konseling berbasis digital: modul evaluasi mandiri, jurnal harian, dan analitik perkembangan siswa yang aman dan privat bagi guru pembimbing.',
                        'image' => 'assets/produk/mindu.jpeg',
                        'type' => 'jasa',
                        'price' => 1500000,
                        'price_unit' => 'lisensi',
                        'specs' => [
                            ['label' => 'Platform', 'value' => 'Cloud-Based Web Application'],
                            ['label' => 'Fitur', 'value' => 'Self-Assessment, Grafik Analitik, Catatan Terenkripsi'],
                        ],
                        'is_featured' => true,
                    ],
                ],
            ],
            [
                'name' => 'SMEMSA Hospitality Hub',
                'slug' => 'smemsa-hospitality-hub',
                'tagline' => 'Edutel & Laundry Center',
                'summary' => 'Pengelolaan Mini Hotel (Edutel), jasa laundry wangi berkualitas, dan produk parfum racikan siswa.',
                'description' => "Unit usaha hospitalitas yang mengoperasikan mini hotel (Edutel), layanan laundry, serta produk parfum hasil praktik siswa Perhotelan.\n\nSiswa mempraktikkan langsung front office, tata graha (housekeeping), hingga administrasi perkantoran.",
                'image' => 'assets/tefa/sunwash.jpeg',
                'features' => ['Standar Hotel', 'Laundry Express', 'Ruang Rapat'],
                'managed_by' => 'siswa',
                'sort_order' => 3,
                'majors' => ['PH', 'MPLB'],
                'products' => [
                    [
                        'name' => 'Eners Perfume',
                        'slug' => 'eners-perfume',
                        'tagline' => 'Parfum Badan Premium',
                        'summary' => 'Parfum badan eksklusif formulasi siswa Perhotelan SMEMSA Genteng.',
                        'description' => 'Eners Perfume adalah produk hasil riset & praktik siswa Perhotelan. Menggunakan bibit parfum pilihan, aman di kulit, tidak meninggalkan noda di pakaian, dan diracik di lab Teaching Factory yang higienis.',
                        'image' => 'assets/produk/produk-parfum-ph.webp',
                        'type' => 'barang',
                        'price' => 35000,
                        'price_unit' => 'botol',
                        'stock' => 30,
                        'variants' => ['Bubblegum', 'Taylor Swift', 'Scandalous', 'Baccarat'],
                        'specs' => [
                            ['label' => 'Kemasan', 'value' => 'Eau de Parfum 35 mL'],
                        ],
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Eners Perfume Laundry',
                        'slug' => 'eners-perfume-laundry',
                        'tagline' => 'Pewangi Laundry Standar Hospitalitas',
                        'summary' => 'Parfum laundry konsentrat tinggi untuk pakaian segar & harum tahan lama.',
                        'description' => 'Diformulasikan oleh tim Teaching Factory Housekeeping Perhotelan untuk kebutuhan laundry hotel dan masyarakat umum. Keharuman bertahan berhari-hari tanpa merusak tekstur pakaian.',
                        'image' => 'assets/produk/produk-ph.webp',
                        'type' => 'barang',
                        'price' => 20000,
                        'price_unit' => 'botol 250 mL',
                        'stock' => 25,
                        'variants' => ['Snappy Fresh', 'Sakura Blossom'],
                        'specs' => [
                            ['label' => 'Kemasan', 'value' => '250 mL'],
                        ],
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Laundry Kiloan',
                        'slug' => 'laundry-kiloan',
                        'tagline' => 'Cuci, Kering & Setrika',
                        'summary' => 'Laundry pakaian harum & higienis dengan standar housekeeping hotel.',
                        'description' => 'Layanan cuci kiloan lengkap: cuci, kering, setrika, dan wangi dengan Eners Perfume Laundry. Dikerjakan siswa Perhotelan dengan SOP housekeeping hotel.',
                        'image' => 'assets/tefa/sunwash.jpeg',
                        'type' => 'jasa',
                        'price' => 7000,
                        'price_unit' => 'kg',
                        'specs' => [
                            ['label' => 'Pengerjaan', 'value' => '2 hari kerja'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'SMEMSA Mart & Business Center',
                'slug' => 'smemsa-mart',
                'tagline' => 'Ritel & Mini Market Siswa',
                'summary' => 'Pusat perbelanjaan perlengkapan sekolah, makanan/minuman produk siswa, dan minimarket berbasis POS Kasir.',
                'description' => "Pusat ritel yang menyediakan ATK, produk makanan/minuman olahan siswa, hingga barang konsumsi harian dengan sistem kasir modern (Point of Sale).\n\nSiswa Bisnis Digital dan AKL berlatih transaksi ritel, visual merchandising, dan pencatatan keuangan.",
                'image' => 'assets/produk/produk-snack-bd.webp',
                'features' => ['Produk Lokal', 'Sistem POS', 'Lengkap & Murah'],
                'managed_by' => 'sekolah',
                'sort_order' => 4,
                'majors' => ['BD', 'AKL'],
                'products' => [
                    [
                        'name' => 'Catet Coffee',
                        'slug' => 'catet-coffee',
                        'tagline' => 'Kopi Sangrai Komunitas IT SMEMSA',
                        'summary' => 'Kopi bubuk nusantara racikan spesial untuk menemani belajar & bekerja.',
                        'description' => 'Catet Coffee adalah produk wirausaha kolaborasi siswa PPLG dan TJKT. Biji kopi arabika/robusta pilihan disangrai medium roast, cocok dinikmati saat belajar dan bekerja.',
                        'image' => 'assets/produk/produk-rpl-tkjt-kopi.webp',
                        'type' => 'barang',
                        'price' => 25000,
                        'price_unit' => 'pouch 100 gr',
                        'stock' => 40,
                        'specs' => [
                            ['label' => 'Kemasan', 'value' => '30 gram (sachet) & 100 gram (pouch)'],
                            ['label' => 'Penyajian', 'value' => 'French Press, V60, Vietnam Drip, Espresso'],
                        ],
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Drasina',
                        'slug' => 'drasina',
                        'tagline' => 'Snack Ladrang Daun Sirih Cina',
                        'summary' => 'Camilan renyah kaya khasiat herbal alami buatan siswa Bisnis Digital.',
                        'description' => 'Drasina (Ladrang Sirih Cina) adalah camilan sehat berbahan daun sirih cina. Gurih, renyah, tanpa pengawet sintetis, dan kaya antioksidan.',
                        'image' => 'assets/produk/produk-snack-bd.webp',
                        'type' => 'barang',
                        'price' => 15000,
                        'price_unit' => 'pouch 200 gr',
                        'stock' => 50,
                        'variants' => ['Gurih Original', 'Pedas Manis'],
                        'specs' => [
                            ['label' => 'Kemasan', 'value' => '200 gram standing pouch'],
                        ],
                        'is_featured' => true,
                    ],
                ],
            ],
        ];
    }
}
