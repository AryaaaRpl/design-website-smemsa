<?php

namespace App\Models\Concerns;

use App\Support\Media;
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
            ? Media::asset($path)
            : Storage::disk('public')->url($path);
    }

    /**
     * URL varian kecil (-card.webp, lebar 640px) untuk kartu daftar.
     * Kembali ke gambar penuh bila varian belum ada (mis. upload lama).
     */
    protected function cardMediaUrl(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        if (str_starts_with($path, 'assets/')) {
            $card = Media::cardPath(Media::path($path));

            return is_file(public_path($card)) ? asset($card) : Media::asset($path);
        }

        $card = Media::cardPath($path);

        return Storage::disk('public')->exists($card)
            ? Storage::disk('public')->url($card)
            : Storage::disk('public')->url($path);
    }
}
