<?php
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

});
