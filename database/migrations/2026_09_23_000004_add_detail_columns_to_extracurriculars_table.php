<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom tambahan untuk kartu & modal di halaman ekstrakurikuler.
     */
    public function up(): void
    {
        Schema::table('extracurriculars', function (Blueprint $table) {
            // Digantikan oleh card_style (normal / featured / tall).
            $table->dropColumn('is_highlighted');
        });

        Schema::table('extracurriculars', function (Blueprint $table) {
            $table->string('card_style', 20)->default('normal')->after('image');
            $table->string('modal_image')->nullable()->after('image');
            // Nama pembina ditulis bebas; coach_id tetap ada untuk relasi ke data guru nanti.
            $table->string('coach_name')->nullable()->after('coach_id');
            $table->string('location')->nullable()->after('schedule');
            $table->string('audience')->nullable()->after('location');
            $table->json('achievements')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('extracurriculars', function (Blueprint $table) {
            $table->dropColumn(['card_style', 'modal_image', 'coach_name', 'location', 'audience', 'achievements']);
            $table->boolean('is_highlighted')->default(false);
        });
    }
};
