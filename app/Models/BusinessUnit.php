<?php

namespace App\Models;

use App\Enums\BusinessManager;
use App\Models\Concerns\HasMediaUrl;
use App\Models\Concerns\HasParagraphText;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Unit usaha BLUD ("toko"), dikelola siswa jurusan tertentu atau oleh sekolah.
 * Setiap unit punya nomor WhatsApp sendiri untuk menerima pesanan.
 */
#[Fillable([
    'name', 'slug', 'tagline', 'summary', 'description', 'image',
    'features', 'managed_by', 'whatsapp', 'sort_order', 'is_active',
])]
class BusinessUnit extends Model
{
    use HasMediaUrl, HasParagraphText, HasSlug;

    protected $attributes = [
        'managed_by' => 'siswa',
    ];

    protected function casts(): array
    {
        return [
            'managed_by' => BusinessManager::class,
            'features' => 'array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function majors(): BelongsToMany
    {
        return $this->belongsToMany(Major::class)->orderBy('sort_order');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
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
     * Kode jurusan pengelola, contoh: "DKV & BD".
     */
    protected function majorsLabel(): Attribute
    {
        return Attribute::get(fn () => $this->majors->pluck('code')->implode(' & '));
    }

    /**
     * Contoh: "Dikelola Siswa DKV & BD" atau "Dikelola Sekolah".
     */
    protected function managerLabel(): Attribute
    {
        return Attribute::get(fn () => trim($this->managed_by->label().' '.$this->majors_label));
    }

    protected function descriptionHtml(): Attribute
    {
        return Attribute::get(fn () => $this->paragraphsToHtml($this->description));
    }

    public function whatsappLink(?string $message = null): string
    {
        return 'https://wa.me/'.$this->whatsapp.($message ? '?text='.rawurlencode($message) : '');
    }
}
