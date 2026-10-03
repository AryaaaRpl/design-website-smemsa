<?php

namespace Tests\Feature;

use App\Models\BusinessUnit;
use App\Models\Major;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\BludSeeder;
use Database\Seeders\MajorSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * Modul BLUD: CRUD unit usaha & produk, halaman publik, dan pesan via WhatsApp.
 */
class BludTest extends TestCase
{
    use RefreshDatabase;

    private function unit(array $overrides = []): BusinessUnit
    {
        return BusinessUnit::create(array_merge([
            'name' => 'Print Studio', 'slug' => 'print-studio', 'whatsapp' => '6281111111111',
        ], $overrides));
    }

    private function product(BusinessUnit $unit, array $overrides = []): Product
    {
        return Product::create(array_merge([
            'business_unit_id' => $unit->id, 'name' => 'Parfum', 'slug' => 'parfum',
            'type' => 'barang', 'price' => 35000, 'price_unit' => 'botol',
        ], $overrides));
    }

    // ---------- Admin ----------

    public function test_guest_cannot_access_blud_admin(): void
    {
        $this->get(route('admin.business-units.index'))->assertRedirect(route('admin.login'));
        $this->get(route('admin.products.index'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_pages_render(): void
    {
        $product = $this->product($unit = $this->unit(), ['specs' => [['label' => 'Kemasan', 'value' => '35 mL']]]);
        $this->actingAs(User::factory()->create());

        $this->get(route('admin.business-units.index'))->assertOk()->assertSee('Print Studio');
        $this->get(route('admin.business-units.create'))->assertOk();
        $this->get(route('admin.business-units.edit', $unit))->assertOk();
        $this->get(route('admin.products.index'))->assertOk()->assertSee('Rp 35.000 / botol');
        $this->get(route('admin.products.create'))->assertOk();
        $this->get(route('admin.products.edit', $product))->assertOk()->assertSee('Kemasan: 35 mL');
        $this->get(route('admin.dashboard'))->assertOk()->assertDontSee('Pesanan BLUD Baru');
    }

    public function test_admin_can_create_business_unit_with_normalized_whatsapp(): void
    {
        $major = Major::create(['code' => 'DKV', 'name' => 'Desain Komunikasi Visual', 'slug' => 'dkv']);

        $this->actingAs(User::factory()->create())
            ->post(route('admin.business-units.store'), [
                'name' => 'SMEMSA Print Studio', 'managed_by' => 'siswa', 'whatsapp' => '0822-4135-6668',
                'features' => "Cetak Satuan\n\nHasil Presisi", 'sort_order' => 1, 'is_active' => '1',
                'majors' => [$major->id],
            ])
            ->assertRedirect(route('admin.business-units.index'));

        $unit = BusinessUnit::firstWhere('slug', 'smemsa-print-studio');
        $this->assertSame('6282241356668', $unit->whatsapp);
        $this->assertSame(['Cetak Satuan', 'Hasil Presisi'], $unit->features);
        $this->assertSame('Dikelola Siswa DKV', $unit->manager_label);
    }

    public function test_admin_can_create_product_with_optional_whatsapp(): void
    {
        $unit = $this->unit();
        $admin = User::factory()->create();

        $this->actingAs($admin)->post(route('admin.products.store'), [
            'business_unit_id' => $unit->id, 'name' => 'Eners Perfume', 'type' => 'barang',
            'price' => '35.000', 'whatsapp' => '0812-3456-7890',
            'specs' => "Kemasan: 35 mL\n", 'sort_order' => 1, 'is_active' => '1',
        ])->assertRedirect(route('admin.products.index'));

        $product = Product::firstWhere('slug', 'eners-perfume');
        $this->assertSame(35000, $product->price);
        $this->assertSame('6281234567890', $product->whatsapp);
        $this->assertSame([['label' => 'Kemasan', 'value' => '35 mL']], $product->specs);

        // Nomor boleh dikosongkan (memakai nomor unit usaha).
        $this->actingAs($admin)->post(route('admin.products.store'), [
            'business_unit_id' => $unit->id, 'name' => 'Aplikasi iCareMu', 'type' => 'jasa',
            'price' => 20000, 'price_unit' => '3 tahun', 'sort_order' => 2,
        ])->assertSessionHasNoErrors();
        $this->assertNull(Product::firstWhere('slug', 'aplikasi-icaremu')->whatsapp);
    }

    public function test_invalid_product_whatsapp_is_rejected(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('admin.products.store'), [
                'business_unit_id' => $this->unit()->id, 'name' => 'Kopi', 'type' => 'barang',
                'price' => 20000, 'whatsapp' => '12', 'sort_order' => 1,
            ])
            ->assertSessionHasErrors('whatsapp');
    }

    public function test_admin_can_update_and_delete_product_and_unit(): void
    {
        $unit = $this->unit();
        $product = $this->product($unit);
        $this->actingAs(User::factory()->create());

        $this->put(route('admin.products.update', $product), [
            'business_unit_id' => $unit->id, 'name' => 'Parfum Baru', 'slug' => 'parfum', 'type' => 'barang',
            'price' => 40000, 'sort_order' => 1, 'is_active' => '1',
        ])->assertRedirect(route('admin.products.index'));
        $this->assertSame('Parfum Baru', $product->fresh()->name);

        $this->delete(route('admin.products.destroy', $product->fresh()))->assertRedirect(route('admin.products.index'));
        $this->assertModelMissing($product);

        $this->delete(route('admin.business-units.destroy', $unit))->assertRedirect(route('admin.business-units.index'));
        $this->assertModelMissing($unit);
    }

    public function test_spec_lines_must_use_label_colon_value(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('admin.products.store'), [
                'business_unit_id' => $this->unit()->id, 'name' => 'Kopi', 'type' => 'barang',
                'price' => 20000, 'specs' => 'tanpa titik dua', 'sort_order' => 1,
            ])
            ->assertSessionHasErrors('specs.0.value');
    }

    // ---------- Halaman publik ----------

    public function test_public_pages_show_seeded_blud_data(): void
    {
        $this->seed([MajorSeeder::class, BludSeeder::class]);

        $this->get(route('home'))
            ->assertSee('Eners Perfume')
            ->assertSee(route('blud.show', 'eners-perfume'), false)
            ->assertSee(route('blud.unit', 'smemsa-print-studio'), false)
            ->assertDontSee('openBludModal')
            // Harga tidak ditampilkan di halaman publik (ditanyakan lewat WhatsApp).
            ->assertDontSee('Rp 35.000');

        $this->get(route('blud.index'))->assertOk()->assertSee('SMEMSA Tech Solutions');
        $this->get(route('blud.unit', 'smemsa-hospitality-hub'))->assertOk()->assertSee('Laundry Kiloan');
        $this->get(route('blud.show', 'eners-perfume'))->assertOk()->assertDontSee('Rp 35.000')->assertSee('Pesan via WhatsApp');
        $this->get(route('jurusan.show', 'ph'))->assertOk()->assertSee('Produk BLUD PH')->assertSee('Eners Perfume');
    }

    public function test_catalog_filter_hides_other_units_without_reload(): void
    {
        $print = $this->unit();
        $mart = $this->unit(['name' => 'Mart', 'slug' => 'mart']);
        $this->product($print, ['name' => 'Totebag', 'slug' => 'totebag']);
        $this->product($mart, ['name' => 'Kopi', 'slug' => 'kopi']);

        // Semua produk selalu ada di halaman; produk unit lain hanya disembunyikan.
        $html = $this->get(route('blud.index', ['unit' => 'mart']))
            ->assertOk()
            ->assertSee('Produk Mart')
            ->assertSee('Totebag')
            ->getContent();

        $this->assertMatchesRegularExpression('/class="bl-item" data-unit="print-studio"\s+hidden/', $html);
        $this->assertDoesNotMatchRegularExpression('/class="bl-item" data-unit="mart"\s+hidden/', $html);
    }

    public function test_missing_photos_show_placeholder_text(): void
    {
        $unit = $this->unit();
        $product = $this->product($unit, ['is_featured' => true]);

        $this->get(route('home'))->assertSee('Belum ada gambar');
        $this->get(route('blud.unit', $unit))->assertSee('Belum ada gambar');
        $this->get(route('blud.show', $product))->assertSee('Belum ada gambar');
    }

    public function test_hidden_product_or_unit_returns_404(): void
    {
        $unit = $this->unit();
        $hidden = $this->product($unit, ['is_active' => false]);
        $this->get(route('blud.show', $hidden))->assertNotFound();

        $unit->update(['is_active' => false]);
        $this->get(route('blud.unit', $unit))->assertNotFound();
    }

    // ---------- Pesan via WhatsApp ----------

    public function test_whatsapp_button_uses_unit_number_with_product_message(): void
    {
        $product = $this->product($this->unit());

        $link = $product->whatsappLink();
        $this->assertStringStartsWith('https://wa.me/6281111111111?text=', $link);
        $this->assertStringContainsString(rawurlencode('*Parfum*'), $link);
        $this->assertStringContainsString(rawurlencode(route('blud.show', $product)), $link);

        $this->get(route('blud.show', $product))
            ->assertOk()
            ->assertSee('Pesan via WhatsApp')
            ->assertSee('https://wa.me/6281111111111', false)
            ->assertDontSee('customer_name');
    }

    public function test_product_whatsapp_overrides_unit_number(): void
    {
        $product = $this->product($this->unit(), ['whatsapp' => '6289999999999']);

        $this->get(route('blud.show', $product))
            ->assertSee('https://wa.me/6289999999999', false)
            ->assertDontSee('https://wa.me/6281111111111', false);
    }

    public function test_order_system_is_removed(): void
    {
        $this->assertFalse(Route::has('blud.order'));
        $this->assertFalse(Route::has('admin.orders.index'));
        $this->assertFalse(Schema::hasTable('orders'));
        $this->assertFalse(Schema::hasColumn('products', 'stock'));

        $this->actingAs(User::factory()->create())
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertDontSee('Pesanan');
    }
}
