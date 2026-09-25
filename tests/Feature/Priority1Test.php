<?php

namespace Tests\Feature;

use App\Enums\TeacherCategory;
use App\Models\JobVacancy;
use App\Models\Partner;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Prioritas 1: redirect peta-sekolah, sambutan kepala sekolah, tahun copyright, data chatbot.
 */
class Priority1Test extends TestCase
{
    use RefreshDatabase;

    public function test_peta_sekolah_redirects_to_facility_map(): void
    {
        $this->get('/peta-sekolah')
            ->assertOk()
            ->assertSee('window.location.href = "'.url('/fasilitas').'#denah"', false)
            ->assertDontSee('fasilitas.html');
    }

    public function test_welcome_section_uses_principal_from_teacher_module(): void
    {
        Teacher::create([
            'name' => 'Budi Kepala, M.Pd', 'slug' => 'budi', 'position' => 'Kepala Sekolah',
            'category' => TeacherCategory::Principal, 'quote' => 'Belajar sepanjang hayat.',
        ]);

        $this->get(route('home'))
            ->assertSee('Budi Kepala, M.Pd')
            ->assertSee('"Belajar sepanjang hayat."', false)
            // Chatbot ikut memakai nama yang sama.
            ->assertSee('Bapak Budi Kepala, M.Pd.', false);
    }

    public function test_welcome_section_falls_back_to_default_without_principal(): void
    {
        $this->get(route('home'))
            ->assertSee('Wahid Wahyudi, S.E., M.M.')
            ->assertSee('PAK-WAHID-AI-e1781064934191.png', false);
    }

    public function test_copyright_year_is_current_year(): void
    {
        $this->get(route('berita'))->assertSee('&copy; '.now()->year.' SMKS Muhammadiyah 1 Genteng.', false);
    }

    public function test_chatbot_lists_open_vacancies_from_database(): void
    {
        $partner = Partner::create(['name' => 'PT Chatbot Uji', 'slug' => 'pt-chatbot-uji']);
        JobVacancy::create([
            'partner_id' => $partner->id, 'position' => 'Operator Produksi', 'slug' => 'operator',
            'employment_type' => 'full-time', 'closes_at' => today()->addWeek(),
        ]);
        JobVacancy::create([
            'partner_id' => $partner->id, 'position' => 'Lowongan Kedaluwarsa', 'slug' => 'lewat',
            'employment_type' => 'full-time', 'closes_at' => today()->subDay(),
        ]);

        $this->get(route('berita'))
            ->assertSee('Operator Produksi')
            ->assertDontSee('Lowongan Kedaluwarsa')
            // Daftar lowongan lama (statis) sudah tidak ada.
            ->assertDontSee('Web &amp; Mobile Developer - PT Digital Kreatif Nusantara (Malang)', false)
            ->assertDontSee('Gaji: Rp 4.200.000');
    }
}
