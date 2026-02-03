<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Livewire\CartIndex;
use App\Livewire\MenuKitchen;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. HALAMAN PUBLIK ---

// Halaman Utama
Route::get('/', MenuKitchen::class)->name('home');

// --- FITUR AUTH (LOGIN) ---
Route::get('/login', function () {
    return view('components.auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');

// TAMBAHAN: Pastikan rute logout tersedia untuk membuang session
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// --- FITUR RESERVASI & SUMMARY ---
Route::controller(ReservationController::class)->group(function () {
    Route::get('/reservation', 'index')->name('reservation.index');
    Route::post('/reservation', 'store')->name('reservation.store');
    Route::get('/order-summary', 'summary')->name('order.summary');
});


// --- FITUR INFORMASI (LOCATION & CONTACT) ---
Route::get('/location', [InfoController::class, 'location'])->name('location.index');
Route::get('/contact', [InfoController::class, 'contact'])->name('contact.index');
Route::post('/contact/send', [InfoController::class, 'storeContact'])->name('contact.store');


// --- FITUR CART & ORDER LIST ---
Route::get('/cart', CartIndex::class)->name('cart.index');

Route::get('/order-list', function () {
    return view('orderList-page');
})->name('order.list');

Route::get('/order-detail/{id}', function ($id) {
    return view('orderDetail-page', ['orderId' => $id]);
})->name('order.detail');


// --- 2. PROTECTED ROUTES (KHUSUS ADMIN) ---
// Rute /dashboard dipindahkan ke sini agar User Biasa tertendang jika mencoba masuk
Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified',
    'is_admin' // Satpam ini akan mengecek apakah email == admin@mail.com
])->group(function () {

    // User biasa mengetik /dashboard sekarang akan tertendang ke home
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Dashboard Admin
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Manajemen Menu
    Route::get('/manajemen-menu', function () {
        return view('manajemen-menu');
    })->name('manajemen.menu');

    // Tambah Menu (New Creation)
    Route::get('/admin/menu/create', function () {
        return view('admin.new-creation-page');
    })->name('admin.menu.create');

    // Rute publik /new-creation dipindah ke sini agar hanya admin yang bisa akses
    Route::get('/new-creation', function () {
        return view('admin.new-creation-page');
    })->name('new.creation');

});


// --- 3. KEPERLUAN AUTH & SETTINGS (FIXED SYNTAX) ---
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}

if (file_exists(__DIR__.'/settings.php')) {
    require __DIR__.'/settings.php';
}