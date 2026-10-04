<?php

namespace App\Models;

use App\Enums\CardStyle;
use App\Models\Concerns\HasMediaUrl;
use App\Models\Concerns\HasParagraphText;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Ekstrakurikuler.
 */
#[Fillable([
    'coach_id', 'coach_name', 'name', 'slug', 'tag', 'short_description', 'description',
    'achievements', 'schedule', 'location', 'audience', 'image',
    'card_style', 'sort_order', 'is_active',
])]
class Extracurricular extends Model
{
    use HasMediaUrl, HasParagraphText, HasSlug;

    protected $attributes = [
        'card_style' => 'normal',
    ];

    protected function casts(): array
    {
        return [
            'card_style' => CardStyle::class,
            'achievements' => 'array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function coach(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'coach_id');
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

    protected function imageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->mediaUrl($this->image));
    }

    /**
     * Deskripsi lengkap sebagai paragraf HTML yang aman (untuk halaman detail).
     */
    protected function descriptionHtml(): Attribute
    {
        return Attribute::get(fn () => $this->paragraphsToHtml($this->description));
    }
}
