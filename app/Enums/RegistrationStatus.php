<?php

namespace App\Enums;

enum RegistrationStatus: string
{
    case Pending = 'menunggu';
    case Incomplete = 'berkas_kurang';
    case Verified = 'terverifikasi';
    case Accepted = 'diterima';
    case Rejected = 'tidak_diterima';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Menunggu Verifikasi',
            self::Incomplete => 'Berkas Perlu Dilengkapi',
            self::Verified => 'Berkas Terverifikasi',
            self::Accepted => 'Diterima',
            self::Rejected => 'Tidak Diterima',
        };
    }

    /**
     * Penjelasan yang dibaca calon siswa di halaman cek status.
     */
    public function description(): string
    {
        return match ($this) {
            self::Pending => 'Pendaftaran sudah kami terima. Panitia sedang memeriksa berkas Anda, silakan cek kembali secara berkala.',
            self::Incomplete => 'Ada berkas yang belum lengkap atau belum sesuai. Baca catatan panitia di bawah, lalu lengkapi berkasnya.',
            self::Verified => 'Berkas Anda sudah diverifikasi panitia dan dinyatakan lengkap. Tunggu pengumuman hasil seleksi.',
            self::Accepted => 'Selamat! Anda diterima sebagai siswa baru. Silakan lakukan daftar ulang sesuai jadwal.',
            self::Rejected => 'Mohon maaf, Anda belum dapat diterima pada periode ini. Hubungi panitia untuk informasi lebih lanjut.',
        };
    }

    /**
     * Tahap yang sudah dicapai untuk progress di halaman cek status: 1 = diterima panitia, 2 = terverifikasi, 3 = hasil.
     */
    public function step(): int
    {
        return match ($this) {
            self::Pending, self::Incomplete => 1,
            self::Verified => 2,
            self::Accepted, self::Rejected => 3,
        };
    }

    /**
     * Warna badge: info, warning, success, danger.
     */
    public function tone(): string
    {
        return match ($this) {
            self::Pending => 'info',
            self::Incomplete => 'warning',
            self::Verified, self::Accepted => 'success',
            self::Rejected => 'danger',
        };
    }
}
