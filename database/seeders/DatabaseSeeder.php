<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun admin awal. Ganti password setelah login pertama.
        User::firstOrCreate(
            ['email' => 'adminsmemsa1968@gmail.com'],
            ['name' => 'Administrator', 'password' => '123password123'],
        );

        $this->call([
            SettingSeeder::class,
            MajorSeeder::class,
            TeacherSeeder::class,
            FacilitySeeder::class,
            TestimonialSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            AchievementSeeder::class,
            BkkSeeder::class,
            MajorPartnerSeeder::class,
            ExtracurricularSeeder::class,
            BludSeeder::class,
            ScholarshipSeeder::class,
            FaqSeeder::class,
            DummyDataSeeder::class, // data contoh tambahan
        ]);
    }
}
