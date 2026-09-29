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

/**
 * Produk/layanan BLUD. Pemesanan lewat WhatsApp: nomor produk, atau nomor unit usaha jika kosong.
 */
#[Fillable([
    'business_unit_id', 'name', 'slug', 'tagline', 'summary', 'description', 'image',
    'type', 'price', 'price_unit', 'whatsapp', 'specs',
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
            'specs' => 'array',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function businessUnit(): BelongsTo
    {
        return $this->belongsTo(BusinessUnit::class);
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
     * Nomor WhatsApp tujuan pesan: milik produk, atau unit usahanya jika kosong.
     */
    public function whatsappNumber(): ?string
    {
        return $this->whatsapp ?: $this->businessUnit?->whatsapp;
    }

    /**
     * Tautan wa.me dengan pesan otomatis berisi nama & tautan produk.
     */
    public function whatsappLink(): ?string
    {
        $number = $this->whatsappNumber();

        if (! $number) {
            return null;
        }

        // Contoh: "Halo, saya tertarik dengan *iCareMu* (SMEMSA Tech Solutions). ..."
        $message = 'Halo, saya tertarik dengan *'.$this->name.'*'
            .($this->businessUnit ? ' ('.$this->businessUnit->name.')' : '')
            .". Boleh minta info lebih lanjut?\n\n".route('blud.show', $this);

        return 'https://wa.me/'.$number.'?text='.rawurlencode($message);
    }

    public static function rupiah(int $amount): string
    {
        return 'Rp '.number_format($amount, 0, ',', '.');
    }
}
