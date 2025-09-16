<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Movie;
use App\Models\Hall;
use App\Models\Screening;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_reservation()
    {

        $user = User::factory()->create();
        $movie = Movie::factory()->create();
        $hall  = Hall::factory()->create(['total_seats' => 100]);
        $screening = Screening::factory()->create([
            'movie_id' => $movie->id,
            'hall_id'  => $hall->id,
            'showtime' => now()->addDay(),
        ]);

        $response = $this->actingAs($user)->post(route('reservations.store'), [
            'screening_id' => $screening->id,
            'tickets'      => 2,
            'status'       => 'reserved',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('reservations', [
            'user_id'      => $user->id,
            'screening_id' => $screening->id,
            'tickets'      => 2,
            'status'       => 'reserved',
        ]);
    }

    /** @test */
    public function reservation_requires_valid_screening()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('reservations.store'), [
            'screening_id' => 3,
            'tickets'      => 2,
            'status'       => 'reserved',
        ]);

        $response->assertSessionHasErrors('screening_id');
    }
}
