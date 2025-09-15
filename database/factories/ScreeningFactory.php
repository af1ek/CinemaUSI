<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Screening;

class ScreeningFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Screening::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'movie_id' => Movie::factory(),
            'hall_id' => Hall::factory(),
            'showtime' => fake()->dateTime(),
            'available_seats' => fake()->randomNumber(),
        ];
    }
}
