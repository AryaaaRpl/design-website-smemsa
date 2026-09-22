<?php

namespace App\Models;

use App\Enums\AchievementLevel;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Prestasi siswa.
 */
#[Fillable(['category_id', 'major_id', 'title', 'slug', 'rank', 'event_name', 'organizer', 'level', 'participants', 'description', 'image', 'achieved_at', 'is_featured'])]
class Achievement extends Model
{
    use HasSlug, SoftDeletes;

    protected function casts(): array
    {
        return [
            'level' => AchievementLevel::class,
            'achieved_at' => 'date',
            'is_featured' => 'boolean',
        ];
    }

    protected function slugSource(): string
    {
        return 'title';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    #[Scope]
    protected function featured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    #[Scope]
    protected function ofLevel(Builder $query, AchievementLevel $level): void
    {
        $query->where('level', $level);
    }
}
