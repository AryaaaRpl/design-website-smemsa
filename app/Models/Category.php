<?php

namespace App\Models;

use App\Enums\CategoryType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Shared category table for berita (post) and prestasi (achievement).
 * Slugs are unique per type, so no HasSlug trait here.
 */
#[Fillable(['type', 'name', 'slug'])]
class Category extends Model
{
    protected function casts(): array
    {
        return [
            'type' => CategoryType::class,
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class);
    }

    #[Scope]
    protected function ofType(Builder $query, CategoryType $type): void
    {
        $query->where('type', $type);
    }
}
