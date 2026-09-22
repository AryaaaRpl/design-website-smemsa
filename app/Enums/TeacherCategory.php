<?php

namespace App\Enums;

enum TeacherCategory: string
{
    case Leadership = 'pimpinan';
    case VicePrincipal = 'wakasek';
    case HeadOfMajor = 'k3';
    case Teacher = 'guru';
    case Staff = 'staf';

    public function label(): string
    {
        return match ($this) {
            self::Leadership => 'Pimpinan',
            self::VicePrincipal => 'Wakil Kepala Sekolah',
            self::HeadOfMajor => 'Kepala Konsentrasi Keahlian',
            self::Teacher => 'Guru',
            self::Staff => 'Tenaga Kependidikan',
        };
    }
}
