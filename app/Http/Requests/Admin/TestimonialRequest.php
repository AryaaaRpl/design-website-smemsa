<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
            'major_id' => ['nullable', 'exists:majors,id'],
            'graduation_year' => ['nullable', 'integer', 'min:1968', 'max:'.(now()->year + 1)],
            'role' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'quote' => ['required', 'string', 'max:400'],
            'photo' => ['nullable', 'image', 'max:2048'],
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
            'name' => 'nama',
            'major_id' => 'jurusan',
            'graduation_year' => 'tahun lulus',
            'role' => 'pekerjaan',
            'company' => 'perusahaan',
            'quote' => 'motivasi',
            'photo' => 'foto profil',
            'sort_order' => 'urutan',
        ];
    }
}
