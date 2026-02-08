<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu; 
use App\Models\ContactMessage; // Menambahkan model ContactMessage

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

    /**
     * Menampilkan daftar pesan masuk dari halaman Contact (Concierge).
     * Ini akan bertindak sebagai inbox pribadi admin.
     */
    public function messages()
    {
        // Mengambil semua pesan, diurutkan dari yang terbaru
        $messages = ContactMessage::latest()->get();

        // Mengembalikan view khusus untuk daftar pesan (pastikan view ini sudah dibuat)
        return view('admin.messages.index', compact('messages'));
    }

    public function destroyMessage($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return back()->with('success', 'Message deleted successfully.');
    }
}