<?php

namespace Tests\Feature\Admin;

use App\Models\Setting;
use App\Models\User;
use App\Support\SiteSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create();
    }

    public function test_guest_cannot_access_settings(): void
    {
        $this->get(route('admin.settings.edit'))->assertRedirect(route('admin.login'));
    }

    public function test_every_tab_can_be_opened(): void
    {
        foreach (array_keys(SiteSettings::GROUPS) as $group) {
            $this->actingAs($this->admin)->get(route('admin.settings.edit', $group))->assertOk();
        }

        $this->actingAs($this->admin)->get(route('admin.settings.edit', 'tidak-ada'))->assertNotFound();
    }

    public function test_whatsapp_number_is_normalized(): void
    {
        $this->actingAs($this->admin)
            ->put(route('admin.settings.update', 'contact'), ['whatsapp' => '0812-3456-7890'])
            ->assertRedirect(route('admin.settings.edit', 'contact'))
            ->assertSessionHasNoErrors();

        $this->assertSame('6281234567890', Setting::getValue('whatsapp'));
    }

    public function test_invalid_values_are_rejected(): void
    {
        $this->actingAs($this->admin)
            ->put(route('admin.settings.update', 'stats'), ['employment_rate' => 120])
            ->assertSessionHasErrors('employment_rate');

        $this->actingAs($this->admin)
            ->put(route('admin.settings.update', 'social'), ['instagram_url' => 'bukan-link'])
            ->assertSessionHasErrors('instagram_url');

        $this->actingAs($this->admin)
            ->put(route('admin.settings.update', 'spmb'), ['spmb_academic_year' => '2027'])
            ->assertSessionHasErrors('spmb_academic_year');
    }

    public function test_empty_settings_use_default_dummy_values(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('92,4%')
            ->assertSee('Daftar SPMB 2026');

        $this->get('/spmb')
            ->assertSee('Tahun Ajaran 2026/2027')
            ->assertSee('0822-4135-6668');
    }

    public function test_saved_settings_appear_on_public_pages(): void
    {
        $this->actingAs($this->admin)->put(route('admin.settings.update', 'stats'), ['employment_rate' => '95.5', 'student_count' => '1200']);
        $this->actingAs($this->admin)->put(route('admin.settings.update', 'spmb'), ['spmb_academic_year' => '2027/2028', 'whatsapp_spmb' => '081111111111']);
        $this->actingAs($this->admin)->put(route('admin.settings.update', 'identity'), ['npsn' => '12345678', 'founded_year' => '1970']);

        $this->get(route('home'))
            ->assertSee('95,5%')
            ->assertSee('1200')
            ->assertSee('Daftar SPMB 2027')
            ->assertSee('NPSN 12345678', false);

        $this->get(route('bkk'))->assertSee('95.5%');

        $this->get('/spmb')
            ->assertSee('Tahun Ajaran 2027/2028')
            ->assertSee('https://wa.me/6281111111111', false)
            ->assertSee('0811-1111-1111');

        $this->get(route('prestasi'))->assertSee('Sejak 1970');
    }

    public function test_bkk_and_spmb_whatsapp_fall_back_to_general_number(): void
    {
        Setting::setValue('whatsapp', '6289999999999');

        $site = new SiteSettings;

        $this->assertSame('6289999999999', $site->whatsapp('bkk'));
        $this->assertSame('6289999999999', $site->whatsapp('spmb'));
        $this->assertSame('0899-9999-9999', $site->whatsappDisplay());
    }

    public function test_clearing_a_setting_returns_to_default(): void
    {
        Setting::setValue('npsn', '11111111');

        $this->actingAs($this->admin)->put(route('admin.settings.update', 'identity'), ['npsn' => '']);

        $this->assertNull(Setting::getValue('npsn'));
        $this->assertSame('20525597', (new SiteSettings)->get('npsn'));
    }
}
