<?php

namespace App\Models;

use App\Models\Concerns\HasMediaUrl;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * Testimoni alumni di beranda (section Jejak Prestasi Siswa SMEMSA).
 */
#[Fillable(['major_id', 'name', 'role', 'company', 'graduation_year', 'quote', 'photo', 'is_published', 'sort_order'])]
class Testimonial extends Model
{
    use HasMediaUrl;

    protected function casts(): array
    {
        return [
            'graduation_year' => 'integer',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    #[Scope]
    protected function published(Builder $query): void
    {
        $query->where('is_published', true);
    }

    #[Scope]
    protected function ordered(Builder $query): void
    {
        $query->orderBy('sort_order')->orderBy('name');
    }

    protected function photoUrl(): Attribute
    {
        return Attribute::get(fn () => $this->mediaUrl($this->photo));
    }

    /**
     * Inisial nama untuk foto profil kosong, contoh: "Ahmad Rizqi Pratama" → "AR".
     */
    protected function initials(): Attribute
    {
        return Attribute::get(fn () => Str::of($this->name)
            ->explode(' ')
            ->filter()
            ->take(2)
            ->map(fn (string $word) => mb_strtoupper(mb_substr($word, 0, 1)))
            ->implode(''));
    }

    /**
     * Keterangan pekerjaan, contoh: "Junior Web Developer • PT Digital Kreatif Nusantara".
     */
    protected function jobTitle(): Attribute
    {
        return Attribute::get(fn () => collect([$this->role, $this->company])->filter()->implode(' • '));
    }
}
