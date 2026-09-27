<?php

namespace App\Support;

/**
 * URL gambar bawaan desain (public/assets) dengan versi WebP yang lebih ringan.
 *
 * Setiap PNG/JPG di public/assets punya "kembaran" .webp yang dibuat otomatis
 * (ukurannya disesuaikan dengan ukuran tampil). Daftarnya ada di
 * resources/webp-manifest.json. File asli tidak diubah, jadi jika kembarannya
 * dihapus, website otomatis kembali memakai file asli.
 */
class Media
{
    /** @var array<string, string>|null */
    private static ?array $manifest = null;

    public static function asset(string $path): string
    {
        return asset(self::manifest()[$path] ?? $path);
    }

    /**
     * @return array<string, string>
     */
    private static function manifest(): array
    {
        if (self::$manifest === null) {
            $file = resource_path('webp-manifest.json');
            self::$manifest = is_file($file) ? (json_decode(file_get_contents($file), true) ?: []) : [];
        }

        return self::$manifest;
    }
}
