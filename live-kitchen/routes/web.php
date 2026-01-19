<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/reservation');

Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');

Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');