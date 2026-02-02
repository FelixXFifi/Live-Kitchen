<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Gunakan updateOrCreate: kalau email sudah ada, dia cuma update. Gak bakal error.
      
        // Sekarang panggil MenuSeeder yang sudah kamu pisah tadi
        $this->call([
            MenuSeeder::class,
        ]);
    }
}