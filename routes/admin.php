<?php
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\FlightController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
})->name('admin.logout');

Route::group(['middleware' => ['auth', 'verified'], 'as' => 'admin.'], function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('staff', StaffController::class);
    Route::get('/staff/{id}/delete', [StaffController::class, 'destroy'])->name('staff.destroy');

//Role
    Route::resource('role', RoleController::class);
    Route::get('/role/{id}/delete', [RoleController::class, 'destroy'])->name('role.destroy');

//Permission
    Route::resource('permission', PermissionController::class);
    Route::get('/permission/{id}/delete', [PermissionController::class, 'destroy'])->name('permission.destroy');

    //Bookings
    Route::get('/bookings', [BookingController::class, 'bookings'])->name('bookings.index');

    Route::get('/schedule_flights', [FlightController::class, 'scheduleFlights'])->name('schedule-flights.index');

    Route::get('/schedule_flights/create', [FlightController::class, 'create'])->name('schedule-flights.create');
    Route::post('/schedule_flights/store', [FlightController::class, 'store'])->name('schedule-flights.store');
    Route::get('/schedule_flights/{id}/edit', [FlightController::class, 'edit'])->name('schedule-flights.edit');
    Route::post('/schedule_flights/{id}/update', [FlightController::class, 'update'])->name('schedule-flights.update');
    Route::get('/schedule_flights/{id}/delete', [FlightController::class, 'delete'])->name('schedule-flights.delete');
    Route::get('/schedule_flights/{slug}/show', [FlightController::class, 'show'])->name('schedule-flights.show');

    //unlock seat
    Route::get('/schedule_flights/{id}/unlock', [FlightController::class, 'unlockSeat'])->name('schedule-flights.unlock');

    // bookseats

    Route::get('book-flight/{slug}', [FlightController::class, 'bookFlight'])->name('book-flight');

    Route::post('book-flight/{slug}', [FlightController::class, 'storeBooking'])->name('store-booking');

    Route::post('store-passenger-info/{slug}', [FlightController::class, 'storePassengerInfo'])->name('store-passenger-info');

});
