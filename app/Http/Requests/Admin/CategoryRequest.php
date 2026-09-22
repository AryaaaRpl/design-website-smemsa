<?php

namespace App\Http\Requests\Admin;

use App\Enums\CategoryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->input('slug') ?: $this->input('name')),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', Rule::enum(CategoryType::class)],
            'name' => ['required', 'string', 'max:100'],
            'slug' => [
                'required',
                'string',
                'max:100',
                'alpha_dash',
                // Slug cukup unik di dalam tipe yang sama.
                Rule::unique('categories')
                    ->where('type', $this->input('type'))
                    ->ignore($this->route('category')),
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'type' => 'tipe',
            'name' => 'nama kategori',
            'slug' => 'slug',
        ];
    }
}
