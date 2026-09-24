<?php

namespace App\Http\Requests\Admin;

use App\Enums\TeacherCategory;
use App\Models\Teacher;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TeacherRequest extends FormRequest
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
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $teacher = $this->route('teacher');

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('teachers')->ignore($teacher)],
            'nip' => ['nullable', 'string', 'max:30', Rule::unique('teachers')->ignore($teacher)],
            'position' => ['required', 'string', 'max:255'],
            'category' => [
                'required',
                Rule::enum(TeacherCategory::class),
                // Kepala Sekolah & Wakil Kepala Sekolah hanya boleh satu orang.
                function (string $attribute, mixed $value, Closure $fail) use ($teacher) {
                    $category = TeacherCategory::tryFrom((string) $value);

                    if (! $category?->isSingle()) {
                        return;
                    }

                    $existing = Teacher::ofCategory($category)
                        ->when($teacher, fn ($query) => $query->whereKeyNot($teacher->id))
                        ->first();

                    if ($existing) {
                        $fail("{$category->label()} sudah diisi oleh {$existing->name}. Ubah dulu kategori data tersebut.");
                    }
                },
            ],
            'major_id' => [
                Rule::requiredIf($this->input('category') === TeacherCategory::HeadOfMajor->value),
                'nullable',
                'exists:majors,id',
            ],
            'quote' => ['nullable', 'string', 'max:500'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'major_id.required' => 'Jurusan wajib dipilih untuk Kepala Konsentrasi Keahlian.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nama',
            'nip' => 'NIP',
            'position' => 'jabatan',
            'category' => 'kategori',
            'major_id' => 'jurusan',
            'quote' => 'kutipan',
            'photo' => 'foto',
            'sort_order' => 'urutan',
        ];
    }
}
