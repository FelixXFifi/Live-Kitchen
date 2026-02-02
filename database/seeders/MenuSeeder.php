<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu; // Pastikan ini ada

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Nasi Liwet Sunda Parahyangan', 'category' => 'Main Menu', 'price' => 25000, 'image' => 'MAIN (1) (1).jpg'],
            ['name' => 'Ayam Kecap Mentega Premium', 'category' => 'Main Menu', 'price' => 25000, 'image' => 'ayam-kecap.jpg'],
            ['name' => 'Daging Rendang Hitam Minang', 'category' => 'Best Seller', 'price' => 35000, 'image' => 'rendang-hitam-padang.jpg'],
            ['name' => 'Zuppa Soup Puff Pastry', 'category' => 'Best Seller', 'price' => 35000, 'image' => 'Zuppa Soup Puff Pastry.jpeg'],
            ['name' => 'Kambing Guling Spesial', 'category' => 'Signature Dish', 'price' => 125000, 'image' => 'kambing-guling.jpg'],
            ['name' => 'Ikan Bakar', 'category' => 'Signature Dish', 'price' => 45000, 'image' => 'ikanbkr.jpg'],
            ['name' => 'Es Cendol Durian Monthong', 'category' => 'Seasonal Special', 'price' => 35000, 'image' => 'cendol.jpg'],
            ['name' => 'Dimsum Imperial Platter', 'category' => 'Seasonal Special', 'price' => 35000, 'image' => 'dimsum.jpg'],
        ];

        foreach ($data as $item) {
            Menu::updateOrCreate(['name' => $item['name']], $item);
        }
    }
}