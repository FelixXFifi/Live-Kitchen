<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Livewire\CartIndex;
use App\Livewire\MenuKitchen;
use App\Livewire\OrderList; // Pastikan ini sudah di-import di paling atas!

/*
|--------------------------------------------------------------------------
| Web Routes - Live Kitchen Luxury Management
|--------------------------------------------------------------------------
*/

// =========================================================================
// 1. HALAMAN PUBLIK (Customer Side)
// =========================================================================

Route::get('/', MenuKitchen::class)->name('home');

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', function () {
        return view('components.auth.login');
    })->name('login');
    Route::post('/login', 'authenticate')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(InfoController::class)->group(function () {
    Route::get('/location', 'location')->name('location.index');
    Route::get('/contact', 'contact')->name('contact.index');
    Route::post('/contact/send', 'storeContact')->name('contact.store');
});

Route::get('/cart', CartIndex::class)->name('cart.index');
Route::get('/order-list', function () { return view('orderList-page'); })->name('order.list');
Route::get('/order-detail/{id}', function ($id) { return view('orderDetail-page', ['orderId' => $id]); })->name('order.detail');

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
    'is_admin' 
])->prefix('admin')->group(function () {

    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // --- PERBAIKAN DI SINI ---
    // Jangan pakai function() { return view(...) } kalau pakai Livewire.
    // Langsung panggil Class Livewire-nya agar variabel $orders otomatis terisi.
    Route::get('/orders', OrderList::class)->name('admin.orders');

    // Manajemen Menu
    Route::get('/manajemen-menu', function () { return view('manajemen-menu'); })->name('manajemen.menu');

    // CRUD Menu
    Route::get('/menu/create', function () { return view('admin.new-creation-page'); })->name('admin.menu.create');

    // Aliases
    Route::get('/new-creation', function () { return view('admin.new-creation-page'); })->name('new.creation');
    Route::get('/dashboard-default', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/admin/messages', [DashboardController::class, 'messages'])->name('admin.messages');
    Route::delete('/admin/messages/{id}', [DashboardController::class, 'destroyMessage'])->name('admin.messages.destroy');
});

// =========================================================================
// 3. EXTERNAL ROUTE FILES
// =========================================================================
$extraFiles = ['auth.php', 'settings.php'];
foreach ($extraFiles as $file) {
    if (file_exists(__DIR__ . '/' . $file)) { require __DIR__ . '/' . $file; }
}