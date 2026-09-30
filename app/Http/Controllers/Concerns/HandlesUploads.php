<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandlesUploads
{
    /** Lebar/tinggi maksimal foto upload; cukup tajam untuk layar retina. */
    private const MAX_IMAGE_SIZE = 1600;

    protected function storeUpload(?UploadedFile $file, string $directory): ?string
    {
        if (! $file) {
            return null;
        }

        return $this->storeAsWebp($file, $directory) ?? $file->store($directory, 'public');
    }

    /**
     * Kecilkan foto JPEG/PNG/WebP lalu simpan sebagai WebP agar ringan di HP.
     * Null bila GD tanpa dukungan WebP atau file bukan foto (PDF, SVG, GIF animasi):
     * file lalu disimpan apa adanya.
     */
    private function storeAsWebp(UploadedFile $file, string $directory): ?string
    {
        if (! function_exists('imagewebp')
            || ! in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/webp'], true)) {
            return null;
        }

        $image = @imagecreatefromstring($file->getContent());
        if (! $image) {
            return null;
        }

        $width = imagesx($image);
        $height = imagesy($image);
        $scale = min(1, self::MAX_IMAGE_SIZE / max($width, $height));
        if ($scale < 1) {
            $image = imagescale($image, (int) round($width * $scale), (int) round($height * $scale));
        }

        imagepalettetotruecolor($image);
        imagealphablending($image, false);
        imagesavealpha($image, true);

        ob_start();
        imagewebp($image, null, 80);
        $path = $directory.'/'.Str::random(40).'.webp';
        Storage::disk('public')->put($path, ob_get_clean());

        return $path;
    }

    /**
     * Hapus file upload lama. File bawaan desain (public/assets) tidak disentuh.
     */
    protected function deleteUpload(?string $path): void
    {
        if ($path && ! str_starts_with($path, 'assets/')) {
            Storage::disk('public')->delete($path);
        }
    }
}
