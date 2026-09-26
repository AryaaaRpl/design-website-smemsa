<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Support\SiteSettings;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Formulir pesan produk BLUD dari pengunjung website.
 */
class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'customer_phone' => SiteSettings::normalizeWhatsapp($this->input('customer_phone')),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        /** @var Product $product */
        $product = $this->route('product');
        $variants = $product->variants ?? [];

        return [
            'customer_name' => ['required', 'string', 'max:100'],
            'customer_phone' => ['required', 'regex:/^62[0-9]{8,13}$/'],
            'variant' => [$variants ? 'required' : 'nullable', 'string', Rule::in($variants)],
            'quantity' => ['required', 'integer', 'min:1', 'max:'.($product->tracksStock() ? $product->stock : 100)],
            'note' => ['nullable', 'string', 'max:500'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'customer_name' => 'nama',
            'customer_phone' => 'nomor WhatsApp',
            'variant' => 'varian',
            'quantity' => 'jumlah',
            'note' => 'catatan',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'customer_phone.regex' => 'Nomor WhatsApp tidak valid. Contoh: 081234567890.',
            'quantity.max' => 'Jumlah melebihi stok yang tersedia (maks. :max).',
        ];
    }
}
