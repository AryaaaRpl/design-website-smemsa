<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Fitur "prestasi unggulan" dihapus: kartu Mahkota Prestasi kini otomatis
 * menampilkan prestasi tingkat tertinggi yang paling baru.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('achieved_at');
        });
    }
};
