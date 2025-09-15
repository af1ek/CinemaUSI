<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Reservation;
use App\Models\Screening;
use App\Models\User;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'screening_id' => Screening::factory(),
            'user_id' => User::factory(),
            'reserved_tickets' => fake()->randomNumber(),
            'status' => fake()->randomElement(["placed","confirmed","canceled"]),
        ];
    }
}
