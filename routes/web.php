<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('book-flight/{slug}', [FlightController::class, 'bookFlight'])->name('book-flight');

    Route::post('book-flight/{slug}', [FlightController::class, 'storeBooking'])->name('store-booking');

    Route::post('store-passenger-info/{slug}', [FlightController::class, 'storePassengerInfo'])->name('store-passenger-info');
    Route::get('/bookings/{userId}', [UserController::class, 'bookings'])->name('bookings.index');
    Route::post('/booking/cancel/{id}', [UserController::class, 'cancelBooking'])->name('cancel-booking');

});

require __DIR__ . '/auth.php';
