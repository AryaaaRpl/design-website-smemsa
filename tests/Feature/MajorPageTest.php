<?php

namespace Tests\Feature;

use App\Enums\TeacherCategory;
use App\Models\Major;
use App\Models\Teacher;
use Database\Seeders\BkkSeeder;
use Database\Seeders\MajorPartnerSeeder;
use Database\Seeders\MajorSeeder;
use Database\Seeders\TestimonialSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MajorPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_page_shows_active_majors_as_cards(): void
    {
        $this->seed(MajorSeeder::class);
        Major::firstWhere('code', 'PH')->update(['is_active' => false]);

        $this->get(route('jurusan.index'))
            ->assertOk()
            ->assertSee('6 Program Keahlian,', false)
            ->assertSee(route('jurusan.show', 'rpl'), false)
            ->assertSee('Pengembang Perangkat Lunak &amp; Gim', false)
            ->assertDontSee(route('jurusan.show', 'ph'), false);
    }

    public function test_list_page_shows_empty_state(): void
    {
        $this->get(route('jurusan.index'))
            ->assertOk()
            ->assertSee('Data jurusan belum tersedia');
    }

    public function test_detail_page_shows_complete_data(): void
    {
        $this->seed([MajorSeeder::class, BkkSeeder::class, MajorPartnerSeeder::class, TestimonialSeeder::class]);
        $major = Major::firstWhere('slug', 'rpl');
        Teacher::create([
            'name' => 'Dinda Nurmawati, S.Kom', 'slug' => 'dinda', 'position' => 'Ketua Program',
            'category' => TeacherCategory::HeadOfMajor, 'major_id' => $major->id,
        ]);

        $this->get(route('jurusan.show', $major))
            ->assertOk()
            ->assertSee('Dari Kelas X ke Tempat Kerja')
            ->assertSee('Web Modern (HTML5, CSS3, JS, Laravel/Node)')
            ->assertSee('Dinda Nurmawati, S.Kom')
            ->assertSee('Mitra Industri PPLG')
            ->assertSee('PT. Hummatech')
            ->assertSee('Junior Web Developer')
            ->assertSee('Ahmad Rizqi Pratama')
            ->assertSee(route('jurusan.show', 'tkj'), false);
    }

    public function test_detail_page_hides_empty_sections(): void
    {
        $major = Major::create(['code' => 'TKR', 'name' => 'Teknik Kendaraan Ringan', 'slug' => 'tkr']);

        $this->get(route('jurusan.show', $major))
            ->assertOk()
            ->assertSee('Informasi segera tersedia')
            ->assertDontSee('Kepala Konsentrasi Keahlian')
            ->assertDontSee('Mitra Industri TKR')
            ->assertDontSee('Kata Alumni');
    }

    public function test_inactive_or_unknown_major_returns_404(): void
    {
        Major::create(['code' => 'X', 'name' => 'Nonaktif', 'slug' => 'nonaktif', 'is_active' => false]);

        $this->get(route('jurusan.show', 'nonaktif'))->assertNotFound();
        $this->get('/jurusan/tidak-ada')->assertNotFound();
    }

    public function test_navbar_marks_major_menu_active_and_home_links_to_detail(): void
    {
        $this->seed(MajorSeeder::class);

        $this->get(route('jurusan.show', 'rpl'))
            ->assertSee('<a href="'.url('/jurusan').'" class="nav-link active">Konsentrasi Keahlian</a>', false);

        $this->get(route('home'))
            ->assertSee('id="panel-detail-link"', false)
            ->assertSee(route('jurusan.show', 'rpl'), false);
    }
}
