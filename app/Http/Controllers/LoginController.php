<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        // 1. Ambil data dari input form
        $username = $request->input('username');
        $password = $request->input('password');

        $credentials = [
            'name'     => $username, 
            'password' => $password,
        ];

        // 2. Cek Akun via Database (Contoh: Akun admin yang Anda buat di Tinker)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        // 3. Pengecekan Manual (Sesuai kode asli Anda untuk Salsabilla)
        // Ini tetap dipertahankan agar kode lama Anda tidak hilang
        if ($username === "salsabilla" && $password === "2007") {
            return redirect()->route('dashboard');
        }

        // 4. Jika semua gagal
        return back()->with('error', 'Akses ditolak. Nama atau Password salah.');
    }
}