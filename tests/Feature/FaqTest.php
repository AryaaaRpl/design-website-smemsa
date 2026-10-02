<?php

namespace Tests\Feature;

use App\Models\Faq;
use App\Models\Setting;
use App\Models\User;
use Database\Seeders\FaqSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * SPMB: FAQ dari admin, kode {…} diganti nilai Pengaturan.
 */
class FaqTest extends TestCase
{
    use RefreshDatabase;

    public function test_spmb_page_shows_seeded_faqs_with_settings_values(): void
    {
        $this->seed(FaqSeeder::class);
        Setting::create(['key' => 'fee_tuition', 'value' => '7000000']);

        $this->get('/spmb')->assertOk()
            ->assertSee('Tahun Ajaran 2026/2027 dibuka?')
            ->assertSee('Biaya PSM 1 Tahun sebesar Rp 7.000.000 dapat dicicil 2 kali per semester (Rp 3.500.000 per semester)')
            ->assertSee('faq-ans-5', false)
            ->assertDontSee('{biaya_psm}');
    }

    public function test_admin_manages_faqs(): void
    {
        $this->actingAs(User::factory()->create());
        $data = ['question' => 'Apakah ada asrama?', 'answer' => 'Ada, khusus <b>putra</b>.', 'sort_order' => 1, 'is_published' => '1'];

        $this->get(route('admin.faqs.index'))->assertOk();
        $this->get(route('admin.faqs.create'))->assertOk();
        $this->post(route('admin.faqs.store'), $data)->assertRedirect(route('admin.faqs.index'));

        $faq = Faq::sole();
        $this->get('/spmb')->assertSee('Apakah ada asrama?')->assertDontSee('<b>putra</b>', false);

        $this->get(route('admin.faqs.edit', $faq))->assertOk();
        $this->put(route('admin.faqs.update', $faq), ['is_published' => '0'] + $data)->assertRedirect();
        $this->get('/spmb')->assertDontSee('Apakah ada asrama?');

        $this->put(route('admin.faqs.update', $faq), ['question' => ''] + $data)->assertSessionHasErrors('question');

        $this->delete(route('admin.faqs.destroy', $faq))->assertRedirect();
        $this->assertModelMissing($faq);
    }
}
