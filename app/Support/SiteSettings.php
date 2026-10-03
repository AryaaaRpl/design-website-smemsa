<?php

namespace App\Support;

use App\Models\Setting;

/**
 * Daftar pengaturan situs & cara membacanya.
 * Nilai awal ('default') diisikan ke database oleh SettingSeeder; di kode tetap jadi cadangan bila barisnya belum ada.
 *
 * Tersedia di semua view sebagai $site, contoh: {{ $site->get('npsn') }}.
 */
class SiteSettings
{
    /**
     * Definisi pengaturan per tab.
     * type: text | textarea | url | number | whatsapp
     */
    public const GROUPS = [
        'identity' => [
            'label' => 'Identitas',
            'fields' => [
                'npsn' => [
                    'label' => 'NPSN',
                    'placeholder' => '12345678',
                    'type' => 'text',
                    'default' => '20525597',
                    'rules' => ['required', 'digits_between:6,10'],
                    'help' => 'Footer, navbar, halaman LSP.',
                ],
                'accreditation' => [
                    'label' => 'Akreditasi',
                    'placeholder' => 'A',
                    'type' => 'text',
                    'default' => 'A',
                    'rules' => ['required', 'string', 'max:5'],
                    'help' => 'Nilai akreditasi, contoh: A. Footer, navbar, statistik beranda.',
                ],
                'accreditation_predicate' => [
                    'label' => 'Predikat Akreditasi',
                    'placeholder' => 'Unggul',
                    'type' => 'text',
                    'default' => 'Unggul',
                    'rules' => ['required', 'string', 'max:30'],
                    'help' => 'Contoh: Unggul. Footer & statistik beranda.',
                ],
                'founded_year' => [
                    'label' => 'Tahun Berdiri',
                    'placeholder' => '1968',
                    'type' => 'number',
                    'default' => '1968',
                    'rules' => ['required', 'integer', 'min:1900', 'max:2100'],
                    'help' => 'Statistik beranda & halaman prestasi. Lama pengabdian (Th) dihitung otomatis.',
                ],
            ],
        ],
        'contact' => [
            'label' => 'Kontak',
            'fields' => [
                'address' => [
                    'label' => 'Alamat',
                    'placeholder' => 'Jl. Contoh No. 1, Kecamatan, Kabupaten, Provinsi 12345',
                    'type' => 'textarea',
                    'default' => 'Jl. KH. Ahmad Dahlan / Jl. KH Imam Bahri No.10, Dusun Krajan, Genteng Wetan, Kec. Genteng, Kabupaten Banyuwangi, Jawa Timur 68465',
                    'rules' => ['required', 'string', 'max:300'],
                    'help' => 'Footer, halaman SPMB, chatbot, data SEO.',
                ],
                'phone' => [
                    'label' => 'Telepon Kantor',
                    'placeholder' => '(0333) 123456',
                    'type' => 'text',
                    'default' => '(0333) 845605',
                    'rules' => ['required', 'string', 'max:30', 'regex:/^[0-9()+\-\s]+$/'],
                    'help' => 'Contoh: (0333) 845605. Footer & halaman SPMB.',
                ],
                'email' => [
                    'label' => 'Email',
                    'placeholder' => 'info@sekolah.sch.id',
                    'type' => 'text',
                    'default' => 'smkmuhi.genteng1968@gmail.com',
                    'rules' => ['required', 'email', 'max:100'],
                    'help' => 'Footer & data SEO.',
                ],
                'whatsapp' => [
                    'label' => 'WhatsApp Umum',
                    'placeholder' => '0812-3456-7890',
                    'type' => 'whatsapp',
                    'default' => '6282241356668',
                    'rules' => ['required', 'regex:/^62[0-9]{8,13}$/'],
                    'help' => 'Footer & chatbot. Boleh ditulis 0822..., otomatis diubah ke 62822...',
                ],
                'whatsapp_bkk' => [
                    'label' => 'WhatsApp BKK',
                    'placeholder' => 'Kosongkan untuk memakai WhatsApp Umum',
                    'type' => 'whatsapp',
                    'default' => null,
                    'rules' => ['nullable', 'regex:/^62[0-9]{8,13}$/'],
                    'help' => 'Tombol "Lamar Loker" di halaman BKK. Kosongkan untuk memakai WhatsApp Umum.',
                ],
                'maps_url' => [
                    'label' => 'Link Google Maps',
                    'placeholder' => 'https://maps.app.goo.gl/...',
                    'type' => 'url',
                    'default' => 'https://maps.google.com/?q=SMKS+Muhammadiyah+1+Genteng',
                    'rules' => ['required', 'url', 'max:500'],
                    'help' => 'Tombol petunjuk arah di halaman SPMB.',
                ],
                'maps_embed_url' => [
                    'label' => 'Link Embed Google Maps',
                    'placeholder' => 'https://www.google.com/maps/embed?pb=...',
                    'type' => 'url',
                    'default' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3947.4960283657647!2d114.155154175011!3d-8.35276589168399!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd154d9bec38cf9%3A0x8c62fbc05274d015!2sSMK%20Muhammadiyah%201%20Genteng!5e0!3m2!1sid!2sid!4v1787989542669!5m2!1sid!2sid',
                    'rules' => ['required', 'url', 'max:1000', 'starts_with:https://www.google.com/maps/embed'],
                    'help' => 'Peta di footer. Ambil dari Google Maps → Bagikan → Sematkan peta → salin isi src="...".',
                ],
            ],
        ],
        'social' => [
            'label' => 'Media Sosial',
            'fields' => [
                'instagram_url' => [
                    'label' => 'Instagram',
                    'placeholder' => 'https://www.instagram.com/namaakun',
                    'type' => 'url',
                    'default' => 'https://www.instagram.com/smkmuhigts/',
                    'rules' => ['nullable', 'url', 'max:255'],
                    'help' => 'Ikon di footer.',
                ],
                'youtube_url' => [
                    'label' => 'YouTube',
                    'placeholder' => 'https://www.youtube.com/@namaakun',
                    'type' => 'url',
                    'default' => 'https://www.youtube.com/@smkmuhigts',
                    'rules' => ['nullable', 'url', 'max:255'],
                    'help' => 'Ikon di footer.',
                ],
                'facebook_url' => [
                    'label' => 'Facebook',
                    'placeholder' => 'https://www.facebook.com/namaakun',
                    'type' => 'url',
                    'default' => 'https://www.facebook.com/smkmuhigts',
                    'rules' => ['nullable', 'url', 'max:255'],
                    'help' => 'Ikon di footer.',
                ],
                'tiktok_url' => [
                    'label' => 'TikTok',
                    'placeholder' => 'https://www.tiktok.com/@namaakun',
                    'type' => 'url',
                    'default' => 'https://www.tiktok.com/@smkmuhigts',
                    'rules' => ['nullable', 'url', 'max:255'],
                    'help' => 'Ikon di footer.',
                ],
            ],
        ],
        'stats' => [
            'label' => 'Statistik',
            'fields' => [
                'employment_rate' => [
                    'label' => 'Serapan Kerja Alumni (%)',
                    'placeholder' => '92.4',
                    'type' => 'number',
                    'default' => '92.4',
                    'rules' => ['required', 'numeric', 'between:0,100'],
                    'help' => 'Hero beranda & halaman BKK. Boleh desimal, contoh: 92.4',
                ],
                'graduates_absorbed' => [
                    'label' => 'Lulusan Terserap Tahun Terakhir',
                    'placeholder' => '450',
                    'type' => 'number',
                    'default' => '450',
                    'rules' => ['required', 'integer', 'min:0'],
                    'help' => 'Banner halaman BKK (tampil dengan tanda +).',
                ],
                'vacancies_per_year' => [
                    'label' => 'Lowongan Kerja per Tahun',
                    'placeholder' => '85',
                    'type' => 'number',
                    'default' => '85',
                    'rules' => ['required', 'integer', 'min:0'],
                    'help' => 'Statistik halaman BKK (tampil dengan tanda +).',
                ],
                'student_count' => [
                    'label' => 'Jumlah Siswa',
                    'placeholder' => '1135',
                    'type' => 'number',
                    'default' => '1135',
                    'rules' => ['required', 'integer', 'min:0'],
                    'help' => 'Hero beranda.',
                ],
                'achievement_count' => [
                    'label' => 'Jumlah Prestasi',
                    'placeholder' => '1000',
                    'type' => 'number',
                    'default' => '1000',
                    'rules' => ['required', 'integer', 'min:0'],
                    'help' => 'Hero beranda.',
                ],
                'trophy_count' => [
                    'label' => 'Piala Kejuaraan Daerah & Jatim',
                    'placeholder' => '48',
                    'type' => 'number',
                    'default' => '48',
                    'rules' => ['required', 'integer', 'min:0'],
                    'help' => 'Statistik halaman prestasi (tampil dengan tanda +).',
                ],
                'bnsp_rate' => [
                    'label' => 'Kelulusan Bersertifikasi BNSP (%)',
                    'placeholder' => '100',
                    'type' => 'number',
                    'default' => '100',
                    'rules' => ['required', 'numeric', 'between:0,100'],
                    'help' => 'Statistik halaman prestasi.',
                ],
            ],
        ],
        'spmb' => [
            'label' => 'SPMB',
            'fields' => [
                'spmb_academic_year' => [
                    'label' => 'Tahun Ajaran',
                    'placeholder' => '2026/2027',
                    'type' => 'text',
                    'default' => '2026/2027',
                    'rules' => ['required', 'regex:/^\d{4}\/\d{4}$/'],
                    'help' => 'Format 2026/2027. Tombol "Daftar SPMB 2026" memakai tahun pertama.',
                ],
                'whatsapp_spmb' => [
                    'label' => 'WhatsApp Panitia SPMB',
                    'placeholder' => 'Kosongkan untuk memakai WhatsApp Umum',
                    'type' => 'whatsapp',
                    'default' => null,
                    'rules' => ['nullable', 'regex:/^62[0-9]{8,13}$/'],
                    'help' => 'Halaman SPMB & chatbot. Kosongkan untuk memakai WhatsApp Umum.',
                ],
            ],
        ],
        'fees' => [
            'label' => 'Biaya SPMB',
            'fields' => [
                'fee_uniform_male' => [
                    'label' => 'Seragam Laki-laki',
                    'placeholder' => '1550000',
                    'type' => 'money',
                    'default' => '1550000',
                    'rules' => ['required', 'integer', 'min:0', 'max:100000000'],
                    'help' => 'Rupiah tanpa titik, contoh: 1550000. Sekali bayar saat masuk.',
                ],
                'fee_uniform_male_note' => [
                    'label' => 'Isi Paket Seragam Laki-laki',
                    'placeholder' => 'Isi paket seragam, contoh: seragam kejuruan, batik, olahraga, jas almamater.',
                    'type' => 'textarea',
                    'default' => 'Termasuk paket seragam kejuruan lengkap, seragam khas sekolah/batik, seragam olahraga, jas almamater, dan atribut sekolah.',
                    'rules' => ['required', 'string', 'max:300'],
                    'help' => 'Keterangan di bawah harga seragam.',
                ],
                'fee_uniform_female' => [
                    'label' => 'Seragam Perempuan',
                    'placeholder' => '1700000',
                    'type' => 'money',
                    'default' => '1700000',
                    'rules' => ['required', 'integer', 'min:0', 'max:100000000'],
                    'help' => 'Rupiah tanpa titik. Sekali bayar saat masuk.',
                ],
                'fee_uniform_female_note' => [
                    'label' => 'Isi Paket Seragam Perempuan',
                    'placeholder' => 'Isi paket seragam, contoh: seragam kejuruan muslimah, jilbab, olahraga, jas almamater.',
                    'type' => 'textarea',
                    'default' => 'Termasuk paket seragam kejuruan muslimah lengkap, rok panjang, jilbab seragam, seragam olahraga, jas almamater, dan atribut.',
                    'rules' => ['required', 'string', 'max:300'],
                    'help' => 'Keterangan di bawah harga seragam.',
                ],
                'fee_tuition' => [
                    'label' => 'Biaya PSM 1 Tahun',
                    'placeholder' => '6350000',
                    'type' => 'money',
                    'default' => '6350000',
                    'rules' => ['required', 'integer', 'min:0', 'max:100000000'],
                    'help' => 'Sama untuk kelas X, XI, XII. Cicilan per semester dihitung otomatis (dibagi 2).',
                ],
                'fee_pkl_local' => [
                    'label' => 'PKL Dalam Kota (Kelas XI)',
                    'placeholder' => '950000',
                    'type' => 'money',
                    'default' => '950000',
                    'rules' => ['required', 'integer', 'min:0', 'max:100000000'],
                    'help' => 'Total kelas XI dihitung otomatis: PSM + PKL.',
                ],
                'fee_pkl_outside' => [
                    'label' => 'PKL Luar Kota (Kelas XI)',
                    'placeholder' => '1200000',
                    'type' => 'money',
                    'default' => '1200000',
                    'rules' => ['required', 'integer', 'min:0', 'max:100000000'],
                    'help' => 'Total kelas XI dihitung otomatis: PSM + PKL.',
                ],
                'fee_certification' => [
                    'label' => 'Biaya UKK & LSP (Kelas XII)',
                    'placeholder' => '1250000',
                    'type' => 'money',
                    'default' => '1250000',
                    'rules' => ['required', 'integer', 'min:0', 'max:100000000'],
                    'help' => 'Total kelas XII dihitung otomatis: PSM + UKK & LSP.',
                ],
            ],
        ],
    ];

    /**
     * Nilai tersimpan, dimuat sekali saat pertama dibutuhkan.
     *
     * @var array<string, string|null>|null
     */
    private ?array $values = null;

    /**
     * Nilai pengaturan. Jika kosong, pakai nilai bawaan.
     */
    public function get(string $key): ?string
    {
        $this->values ??= Setting::allValues();

        // Sudah tersimpan (boleh kosong, misal sosial media yang tidak dipakai): pakai itu. Belum ada: nilai awal.
        if (array_key_exists($key, $this->values)) {
            return filled($this->values[$key]) ? (string) $this->values[$key] : null;
        }

        return self::field($key)['default'] ?? null;
    }

    /**
     * Semua nilai awal: kunci => nilai (yang punya nilai saja).
     *
     * @return array<string, string>
     */
    public static function defaults(): array
    {
        return collect(self::GROUPS)
            ->flatMap(fn (array $group) => array_map(fn (array $field) => $field['default'], $group['fields']))
            ->filter(fn ($value) => filled($value))
            ->all();
    }

    /**
     * Definisi satu pengaturan.
     *
     * @return array<string, mixed>
     */
    public static function field(string $key): array
    {
        foreach (self::GROUPS as $group) {
            if (isset($group['fields'][$key])) {
                return $group['fields'][$key];
            }
        }

        return [];
    }

    /**
     * Rapikan nomor WhatsApp: "0822-4135-6668" / "+62 822..." menjadi "6282241356668".
     */
    public static function normalizeWhatsapp(?string $number): ?string
    {
        $digits = preg_replace('/\D/', '', (string) $number);

        if ($digits === '') {
            return null;
        }

        return match (true) {
            str_starts_with($digits, '0') => '62'.substr($digits, 1),
            str_starts_with($digits, '8') => '62'.$digits,
            default => $digits,
        };
    }

    /**
     * Nomor WhatsApp per keperluan: 'umum', 'bkk', 'spmb'. BKK & SPMB kosong = pakai nomor umum.
     */
    public function whatsapp(string $channel = 'umum'): string
    {
        $key = ['bkk' => 'whatsapp_bkk', 'spmb' => 'whatsapp_spmb'][$channel] ?? 'whatsapp';

        return $this->get($key) ?? $this->get('whatsapp');
    }

    /**
     * Link wa.me, opsional dengan pesan awal.
     */
    public function whatsappLink(string $channel = 'umum', ?string $message = null): string
    {
        return 'https://wa.me/'.$this->whatsapp($channel).($message ? '?text='.rawurlencode($message) : '');
    }

    /**
     * Format tampilan nomor WhatsApp: "6282241356668" menjadi "0822-4135-6668".
     */
    public function whatsappDisplay(string $channel = 'umum'): string
    {
        $local = '0'.substr($this->whatsapp($channel), 2);

        return implode('-', array_filter([substr($local, 0, 4), substr($local, 4, 4), substr($local, 8)]));
    }

    /**
     * Nomor telepon untuk link tel: (hanya angka).
     */
    public function phoneLink(): string
    {
        return preg_replace('/\D/', '', (string) $this->get('phone'));
    }

    /**
     * Nomor telepon format internasional untuk data SEO, contoh: +62-333-845605.
     */
    public function phoneInternational(): string
    {
        $digits = ltrim($this->phoneLink(), '0');

        return '+62-'.substr($digits, 0, 3).'-'.substr($digits, 3);
    }

    /**
     * Tahun pertama tahun ajaran SPMB, contoh: "2026/2027" menjadi "2026".
     */
    public function spmbYear(): string
    {
        return strtok((string) $this->get('spmb_academic_year'), '/');
    }

    /**
     * Lama pengabdian sejak tahun berdiri, contoh: 1968 → 58 (tahun 2026).
     */
    public function yearsServing(): int
    {
        return max(0, (int) now()->year - (int) $this->get('founded_year'));
    }

    /**
     * Format rupiah dari angka atau kunci pengaturan, contoh: 6350000 → "Rp 6.350.000".
     */
    public function rupiah(int|string $amount): string
    {
        $value = is_int($amount) ? $amount : (int) $this->get($amount);

        return 'Rp '.number_format($value, 0, ',', '.');
    }

    /**
     * Persentase tanpa nol di belakang koma, dengan pemisah desimal sesuai desain halaman.
     * Contoh: 92.40 → "92,4" (beranda) atau "92.4" (BKK).
     */
    public function percent(string $key, string $decimalSeparator = '.'): string
    {
        $value = rtrim(rtrim(number_format((float) $this->get($key), 2, '.', ''), '0'), '.');

        return str_replace('.', $decimalSeparator, $value);
    }
}
