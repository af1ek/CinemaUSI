<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Http\Requests\ReservationUpdateRequest;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(Request $request): Response
    {
        $reservations = Reservation::all();

        return view('reservation.index', [
            'reservations' => $reservations,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('reservation.create');
    }

    public function store(ReservationStoreRequest $request): Response
    {
        $reservation = Reservation::create($request->validated());

        $request->session()->flash('reservation.id', $reservation->id);

        return redirect()->route('reservations.index');
    }

    public function show(Request $request, Reservation $reservation): Response
    {
        return view('reservation.show', [
            'reservation' => $reservation,
        ]);
    }

    public function edit(Request $request, Reservation $reservation): Response
    {
        return view('reservation.edit', [
            'reservation' => $reservation,
        ]);
    }

    public function update(ReservationUpdateRequest $request, Reservation $reservation): Response
    {
        $reservation->update($request->validated());

        $request->session()->flash('reservation.id', $reservation->id);

        return redirect()->route('reservations.index');
    }

    public function destroy(Request $request, Reservation $reservation): Response
    {
        $reservation->delete();

        return redirect()->route('reservations.index');
    }
}
