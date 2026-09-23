<?php

namespace App\Models;

use App\Models\Concerns\HasMediaUrl;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Konsentrasi Keahlian (jurusan).
 */
#[Fillable([
    'code', 'name', 'slug', 'description', 'logo', 'student_photo',
    'tefa_name', 'certification_summary', 'competencies',
    'practice_items', 'practice_note',
    'certification_items', 'certification_note',
    'career_items', 'career_note',
    'sort_order', 'is_active',
])]
class Major extends Model
{
    use HasMediaUrl, HasSlug;

    protected function casts(): array
    {
        return [
            'competencies' => 'array',
            'practice_items' => 'array',
            'certification_items' => 'array',
            'career_items' => 'array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class);
    }

    public function facilities(): HasMany
    {
        return $this->hasMany(Facility::class);
    }

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class);
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

    public function partners(): BelongsToMany
    {
        return $this->belongsToMany(Partner::class);
    }

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', true);
    }

    #[Scope]
    protected function ordered(Builder $query): void
    {
        $query->orderBy('sort_order')->orderBy('name');
    }

    protected function logoUrl(): Attribute
    {
        return Attribute::get(fn () => $this->mediaUrl($this->logo));
    }

    protected function studentPhotoUrl(): Attribute
    {
        return Attribute::get(fn () => $this->mediaUrl($this->student_photo));
    }

    /**
     * Data untuk panel jurusan di beranda (dipakai oleh JavaScript).
     */
    public function toLandingArray(int $number): array
    {
        return [
            'key' => $this->slug,
            'code' => $this->code,
            'num' => str_pad((string) $number, 2, '0', STR_PAD_LEFT),
            'title' => $this->name,
            'tefa' => $this->tefa_name,
            'certSummary' => $this->certification_summary,
            'logo' => $this->logo_url,
            'foto' => $this->student_photo_url,
            'desc' => $this->description,
            'kompetensi' => $this->competencies ?? [],
            'tempatPraktik' => ['items' => $this->practice_items ?? [], 'box' => $this->practice_note],
            'sertifikasi' => ['items' => $this->certification_items ?? [], 'box' => $this->certification_note],
            'setelahLulus' => ['items' => $this->career_items ?? [], 'box' => $this->career_note],
        ];
    }
}
