<?php

namespace App\Enums;

/**
 * Jenis produk BLUD. Hanya barang yang memakai stok.
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

    /**
     * Contoh isian catatan di formulir pesan.
     */
    public function notePlaceholder(): string
    {
        return match ($this) {
            self::Goods => 'Contoh: diambil di sekolah hari Senin',
            self::Service => 'Contoh: jadwal, alamat, atau detail kebutuhan',
        };
    }
}
