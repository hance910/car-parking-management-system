<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CarDetailController;
use App\Http\Controllers\ParkingEntryController;
use App\Http\Controllers\CarParkingDetailController;

Route::get('/', function () {
    return view('auth.login');
});

// LOGIN 
Route::get('/users/login', [LoginController::class, 'index'])->name('login');
Route::post('/users/login', [LoginController::class, 'store']);



Route::get('/parking-entry', [ParkingEntryController::class, 'index'])->name('parking-entry');
Route::post('/parking-entry', [CarDetailController::class, 'store'])->name('car-detail-entry');
Route::post('/parking-entry/carparkingdetail', [CarParkingDetailController::class, 'assign'])->name('car-parking-detail-entry');
Route::post('/parking-entry/carparkingcharges', [CarParkingDetailController::class, 'store'])->name('car-parking-charges-submission');

// REGISTER
Route::get('/users/register', [RegisterController::class, 'index'])->name('register');
Route::post('/users/register', [RegisterController::class, 'store'])->name('register');


// LOGOUT
Route::post('/users/logout', [LogoutController::class, 'logout'])->name('logout');



