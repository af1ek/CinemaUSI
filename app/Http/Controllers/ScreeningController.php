<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScreeningStoreRequest;
use App\Http\Requests\ScreeningUpdateRequest;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ScreeningController extends Controller
{
    public function index(Request $request): View
    {
        $screenings = Screening::with(['movie', 'hall'])->get();

        return view('screening.index', compact('screenings'));
    }

    public function create(Request $request): View
    {

        $movies = Movie::all();
        $halls  = Hall::all();

        return view('admin.create', [
            'type'   => 'projection',
            'movies' => $movies,
            'halls'  => $halls,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'hall_id'  => 'required|exists:halls,id',
            'showtime' => 'required|date',
        ]);

        Screening::create($validated);

        return redirect()->route('admin.index')->with('success', 'Projekcija uspešno dodata.');
    }

    public function show(Request $request, Screening $screening): Response
    {
        return view('screening.show', [
            'screening' => $screening,
        ]);
    }

    public function edit(Request $request, Screening $screening): Response
    {
        return view('screening.edit', [
            'screening' => $screening,
        ]);
    }

    public function update(ScreeningUpdateRequest $request, Screening $screening): Response
    {
        $screening->update($request->validated());

        $request->session()->flash('screening.id', $screening->id);

        return redirect()->route('screenings.index');
    }

    public function destroy(Request $request, Screening $screening): Response
    {
        $screening->delete();

        return redirect()->route('screenings.index');
    }
}
