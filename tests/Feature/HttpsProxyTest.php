<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Di belakang Cloudflare, link aset harus tetap https:// (mencegah font diblokir "Mixed Content").
 */
class HttpsProxyTest extends TestCase
{
    use RefreshDatabase;

    public function test_assets_use_https_behind_cloudflare(): void
    {
        $html = $this->withHeaders(['X-Forwarded-Proto' => 'https'])
            ->get('/')
            ->assertOk()
            ->getContent();

        $this->assertStringContainsString('https://localhost:8000/fonts/plus-jakarta-sans/', $html);
        $this->assertStringNotContainsString("url('http://localhost:8000/fonts/", $html);
    }
}
