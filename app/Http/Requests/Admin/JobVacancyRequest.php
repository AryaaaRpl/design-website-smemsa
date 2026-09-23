<?php

namespace App\Http\Requests\Admin;

use App\Enums\EmploymentType;
use App\Enums\VacancyStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class JobVacancyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->input('slug') ?: $this->input('position')),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'partner_id' => ['required', 'exists:partners,id'],
            'position' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('job_vacancies')->ignore($this->route('vacancy'))],
            'employment_type' => ['required', Rule::enum(EmploymentType::class)],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'requirements' => ['nullable', 'string'],
            'apply_url' => ['nullable', 'url', 'max:255'],
            'status' => ['required', Rule::enum(VacancyStatus::class)],
            'closes_at' => ['nullable', 'date'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'partner_id' => 'perusahaan mitra',
            'position' => 'posisi',
            'employment_type' => 'tipe pekerjaan',
            'location' => 'lokasi',
            'description' => 'deskripsi',
            'requirements' => 'persyaratan',
            'apply_url' => 'link lamaran',
            'closes_at' => 'batas lamaran',
        ];
    }
}
