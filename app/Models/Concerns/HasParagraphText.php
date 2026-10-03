<?php

namespace App\Models\Concerns;

use App\Support\RichText;

/**
 * Isi panjang (editor Trix atau teks biasa lama) menjadi HTML yang aman. Lihat RichText.
 */
trait HasParagraphText
{
    protected function paragraphsToHtml(?string $text): string
    {
        return RichText::toHtml($text);
    }
}
