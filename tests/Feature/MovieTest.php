<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_add_a_movie()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post(route('movie.store'), [
            'name' => 'Inception',
            'genre' => 'Sci-Fi',
            'length' => 148,
            'description' => 'Test description',
        ]);

        $response->assertRedirect(route('admin.index'));
        $this->assertDatabaseHas('movies', ['name' => 'Inception']);
    }
}
