<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Reservation;
use App\Models\Screening;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ReservationController
 */
final class ReservationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $reservations = Reservation::factory()->count(3)->create();

        $response = $this->get(route('reservations.index'));

        $response->assertOk();
        $response->assertViewIs('reservation.index');
        $response->assertViewHas('reservations');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('reservations.create'));

        $response->assertOk();
        $response->assertViewIs('reservation.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReservationController::class,
            'store',
            \App\Http\Requests\ReservationStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $screening = Screening::factory()->create();
        $user = User::factory()->create();
        $reserved_tickets = fake()->numberBetween(-10000, 10000);
        $status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('reservations.store'), [
            'screening_id' => $screening->id,
            'user_id' => $user->id,
            'reserved_tickets' => $reserved_tickets,
            'status' => $status,
        ]);

        $reservations = Reservation::query()
            ->where('screening_id', $screening->id)
            ->where('user_id', $user->id)
            ->where('reserved_tickets', $reserved_tickets)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $reservations);
        $reservation = $reservations->first();

        $response->assertRedirect(route('reservations.index'));
        $response->assertSessionHas('reservation.id', $reservation->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $reservation = Reservation::factory()->create();

        $response = $this->get(route('reservations.show', $reservation));

        $response->assertOk();
        $response->assertViewIs('reservation.show');
        $response->assertViewHas('reservation');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $reservation = Reservation::factory()->create();

        $response = $this->get(route('reservations.edit', $reservation));

        $response->assertOk();
        $response->assertViewIs('reservation.edit');
        $response->assertViewHas('reservation');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReservationController::class,
            'update',
            \App\Http\Requests\ReservationUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $reservation = Reservation::factory()->create();
        $screening = Screening::factory()->create();
        $user = User::factory()->create();
        $reserved_tickets = fake()->numberBetween(-10000, 10000);
        $status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('reservations.update', $reservation), [
            'screening_id' => $screening->id,
            'user_id' => $user->id,
            'reserved_tickets' => $reserved_tickets,
            'status' => $status,
        ]);

        $reservation->refresh();

        $response->assertRedirect(route('reservations.index'));
        $response->assertSessionHas('reservation.id', $reservation->id);

        $this->assertEquals($screening->id, $reservation->screening_id);
        $this->assertEquals($user->id, $reservation->user_id);
        $this->assertEquals($reserved_tickets, $reservation->reserved_tickets);
        $this->assertEquals($status, $reservation->status);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $reservation = Reservation::factory()->create();

        $response = $this->delete(route('reservations.destroy', $reservation));

        $response->assertRedirect(route('reservations.index'));

        $this->assertModelMissing($reservation);
    }
}
