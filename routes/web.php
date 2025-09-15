<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';


Route::resource('movies', App\Http\Controllers\MovieController::class);

Route::resource('halls', App\Http\Controllers\HallController::class);

Route::resource('screenings', App\Http\Controllers\ScreeningController::class);

Route::resource('reservations', App\Http\Controllers\ReservationController::class);

Route::resource('users', App\Http\Controllers\UserController::class);


Route::resource('movies', App\Http\Controllers\MovieController::class);

Route::resource('halls', App\Http\Controllers\HallController::class);

Route::resource('screenings', App\Http\Controllers\ScreeningController::class);

Route::resource('reservations', App\Http\Controllers\ReservationController::class);

Route::resource('users', App\Http\Controllers\UserController::class);


Route::resource('movies', App\Http\Controllers\MovieController::class);

Route::resource('halls', App\Http\Controllers\HallController::class);

Route::resource('screenings', App\Http\Controllers\ScreeningController::class);

Route::resource('reservations', App\Http\Controllers\ReservationController::class);

Route::resource('users', App\Http\Controllers\UserController::class);


Route::resource('movies', App\Http\Controllers\MovieController::class);

Route::resource('halls', App\Http\Controllers\HallController::class);

Route::resource('screenings', App\Http\Controllers\ScreeningController::class);

Route::resource('reservations', App\Http\Controllers\ReservationController::class);

Route::resource('users', App\Http\Controllers\UserController::class);
