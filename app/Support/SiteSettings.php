<?php

namespace App\Support;

use App\Models\Setting;

/**
 * Daftar pengaturan situs & cara membacanya.
 * Jika pengaturan kosong, website memakai nilai bawaan ('default') sebagai data dummy.
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
                    'type' => 'text',
                    'default' => '20525597',
                    'rules' => ['nullable', 'digits_between:6,10'],
                    'help' => 'Footer, navbar, halaman LSP.',
                ],
                'accreditation' => [
                    'label' => 'Akreditasi',
                    'type' => 'text',
                    'default' => 'A',
                    'rules' => ['nullable', 'string', 'max:5'],
                    'help' => 'Nilai akreditasi, contoh: A. Footer, navbar, statistik beranda.',
                ],
                'accreditation_predicate' => [
                    'label' => 'Predikat Akreditasi',
                    'type' => 'text',
                    'default' => 'Unggul',
                    'rules' => ['nullable', 'string', 'max:30'],
                    'help' => 'Contoh: Unggul. Footer & statistik beranda.',
                ],
                'founded_year' => [
                    'label' => 'Tahun Berdiri',
                    'type' => 'number',
                    'default' => '1968',
                    'rules' => ['nullable', 'integer', 'min:1900', 'max:2100'],
                    'help' => 'Statistik beranda & halaman prestasi. Lama pengabdian (Th) dihitung otomatis.',
                ],
            ],
        ],
        'contact' => [
            'label' => 'Kontak',
            'fields' => [
                'address' => [
                    'label' => 'Alamat',
                    'type' => 'textarea',
                    'default' => 'Jl. KH. Ahmad Dahlan / Jl. KH Imam Bahri No.10, Dusun Krajan, Genteng Wetan, Kec. Genteng, Kabupaten Banyuwangi, Jawa Timur 68465',
                    'rules' => ['nullable', 'string', 'max:300'],
                    'help' => 'Footer, halaman SPMB, chatbot, data SEO.',
                ],
                'phone' => [
                    'label' => 'Telepon Kantor',
                    'type' => 'text',
                    'default' => '(0333) 845605',
                    'rules' => ['nullable', 'string', 'max:30', 'regex:/^[0-9()+\-\s]+$/'],
                    'help' => 'Contoh: (0333) 845605. Footer & halaman SPMB.',
                ],
                'email' => [
                    'label' => 'Email',
                    'type' => 'text',
                    'default' => 'smkmuhi.genteng1968@gmail.com',
                    'rules' => ['nullable', 'email', 'max:100'],
                    'help' => 'Footer & data SEO.',
                ],
                'whatsapp' => [
                    'label' => 'WhatsApp Umum',
                    'type' => 'whatsapp',
                    'default' => '6282241356668',
                    'rules' => ['nullable', 'regex:/^62[0-9]{8,13}$/'],
                    'help' => 'Footer & chatbot. Boleh ditulis 0822..., otomatis diubah ke 62822...',
                ],
                'whatsapp_bkk' => [
                    'label' => 'WhatsApp BKK',
                    'type' => 'whatsapp',
                    'default' => null,
                    'rules' => ['nullable', 'regex:/^62[0-9]{8,13}$/'],
                    'help' => 'Tombol "Lamar Loker" di halaman BKK. Kosongkan untuk memakai WhatsApp Umum.',
                ],
                'maps_url' => [
                    'label' => 'Link Google Maps',
                    'type' => 'url',
                    'default' => 'https://maps.google.com/?q=SMKS+Muhammadiyah+1+Genteng',
                    'rules' => ['nullable', 'url', 'max:500'],
                    'help' => 'Tombol petunjuk arah di halaman SPMB.',
                ],
                'maps_embed_url' => [
                    'label' => 'Link Embed Google Maps',
                    'type' => 'url',
                    'default' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3947.4960283657647!2d114.155154175011!3d-8.35276589168399!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd154d9bec38cf9%3A0x8c62fbc05274d015!2sSMK%20Muhammadiyah%201%20Genteng!5e0!3m2!1sid!2sid!4v1787989542669!5m2!1sid!2sid',
                    'rules' => ['nullable', 'url', 'max:1000', 'starts_with:https://www.google.com/maps/embed'],
                    'help' => 'Peta di footer. Ambil dari Google Maps → Bagikan → Sematkan peta → salin isi src="...".',
                ],
            ],
        ],
        'social' => [
            'label' => 'Media Sosial',
            'fields' => [
                'instagram_url' => [
                    'label' => 'Instagram',
                    'type' => 'url',
                    'default' => 'https://www.instagram.com/smkmuhigts/',
                    'rules' => ['nullable', 'url', 'max:255'],
                    'help' => 'Ikon di footer.',
                ],
                'youtube_url' => [
                    'label' => 'YouTube',
                    'type' => 'url',
                    'default' => 'https://www.youtube.com/@smkmuhigts',
                    'rules' => ['nullable', 'url', 'max:255'],
                    'help' => 'Ikon di footer.',
                ],
                'facebook_url' => [
                    'label' => 'Facebook',
                    'type' => 'url',
                    'default' => 'https://www.facebook.com/smkmuhigts',
                    'rules' => ['nullable', 'url', 'max:255'],
                    'help' => 'Ikon di footer.',
                ],
                'tiktok_url' => [
                    'label' => 'TikTok',
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
                    'type' => 'number',
                    'default' => '92.4',
                    'rules' => ['nullable', 'numeric', 'between:0,100'],
                    'help' => 'Hero beranda & halaman BKK. Boleh desimal, contoh: 92.4',
                ],
                'graduates_absorbed' => [
                    'label' => 'Lulusan Terserap Tahun Terakhir',
                    'type' => 'number',
                    'default' => '450',
                    'rules' => ['nullable', 'integer', 'min:0'],
                    'help' => 'Banner halaman BKK (tampil dengan tanda +).',
                ],
                'vacancies_per_year' => [
                    'label' => 'Lowongan Kerja per Tahun',
                    'type' => 'number',
                    'default' => '85',
                    'rules' => ['nullable', 'integer', 'min:0'],
                    'help' => 'Statistik halaman BKK (tampil dengan tanda +).',
                ],
                'student_count' => [
                    'label' => 'Jumlah Siswa',
                    'type' => 'number',
                    'default' => '1135',
                    'rules' => ['nullable', 'integer', 'min:0'],
                    'help' => 'Hero beranda.',
                ],
                'achievement_count' => [
                    'label' => 'Jumlah Prestasi',
                    'type' => 'number',
                    'default' => '1000',
                    'rules' => ['nullable', 'integer', 'min:0'],
                    'help' => 'Hero beranda.',
                ],
                'trophy_count' => [
                    'label' => 'Piala Kejuaraan Daerah & Jatim',
                    'type' => 'number',
                    'default' => '48',
                    'rules' => ['nullable', 'integer', 'min:0'],
                    'help' => 'Statistik halaman prestasi (tampil dengan tanda +).',
                ],
                'bnsp_rate' => [
                    'label' => 'Kelulusan Bersertifikasi BNSP (%)',
                    'type' => 'number',
                    'default' => '100',
                    'rules' => ['nullable', 'numeric', 'between:0,100'],
                    'help' => 'Statistik halaman prestasi.',
                ],
            ],
        ],
        'spmb' => [
            'label' => 'SPMB',
            'fields' => [
                'spmb_academic_year' => [
                    'label' => 'Tahun Ajaran',
                    'type' => 'text',
                    'default' => '2026/2027',
                    'rules' => ['nullable', 'regex:/^\d{4}\/\d{4}$/'],
                    'help' => 'Format 2026/2027. Tombol "Daftar SPMB 2026" memakai tahun pertama.',
                ],
                'whatsapp_spmb' => [
                    'label' => 'WhatsApp Panitia SPMB',
                    'type' => 'whatsapp',
                    'default' => null,
                    'rules' => ['nullable', 'regex:/^62[0-9]{8,13}$/'],
                    'help' => 'Halaman SPMB & chatbot. Kosongkan untuk memakai WhatsApp Umum.',
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
        $value = $this->values[$key] ?? null;

        return filled($value) ? (string) $value : self::field($key)['default'] ?? null;
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
     * Persentase tanpa nol di belakang koma, dengan pemisah desimal sesuai desain halaman.
     * Contoh: 92.40 → "92,4" (beranda) atau "92.4" (BKK).
     */
    public function percent(string $key, string $decimalSeparator = '.'): string
    {
        $value = rtrim(rtrim(number_format((float) $this->get($key), 2, '.', ''), '0'), '.');

        return str_replace('.', $decimalSeparator, $value);
    }
}
