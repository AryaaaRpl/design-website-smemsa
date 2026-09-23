<?php

namespace App\Http\Requests\Admin;

use App\Enums\CardStyle;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ExtracurricularRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->input('slug') ?: $this->input('name')),
            'is_active' => $this->boolean('is_active'),
            // Textarea "satu baris satu prestasi" menjadi array.
            'achievements' => collect(preg_split('/\R/', (string) $this->input('achievements')))
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
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('extracurriculars')->ignore($this->route('extracurricular'))],
            'tag' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'achievements' => ['array'],
            'achievements.*' => ['string', 'max:255'],
            'schedule' => ['nullable', 'string', 'max:255'],
            'coach_name' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'audience' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'modal_image' => ['nullable', 'image', 'max:2048'],
            'card_style' => ['required', Rule::enum(CardStyle::class)],
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
            'name' => 'nama ekstrakurikuler',
            'tag' => 'label',
            'short_description' => 'ringkasan',
            'description' => 'deskripsi',
            'achievements.*' => 'prestasi',
            'schedule' => 'jadwal latihan',
            'coach_name' => 'pembina',
            'location' => 'tempat latihan',
            'audience' => 'terbuka untuk',
            'image' => 'foto kartu',
            'modal_image' => 'foto detail',
            'card_style' => 'ukuran kartu',
            'sort_order' => 'urutan',
        ];
    }
}
