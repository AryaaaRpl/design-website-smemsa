<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'message' => ['required', 'string', 'max:500'],
            // Riwayat dari widget; hanya 6 pesan terakhir yang diteruskan ke AI.
            'history' => ['nullable', 'array', 'max:20'],
            'history.*.role' => ['required', 'string', 'in:user,model'],
            'history.*.text' => ['required', 'string', 'max:1500'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'message' => 'pesan',
            'history' => 'riwayat',
        ];
    }

    /**
     * 6 pesan terakhir riwayat percakapan.
     *
     * @return list<array{role: string, text: string}>
     */
    public function recentHistory(): array
    {
        return collect($this->validated('history') ?? [])
            ->take(-6)
            ->map(fn (array $item) => ['role' => $item['role'], 'text' => trim($item['text'])])
            ->values()
            ->all();
    }
}
