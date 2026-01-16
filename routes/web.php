<?php

use Illuminate\Support\Facades\Route;

// Halaman depan langsung nampilin Login
Route::get('/', function () {
    return view('login');
});

// Daftarin alamat Dashboard biar bisa dibuka
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');