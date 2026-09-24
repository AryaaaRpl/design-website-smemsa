<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Nama pendek jurusan untuk tombol pintasan di beranda, contoh: "Akuntansi".
     */
    public function up(): void
    {
        Schema::table('majors', function (Blueprint $table) {
            $table->string('short_name', 50)->nullable()->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('majors', function (Blueprint $table) {
            $table->dropColumn('short_name');
        });
    }
};
