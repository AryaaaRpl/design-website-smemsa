<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Skema beasiswa & keringanan biaya di halaman SPMB.
 */
#[Fillable(['name', 'tag', 'tag_color', 'description', 'period', 'amount', 'tone', 'is_published', 'sort_order'])]
class Scholarship extends Model
{
    /** Gaya baris di tabel: kunci => label admin. */
    public const TONES = [
        'highlight' => 'Disorot kuning (contoh: Early Bird)',
        'nominal' => 'Potongan nominal',
        'discount' => 'Potongan persen (berlaku beberapa tahun)',
        'free' => 'Gratis 100% (hijau)',
    ];

    public const TAG_COLORS = ['amber' => 'Kuning', 'blue' => 'Biru', 'slate' => 'Abu-abu', 'green' => 'Hijau'];

    /** Kelas CSS per gaya: baris, nomor, masa berlaku, besaran. */
    private const TONE_CLASSES = [
        'highlight' => ['row-highlight', 'highlight', 'amber', 'discount'],
        'nominal' => ['', '', '', 'nominal'],
        'discount' => ['', '', 'blue', 'discount'],
        'free' => ['row-free', 'green', 'green', 'free'],
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    #[Scope]
    protected function published(Builder $query): void
    {
        $query->where('is_published', true);
    }

    #[Scope]
    protected function ordered(Builder $query): void
    {
        $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * @return array{0: string, 1: string, 2: string, 3: string}
     */
    public function toneClasses(): array
    {
        return self::TONE_CLASSES[$this->tone] ?? self::TONE_CLASSES['nominal'];
    }
}
