<?php

namespace App\Enums;

enum AchievementLevel: string
{
    case School = 'sekolah';
    case Regency = 'kabupaten';
    case Regional = 'regional';
    case Province = 'provinsi';
    case National = 'nasional';
    case International = 'internasional';

    public function label(): string
    {
        return match ($this) {
            self::School => 'Sekolah',
            self::Regency => 'Kabupaten',
            self::Regional => 'Regional',
            self::Province => 'Provinsi',
            self::National => 'Nasional',
            self::International => 'Internasional',
        };
    }
}
