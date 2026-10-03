<?php

namespace App\Support;

use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

/**
 * Isi dari editor Trix (HTML) atau teks biasa lama, diubah jadi HTML yang aman untuk ditampilkan.
 */
class RichText
{
    /** Tag yang boleh tampil; selain ini dibuang (termasuk script, style, atribut on*). */
    private const TAGS = ['p', 'div', 'br', 'strong', 'b', 'em', 'i', 'del', 'h1', 'h2', 'h3', 'ul', 'ol', 'li', 'blockquote', 'pre'];

    public static function isHtml(?string $text): bool
    {
        return (bool) preg_match('/<(p|div|br|h[1-3]|ul|ol|blockquote|strong|em|a)\b/i', (string) $text);
    }

    /**
     * HTML siap tampil. Teks biasa: baris kosong = paragraf baru (seperti sebelum ada editor).
     */
    public static function toHtml(?string $text): string
    {
        if (! self::isHtml($text)) {
            return self::paragraphs($text);
        }

        $html = self::sanitizer()->sanitize((string) $text);

        // Trix memakai <div> per blok; tampilkan sebagai paragraf agar ikut gaya halaman.
        return str_replace(['<div>', '</div>'], ['<p>', '</p>'], $html);
    }

    /**
     * Nilai awal editor: teks biasa lama diubah ke paragraf HTML agar baris barunya tidak hilang.
     */
    public static function forEditor(?string $text): string
    {
        return self::isHtml($text) ? (string) $text : self::paragraphs($text);
    }

    private static function paragraphs(?string $text): string
    {
        return collect(preg_split('/\R\s*\R/', trim((string) $text)))
            ->filter(fn (string $paragraph) => trim($paragraph) !== '')
            ->map(fn (string $paragraph) => '<p>'.nl2br(e(trim($paragraph))).'</p>')
            ->implode("\n");
    }

    private static function sanitizer(): HtmlSanitizer
    {
        $config = (new HtmlSanitizerConfig)
            ->allowLinkSchemes(['http', 'https', 'mailto'])
            ->allowElement('a', ['href'])
            ->forceAttribute('a', 'rel', 'noopener noreferrer')
            ->forceAttribute('a', 'target', '_blank');

        foreach (self::TAGS as $tag) {
            $config = $config->allowElement($tag);
        }

        return new HtmlSanitizer($config);
    }
}
