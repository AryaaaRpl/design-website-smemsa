<?php

namespace Tests\Feature;

use App\Models\Major;
use Database\Seeders\MajorSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VisionMissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_majors_section_uses_database(): void
    {
        $this->seed(MajorSeeder::class);
        Major::firstWhere('code', 'PH')->update(['is_active' => false]);

        $this->get(route('visi-misi'))
            ->assertOk()
            ->assertSee("openMajorModal('rpl')", false)
            ->assertSee('Desain Komunikasi Visual')
            ->assertDontSee("openMajorModal('ph')", false)
            ->assertDontSee('Data jurusan belum tersedia');
    }

    public function test_profile_array_takes_career_line(): void
    {
        $major = new Major([
            'code' => 'PPLG',
            'name' => 'Pengembang Perangkat Lunak & Gim',
            'career_items' => ['Mitra: Hummatech.', 'Karir: Web Developer, QA.'],
        ]);

        $data = $major->toProfileArray();

        $this->assertSame('Pengembang Perangkat Lunak & Gim (PPLG)', $data['title']);
        $this->assertSame('Web Developer, QA.', $data['career']);
    }

    public function test_empty_state_when_no_majors(): void
    {
        $this->get(route('visi-misi'))
            ->assertOk()
            ->assertSee('Data jurusan belum tersedia')
            ->assertDontSee('onclick="openMajorModal(', false);
    }
}
