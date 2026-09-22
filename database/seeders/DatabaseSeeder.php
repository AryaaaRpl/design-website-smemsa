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
            ['email' => 'admin@smemsa.sch.id'],
            ['name' => 'Administrator', 'password' => 'password'],
        );
    }
}
