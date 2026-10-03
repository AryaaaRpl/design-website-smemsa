<?php

namespace App\Models\Concerns;

use App\Models\SlugRedirect;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

/**
 * Slug selalu dibuat dari kolom sumber (nama/judul), ikut berubah saat sumbernya diubah,
 * dan dibuat unik dengan akhiran -2, -3, dst. Slug lama dicatat agar link lama dialihkan (301) ke alamat baru.
 */
trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::saving(function (self $model): void {
            if (blank($model->slug) || ($model->exists && $model->isDirty($model->slugSource()))) {
                $model->slug = $model->generateUniqueSlug();
            }
        });

        static::updated(function (self $model): void {
            $old = $model->getOriginal('slug');

            if ($model->wasChanged('slug') && filled($old)) {
                SlugRedirect::updateOrCreate(
                    ['model_type' => $model->getMorphClass(), 'old_slug' => $old],
                    ['model_id' => $model->getKey()],
                );
            }
        });

        static::deleted(function (self $model): void {
            if (! method_exists($model, 'isForceDeleting') || $model->isForceDeleting()) {
                SlugRedirect::where('model_type', $model->getMorphClass())->where('model_id', $model->getKey())->delete();
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

    /**
     * Cari berdasarkan slug. Jika slug lama, alihkan permanen ke URL dengan slug baru.
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $model = parent::resolveRouteBinding($value, $field);

        // Hanya GET yang dialihkan; form (PUT/DELETE) ke slug lama tetap 404.
        if ($model || $field || ! request()->isMethod('GET')) {
            return $model;
        }

        $redirect = SlugRedirect::where('model_type', $this->getMorphClass())->where('old_slug', $value)->first();
        $target = $redirect ? static::find($redirect->model_id) : null;

        if ($target) {
            $segments = array_map(fn (string $segment) => $segment === $value ? $target->slug : $segment, request()->segments());

            throw new HttpResponseException(redirect()->to(implode('/', $segments).(request()->getQueryString() ? '?'.request()->getQueryString() : ''), 301));
        }

        return null;
    }

    protected function generateUniqueSlug(): string
    {
        $base = Str::slug((string) $this->getAttribute($this->slugSource())) ?: Str::lower(Str::random(6));
        $slug = $base;
        $counter = 2;

        // Termasuk data di tempat sampah, karena slug tetap unik di database.
        $query = fn () => in_array(SoftDeletes::class, class_uses_recursive(static::class), true)
            ? static::withTrashed()
            : static::query();

        while ($query()->where('slug', $slug)->whereKeyNot($this->getKey())->exists()) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
