<?php

use App\Http\Controllers\AlertController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/monitoring', [DashboardController::class, 'monitoring'])->name('dashboard.monitoring');
    Route::get('/dashboard/alerts', [DashboardController::class, 'alerts'])->name('dashboard.alerts');

    Route::get('/dashboard/devices', [DashboardController::class, 'devices'])->name('dashboard.device');
    Route::get('/dashboard/devices/detail/{device}', [DashboardController::class, 'device_detail'])->name('dashboard.device.detail');

});
Route::resource('area', AreaController::class)->middleware(['auth', 'verified']);
Route::resource('device', DeviceController::class)->middleware(['auth', 'verified']);
Route::resource('alert', AlertController::class)->middleware(['auth', 'verified']);
Route::resource('user', UserController::class)->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
