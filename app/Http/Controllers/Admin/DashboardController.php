<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu; 

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data menu
        $menus = Menu::all(); 

        // Hitung statistik
        $stats = [
            'jumlah_menu'    => Menu::count(),
            'menu_kosong'    => 0, // Diubah ke 0 dulu agar tidak error kolom 'stok'
            'jumlah_pesanan' => 0, 
            'status_website' => 'At Service'
        ];

        return view('admin.dashboard', compact('menus', 'stats'));
    }
}