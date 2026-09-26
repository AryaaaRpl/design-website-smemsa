<?php

namespace App\Enums;

/**
 * Pengelola unit usaha BLUD.
 */
enum BusinessManager: string
{
    case Student = 'siswa';
    case School = 'sekolah';

    public function label(): string
    {
        return match ($this) {
            self::Student => 'Dikelola Siswa',
            self::School => 'Dikelola Sekolah',
        };
    }
}
