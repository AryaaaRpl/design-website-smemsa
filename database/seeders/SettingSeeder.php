<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Support\SiteSettings;
use Illuminate\Database\Seeder;

/**
 * Isi Pengaturan dengan nilai awal. Hanya mengisi yang belum ada atau kosong, isian admin tidak ditimpa.
 */
class SettingSeeder extends Seeder
{
    public function run(): void
    {
        foreach (SiteSettings::defaults() as $key => $value) {
            $setting = Setting::firstOrNew(['key' => $key]);

            if (blank($setting->value)) {
                $setting->value = $value;
                $setting->save();
            }
        }
    }
}
