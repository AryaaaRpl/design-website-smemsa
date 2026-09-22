<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

/**
 * Automatically fills the `slug` column from a source attribute when empty
 * and uses the slug for route model binding.
 */
trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function (self $model): void {
            if (blank($model->slug)) {
                $model->slug = $model->generateUniqueSlug();
            }
        });
    }

    /**
     * The attribute used as the slug source.
     */
    protected function slugSource(): string
    {
        return 'name';
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function generateUniqueSlug(): string
    {
        $base = Str::slug((string) $this->getAttribute($this->slugSource()));
        $slug = $base;
        $counter = 2;

        while (static::query()->where('slug', $slug)->exists()) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
