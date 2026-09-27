<?php

namespace App\Models;

use App\Enums\RegistrationStatus;
use App\Support\SiteSettings;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * Pendaftar SPMB. Sementara diinput panitia dari admin, nanti juga dari form pendaftaran online.
 */
#[Fillable([
    'name', 'birth_date', 'school_origin', 'phone', 'major_id', 'pathway', 'status', 'note',
])]
class Registration extends Model
{
    public const PATHWAYS = ['Reguler', 'Prestasi', 'Beasiswa & KIP'];

    protected $attributes = [
        'status' => 'menunggu',
    ];

    protected static function booted(): void
    {
        static::creating(function (Registration $registration): void {
            $registration->registration_number ??= static::generateNumber();
        });
    }

    /**
     * Contoh: SPMB-2026-K7Q2M. Akhiran acak agar nomor tidak bisa ditebak berurutan.
     */
    public static function generateNumber(): string
    {
        $year = app(SiteSettings::class)->spmbYear() ?: now()->year;

        do {
            $number = "SPMB-{$year}-".Str::upper(Str::random(5));
        } while (static::where('registration_number', $number)->exists());

        return $number;
    }

    protected function casts(): array
    {
        return [
            'status' => RegistrationStatus::class,
            'birth_date' => 'date',
        ];
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    #[Scope]
    protected function ofStatus(Builder $query, RegistrationStatus $status): void
    {
        $query->where('status', $status);
    }

    /**
     * Nama disamarkan untuk halaman publik, contoh: "Ahmad Fauzi" menjadi "Ah*** Fa***".
     */
    protected function maskedName(): Attribute
    {
        return Attribute::get(fn () => collect(explode(' ', trim($this->name)))
            ->filter()
            ->map(fn (string $word) => mb_substr($word, 0, 2).str_repeat('*', max(mb_strlen($word) - 2, 1)))
            ->implode(' '));
    }
}
