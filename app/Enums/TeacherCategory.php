<?php

namespace App\Enums;

enum TeacherCategory: string
{
    case Principal = 'kepsek';
    case VicePrincipal = 'wakasek';
    case Leadership = 'pimpinan';
    case HeadOfMajor = 'k3';
    case Teacher = 'guru';
    case Staff = 'staf';

    public function label(): string
    {
        return match ($this) {
            self::Principal => 'Kepala Sekolah',
            self::VicePrincipal => 'Wakil Kepala Sekolah',
            self::Leadership => 'Pimpinan & Waka',
            self::HeadOfMajor => 'Kepala Konsentrasi Keahlian',
            self::Teacher => 'Guru',
            self::Staff => 'Staff Karyawan',
        };
    }

    /**
     * Kategori yang hanya boleh diisi satu orang (kartu besar di halaman guru).
     */
    public function isSingle(): bool
    {
        return in_array($this, [self::Principal, self::VicePrincipal], true);
    }

    /**
     * Kelompok section di halaman guru. Kepsek & wakasek masuk section Pimpinan.
     */
    public function pageGroup(): string
    {
        return match ($this) {
            self::Principal, self::VicePrincipal, self::Leadership => 'pimpinan',
            self::HeadOfMajor => 'k3',
            self::Teacher => 'guru',
            self::Staff => 'tendik',
        };
    }

    /**
     * Jabatan yang tampil di kartu besar (sesuai desain).
     */
    public function cardTitle(): ?string
    {
        return match ($this) {
            self::Principal => 'Kepala SMKS Muhammadiyah 1 Genteng',
            self::VicePrincipal => 'Wakil Kepala Sekolah',
            default => null,
        };
    }
}
