<?php

namespace Tests\Feature;

use App\Models\Major;
use Database\Seeders\MajorSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VisionMissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_major_buttons_link_to_major_detail_page(): void
    {
        $this->seed(MajorSeeder::class);
        Major::firstWhere('code', 'PH')->update(['is_active' => false]);

        $this->get(route('visi-misi'))
            ->assertOk()
            ->assertSee('href="'.route('jurusan.show', 'rpl').'" class="major-chip"', false)
            ->assertSee('Desain Komunikasi Visual')
            ->assertDontSee(route('jurusan.show', 'ph'), false)
            ->assertDontSee('openMajorModal')
            ->assertDontSee('major-modal-overlay')
            ->assertDontSee('Data jurusan belum tersedia');
    }

    public function test_empty_state_when_no_majors(): void
    {
        $this->get(route('visi-misi'))
            ->assertOk()
            ->assertSee('Data jurusan belum tersedia');
    }
}
