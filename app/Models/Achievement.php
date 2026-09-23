<?php

namespace App\Models;

use App\Enums\AchievementLevel;
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
 * Prestasi siswa.
 */
#[Fillable([
    'category_id', 'major_id', 'title', 'field_label', 'slug', 'rank', 'event_name',
    'organizer', 'location', 'level', 'participants', 'excerpt', 'description',
    'image', 'achieved_at', 'is_featured',
])]
class Achievement extends Model
{
    use HasMediaUrl, HasParagraphText, HasSlug, SoftDeletes;

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

    /**
     * Prestasi unggulan yang tampil di bagian "Mahkota Prestasi" (maksimal satu).
     */
    #[Scope]
    protected function headline(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    #[Scope]
    protected function ofLevel(Builder $query, AchievementLevel $level): void
    {
        $query->where('level', $level);
    }

    #[Scope]
    protected function latestAchieved(Builder $query): void
    {
        $query->orderByDesc('achieved_at')->orderByDesc('id');
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->mediaUrl($this->image));
    }

    /**
     * Bulan & tahun capaian, contoh: "Maret 2026".
     */
    protected function achievedLabel(): Attribute
    {
        return Attribute::get(fn () => $this->achieved_at?->locale('id')->translatedFormat('F Y'));
    }

    /**
     * Label bidang, jika kosong memakai nama kategori.
     */
    protected function fieldName(): Attribute
    {
        return Attribute::get(fn () => $this->field_label ?: $this->category?->name);
    }

    protected function descriptionHtml(): Attribute
    {
        return Attribute::get(fn () => $this->paragraphsToHtml($this->description));
    }

    /**
     * Data untuk katalog & modal di halaman prestasi (dipakai oleh JavaScript).
     */
    public function toCatalogArray(): array
    {
        $fullDesc = $this->description_html;

        // Foto dokumentasi tampil di atas deskripsi, sama seperti desain awal.
        if ($this->image_url) {
            $fullDesc = '<div style="margin-bottom: 1.5rem; border-radius: 14px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">'
                .'<img src="'.e($this->image_url).'" alt="'.e($this->title).'" loading="lazy" style="width: 100%; height: auto; display: block;">'
                .'</div>'.$fullDesc;
        }

        return [
            'id' => $this->slug,
            'title' => $this->title,
            'category' => $this->category?->slug,
            'categoryLabel' => (string) $this->field_name,
            'level' => $this->level?->value,
            'badge' => mb_strtoupper((string) ($this->rank ?: $this->level?->label())),
            'year' => (string) $this->achieved_at?->year,
            'dateStr' => (string) $this->achieved_label,
            'location' => (string) $this->location,
            'org' => (string) $this->organizer,
            'excerpt' => (string) $this->excerpt,
            'imageUrl' => $this->image_url,
            'fullDesc' => $fullDesc,
        ];
    }
}
