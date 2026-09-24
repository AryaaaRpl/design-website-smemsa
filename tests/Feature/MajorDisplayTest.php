<?php

namespace Tests\Feature;

use App\Models\Major;
use Database\Seeders\MajorSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Tampilan data jurusan di beranda, footer, meta & chatbot untuk berbagai jumlah data.
 */
class MajorDisplayTest extends TestCase
{
    use RefreshDatabase;

    private function makeMajors(int $count): void
    {
        foreach (range(1, $count) as $i) {
            Major::create(['code' => "J{$i}", 'name' => "Jurusan Uji {$i}", 'slug' => "jurusan-{$i}", 'sort_order' => $i]);
        }
    }

    public function test_without_majors_sections_are_hidden_or_show_empty_state(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertDontSee('major-quick-chips-section', false)
            ->assertDontSee('spmb-point-num">0', false)
            ->assertSee('Jelajahi Konsentrasi Keahlian')
            ->assertSee('Data jurusan belum tersedia')
            ->assertSee('Informasi segera tersedia');

        // Footer tampil di semua halaman.
        $this->get(route('berita'))->assertOk()->assertSee('Informasi segera tersedia');
    }

    public function test_one_major_is_displayed_everywhere(): void
    {
        $this->makeMajors(1);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Jelajahi 1 Konsentrasi Keahlian')
            ->assertSee('<h4>1 Konsentrasi</h4>', false)
            ->assertSee('jumpToMajor(\'jurusan-1\')', false)
            ->assertSee('--a: 0deg; --r: 210px', false);
    }

    public function test_two_majors_are_spread_evenly_on_the_orbit(): void
    {
        $this->makeMajors(2);

        $this->get(route('home'))
            ->assertSee('--a: 0deg; --r: 210px', false)
            ->assertSee('--a: 180deg; --r: 210px', false)
            ->assertDontSee('--r: 300px', false);
    }

    public function test_seeded_majors_keep_original_design(): void
    {
        $this->seed(MajorSeeder::class);

        $response = $this->get(route('home'))->assertOk();

        // Orbit sama seperti desain awal: dalam tiap 90deg, luar 45/135/225deg.
        foreach ([0, 90, 180, 270] as $angle) {
            $response->assertSee("--a: {$angle}deg; --r: 210px", false);
        }
        foreach ([45, 135, 225] as $angle) {
            $response->assertSee("--a: {$angle}deg; --r: 300px", false);
        }

        $response->assertSee('Jelajahi 7 Konsentrasi Keahlian')
            ->assertSee('<span class="spmb-point-num">7</span>', false)
            ->assertSee('Akuntansi')
            ->assertSee('dengan 7 Konsentrasi Keahlian Industri', false);

        // Footer di halaman lain menautkan ke beranda.
        $this->get(route('bkk'))
            ->assertSee('Pengembang Perangkat Lunak &amp; Gim', false)
            ->assertSee(url('/').'#jurusan', false);
    }

    public function test_inactive_major_is_not_displayed(): void
    {
        $this->seed(MajorSeeder::class);
        Major::firstWhere('code', 'PH')->update(['is_active' => false]);

        $this->get(route('home'))
            ->assertSee('Jelajahi 6 Konsentrasi Keahlian')
            ->assertDontSee("jumpToMajor('ph')", false);
    }
}
