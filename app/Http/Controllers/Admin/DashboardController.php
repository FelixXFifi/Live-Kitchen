<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Amankan dengan mengimpor model kamu di sini nanti
// Contoh: use App\Models\Menu;

class DashboardController extends Controller
{
    public function index()
    {
        // Data ini nantinya bisa kamu ambil langsung dari Database
        $stats = [
            'jumlah_menu' => 0,      // Contoh: Menu::count()
            'menu_kosong' => 0,      // Contoh: Menu::where('stok', 0)->count()
            'jumlah_pesanan' => 0,   // Contoh: Order::count()
            'status_website' => 'Aktif'
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
