<?php

namespace App\Models;

use App\Enums\RegistrationStatus;
use App\Support\SiteSettings;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * Pendaftar SPMB: diinput panitia dari admin atau lewat pendaftaran online (akun Applicant).
 */
#[Fillable([
    'name', 'birth_date', 'nik', 'school_origin', 'phone', 'major_id', 'pathway', 'status', 'note',
    'gender', 'birth_place', 'religion', 'nisn', 'kk_number', 'shirt_size',
    'father_name', 'father_status', 'father_job', 'father_phone',
    'mother_name', 'mother_status', 'mother_job', 'mother_phone',
    'guardian_name', 'guardian_job', 'guardian_phone', 'guardian_relation',
    'residence_status', 'address', 'submitted_at',
])]
class Registration extends Model
{
    public const PATHWAYS = ['Reguler', 'Prestasi', 'Beasiswa & KIP'];

    // Pilihan isian formulir online.
    public const GENDERS = ['Laki-laki', 'Perempuan'];

    public const RELIGIONS = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];

    public const SHIRT_SIZES = ['S', 'M', 'L', 'XL', 'XXL'];

    public const PARENT_STATUSES = ['Masih Hidup', 'Meninggal', 'Cerai'];

    public const GUARDIAN_RELATIONS = ['Ayah', 'Ibu', 'Kakek/Nenek', 'Paman/Bibi', 'Kakak', 'Lainnya'];

    public const RESIDENCES = ['Bersama Orang Tua', 'Bersama Wali', 'Kos', 'Asrama/Pondok'];

    /** Berkas wajib: kunci => label. */
    public const DOCUMENTS = [
        'kk' => 'Kartu Keluarga',
        'akte' => 'Akta Kelahiran',
        'ijazah' => 'Ijazah SMP/MTs',
        'foto' => 'Pas Foto 3x4',
    ];

    /** Berkas pendukung tambahan per jalur (jenis 'pendukung'). */
    public const SUPPORTING_DOCUMENTS = [
        'Prestasi' => 'Sertifikat/Piagam Prestasi',
        'Beasiswa & KIP' => 'Kartu KIP/PKH/KKS atau SKTM',
    ];

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
            'submitted_at' => 'datetime',
        ];
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }

    /**
     * Alur pendaftaran online: label => sudah selesai?
     *
     * @return array<string, bool>
     */
    public function steps(): array
    {
        return [
            'Pilih Jalur' => filled($this->pathway),
            'Isi Data Diri' => filled($this->gender),
            'Formulir' => filled($this->school_origin) && filled($this->guardian_name),
            'Unggah Berkas' => $this->hasAllDocuments(),
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

    /**
     * Berkas wajib untuk jalur yang dipilih: 4 berkas umum + 1 berkas pendukung untuk jalur Prestasi / Beasiswa & KIP.
     *
     * @return array<string, string>
     */
    public function requiredDocuments(): array
    {
        $supporting = self::SUPPORTING_DOCUMENTS[$this->pathway] ?? null;

        return self::DOCUMENTS + ($supporting ? ['pendukung' => $supporting] : []);
    }

    public function hasAllDocuments(): bool
    {
        $required = array_keys($this->requiredDocuments());

        return $this->documents()->whereIn('type', $required)->count() >= count($required);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(RegistrationDocument::class);
    }

    public function isSubmitted(): bool
    {
        return $this->submitted_at !== null;
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
}
