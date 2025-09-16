<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        Movie::create([
            'name' => 'Inception',
            'genre' => 'Sci-Fi',
            'length' => 148,
            'description' => 'A skilled thief is offered a chance to erase his criminal history by performing an almost impossible task: inception.',
            'poster' => 'posters/inception.jpg',
        ]);

        Movie::create([
            'name' => 'The Dark Knight',
            'genre' => 'Action',
            'length' => 152,
            'description' => 'Batman faces his greatest psychological and physical test when the Joker wreaks havoc on Gotham City.',
            'poster' => 'posters/dark-knight.jpg',
        ]);

        Movie::create([
            'name' => 'Interstellar',
            'genre' => 'Adventure',
            'length' => 169,
            'description' => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity’s survival.',
            'poster' => 'posters/interstellar.jpg',
        ]);
    }

}
