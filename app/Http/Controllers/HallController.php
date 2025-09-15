<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallStoreRequest;
use App\Http\Requests\HallUpdateRequest;
use App\Models\Hall;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HallController extends Controller
{
    public function index(Request $request): Response
    {
        $halls = Hall::all();

        return view('hall.index', [
            'halls' => $halls,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('hall.create');
    }

    public function store(HallStoreRequest $request): Response
    {
        $hall = Hall::create($request->validated());

        $request->session()->flash('hall.id', $hall->id);

        return redirect()->route('halls.index');
    }

    public function show(Request $request, Hall $hall): Response
    {
        return view('hall.show', [
            'hall' => $hall,
        ]);
    }

    public function edit(Request $request, Hall $hall): Response
    {
        return view('hall.edit', [
            'hall' => $hall,
        ]);
    }

    public function update(HallUpdateRequest $request, Hall $hall): Response
    {
        $hall->update($request->validated());

        $request->session()->flash('hall.id', $hall->id);

        return redirect()->route('halls.index');
    }

    public function destroy(Request $request, Hall $hall): Response
    {
        $hall->delete();

        return redirect()->route('halls.index');
    }
}
