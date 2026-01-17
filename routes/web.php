<?php

use Illuminate\Support\Facades\Route;

// Halaman utama (Login)
Route::get('/', function () {
    return view('login');
});

// Jalur untuk Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
});

// Jalur untuk Manajemen Menu
Route::get('/manajemen-menu', function () {
    return view('manajemen-menu');
});