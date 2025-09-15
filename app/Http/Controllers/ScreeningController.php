<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScreeningStoreRequest;
use App\Http\Requests\ScreeningUpdateRequest;
use App\Models\Screening;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScreeningController extends Controller
{
    public function index(Request $request): Response
    {
        $screenings = Screening::all();

        return view('screening.index', [
            'screenings' => $screenings,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('screening.create');
    }

    public function store(ScreeningStoreRequest $request): Response
    {
        $screening = Screening::create($request->validated());

        $request->session()->flash('screening.id', $screening->id);

        return redirect()->route('screenings.index');
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
