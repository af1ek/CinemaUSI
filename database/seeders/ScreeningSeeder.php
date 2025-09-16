<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Screening;
use App\Models\Movie;
use App\Models\Hall;
use Carbon\Carbon;

class ScreeningSeeder extends Seeder
{
    public function run(): void
    {
        $movie = Movie::first();
        $hall = Hall::first();

        Screening::create([
            'movie_id' => $movie->id,
            'hall_id' => $hall->id,
            'showtime' => Carbon::now()->addDays(1),
        ]);
    }
}
