<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MovieController
 */
final class MovieControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $movies = Movie::factory()->count(3)->create();

        $response = $this->get(route('movies.index'));

        $response->assertOk();
        $response->assertViewIs('movie.index');
        $response->assertViewHas('movies');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('movies.create'));

        $response->assertOk();
        $response->assertViewIs('movie.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MovieController::class,
            'store',
            \App\Http\Requests\MovieStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = fake()->name();
        $genre = fake()->word();
        $length = fake()->numberBetween(-10000, 10000);
        $poster = fake()->word();

        $response = $this->post(route('movies.store'), [
            'name' => $name,
            'genre' => $genre,
            'length' => $length,
            'poster' => $poster,
        ]);

        $movies = Movie::query()
            ->where('name', $name)
            ->where('genre', $genre)
            ->where('length', $length)
            ->where('poster', $poster)
            ->get();
        $this->assertCount(1, $movies);
        $movie = $movies->first();

        $response->assertRedirect(route('movies.index'));
        $response->assertSessionHas('movie.id', $movie->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $movie = Movie::factory()->create();

        $response = $this->get(route('movies.show', $movie));

        $response->assertOk();
        $response->assertViewIs('movie.show');
        $response->assertViewHas('movie');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $movie = Movie::factory()->create();

        $response = $this->get(route('movies.edit', $movie));

        $response->assertOk();
        $response->assertViewIs('movie.edit');
        $response->assertViewHas('movie');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MovieController::class,
            'update',
            \App\Http\Requests\MovieUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $movie = Movie::factory()->create();
        $name = fake()->name();
        $genre = fake()->word();
        $length = fake()->numberBetween(-10000, 10000);
        $poster = fake()->word();

        $response = $this->put(route('movies.update', $movie), [
            'name' => $name,
            'genre' => $genre,
            'length' => $length,
            'poster' => $poster,
        ]);

        $movie->refresh();

        $response->assertRedirect(route('movies.index'));
        $response->assertSessionHas('movie.id', $movie->id);

        $this->assertEquals($name, $movie->name);
        $this->assertEquals($genre, $movie->genre);
        $this->assertEquals($length, $movie->length);
        $this->assertEquals($poster, $movie->poster);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $movie = Movie::factory()->create();

        $response = $this->delete(route('movies.destroy', $movie));

        $response->assertRedirect(route('movies.index'));

        $this->assertModelMissing($movie);
    }
}
