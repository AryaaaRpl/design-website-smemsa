<?php

namespace App\Http\Requests\Admin;

use App\Enums\ProductType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $isGoods = $this->input('type') === ProductType::Goods->value;

        $this->merge([
            'slug' => Str::slug($this->input('slug') ?: $this->input('name')),
            'is_active' => $this->boolean('is_active'),
            'is_featured' => $this->boolean('is_featured'),
            // Harga boleh ditulis "35.000".
            'price' => preg_replace('/\D/', '', (string) $this->input('price')),
            // Jasa tidak memakai stok. Stok barang kosong = tidak dihitung.
            'stock' => $isGoods && filled($this->input('stock')) ? $this->input('stock') : null,
            'variants' => $this->lines('variants')->all(),
            // "Kemasan: 35 mL" menjadi ['label' => 'Kemasan', 'value' => '35 mL'].
            'specs' => $this->lines('specs')
                ->map(function (string $line) {
                    [$label, $value] = array_pad(explode(':', $line, 2), 2, '');

                    return ['label' => trim($label), 'value' => trim($value)];
                })
                ->all(),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'business_unit_id' => ['required', 'integer', 'exists:business_units,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('products')->ignore($this->route('product'))],
            'tagline' => ['nullable', 'string', 'max:255'],
            'summary' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'type' => ['required', Rule::enum(ProductType::class)],
            'price' => ['required', 'integer', 'min:0', 'max:1000000000'],
            'price_unit' => ['nullable', 'string', 'max:50'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'variants' => ['array', 'max:20'],
            'variants.*' => ['string', 'max:100'],
            'specs' => ['array', 'max:10'],
            'specs.*.label' => ['required', 'string', 'max:50'],
            'specs.*.value' => ['required', 'string', 'max:255'],
            'is_featured' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'business_unit_id' => 'unit usaha',
            'name' => 'nama produk',
            'tagline' => 'subjudul',
            'summary' => 'ringkasan',
            'description' => 'deskripsi',
            'image' => 'foto',
            'type' => 'jenis',
            'price' => 'harga',
            'price_unit' => 'satuan harga',
            'stock' => 'stok',
            'variants' => 'varian',
            'variants.*' => 'varian',
            'specs' => 'spesifikasi',
            'sort_order' => 'urutan',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'specs.*.label.required' => 'Setiap baris spesifikasi harus ditulis "Label: Isi".',
            'specs.*.value.required' => 'Setiap baris spesifikasi harus ditulis "Label: Isi".',
        ];
    }

    /**
     * Isi textarea menjadi daftar baris yang tidak kosong.
     */
    private function lines(string $key): Collection
    {
        return collect(preg_split('/\R/', (string) $this->input($key)))
            ->map(fn (string $line) => trim($line))
            ->filter()
            ->values();
    }
}
