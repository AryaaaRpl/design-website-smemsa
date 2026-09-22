<?php

namespace App\Enums;

enum FacilityType: string
{
    case Laboratory = 'lab';
    case TeachingFactory = 'tefa';
    case Workshop = 'bengkel';
    case Supporting = 'penunjang';

    public function label(): string
    {
        return match ($this) {
            self::Laboratory => 'Laboratorium',
            self::TeachingFactory => 'Teaching Factory',
            self::Workshop => 'Bengkel',
            self::Supporting => 'Sarana Penunjang',
        };
    }
}
