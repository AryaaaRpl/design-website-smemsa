<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Satu data fasilitas = satu lokasi. Admin menentukan di mana fasilitas tampil:
     * titik denah (map_x/map_y), daftar TEFA, dan/atau grid fasilitas unggulan (is_featured).
     */
    public function up(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            // Foto sekarang dikelola lewat galeri (facility_images), foto pertama = foto utama.
            $table->dropColumn('image');
        });

        Schema::table('facilities', function (Blueprint $table) {
            $table->string('short_name', 100)->nullable()->after('name');
            $table->string('mark', 5)->nullable()->after('short_name');
            $table->string('tag', 100)->nullable()->after('type');
            $table->string('location_label')->nullable()->after('tag');
            $table->text('highlight')->nullable()->after('features');
            $table->string('icon', 30)->default('building')->after('highlight');
            $table->unsignedSmallInteger('map_x')->nullable()->after('icon');
            $table->unsignedSmallInteger('map_y')->nullable()->after('map_x');
            $table->boolean('show_in_tefa_list')->default(false)->after('map_y');
            $table->boolean('is_wide')->default(false)->after('is_featured');
        });
    }

    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn([
                'short_name', 'mark', 'tag', 'location_label', 'highlight', 'icon',
                'map_x', 'map_y', 'show_in_tefa_list', 'is_wide',
            ]);
            $table->string('image')->nullable();
        });
    }
};
