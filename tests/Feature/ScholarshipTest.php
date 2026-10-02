<?php

namespace Tests\Feature;

use App\Models\Scholarship;
use App\Models\Setting;
use App\Models\User;
use Database\Seeders\ScholarshipSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * SPMB: biaya dari Pengaturan > Biaya SPMB dan skema beasiswa dari admin.
 */
class ScholarshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_spmb_page_shows_default_fees_and_seeded_scholarships(): void
    {
        $this->seed(ScholarshipSeeder::class);

        $this->get('/spmb')->assertOk()
            ->assertSee('Rp 1.550.000')->assertSee('Rp 3.175.000 / semester')
            ->assertSee('Rp 7.300.000')->assertSee('Rp 7.550.000')->assertSee('Rp 7.600.000')
            ->assertSee('9 Kategori Beasiswa')
            ->assertSee('<strong>kedua orang tuanya telah wafat</strong>', false)
            ->assertSee('Gratis 100% (Bebas Biaya 3 Thn)')
            // Berkas wajib sama dengan unggahan pendaftaran online.
            ->assertSeeInOrder(['Scan/Foto Kartu Keluarga', 'Scan/Foto Akta Kelahiran', 'Scan/Foto Ijazah SMP/MTs', 'Scan/Foto Pas Foto 3x4']);
    }

    public function test_fee_setting_recalculates_totals(): void
    {
        Setting::create(['key' => 'fee_tuition', 'value' => '7000000']);

        $this->get('/spmb')->assertOk()
            ->assertSee('Rp 3.500.000 / semester')
            ->assertSee('Rp 7.950.000')
            ->assertDontSee('Rp 6.350.000');
    }

    public function test_admin_manages_scholarships(): void
    {
        $this->actingAs(User::factory()->create());
        $data = [
            'name' => 'Beasiswa Atlet', 'tag' => 'Olahraga', 'tag_color' => 'blue',
            'description' => 'Juara <strong>provinsi</strong><script>x</script>', 'period' => 'Sekali', 'amount' => 'Potongan Rp 300.000',
            'tone' => 'nominal', 'sort_order' => 1, 'is_published' => '1',
        ];

        $this->get(route('admin.scholarships.index'))->assertOk();
        $this->get(route('admin.scholarships.create'))->assertOk();
        $this->post(route('admin.scholarships.store'), $data)->assertRedirect(route('admin.scholarships.index'));

        $scholarship = Scholarship::sole();
        $this->get('/spmb')->assertSee('Beasiswa Atlet')->assertSee('<strong>provinsi</strong>', false)->assertDontSee('<script>x', false);

        $this->get(route('admin.scholarships.edit', $scholarship))->assertOk();
        $this->put(route('admin.scholarships.update', $scholarship), ['is_published' => '0'] + $data)->assertRedirect();
        $this->get('/spmb')->assertDontSee('Beasiswa Atlet');

        $this->put(route('admin.scholarships.update', $scholarship), ['tone' => 'ngawur'] + $data)->assertSessionHasErrors('tone');

        $this->delete(route('admin.scholarships.destroy', $scholarship))->assertRedirect();
        $this->assertModelMissing($scholarship);
    }
}
