<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Nama penulis/tim yang tampil di samping tanggal, misalnya "Tim Jurnalistik".
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('byline', 100)->nullable()->after('location');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('byline');
        });
    }
};
