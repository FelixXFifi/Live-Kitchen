<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // FOODS
            ['name' => 'Nasi Liwet Sunda Parahyangan', 'category' => 'Foods', 'price' => 25000, 'image' => 'https://www.tagar.id/Asset/uploads2019/1642129532972-resep-nasi-liwet.jpeg'],
            ['name' => 'Nasi Kebuli', 'category' => 'Foods', 'price' => 45000, 'image' => 'https://assets.telkomsel.com/public/2025-07/resep-nasi-kebuli.png?VersionId=JQO2CxWWDDUzKUPcgqvwj6OKTn8cwKE0'],
            ['name' => 'Udang Saus Padang', 'category' => 'Foods', 'price' => 45000, 'image' => 'https://cdn.8mediatech.com/gambar/61456505644-6_resep_udang_saus_padang,_lezat_dan_mudah_dibuat_di_rumah.jpg'],
            ['name' => 'Daging Sapi Lada Hitam', 'category' => 'Foods', 'price' => 45000, 'image' => 'https://www.tokomesin.com/wp-content/uploads/2015/09/resep-daging-sapi-lada-hitam-tokomesin.jpg'],
            ['name' => 'Ayam Bakar Bumbu Rujak', 'category' => 'Foods', 'price' => 35000, 'image' => 'https://awsimages.detik.net.id/community/media/visual/2022/06/09/resep-ayam-bakar-bumbu-rujak-1.jpeg?w=1200'],
            ['name' => 'Kambing Guling', 'category' => 'Foods', 'price' => 45000, 'image' => 'https://image.idntimes.com/post/20220713/classic-roast-leg-of-lamb-recipe-101495-hero-01-47b3b440930a458caacf18adcfbcf90a-d16188faf3f6daf6341d2938f7e47370.jpg'],
            
           // DRINKS (6 Menu)
        ['name' => 'Es Cendol Durian Monthong', 'category' => 'Drinks', 'price' => 35000, 'image' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=400'],
        ['name' => 'Coffee Latte', 'category' => 'Drinks', 'price' => 28000, 'image' => 'https://cdn.pixabay.com/photo/2016/11/29/02/10/caffeine-1866758_640.jpg'],
        ['name' => 'Iced Lychee Tea Fresh', 'category' => 'Drinks', 'price' => 22000, 'image' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=400'],
        ['name' => 'Matcha Greentea Creamy', 'category' => 'Drinks', 'price' => 25000, 'image' => 'https://images.unsplash.com/photo-1515823064-d6e0c04616a7?w=400'],
        ['name' => 'Fresh Orange Juice', 'category' => 'Drinks', 'price' => 20000, 'image' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=400'],
        ['name' => ' Thai Iced Tea', 'category' => 'Drinks', 'price' => 23000, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSmCw0J1GM8KvN0k25478N27_0V8loPbceaNg&s'],

        // DESSERTS (6 Menu)
        ['name' => 'Chocolate Lava Cake', 'category' => 'Desserts', 'price' => 35000, 'image' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=400'],
        ['name' => 'Strawberry Cheesecake', 'category' => 'Desserts', 'price' => 38000, 'image' => 'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?w=400'],
        ['name' => 'Tiramisu Italian Classic', 'category' => 'Desserts', 'price' => 40000, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSOtQ146XROwPhLWgvObeACgm9fqYdkslOVoA&s'],
        ['name' => 'Pannacotta Mango Puree', 'category' => 'Desserts', 'price' => 32000, 'image' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=400'],
        ['name' => 'Warm Apple Pie', 'category' => 'Desserts', 'price' => 30000, 'image' => 'https://thumbs.dreamstime.com/b/warm-apple-pie-slice-melting-ice-cream-cozy-treat-419923729.jpg'],
        ['name' => 'Brownies Almond Fudge', 'category' => 'Desserts', 'price' => 28000, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRo3fC_r9WFW32eE1evzSWfhv3_Zc-PSO2GLQ&s'],

        // QUICK BITES (6 Menu)
        ['name' => 'Zuppa Soup Puff Pastry', 'category' => 'Quick Bites', 'price' => 35000, 'image' => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=400'],
        ['name' => 'Dimsum Imperial Platter', 'category' => 'Quick Bites', 'price' => 35000, 'image' => 'https://images.unsplash.com/photo-1496116218417-1a781b1c416c?w=400'],
        ['name' => 'French Fries Truffle', 'category' => 'Quick Bites', 'price' => 25000, 'image' => 'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=400'],
        ['name' => 'Chicken Wings BBQ', 'category' => 'Quick Bites', 'price' => 32000, 'image' => 'https://images.unsplash.com/photo-1527477396000-e27163b481c2?w=400'],
        ['name' => 'Nachos Cheese Supreme', 'category' => 'Quick Bites', 'price' => 30000, 'image' => 'https://images.unsplash.com/photo-1513456852971-30c0b8199d4d?w=400'],
        ['name' => 'Mozzarella Sticks', 'category' => 'Quick Bites', 'price' => 28000, 'image' => 'https://vargasavourrecipes.com/wp-content/uploads/2025/10/Untitled-.jpg'],

        // HEALTHY OPTIONS (6 Menu)
        ['name' => 'Avocado Garden Salad', 'category' => 'Healthy Options', 'price' => 45000, 'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=400'],
        ['name' => 'Fruit Bowl Granola', 'category' => 'Healthy Options', 'price' => 35000, 'image' => 'https://images.unsplash.com/photo-1511690656952-34342bb7c2f2?w=400'],
        ['name' => 'Salmon Poke Bowl', 'category' => 'Healthy Options', 'price' => 55000, 'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400'],
        ['name' => 'Greek Yogurt Honey', 'category' => 'Healthy Options', 'price' => 30000, 'image' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=400'],
        ['name' => 'Roasted Pumpkin Soup', 'category' => 'Healthy Options', 'price' => 32000, 'image' => 'https://images.unsplash.com/photo-1476718406336-bb5a9690ee2a?w=400'],
        ['name' => 'Caesar Salad Grilled Chicken', 'category' => 'Healthy Options', 'price' => 48000, 'image' => 'https://images.unsplash.com/photo-1550304943-4f24f54ddde9?w=400'],
        ];

        foreach ($data as $item) {
            // Kita tambahkan deskripsi default supaya modalnya tidak kosong
            Menu::updateOrCreate(
                ['name' => $item['name']], 
                array_merge($item, ['description' => 'Hidangan spesial dengan bahan premium dan bumbu rahasia dapur kami.'])
            );
        }
    }
}