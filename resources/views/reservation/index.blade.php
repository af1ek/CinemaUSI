@extends('layouts.app')

@section('title', 'Moje rezervacije')

@section('content')
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold">Moje rezervacije</h1>
    </div>

    @if($reservations->count() > 0)
        <div class="flex flex-wrap justify-center gap-6">
            @foreach ($reservations as $reservation)
                <div class="w-64 bg-[#191B1F] rounded-lg shadow-md p-6 text-center">
                    <p class="text-lg font-semibold mb-3">Film: {{ $reservation->screening->movie->name }}</p>
                    <div class="bg-[#0F1115] px-4 py-2 rounded text-gray-300 font-medium mb-4">
                        Termin: {{ \Carbon\Carbon::parse($reservation->screening->showtime)->format('d.m.Y H:i') }}
                    </div>
                    <div class="text-sm text-gray-400 mb-4">
                        <p>Sala: {{ $reservation->screening->hall->name }}</p>
                        <p>Broj karata: {{ $reservation->reserved_tickets }}</p>
                    </div>

                    <form method="POST" action="{{ route('reservation.destroy', $reservation->id) }}"
                          onsubmit="return confirm('Da li ste sigurni da želite da otkažete ovu rezervaciju? Ova radnja je nepovratna.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-md">
                            Otkaži rezervaciju
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center text-gray-400">
            <p class="text-lg mb-4">Nemate rezervacija.</p>
            <a href="{{ route('movie.single') }}" class="bg-[#2C2F36] hover:bg-gray-700 text-white px-6 py-2 rounded-md">
                Pogledaj filmove
            </a>
        </div>
    @endif
@endsection
