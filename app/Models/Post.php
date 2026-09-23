<?php

namespace App\Models;

use App\Enums\PostStatus;
use App\Models\Concerns\HasMediaUrl;
use App\Models\Concerns\HasParagraphText;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Berita & artikel.
 */
#[Fillable(['user_id', 'category_id', 'title', 'slug', 'excerpt', 'body', 'thumbnail', 'location', 'byline', 'status', 'is_featured', 'published_at'])]
class Post extends Model
{
    use HasMediaUrl, HasParagraphText, HasSlug, SoftDeletes;

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

    /**
     * Berita yang ditandai sebagai headline utama (maksimal satu).
     */
    #[Scope]
    protected function headline(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    #[Scope]
    protected function latestPublished(Builder $query): void
    {
        $query->orderByDesc('published_at')->orderByDesc('id');
    }

    protected function thumbnailUrl(): Attribute
    {
        return Attribute::get(fn () => $this->mediaUrl($this->thumbnail));
    }

    /**
     * Tanggal terbit dalam bahasa Indonesia, contoh: "18 Juni 2026".
     */
    protected function publishedDate(): Attribute
    {
        return Attribute::get(fn () => $this->published_at?->locale('id')->translatedFormat('j F Y'));
    }

    /**
     * Isi berita (teks biasa) diubah menjadi paragraf HTML yang aman.
     * Baris kosong = paragraf baru.
     */
    protected function bodyHtml(): Attribute
    {
        return Attribute::get(fn () => $this->paragraphsToHtml($this->body));
    }

    /**
     * Data untuk modal detail berita (dipakai oleh JavaScript).
     */
    public function toModalArray(): array
    {
        return [
            'category' => mb_strtoupper($this->category?->name ?? 'Berita'),
            'date' => collect([$this->published_date, $this->byline])->filter()->implode(' • '),
            'img' => $this->thumbnail_url,
            'title' => $this->title,
            'body' => $this->body_html,
        ];
    }
}
