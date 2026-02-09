<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class InfoController extends Controller
{
    public function contact() {
        // Memanggil file contactmessage.blade.php
        // Memanggil file ContactMessage.php
        return view('contactmessage'); 
    }

    public function location() {
        // Memanggil file location-index.blade.php
        return view('location-index'); 
    }

    /**
     * Menyimpan pesan dari form kontak ke database pribadi.
     * Ini berfungsi sebagai sistem pesan internal tanpa perlu WhatsApp.
     */
    public function storeContact(Request $request) {
        // Validasi data yang masuk dari form
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:5', // Menambahkan batas minimal karakter
        ]);

        // Menyimpan data ke tabel contact_messages
        // Pastikan Anda sudah menjalankan migration untuk tabel ini.
        ContactMessage::create($validated);

        // Mengirim kembali dengan pesan sukses yang akan ditampilkan di Blade
        return back()->with('success', 'Your inquiry has been received by our concierge. We will get back to you shortly.');
    }
}