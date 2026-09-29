<?php

namespace App\Enums;

/**
 * Jenis produk BLUD.
 */
enum ProductType: string
{
    case Goods = 'barang';
    case Service = 'jasa';

    public function label(): string
    {
        return match ($this) {
            self::Goods => 'Barang',
            self::Service => 'Jasa',
        };
    }
}
