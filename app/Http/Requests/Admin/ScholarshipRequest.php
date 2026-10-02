<?php

namespace App\Http\Requests\Admin;

use App\Models\Scholarship;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ScholarshipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_published' => $this->boolean('is_published'),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'tag' => ['nullable', 'string', 'max:60'],
            'tag_color' => ['required', Rule::in(array_keys(Scholarship::TAG_COLORS))],
            'description' => ['required', 'string', 'max:500'],
            'period' => ['required', 'string', 'max:60'],
            'amount' => ['required', 'string', 'max:60'],
            'tone' => ['required', Rule::in(array_keys(Scholarship::TONES))],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_published' => ['boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nama beasiswa',
            'tag' => 'label',
            'tag_color' => 'warna label',
            'description' => 'kriteria & syarat',
            'period' => 'masa berlaku',
            'amount' => 'besaran keringanan',
            'tone' => 'gaya baris',
            'sort_order' => 'urutan',
        ];
    }
}
