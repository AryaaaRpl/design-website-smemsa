<?php

namespace App\Http\Requests\Admin;

use App\Enums\BusinessManager;
use App\Support\SiteSettings;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BusinessUnitRequest extends FormRequest
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
            // 0822... menjadi 62822...
            'whatsapp' => SiteSettings::normalizeWhatsapp($this->input('whatsapp')),
            // Textarea "satu baris satu keunggulan" menjadi array.
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
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('business_units')->ignore($this->route('business_unit'))],
            'tagline' => ['nullable', 'string', 'max:255'],
            'summary' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'features' => ['array', 'max:6'],
            'features.*' => ['string', 'max:40'],
            'managed_by' => ['required', Rule::enum(BusinessManager::class)],
            'whatsapp' => ['required', 'regex:/^62[0-9]{8,13}$/'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
            'majors' => ['array'],
            'majors.*' => ['integer', 'exists:majors,id'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nama unit usaha',
            'tagline' => 'bidang usaha',
            'summary' => 'ringkasan',
            'description' => 'deskripsi',
            'image' => 'foto',
            'features' => 'keunggulan',
            'features.*' => 'keunggulan',
            'managed_by' => 'pengelola',
            'whatsapp' => 'nomor WhatsApp',
            'sort_order' => 'urutan',
            'majors' => 'jurusan',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'whatsapp.regex' => 'Nomor WhatsApp tidak valid. Contoh: 082241356668.',
        ];
    }
}
