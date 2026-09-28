<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Satu baris = satu pengunjung unik pada satu hari (WIB).
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->date('visited_on');
            // Hash dari IP + browser + tanggal; IP asli tidak disimpan.
            $table->char('visitor_hash', 64);
            $table->timestamp('created_at')->nullable();

            $table->unique(['visited_on', 'visitor_hash']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
