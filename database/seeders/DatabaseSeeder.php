<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category; // Tambahan biar sekalian ada kategori dummy
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin
        // Cek dulu apakah user sudah ada biar tidak error duplikat
        if (!User::where('email', 'admin@resto.com')->exists()) {
            User::create([
                'name' => 'Admin Resto',
                'email' => 'admin@resto.com',
                'password' => Hash::make('password'), // Passwordnya adalah: password
            ]);
        }

        // 2. Buat Kategori Dummy (Opsional, biar tidak kosong melompong)
        if (Category::count() == 0) {
            Category::insert([
                ['name' => 'Makanan Berat', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Minuman Dingin', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Cemilan', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
}