<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieStoreRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Models\Movie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class MovieController extends Controller
{
    public function index(Request $request): View
    {
        $movies = Movie::all();

        return view('movie.index', [
            'movies' => $movies,
        ]);
    }

    public function home()
    {
        $movies = Movie::all();
        return view('home', compact('movies'));
    }

    public function create(Request $request): Response
    {
        return view('movie.create');
    }

    public function store(MovieStoreRequest $request): Response
    {
        $movie = Movie::create($request->validated());

        $request->session()->flash('movie.id', $movie->id);

        return redirect()->route('movies.index');
    }

    public function show(Request $request, Movie $movie): Response
    {
        return view('movie.show', [
            'movie' => $movie,
        ]);
    }

    public function edit(Request $request, Movie $movie): Response
    {
        return view('movie.edit', [
            'movie' => $movie,
        ]);
    }

    public function update(MovieUpdateRequest $request, Movie $movie): Response
    {
        $movie->update($request->validated());

        $request->session()->flash('movie.id', $movie->id);

        return redirect()->route('movies.index');
    }

    public function destroy(Request $request, Movie $movie): Response
    {
        $movie->delete();

        return redirect()->route('movies.index');
    }
}
