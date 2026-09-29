<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotFoundPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_unknown_url_shows_custom_404_page(): void
    {
        $this->get('/halaman-yang-tidak-pernah-ada')
            ->assertNotFound()
            ->assertSee('Halaman Tidak Ditemukan')
            ->assertSee('/halaman-yang-tidak-pernah-ada')
            ->assertSee('Kembali ke Beranda');
    }

    public function test_missing_record_also_shows_custom_404_page(): void
    {
        $this->get('/blud/produk-yang-sudah-dihapus')
            ->assertNotFound()
            ->assertSee('Halaman Tidak Ditemukan');
    }

    public function test_requested_path_is_escaped(): void
    {
        $this->get('/%3Cscript%3Ealert(1)%3C/script%3E')
            ->assertNotFound()
            ->assertDontSee('<script>alert(1)</script>', false);
    }
}
