<?php

namespace Tests\Unit;

use App\Support\Media;
use Tests\TestCase;

class MediaTest extends TestCase
{
    public function test_design_image_uses_generated_webp_twin(): void
    {
        $this->assertSame(asset('assets/background/3orang.webp'), Media::asset('assets/background/3orang.png'));
    }

    public function test_image_without_twin_keeps_original_path(): void
    {
        $this->assertSame(asset('assets/logo.webp'), Media::asset('assets/logo.webp'));
        $this->assertSame(asset('assets/tidak-ada.png'), Media::asset('assets/tidak-ada.png'));
    }

    public function test_every_manifest_entry_points_to_existing_files(): void
    {
        $manifest = json_decode(file_get_contents(resource_path('webp-manifest.json')), true);

        foreach ($manifest as $original => $webp) {
            $this->assertFileExists(public_path($original));
            $this->assertFileExists(public_path($webp));
        }
    }
}
