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

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'length' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'poster' => 'nullable|image|max:2048', // slika do 2MB
        ]);

        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }

        Movie::create($validated);

        return redirect()->route('admin.index')->with('success', 'Film uspešno dodat.');
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

    public function allMovies(): View
    {
        $movies = \App\Models\Movie::all();
        return view('movie.movie_list', compact('movies'));
    }

    public function single(Request $request)
    {
        $query = Movie::query();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        $movies = $query->get();

        return view('movie.single', compact('movies'));
    }
}

