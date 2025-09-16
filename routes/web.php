<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScreeningController;
use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::get('/all-movies', [MovieController::class, 'allMovies'])->name('movie.all');

Route::get('/', [MovieController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/movies/{id}', function ($id) {
    $movie = Movie::findOrFail($id);

    $projections = Screening::where('movie_id', $id)
        ->orderBy('showtime')
        ->get();

    return view('movie.movieDetails', compact('movie', 'projections'));
})->name('movie.details');



Route::get('/admin', function () {
    $stats = [
        ['title' => 'Film 1', 'tickets' => 300],
        ['title' => 'Film 2', 'tickets' => 230],
        ['title' => 'Film 3', 'tickets' => 125],
    ];

    return view('admin.index', compact('stats'));
})->name('admin.index');

Route::get('/admin/create', function (\Illuminate\Http\Request $request) {
    $type = $request->query('type'); // može biti "movie" ili "projection"

    return view('admin.create', compact('type'));
})->name('admin.create');

Route::get('/admin/create', [ScreeningController::class, 'create'])->name('admin.create');

Route::post('/movies', [MovieController::class, 'store'])->name('movie.store');
Route::post('/screenings', [ScreeningController::class, 'store'])->name('screening.store');

Route::get('/movies', [MovieController::class, 'single'])->name('movie.single');

Route::get('/reservations/create/{screening}', [ReservationController::class, 'create'])->name('reservation.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservation.index');
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservation.destroy');
