<?php

namespace App\Enums;

enum OrderStatus: string
{
    case New = 'baru';
    case Processing = 'diproses';
    case Done = 'selesai';
    case Cancelled = 'batal';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Baru',
            self::Processing => 'Diproses',
            self::Done => 'Selesai',
            self::Cancelled => 'Batal',
        };
    }

    /**
     * Status yang sudah memotong stok barang.
     */
    public function usesStock(): bool
    {
        return in_array($this, [self::Processing, self::Done], true);
    }
}
