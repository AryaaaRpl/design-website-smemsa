<?php

namespace App\Http\Controllers\Concerns;

use App\Support\Media;
use GdImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandlesUploads
{
    /** Lebar/tinggi maksimal foto upload; cukup tajam untuk layar retina. */
    private const MAX_IMAGE_SIZE = 1600;

    /** Lebar varian kartu: ±370px tampil di HP x DPR ±1,75. */
    private const CARD_IMAGE_WIDTH = 640;

    protected function storeUpload(?UploadedFile $file, string $directory): ?string
    {
        if (! $file) {
            return null;
        }

        return $this->storeAsWebp($file, $directory) ?? $file->store($directory, 'public');
    }

    /**
     * Kecilkan foto JPEG/PNG/WebP lalu simpan sebagai WebP agar ringan di HP,
     * beserta varian kecil -card.webp untuk kartu daftar (HasMediaUrl::cardMediaUrl).
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

        imagepalettetotruecolor($image);
        $path = $directory.'/'.Str::random(40).'.webp';
        $disk = Storage::disk('public');
        $disk->put($path, $this->encodeWebp($image, self::MAX_IMAGE_SIZE / max(imagesx($image), imagesy($image)), 80));
        $disk->put(Media::cardPath($path), $this->encodeWebp($image, self::CARD_IMAGE_WIDTH / imagesx($image), 60));

        return $path;
    }

    /** Perkecil gambar dengan faktor $scale (tidak pernah diperbesar), lalu encode WebP. */
    private function encodeWebp(GdImage $image, float $scale, int $quality): string
    {
        if ($scale < 1) {
            $image = imagescale($image, (int) round(imagesx($image) * $scale), (int) round(imagesy($image) * $scale));
        }
        imagealphablending($image, false);
        imagesavealpha($image, true);

        ob_start();
        imagewebp($image, null, $quality);

        return ob_get_clean();
    }

    /**
     * Hapus file upload lama beserta varian kartunya. File bawaan desain (public/assets) tidak disentuh.
     */
    protected function deleteUpload(?string $path): void
    {
        if ($path && ! str_starts_with($path, 'assets/')) {
            Storage::disk('public')->delete([$path, Media::cardPath($path)]);
        }
    }
}
