<?php

namespace App\Models;

use App\Support\SiteSettings;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Pertanyaan Sering Diajukan (FAQ) di halaman SPMB.
 */
#[Fillable(['question', 'answer', 'is_published', 'sort_order'])]
class Faq extends Model
{
    /** Kode yang otomatis diganti nilai Pengaturan, agar angka di FAQ selalu sama dengan rincian biaya. */
    public const PLACEHOLDERS = [
        '{tahun_ajaran}' => 'Tahun ajaran SPMB, contoh: 2026/2027',
        '{biaya_psm}' => 'Biaya PSM 1 tahun, contoh: Rp 6.350.000',
        '{cicilan_psm}' => 'Cicilan PSM per semester, contoh: Rp 3.175.000',
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
     * Ganti kode {…} dengan nilai Pengaturan.
     */
    public static function withValues(string $text): string
    {
        $site = app(SiteSettings::class);
        $tuition = (int) $site->get('fee_tuition');

        return strtr($text, [
            '{tahun_ajaran}' => (string) $site->get('spmb_academic_year'),
            '{biaya_psm}' => $site->rupiah($tuition),
            '{cicilan_psm}' => $site->rupiah(intdiv($tuition, 2)),
        ]);
    }
}
