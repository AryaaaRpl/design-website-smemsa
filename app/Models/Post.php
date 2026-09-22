<?php

namespace App\Models;

use App\Enums\PostStatus;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Berita & artikel.
 */
#[Fillable(['user_id', 'category_id', 'title', 'slug', 'excerpt', 'body', 'thumbnail', 'location', 'status', 'is_featured', 'published_at'])]
class Post extends Model
{
    use HasSlug, SoftDeletes;

    protected $attributes = [
        'status' => 'draft',
    ];

    protected function casts(): array
    {
        return [
            'status' => PostStatus::class,
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    protected function slugSource(): string
    {
        return 'title';
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    #[Scope]
    protected function published(Builder $query): void
    {
        $query->where('status', PostStatus::Published)
            ->where('published_at', '<=', now());
    }

    #[Scope]
    protected function latestPublished(Builder $query): void
    {
        $query->orderByDesc('published_at');
    }
}
