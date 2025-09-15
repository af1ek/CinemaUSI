<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Hall;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\HallController
 */
final class HallControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $halls = Hall::factory()->count(3)->create();

        $response = $this->get(route('halls.index'));

        $response->assertOk();
        $response->assertViewIs('hall.index');
        $response->assertViewHas('halls');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('halls.create'));

        $response->assertOk();
        $response->assertViewIs('hall.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HallController::class,
            'store',
            \App\Http\Requests\HallStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = fake()->name();
        $total_seats = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('halls.store'), [
            'name' => $name,
            'total_seats' => $total_seats,
        ]);

        $halls = Hall::query()
            ->where('name', $name)
            ->where('total_seats', $total_seats)
            ->get();
        $this->assertCount(1, $halls);
        $hall = $halls->first();

        $response->assertRedirect(route('halls.index'));
        $response->assertSessionHas('hall.id', $hall->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $hall = Hall::factory()->create();

        $response = $this->get(route('halls.show', $hall));

        $response->assertOk();
        $response->assertViewIs('hall.show');
        $response->assertViewHas('hall');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $hall = Hall::factory()->create();

        $response = $this->get(route('halls.edit', $hall));

        $response->assertOk();
        $response->assertViewIs('hall.edit');
        $response->assertViewHas('hall');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HallController::class,
            'update',
            \App\Http\Requests\HallUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $hall = Hall::factory()->create();
        $name = fake()->name();
        $total_seats = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('halls.update', $hall), [
            'name' => $name,
            'total_seats' => $total_seats,
        ]);

        $hall->refresh();

        $response->assertRedirect(route('halls.index'));
        $response->assertSessionHas('hall.id', $hall->id);

        $this->assertEquals($name, $hall->name);
        $this->assertEquals($total_seats, $hall->total_seats);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $hall = Hall::factory()->create();

        $response = $this->delete(route('halls.destroy', $hall));

        $response->assertRedirect(route('halls.index'));

        $this->assertModelMissing($hall);
    }
}
