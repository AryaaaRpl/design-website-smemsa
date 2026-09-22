<?php

namespace App\Models;

use App\Enums\FacilityType;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Fasilitas: lab, TEFA, bengkel, sarana penunjang.
 */
#[Fillable(['major_id', 'name', 'slug', 'type', 'short_description', 'description', 'features', 'image', 'is_featured', 'sort_order'])]
class Facility extends Model
{
    use HasSlug;

    protected function casts(): array
    {
        return [
            'type' => FacilityType::class,
            'features' => 'array',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(FacilityImage::class)->orderBy('sort_order');
    }

    #[Scope]
    protected function ofType(Builder $query, FacilityType $type): void
    {
        $query->where('type', $type);
    }

    #[Scope]
    protected function ordered(Builder $query): void
    {
        $query->orderBy('sort_order')->orderBy('name');
    }
}
