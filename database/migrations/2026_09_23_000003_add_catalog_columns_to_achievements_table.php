<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom tambahan untuk katalog di halaman prestasi.
     */
    public function up(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            // Nama event sudah terwakili oleh judul, jadi tidak wajib diisi.
            $table->string('event_name')->nullable()->change();

            $table->string('field_label', 100)->nullable()->after('title');
            $table->string('excerpt', 500)->nullable()->after('participants');
            $table->string('location')->nullable()->after('organizer');
        });
    }

    public function down(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->dropColumn(['field_label', 'excerpt', 'location']);
            $table->string('event_name')->nullable(false)->change();
        });
    }
};
