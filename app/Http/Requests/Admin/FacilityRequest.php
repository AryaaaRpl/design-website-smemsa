<?php

namespace App\Http\Requests\Admin;

use App\Enums\FacilityIcon;
use App\Enums\FacilityType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FacilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->input('slug') ?: $this->input('name')),
            'show_in_tefa_list' => $this->boolean('show_in_tefa_list'),
            'is_featured' => $this->boolean('is_featured'),
            'is_wide' => $this->boolean('is_wide'),
            // Textarea "satu baris satu sarana" menjadi array.
            'features' => collect(preg_split('/\R/', (string) $this->input('features')))
                ->map(fn (string $line) => trim($line))
                ->filter()
                ->values()
                ->all(),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'short_name' => ['nullable', 'string', 'max:100'],
            'mark' => ['nullable', 'string', 'max:5'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('facilities')->ignore($this->route('facility'))],
            'type' => ['required', Rule::enum(FacilityType::class)],
            'major_id' => ['nullable', 'exists:majors,id'],
            'tag' => ['nullable', 'string', 'max:100'],
            'location_label' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'features' => ['array'],
            'features.*' => ['string', 'max:255'],
            'highlight' => ['nullable', 'string'],
            'icon' => ['required', Rule::enum(FacilityIcon::class)],
            // Titik denah: keduanya diisi atau keduanya kosong (area denah 1000 x 800).
            'map_x' => ['nullable', 'required_with:map_y', 'integer', 'between:0,1000'],
            'map_y' => ['nullable', 'required_with:map_x', 'integer', 'between:0,800'],
            'show_in_tefa_list' => ['boolean'],
            'is_featured' => ['boolean'],
            'is_wide' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
            // Galeri: foto baru, keterangan & urutan foto lama, foto yang dihapus.
            'new_images' => ['array', 'max:10'],
            'new_images.*' => ['image', 'max:2048'],
            'images' => ['array'],
            'images.*.caption' => ['nullable', 'string', 'max:100'],
            'images.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'images.*.delete' => ['nullable', 'boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nama lengkap',
            'short_name' => 'nama pendek',
            'mark' => 'kode singkat',
            'type' => 'tipe',
            'major_id' => 'jurusan',
            'tag' => 'label kategori',
            'location_label' => 'lokasi',
            'short_description' => 'ringkasan',
            'description' => 'deskripsi',
            'features.*' => 'sarana utama',
            'highlight' => 'nilai tambah',
            'icon' => 'ikon',
            'map_x' => 'titik X',
            'map_y' => 'titik Y',
            'sort_order' => 'urutan',
            'new_images.*' => 'foto',
        ];
    }
}
