<?php

namespace App\Models;

use App\Enums\ProductType;
use App\Models\Concerns\HasMediaUrl;
use App\Models\Concerns\HasParagraphText;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Produk BLUD: barang (punya stok) atau jasa (tanpa stok).
 * Stok barang boleh kosong (null) = tidak dihitung.
 */
#[Fillable([
    'business_unit_id', 'name', 'slug', 'tagline', 'summary', 'description', 'image',
    'type', 'price', 'price_unit', 'variants', 'specs', 'stock',
    'is_featured', 'sort_order', 'is_active',
])]
class Product extends Model
{
    use HasMediaUrl, HasParagraphText, HasSlug;

    protected $attributes = [
        'type' => 'barang',
    ];

    protected function casts(): array
    {
        return [
            'type' => ProductType::class,
            'price' => 'integer',
            'variants' => 'array',
            'specs' => 'array',
            'stock' => 'integer',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function businessUnit(): BelongsTo
    {
        return $this->belongsTo(BusinessUnit::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Produk aktif dari unit usaha yang juga aktif (yang boleh tampil di website).
     */
    #[Scope]
    protected function visible(Builder $query): void
    {
        $query->where('is_active', true)
            ->whereHas('businessUnit', fn (Builder $unit) => $unit->where('is_active', true));
    }

    #[Scope]
    protected function featured(Builder $query): void
    {
        $query->where('is_featured', true);
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

    protected function descriptionHtml(): Attribute
    {
        return Attribute::get(fn () => $this->paragraphsToHtml($this->description));
    }

    /**
     * Contoh: "Rp 35.000 / botol".
     */
    protected function priceLabel(): Attribute
    {
        return Attribute::get(fn () => self::rupiah($this->price).($this->price_unit ? ' / '.$this->price_unit : ''));
    }

    /**
     * Stok hanya dihitung untuk barang yang kolom stoknya diisi.
     */
    public function tracksStock(): bool
    {
        return $this->type === ProductType::Goods && $this->stock !== null;
    }

    public function isAvailable(): bool
    {
        return $this->is_active && (! $this->tracksStock() || $this->stock > 0);
    }

    /**
     * Contoh: "Stok tersisa 12", "Stok habis", "Menerima pesanan".
     */
    protected function availabilityLabel(): Attribute
    {
        return Attribute::get(fn () => match (true) {
            ! $this->tracksStock() => $this->type === ProductType::Service ? 'Menerima pesanan' : 'Tersedia',
            $this->stock > 0 => "Stok tersisa {$this->stock}",
            default => 'Stok habis',
        });
    }

    public static function rupiah(int $amount): string
    {
        return 'Rp '.number_format($amount, 0, ',', '.');
    }
}
