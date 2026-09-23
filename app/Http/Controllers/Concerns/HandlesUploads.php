<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HandlesUploads
{
    protected function storeUpload(?UploadedFile $file, string $directory): ?string
    {
        return $file?->store($directory, 'public');
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
