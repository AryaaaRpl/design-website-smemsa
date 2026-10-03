<?php

use Database\Seeders\SettingSeeder;
use Illuminate\Database\Migrations\Migration;

/**
 * Nilai awal Pengaturan langsung masuk database saat migrate, agar di server tidak perlu menjalankan seeder terpisah.
 */
return new class extends Migration
{
    public function up(): void
    {
        (new SettingSeeder)->run();
    }

    public function down(): void
    {
        // Data pengaturan dibiarkan: bisa saja sudah diubah admin.
    }
};
