<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Http\Requests\ReservationUpdateRequest;
use App\Models\Reservation;
use App\Models\Screening;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(Request $request): View
    {
        $reservations = Reservation::with(['screening.movie', 'screening.hall'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reservation.index', compact('reservations'));
    }

    public function create(Request $request, $screeningId): View
    {
        $screening = Screening::with(['movie', 'hall'])->findOrFail($screeningId);

        $reservedTickets = Reservation::where('screening_id', $screeningId)
            ->where('status', '!=', 'cancelled')
            ->sum('reserved_tickets');

        $availableSeats = $screening->hall->total_seats - $reservedTickets;
        $maxTickets = min(8, $availableSeats); // max 8 ili koliko ima dostupno

        return view('reservation.create', compact('screening', 'availableSeats', 'maxTickets'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'screening_id' => 'required|exists:screenings,id',
            'tickets' => 'required|integer|min:1|max:8',
        ]);


        $screening = Screening::with('hall')->findOrFail($validated['screening_id']);
        $reservedTickets = Reservation::where('screening_id', $validated['screening_id'])
            ->where('status', '!=', 'cancelled')
            ->sum('reserved_tickets');

        $availableSeats = $screening->hall->total_seats - $reservedTickets;

        if ($validated['tickets'] > $availableSeats) {
            return back()->withErrors(['tickets' => 'Nema dovoljno slobodnih mesta.']);
        }

        Reservation::create([
            'screening_id' => $validated['screening_id'],
            'user_id' => auth()->id(),
            'reserved_tickets' => $validated['tickets'],
            'status' => 'placed'
        ]);

        return redirect()->route('reservation.index')->with('success', 'Rezervacija uspešno kreirana.');
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

    public function destroy(Reservation $reservation): RedirectResponse
    {
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        $reservation->delete();

        return redirect()->back()->with('success', 'Rezervacija je uspešno otkazana.');
    }
}
