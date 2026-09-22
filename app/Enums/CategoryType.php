<?php

namespace App\Enums;

enum CategoryType: string
{
    case Post = 'post';
    case Achievement = 'achievement';

    public function label(): string
    {
        return match ($this) {
            self::Post => 'Berita',
            self::Achievement => 'Prestasi',
        };
    }
}
