<?php

namespace Tests\Feature;

use App\Enums\OrderStatus;
use App\Models\BusinessUnit;
use App\Models\Major;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\BludSeeder;
use Database\Seeders\MajorSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Modul BLUD: admin unit usaha & produk, halaman publik, pemesanan, dan stok.
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
            'type' => 'barang', 'price' => 35000, 'price_unit' => 'botol', 'stock' => 5,
        ], $overrides));
    }

    // ---------- Admin ----------

    public function test_guest_cannot_access_blud_admin(): void
    {
        $this->get(route('admin.business-units.index'))->assertRedirect(route('admin.login'));
        $this->get(route('admin.products.index'))->assertRedirect(route('admin.login'));
        $this->get(route('admin.orders.index'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_pages_render(): void
    {
        $product = $this->product($unit = $this->unit(), ['variants' => ['A'], 'specs' => [['label' => 'Kemasan', 'value' => '35 mL']]]);
        $this->actingAs(User::factory()->create());

        $this->get(route('admin.business-units.index'))->assertOk()->assertSee('Print Studio');
        $this->get(route('admin.business-units.create'))->assertOk();
        $this->get(route('admin.business-units.edit', $unit))->assertOk();
        $this->get(route('admin.products.index'))->assertOk()->assertSee('Rp 35.000 / botol');
        $this->get(route('admin.products.create'))->assertOk();
        $this->get(route('admin.products.edit', $product))->assertOk()->assertSee('Kemasan: 35 mL');
        $this->get(route('admin.dashboard'))->assertOk()->assertSee('Pesanan BLUD Baru');
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

    public function test_admin_can_create_product_and_service_has_no_stock(): void
    {
        $unit = $this->unit();
        $admin = User::factory()->create();

        $this->actingAs($admin)->post(route('admin.products.store'), [
            'business_unit_id' => $unit->id, 'name' => 'Eners Perfume', 'type' => 'barang',
            'price' => '35.000', 'stock' => 10, 'variants' => "Bubblegum\nBaccarat",
            'specs' => "Kemasan: 35 mL\n", 'sort_order' => 1, 'is_active' => '1',
        ])->assertRedirect(route('admin.products.index'));

        $product = Product::firstWhere('slug', 'eners-perfume');
        $this->assertSame(35000, $product->price);
        $this->assertSame(10, $product->stock);
        $this->assertSame(['Bubblegum', 'Baccarat'], $product->variants);
        $this->assertSame([['label' => 'Kemasan', 'value' => '35 mL']], $product->specs);

        // Jasa: stok selalu dikosongkan.
        $this->actingAs($admin)->post(route('admin.products.store'), [
            'business_unit_id' => $unit->id, 'name' => 'Servis Laptop', 'type' => 'jasa',
            'price' => 50000, 'stock' => 99, 'sort_order' => 2,
        ]);
        $this->assertNull(Product::firstWhere('slug', 'servis-laptop')->stock);
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
            // Harga hanya tampil di halaman detail.
            ->assertDontSee('Rp 35.000');

        $this->get(route('blud.index'))->assertOk()->assertSee('SMEMSA Tech Solutions');
        $this->get(route('blud.unit', 'smemsa-hospitality-hub'))->assertOk()->assertSee('Laundry Kiloan');
        $this->get(route('blud.show', 'eners-perfume'))->assertOk()->assertSee('Rp 35.000 / botol')->assertSee('Stok tersisa 30');
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

    // ---------- Pemesanan ----------

    public function test_visitor_order_is_saved_and_redirected_to_unit_whatsapp(): void
    {
        $product = $this->product($this->unit(), ['variants' => ['Bubblegum']]);

        $response = $this->post(route('blud.order', $product), [
            'customer_name' => 'Budi', 'customer_phone' => '081234567890',
            'variant' => 'Bubblegum', 'quantity' => 2, 'note' => 'Ambil hari Senin',
        ]);

        $order = Order::sole();
        $this->assertSame('6281234567890', $order->customer_phone);
        $this->assertSame(70000, $order->total);
        $this->assertSame(OrderStatus::New, $order->status);
        // Stok belum berkurang sebelum diproses admin.
        $this->assertSame(5, $product->fresh()->stock);

        $response->assertRedirect();
        $this->assertStringStartsWith('https://wa.me/6281111111111?text=', $response->headers->get('Location'));
        $this->assertStringContainsString(rawurlencode($order->code), $response->headers->get('Location'));
    }

    public function test_order_validation_for_variant_and_stock(): void
    {
        $product = $this->product($this->unit(), ['variants' => ['Bubblegum']]);

        $this->post(route('blud.order', $product), [
            'customer_name' => 'Budi', 'customer_phone' => '0812345678', 'variant' => 'Lain', 'quantity' => 6,
        ])->assertSessionHasErrors(['variant', 'quantity']);

        $product->update(['stock' => 0]);
        $this->post(route('blud.order', $product), [
            'customer_name' => 'Budi', 'customer_phone' => '0812345678', 'variant' => 'Bubblegum', 'quantity' => 1,
        ])->assertSessionHasErrors('quantity');

        $this->assertDatabaseCount('orders', 0);
    }

    public function test_processing_order_deducts_stock_and_cancel_restores_it(): void
    {
        $product = $this->product($this->unit());
        $order = Order::create([
            'product_id' => $product->id, 'business_unit_id' => $product->business_unit_id,
            'product_name' => 'Parfum', 'quantity' => 3, 'unit_price' => 35000,
            'customer_name' => 'Budi', 'customer_phone' => '6281234567890',
        ]);
        $admin = User::factory()->create();

        $this->actingAs($admin)->put(route('admin.orders.update', $order), ['status' => 'diproses']);
        $this->assertSame(2, $product->fresh()->stock);

        // Diproses -> Selesai tidak memotong stok lagi.
        $this->actingAs($admin)->put(route('admin.orders.update', $order), ['status' => 'selesai']);
        $this->assertSame(2, $product->fresh()->stock);

        $this->actingAs($admin)->put(route('admin.orders.update', $order), ['status' => 'batal']);
        $this->assertSame(5, $product->fresh()->stock);
    }

    public function test_processing_fails_when_stock_is_not_enough(): void
    {
        $product = $this->product($this->unit(), ['stock' => 1]);
        $order = Order::create([
            'product_id' => $product->id, 'business_unit_id' => $product->business_unit_id,
            'product_name' => 'Parfum', 'quantity' => 3, 'unit_price' => 35000,
            'customer_name' => 'Budi', 'customer_phone' => '6281234567890',
        ]);

        $this->actingAs(User::factory()->create())
            ->put(route('admin.orders.update', $order), ['status' => 'diproses'])
            ->assertSessionHasErrors('status');

        $this->assertSame(OrderStatus::New, $order->fresh()->status);
        $this->assertSame(1, $product->fresh()->stock);
    }

    public function test_admin_order_list_shows_new_order_badge(): void
    {
        $product = $this->product($this->unit());
        Order::create([
            'product_id' => $product->id, 'business_unit_id' => $product->business_unit_id,
            'product_name' => 'Parfum', 'quantity' => 1, 'unit_price' => 35000,
            'customer_name' => 'Pemesan Uji', 'customer_phone' => '6281234567890',
        ]);

        $this->actingAs(User::factory()->create())
            ->get(route('admin.orders.index'))
            ->assertOk()
            ->assertSee('Pemesan Uji')
            ->assertSee('title="Pesanan baru">1<', false);
    }
}
