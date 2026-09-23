<?php

namespace Database\Seeders;

use App\Enums\EmploymentType;
use App\Enums\VacancyStatus;
use App\Models\JobVacancy;
use App\Models\Partner;
use Illuminate\Database\Seeder;

/**
 * Data awal BKK: mitra industri & lowongan kerja,
 * dipindahkan dari data statis halaman BKK dan marquee beranda.
 */
class BkkSeeder extends Seeder
{
    public function run(): void
    {
        // Mitra yang logonya tampil di daftar mitra & marquee (urutan sesuai halaman BKK).
        $partners = [
            ['PT. Semesta Multitekno', 'assets/mitra/semesta.webp'],
            ['PT. Hummatech', 'assets/mitra/11.jpg'],
            ['CircleK', 'assets/mitra/3.jpg'],
            ['TERAS Hotel & Villa', 'assets/mitra/10.jpg'],
            ['KDS Genteng', 'assets/mitra/22.jpg'],
            ['Gold Vitel Surabaya', 'assets/mitra/12.jpg'],
            ['Deles Spesial Teh Tarik', 'assets/mitra/2.jpg'],
            ['Rays Hotel VIP', 'assets/mitra/1.jpg'],
            ['PT. Indo Bismar', 'assets/mitra/4.jpg'],
            ['Ayu Printing', 'assets/mitra/5.jpg'],
            ['Bank BTPN', 'assets/mitra/6.jpg'],
            ['Pegadaian', 'assets/mitra/7.jpg'],
            ['Pacific Indonesia', 'assets/mitra/8.jpg'],
            ['LPK Nusantara Gakkou', 'assets/mitra/9.jpg'],
            ['Alfamart', 'assets/mitra/13.jpg'],
            ['Juragan Tas Online', 'assets/mitra/14.jpg'],
            ['MicroTik Academy', 'assets/mitra/15.jpg'],
            ['PT. Sumber Alam Santoso Pratama', 'assets/mitra/16.jpg'],
            ['New Surya Hotel', 'assets/mitra/17.jpg'],
            ['Indomaret', 'assets/mitra/18.jpg'],
            ['BTN', 'assets/mitra/19.jpg'],
            ['Bank Muamalat', 'assets/mitra/20.jpg'],
            ['YAMAHA', 'assets/mitra/21.jpg'],
            ['Surya Mart SMKS Muhammadiyah 1 Genteng', 'assets/mitra/23.jpg'],
        ];

        foreach ($partners as $index => [$name, $logo]) {
            Partner::updateOrCreate(
                ['name' => $name],
                ['slug' => str($name)->slug(), 'logo' => $logo, 'sort_order' => $index + 1, 'is_active' => true],
            );
        }

        // Lowongan dari tabel "Informasi Loker & Magang Terkini".
        // Perusahaannya belum punya logo, jadi disimpan sebagai mitra yang tidak tampil di daftar logo.
        $vacancies = [
            ['PT Digital Kreatif Nusantara', 'Junior Web Developer', EmploymentType::FullTime, 'Surabaya / Banyuwangi'],
            ['Hotel Ketapang Indah', 'PKL Perhotelan & Tata Boga', EmploymentType::Internship, 'Banyuwangi'],
            ['Bank Jatim Syariah Genteng', 'Staff Administrasi Operasional', EmploymentType::FullTime, 'Genteng, Banyuwangi'],
            ['PT Telkom Indonesia (Witel Jatim)', 'Teknisi Jaringan & Fiber Optik', EmploymentType::FullTime, 'Jember / Banyuwangi'],
        ];

        foreach ($vacancies as $index => [$company, $position, $type, $location]) {
            $partner = Partner::firstOrCreate(
                ['name' => $company],
                ['slug' => str($company)->slug(), 'sort_order' => 100 + $index, 'is_active' => false],
            );

            JobVacancy::updateOrCreate(
                ['slug' => str($position)->slug()],
                [
                    'partner_id' => $partner->id,
                    'position' => $position,
                    'employment_type' => $type,
                    'location' => $location,
                    'status' => VacancyStatus::Open,
                    'closes_at' => today()->addDays(30),
                ],
            );
        }
    }
}
