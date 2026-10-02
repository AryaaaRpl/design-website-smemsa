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
    'name', 'birth_date', 'nik', 'school_origin', 'phone', 'major_id', 'pathway', 'status', 'note',
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

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }

    /**
     * Alur pendaftaran online: label => sudah selesai?
     * Kolom data diri, formulir & berkas ditambahkan di tahap 3 (selama belum ada, bernilai null = belum selesai).
     *
     * @return array<string, bool>
     */
    public function steps(): array
    {
        return [
            'Pilih Jalur' => filled($this->pathway),
            'Isi Data Diri' => filled($this->gender),
            'Formulir' => filled($this->school_origin) && filled($this->guardian_name),
            'Unggah Berkas' => (bool) $this->documents_completed,
            'Pilih Jurusan' => filled($this->major_id),
            'Pengumuman' => in_array($this->status, [RegistrationStatus::Accepted, RegistrationStatus::Rejected], true),
        ];
    }

    /**
     * Nomor langkah yang sedang dikerjakan (1-6): langkah pertama yang belum selesai.
     */
    public function currentStep(): int
    {
        $index = array_search(false, array_values($this->steps()), true);

        return $index === false ? count($this->steps()) : $index + 1;
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
