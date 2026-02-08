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

// Home & Menu (Livewire)
Route::get('/', MenuKitchen::class)->name('home');

// Auth System
Route::get('/login', function () {
    return view('components.auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Information Pages
Route::get('/location', [InfoController::class, 'location'])->name('location.index');
Route::get('/contact', [InfoController::class, 'contact'])->name('contact.index');
Route::post('/contact/send', [InfoController::class, 'storeContact'])->name('contact.store');

// Cart & Orders
Route::get('/cart', CartIndex::class)->name('cart.index');
Route::get('/order-list', function () {
    return view('orderList-page');
})->name('order.list');

Route::get('/order-detail/{id}', function ($id) {
    return view('orderDetail-page', ['orderId' => $id]);
})->name('order.detail');

// Reservation System
Route::controller(ReservationController::class)->group(function () {
    Route::get('/reservation', 'index')->name('reservation.index');
    Route::post('/reservation', 'store')->name('reservation.store');
    Route::get('/order-summary', 'summary')->name('order.summary');
});

// --- 2. PROTECTED ROUTES (KHUSUS ADMIN) ---

Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified',
    'is_admin' // Middleware proteksi admin
])->group(function () {

    // Main Admin Dashboard - Menggunakan DashboardController yang sudah di-merge
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Dashboard Jetstream Default
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Menu Management
    Route::get('/manajemen-menu', function () {
        return view('manajemen-menu');
    })->name('manajemen.menu');

    // CRUD Menu / New Creation
    Route::get('/admin/menu/create', function () {
        return view('admin.new-creation-page');
    })->name('admin.menu.create');

    Route::get('/new-creation', function () {
        return view('admin.new-creation-page');
    })->name('new.creation');

    // Di dalam Route::middleware(['auth', 'is_admin'])...
    Route::get('/admin/messages', [DashboardController::class, 'messages'])->name('admin.messages');
    Route::delete('/admin/messages/{id}', [DashboardController::class, 'destroyMessage'])->name('admin.messages.destroy');
});

// --- 3. EXTERNAL ROUTE FILES ---

if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}

if (file_exists(__DIR__.'/settings.php')) {
    require __DIR__.'/settings.php';
}