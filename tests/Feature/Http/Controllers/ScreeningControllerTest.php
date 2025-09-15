<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ScreeningController
 */
final class ScreeningControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $screenings = Screening::factory()->count(3)->create();

        $response = $this->get(route('screenings.index'));

        $response->assertOk();
        $response->assertViewIs('screening.index');
        $response->assertViewHas('screenings');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('screenings.create'));

        $response->assertOk();
        $response->assertViewIs('screening.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ScreeningController::class,
            'store',
            \App\Http\Requests\ScreeningStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $movie = Movie::factory()->create();
        $hall = Hall::factory()->create();
        $showtime = Carbon::parse(fake()->dateTime());
        $available_seats = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('screenings.store'), [
            'movie_id' => $movie->id,
            'hall_id' => $hall->id,
            'showtime' => $showtime->toDateTimeString(),
            'available_seats' => $available_seats,
        ]);

        $screenings = Screening::query()
            ->where('movie_id', $movie->id)
            ->where('hall_id', $hall->id)
            ->where('showtime', $showtime)
            ->where('available_seats', $available_seats)
            ->get();
        $this->assertCount(1, $screenings);
        $screening = $screenings->first();

        $response->assertRedirect(route('screenings.index'));
        $response->assertSessionHas('screening.id', $screening->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $screening = Screening::factory()->create();

        $response = $this->get(route('screenings.show', $screening));

        $response->assertOk();
        $response->assertViewIs('screening.show');
        $response->assertViewHas('screening');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $screening = Screening::factory()->create();

        $response = $this->get(route('screenings.edit', $screening));

        $response->assertOk();
        $response->assertViewIs('screening.edit');
        $response->assertViewHas('screening');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ScreeningController::class,
            'update',
            \App\Http\Requests\ScreeningUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $screening = Screening::factory()->create();
        $movie = Movie::factory()->create();
        $hall = Hall::factory()->create();
        $showtime = Carbon::parse(fake()->dateTime());
        $available_seats = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('screenings.update', $screening), [
            'movie_id' => $movie->id,
            'hall_id' => $hall->id,
            'showtime' => $showtime->toDateTimeString(),
            'available_seats' => $available_seats,
        ]);

        $screening->refresh();

        $response->assertRedirect(route('screenings.index'));
        $response->assertSessionHas('screening.id', $screening->id);

        $this->assertEquals($movie->id, $screening->movie_id);
        $this->assertEquals($hall->id, $screening->hall_id);
        $this->assertEquals($showtime, $screening->showtime);
        $this->assertEquals($available_seats, $screening->available_seats);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $screening = Screening::factory()->create();

        $response = $this->delete(route('screenings.destroy', $screening));

        $response->assertRedirect(route('screenings.index'));

        $this->assertModelMissing($screening);
    }
}
