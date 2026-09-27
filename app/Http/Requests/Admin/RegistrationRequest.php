<?php

namespace App\Http\Requests\Admin;

use App\Enums\RegistrationStatus;
use App\Models\Registration;
use App\Support\SiteSettings;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            // 0822... menjadi 62822...
            'phone' => $this->filled('phone') ? SiteSettings::normalizeWhatsapp($this->input('phone')) : null,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date', 'before:today'],
            'school_origin' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'regex:/^62[0-9]{8,13}$/'],
            'major_id' => ['nullable', 'integer', 'exists:majors,id'],
            'pathway' => ['nullable', Rule::in(Registration::PATHWAYS)],
            'status' => ['required', Rule::enum(RegistrationStatus::class)],
            'note' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nama lengkap',
            'birth_date' => 'tanggal lahir',
            'school_origin' => 'asal sekolah',
            'phone' => 'nomor WhatsApp',
            'major_id' => 'jurusan pilihan',
            'pathway' => 'jalur pendaftaran',
            'note' => 'catatan panitia',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'phone.regex' => 'Nomor WhatsApp tidak valid. Contoh: 082241356668.',
        ];
    }
}
