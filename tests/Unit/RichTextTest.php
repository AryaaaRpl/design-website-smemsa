<?php

namespace Tests\Unit;

use App\Support\RichText;
use PHPUnit\Framework\TestCase;

/**
 * Isi editor dibersihkan dari tag berbahaya; teks lama tetap jadi paragraf.
 */
class RichTextTest extends TestCase
{
    public function test_plain_text_becomes_escaped_paragraphs(): void
    {
        $this->assertSame("<p>Baris 1<br />\nBaris 2</p>\n<p>&lt;b&gt;bukan tag&lt;/b&gt;</p>", RichText::toHtml("Baris 1\nBaris 2\n\n<b>bukan tag</b>"));
        $this->assertSame('<p>Halo</p>', RichText::forEditor('Halo'));
    }

    public function test_editor_html_is_sanitized(): void
    {
        $html = RichText::toHtml('<div>Isi <strong>tebal</strong><script>alert(1)</script></div>'
            .'<h1 onclick="x()">Judul</h1><ul><li>Satu</li></ul>'
            .'<a href="javascript:alert(1)">jahat</a><a href="https://smemsa.sch.id">aman</a><img src="x" onerror="y">');

        $this->assertStringContainsString('<p>Isi <strong>tebal</strong></p>', $html);
        $this->assertStringContainsString('<h1>Judul</h1><ul><li>Satu</li></ul>', $html);
        $this->assertStringContainsString('href="https://smemsa.sch.id"', $html);
        $this->assertStringContainsString('rel="noopener noreferrer"', $html);
        foreach (['script', 'onclick', 'javascript:', '<img', 'onerror'] as $bad) {
            $this->assertStringNotContainsString($bad, $html);
        }
    }
}
