<?php

namespace App\Models;

use App\Enums\FacilityIcon;
use App\Enums\FacilityType;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Fasilitas & Teaching Factory. Satu data = satu lokasi, bisa tampil di:
 * titik denah (map_x/map_y), daftar TEFA (show_in_tefa_list), grid unggulan (is_featured).
 */
#[Fillable([
    'major_id', 'name', 'short_name', 'mark', 'slug', 'type', 'tag', 'location_label',
    'short_description', 'description', 'features', 'highlight', 'icon',
    'map_x', 'map_y', 'show_in_tefa_list', 'is_featured', 'is_wide', 'sort_order',
])]
class Facility extends Model
{
    use HasSlug;

    protected $attributes = [
        'icon' => 'building',
    ];

    protected function casts(): array
    {
        return [
            'type' => FacilityType::class,
            'icon' => FacilityIcon::class,
            'features' => 'array',
            'map_x' => 'integer',
            'map_y' => 'integer',
            'show_in_tefa_list' => 'boolean',
            'is_featured' => 'boolean',
            'is_wide' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(FacilityImage::class)->orderBy('sort_order')->orderBy('id');
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

    /**
     * Fasilitas yang punya titik di denah.
     */
    #[Scope]
    protected function onMap(Builder $query): void
    {
        $query->whereNotNull('map_x')->whereNotNull('map_y');
    }

    protected function isTefa(): Attribute
    {
        return Attribute::get(fn () => $this->type === FacilityType::TeachingFactory);
    }

    /**
     * Nama pendek untuk daftar & daftar TEFA. Jika kosong, pakai nama lengkap.
     */
    protected function listName(): Attribute
    {
        return Attribute::get(fn () => $this->short_name ?: $this->name);
    }

    /**
     * Data untuk titik denah, panel detail & modal (dipakai oleh JavaScript).
     */
    public function toPageArray(): array
    {
        return [
            'id' => $this->slug,
            'kind' => $this->is_tefa ? 'tefa' : 'fasilitas',
            'x' => $this->map_x,
            'y' => $this->map_y,
            'mark' => $this->mark ?: mb_strtoupper(mb_substr($this->list_name, 0, 3)),
            'kicker' => (string) $this->tag,
            'loc' => (string) $this->location_label,
            'name' => $this->list_name,
            'full' => $this->name,
            'desc' => (string) $this->description,
            'tools' => $this->features ?? [],
            'highlight' => (string) $this->highlight,
            'icon' => $this->icon->emoji(),
            'photos' => $this->images->map(fn (FacilityImage $image) => [
                'url' => $image->url,
                'caption' => $image->caption,
            ])->values(),
        ];
    }
}
