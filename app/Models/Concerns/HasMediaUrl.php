<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\Storage;

/**
 * Mengubah path gambar menjadi URL.
 * File bawaan desain ada di public/assets, file upload admin ada di storage publik.
 */
trait HasMediaUrl
{
    protected function mediaUrl(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        return str_starts_with($path, 'assets/')
            ? asset($path)
            : Storage::disk('public')->url($path);
    }
}
