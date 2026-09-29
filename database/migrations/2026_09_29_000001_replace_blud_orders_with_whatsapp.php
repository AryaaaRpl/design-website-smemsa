<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Sistem pesanan BLUD diganti "Pesan via WhatsApp":
 * tabel pesanan & kolom stok/varian dihapus, produk boleh punya nomor WhatsApp sendiri.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('orders');

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['stock', 'variants']);
            // Kosong = memakai nomor WhatsApp unit usaha.
            $table->string('whatsapp', 20)->nullable()->after('price_unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('whatsapp');
            $table->json('variants')->nullable();
            $table->unsignedInteger('stock')->nullable();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('business_unit_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_name');
            $table->string('variant')->nullable();
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('unit_price');
            $table->string('customer_name');
            $table->string('customer_phone', 20);
            $table->text('note')->nullable();
            $table->string('status')->default('baru');
            $table->boolean('stock_deducted')->default(false);
            $table->timestamps();
        });
    }
};
