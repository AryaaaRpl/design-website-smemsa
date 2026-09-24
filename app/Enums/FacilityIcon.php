<?php

namespace App\Enums;

/**
 * Ikon fasilitas: SVG untuk kartu grid, emoji untuk banner modal (sesuai desain awal).
 */
enum FacilityIcon: string
{
    case Computer = 'computer';
    case Design = 'design';
    case Book = 'book';
    case Wifi = 'wifi';
    case Sport = 'sport';
    case Building = 'building';
    case Printer = 'printer';
    case Hotel = 'hotel';
    case Card = 'card';
    case Bank = 'bank';
    case Network = 'network';

    public function label(): string
    {
        return match ($this) {
            self::Computer => 'Komputer',
            self::Design => 'Desain',
            self::Book => 'Buku',
            self::Wifi => 'Wi-Fi',
            self::Sport => 'Olahraga',
            self::Building => 'Gedung',
            self::Printer => 'Percetakan',
            self::Hotel => 'Hotel',
            self::Card => 'Kartu',
            self::Bank => 'Bank',
            self::Network => 'Jaringan',
        };
    }

    public function emoji(): string
    {
        return match ($this) {
            self::Computer => '💻',
            self::Design => '🎨',
            self::Book => '📚',
            self::Wifi => '📶',
            self::Sport => '⚽',
            self::Building => '🏛️',
            self::Printer => '🖨️',
            self::Hotel => '🏨',
            self::Card => '💳',
            self::Bank => '🏦',
            self::Network => '🌐',
        };
    }

    /**
     * Isi <svg> (24x24) untuk kartu grid. Ikon tanpa SVG khusus memakai ikon gedung.
     */
    public function svg(): string
    {
        return match ($this) {
            self::Computer => '<rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line>',
            self::Design => '<path d="M12 19l7-7 3 3-7 7-3-3z"></path><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path><path d="M2 2l7.586 7.586"></path><circle cx="11" cy="11" r="2"></circle>',
            self::Book => '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>',
            self::Wifi => '<path d="M5 12.55a11 11 0 0 1 14.08 0"></path><path d="M1.42 9a16 16 0 0 1 21.16 0"></path><path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path><line x1="12" y1="20" x2="12.01" y2="20"></line>',
            self::Sport => '<circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line>',
            default => '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line>',
        };
    }
}
