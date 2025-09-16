<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/movies/{id}', function ($id) {
    $movie = [
        'title' => 'Naslov filma',
        'description' => 'Ovde se nalazi opis filma. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fringilla luctus arcu nec ultrices. Vestibulum cursus mollis metus.',
        'genre' => 'Akcija',
        'length' => 120,
        'poster' => null
    ];

    $projections = [
        '09-05-2025 19:30',
        '10-05-2025 17:00',
        '11-05-2025 20:15'
    ];

    return view('movie.movieDetails', compact('movie', 'projections'));
})->name('movie.Details');

Route::get('/reservation', function () {
    $availableSeats = 15;
    $maxTickets = 8;

    return view('reservation.create', compact('availableSeats', 'maxTickets'));
})->name('reservation.create');

Route::get('/my-reservations', function () {
    $reservations = [
        ['movie' => 'Film 1', 'time' => '09-05-2025 19:30'],
        ['movie' => 'Film 2', 'time' => '09-08-2025 17:30'],
        ['movie' => 'Film 3', 'time' => '09-12-2025 20:00'],
    ];

    return view('reservation.index', compact('reservations'));
})->name('reservation.index');

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
