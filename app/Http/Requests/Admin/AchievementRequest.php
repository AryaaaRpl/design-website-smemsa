<?php

namespace App\Http\Requests\Admin;

use App\Enums\AchievementLevel;
use App\Enums\CategoryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AchievementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->input('slug') ?: $this->input('title')),
            'is_featured' => $this->boolean('is_featured'),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('achievements')->ignore($this->route('achievement'))],
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where('type', CategoryType::Achievement->value),
            ],
            'field_label' => ['nullable', 'string', 'max:100'],
            'major_id' => ['nullable', 'exists:majors,id'],
            'level' => ['required', Rule::enum(AchievementLevel::class)],
            'rank' => ['nullable', 'string', 'max:100'],
            'achieved_at' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'organizer' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_featured' => ['boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'judul',
            'category_id' => 'kategori',
            'field_label' => 'bidang',
            'major_id' => 'jurusan',
            'level' => 'tingkat',
            'rank' => 'predikat',
            'achieved_at' => 'tanggal capaian',
            'location' => 'lokasi',
            'organizer' => 'penyelenggara',
            'excerpt' => 'ringkasan',
            'description' => 'deskripsi',
            'image' => 'foto',
        ];
    }
}
