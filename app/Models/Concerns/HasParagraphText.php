<?php

namespace App\Models\Concerns;

/**
 * Mengubah teks biasa menjadi paragraf HTML yang aman (sudah di-escape).
 * Baris kosong = paragraf baru.
 */
trait HasParagraphText
{
    protected function paragraphsToHtml(?string $text): string
    {
        $paragraphs = preg_split('/\R\s*\R/', trim((string) $text));

        return collect($paragraphs)
            ->filter(fn (string $paragraph) => trim($paragraph) !== '')
            ->map(fn (string $paragraph) => '<p>'.nl2br(e(trim($paragraph))).'</p>')
            ->implode("\n");
    }
}
