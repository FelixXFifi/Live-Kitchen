<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function authenticate(Request $request)
    {
       
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        
        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk keamanan (mencegah session fixation)
            $request->session()->regenerate();

            $user = Auth::user();

            // 3. Logika Pengalihan (Redirect)
            // Jika yang login adalah admin (berdasarkan email)
            if ($user->email === 'admin@mail.com') {
                return redirect()->intended(route('admin.dashboard'));
            }

            // Jika User Biasa, arahkan ke halaman utama
            return redirect()->intended(route('home'));
        }

        // 4. Jika gagal login
        // Menampilkan pesan error kembali ke halaman login
        return back()->with('error', 'The provided credentials do not match our records or your account is not curated.');
    }

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Menghapus session agar benar-benar bersih
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}