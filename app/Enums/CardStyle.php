<?php

namespace App\Enums;

/**
 * Ukuran kartu di grid ekstrakurikuler (sesuai class CSS .ekskul-card).
 */
enum CardStyle: string
{
    case Normal = 'normal';
    case Featured = 'featured';
    case Tall = 'tall';

    public function label(): string
    {
        return match ($this) {
            self::Normal => 'Normal',
            self::Featured => 'Lebar (unggulan)',
            self::Tall => 'Tinggi',
        };
    }

    /**
     * Class CSS tambahan pada kartu.
     */
    public function cssClass(): string
    {
        return $this === self::Normal ? '' : $this->value;
    }
}
