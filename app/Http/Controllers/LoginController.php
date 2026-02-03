<?php



namespace App\Http\Controllers;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;



class LoginController extends Controller

{

    public function authenticate(Request $request)

    {

        // 1. Validasi input

        $credentials = $request->validate([

            'username' => ['required'],

            'password' => ['required'],

        ]);



        // Mapping 'username' dari form ke kolom 'name' di database

        $authData = [

            'name'     => $request->input('username'),

            'password' => $request->input('password'),

        ];



        // 2. Cek Akun via Database

        if (Auth::attempt($authData)) {

            $request->session()->regenerate();



            $user = Auth::user();



            // CEK APAKAH DIA ADMIN 

            // Gunakan 'admin@mail.com' sesuai data yang berhasil kita buat di Tinker tadi

            if ($user->email === 'admin@mail.com') {

                return redirect()->route('admin.dashboard');

            }



            // Jika User Biasa, arahkan ke halaman utama (MenuKitchen) sesuai web.php

            return redirect()->route('home');

        }



        // 3. Pengecekan Manual (Hardcoded)

        if ($request->input('username') === "salsabilla" && $request->input('password') === "2007") {

            // Kita anggap salsabilla adalah user biasa, kirim ke home

            return redirect()->route('home');

        }



        // 4. Jika gagal

        return back()->with('error', 'Akses ditolak. Nama atau Password salah.');

    }



    public function logout(Request $request)

    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');

    }

}