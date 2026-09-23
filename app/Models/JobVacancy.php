<?php

namespace App\Models;

use App\Enums\EmploymentType;
use App\Enums\VacancyStatus;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Lowongan kerja BKK.
 * Lowongan otomatis dianggap kedaluwarsa setelah melewati batas lamaran (closes_at).
 */
#[Fillable(['partner_id', 'position', 'slug', 'employment_type', 'location', 'description', 'requirements', 'apply_url', 'status', 'closes_at'])]
class JobVacancy extends Model
{
    use HasSlug;

    /**
     * Nomor WhatsApp BKK bawaan, dipakai jika link lamaran kosong.
     */
    public const DEFAULT_WHATSAPP = '6282241356668';

    protected $attributes = [
        'status' => 'open',
    ];

    protected function casts(): array
    {
        return [
            'employment_type' => EmploymentType::class,
            'status' => VacancyStatus::class,
            'closes_at' => 'date',
        ];
    }

    protected function slugSource(): string
    {
        return 'position';
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Lowongan dibuka dan belum melewati batas lamaran.
     */
    #[Scope]
    protected function open(Builder $query): void
    {
        $query->where('status', VacancyStatus::Open)
            ->where(fn (Builder $q) => $q->whereNull('closes_at')->orWhereDate('closes_at', '>=', today()));
    }

    /**
     * Lowongan berstatus dibuka tetapi batas lamarannya sudah lewat.
     */
    #[Scope]
    protected function expired(Builder $query): void
    {
        $query->where('status', VacancyStatus::Open)
            ->whereDate('closes_at', '<', today());
    }

    protected function isExpired(): Attribute
    {
        return Attribute::get(fn () => $this->closes_at !== null && $this->closes_at->lt(today()));
    }

    /**
     * Status yang terlihat oleh admin: Dibuka, Kedaluwarsa, atau Ditutup.
     */
    protected function displayStatus(): Attribute
    {
        return Attribute::get(function () {
            if ($this->status === VacancyStatus::Closed) {
                return VacancyStatus::Closed->label();
            }

            return $this->is_expired ? 'Kedaluwarsa' : VacancyStatus::Open->label();
        });
    }

    /**
     * Keterangan batas lamaran, contoh: "30 Sep 2026 (7 hari lagi)".
     */
    protected function deadlineLabel(): Attribute
    {
        return Attribute::get(function () {
            if (! $this->closes_at) {
                return 'Tanpa batas';
            }

            $date = $this->closes_at->locale('id')->translatedFormat('j M Y');
            $days = (int) today()->diffInDays($this->closes_at, false);

            return match (true) {
                $days < 0 => $date,
                $days === 0 => "{$date} (hari ini)",
                default => "{$date} ({$days} hari lagi)",
            };
        });
    }

    /**
     * Link tombol "Lamar Loker". Jika admin tidak mengisi link, pakai WhatsApp BKK.
     */
    protected function applyLink(): Attribute
    {
        return Attribute::get(function () {
            if ($this->apply_url) {
                return $this->apply_url;
            }

            $message = "Halo BKK SMK MUHI, saya tertarik melamar {$this->position}";

            return 'https://wa.me/'.self::DEFAULT_WHATSAPP.'?text='.rawurlencode($message);
        });
    }
}
