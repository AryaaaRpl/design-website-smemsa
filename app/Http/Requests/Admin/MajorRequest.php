<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MajorRequest extends FormRequest
{
    /**
     * Kolom yang diisi lewat textarea "satu baris satu poin".
     */
    public const LIST_FIELDS = ['competencies', 'practice_items', 'certification_items', 'career_items'];

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $data = [
            'slug' => Str::slug($this->input('slug') ?: $this->input('name')),
            'is_active' => $this->boolean('is_active'),
        ];

        foreach (self::LIST_FIELDS as $field) {
            $data[$field] = collect(preg_split('/\r\n|\n/', (string) $this->input($field)))
                ->map(fn (string $line) => trim($line))
                ->filter()
                ->values()
                ->all();
        }

        $this->merge($data);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $major = $this->route('major');

        return [
            'code' => ['required', 'string', 'max:20', Rule::unique('majors')->ignore($major)],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('majors')->ignore($major)],
            'description' => ['nullable', 'string', 'max:1000'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'student_photo' => ['nullable', 'image', 'max:2048'],
            'tefa_name' => ['nullable', 'string', 'max:255'],
            'certification_summary' => ['nullable', 'string', 'max:255'],
            'competencies' => ['array'],
            'competencies.*' => ['string', 'max:255'],
            'practice_items' => ['array'],
            'practice_items.*' => ['string', 'max:255'],
            'practice_note' => ['nullable', 'string', 'max:255'],
            'certification_items' => ['array'],
            'certification_items.*' => ['string', 'max:255'],
            'certification_note' => ['nullable', 'string', 'max:255'],
            'career_items' => ['array'],
            'career_items.*' => ['string', 'max:255'],
            'career_note' => ['nullable', 'string', 'max:255'],
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
            'code' => 'kode',
            'name' => 'nama jurusan',
            'slug' => 'slug',
            'description' => 'deskripsi',
            'logo' => 'logo',
            'student_photo' => 'foto siswa',
            'tefa_name' => 'nama TEFA',
            'certification_summary' => 'ringkasan sertifikasi',
            'sort_order' => 'urutan',
        ];
    }
}
