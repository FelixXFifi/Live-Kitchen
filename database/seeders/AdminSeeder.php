<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
{
    \App\Models\User::updateOrCreate(
        ['email' => 'admin@mail.com'], // Cari berdasarkan email
        [
            'name' => 'Grand Administrator',
            'username' => 'Administrator', // Ini yang akan dipakai buat login
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'email_verified_at' => now(),
        ]
    );
}
}