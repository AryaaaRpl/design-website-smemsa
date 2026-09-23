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
 * Mitra industri (DUDI) untuk BKK.
 * `is_active` = logo mitra ditampilkan di daftar mitra (halaman BKK) & marquee beranda.
 */
#[Fillable(['name', 'slug', 'industry', 'city', 'logo', 'website', 'sort_order', 'is_active'])]
class Partner extends Model
{
    use HasMediaUrl, HasSlug;

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function majors(): BelongsToMany
    {
        return $this->belongsToMany(Major::class);
    }

    public function jobVacancies(): HasMany
    {
        return $this->hasMany(JobVacancy::class);
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
}
