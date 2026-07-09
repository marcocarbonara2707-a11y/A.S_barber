<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HaircutController;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Profilo utente (Breeze)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/aggiungi-taglio', [HaircutController::class, 'create'])->name('haircuts.create');
    Route::post('/aggiungi-taglio', [HaircutController::class, 'store'])->name('haircuts.store');
});

/*
|--------------------------------------------------------------------------
| Prenotazioni
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/prenota', [BookingController::class, 'create'])->name('booking.create');
    Route::get('/prenota/slots', [BookingController::class, 'availability'])->name('booking.availability');
    Route::post('/prenota', [BookingController::class, 'store'])->name('booking.store');
    Route::delete('/prenota/{appointment}', [BookingController::class, 'destroy'])->name('booking.destroy');

    Route::get('/i-miei-appuntamenti', [BookingController::class, 'myAppointments'])->name('booking.my-appointments');
});

/*
|--------------------------------------------------------------------------
| Area Admin
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/closed-days', [AdminController::class, 'storeClosedDay'])->name('admin.closed-days.store');
    Route::post('/admin/haircuts/{haircut}/approve', [AdminController::class, 'approveHaircut'])->name('admin.haircuts.approve');
});

/*
|--------------------------------------------------------------------------
| Autenticazione (Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';