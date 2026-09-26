<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Pesanan produk BLUD dari pengunjung website.
 * Stok barang dipotong saat admin mengubah status ke "Diproses", dan dikembalikan jika dibatalkan.
 */
#[Fillable([
    'product_id', 'business_unit_id', 'product_name', 'variant', 'quantity', 'unit_price',
    'customer_name', 'customer_phone', 'note', 'status',
])]
class Order extends Model
{
    protected $attributes = [
        'status' => 'baru',
    ];

    protected static function booted(): void
    {
        static::creating(function (Order $order): void {
            $order->code ??= 'BLUD-'.now()->format('ymd').'-'.Str::upper(Str::random(4));
        });
    }

    protected function casts(): array
    {
        return [
            'status' => OrderStatus::class,
            'quantity' => 'integer',
            'unit_price' => 'integer',
            'stock_deducted' => 'boolean',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function businessUnit(): BelongsTo
    {
        return $this->belongsTo(BusinessUnit::class);
    }

    #[Scope]
    protected function ofStatus(Builder $query, OrderStatus $status): void
    {
        $query->where('status', $status);
    }

    protected function total(): Attribute
    {
        return Attribute::get(fn () => $this->quantity * $this->unit_price);
    }

    protected function totalLabel(): Attribute
    {
        return Attribute::get(fn () => Product::rupiah($this->total));
    }

    /**
     * Ubah status sekaligus memotong / mengembalikan stok barang.
     *
     * @throws ValidationException jika stok tidak cukup
     */
    public function changeStatus(OrderStatus $status): void
    {
        DB::transaction(function () use ($status) {
            $product = $this->product()->lockForUpdate()->first();
            $tracksStock = $product?->tracksStock() ?? false;

            if ($status->usesStock() && ! $this->stock_deducted && $tracksStock) {
                if ($product->stock < $this->quantity) {
                    throw ValidationException::withMessages([
                        'status' => "Stok {$product->name} tinggal {$product->stock}, tidak cukup untuk pesanan {$this->code}.",
                    ]);
                }

                $product->decrement('stock', $this->quantity);
                $this->stock_deducted = true;
            }

            if ($status === OrderStatus::Cancelled && $this->stock_deducted) {
                // Produk yang sudah dihapus atau tidak lagi memakai stok tidak perlu dikembalikan.
                if ($tracksStock) {
                    $product->increment('stock', $this->quantity);
                }
                $this->stock_deducted = false;
            }

            $this->status = $status;
            $this->save();
        });
    }

    /**
     * Pesan WhatsApp dari pemesan ke unit usaha.
     */
    public function whatsappMessage(): string
    {
        return collect([
            "Halo {$this->businessUnit?->name}, saya ingin memesan:",
            '',
            "Kode pesanan: {$this->code}",
            'Produk: '.$this->product_name.($this->variant ? " ({$this->variant})" : ''),
            "Jumlah: {$this->quantity}",
            "Perkiraan total: {$this->total_label}",
            "Nama: {$this->customer_name}",
            $this->note ? "Catatan: {$this->note}" : null,
        ])->reject(fn ($line) => $line === null)->implode("\n");
    }

    /**
     * Link bagi admin untuk menghubungi pemesan.
     */
    public function customerWhatsappLink(): string
    {
        return 'https://wa.me/'.$this->customer_phone.'?text='.rawurlencode(
            "Halo {$this->customer_name}, kami dari {$this->businessUnit?->name} ingin mengonfirmasi pesanan {$this->code}."
        );
    }
}
