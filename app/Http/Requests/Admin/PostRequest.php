<?php

namespace App\Http\Requests\Admin;

use App\Enums\CategoryType;
use App\Enums\PostStatus;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('posts')->ignore($this->route('post'))],
            'category_id' => [
                'nullable',
                Rule::exists('categories', 'id')->where('type', CategoryType::Post->value),
            ],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'location' => ['nullable', 'string', 'max:255'],
            'byline' => ['nullable', 'string', 'max:100'],
            'status' => ['required', Rule::enum(PostStatus::class)],
            'published_at' => ['nullable', 'date'],
            'is_featured' => [
                'boolean',
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($value && $this->input('status') !== PostStatus::Published->value) {
                        $fail('Hanya berita berstatus Terbit yang bisa dijadikan headline utama.');
                    }
                },
            ],
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
            'excerpt' => 'ringkasan',
            'body' => 'isi berita',
            'thumbnail' => 'gambar',
            'location' => 'lokasi',
            'byline' => 'penulis',
            'published_at' => 'tanggal terbit',
        ];
    }
}
