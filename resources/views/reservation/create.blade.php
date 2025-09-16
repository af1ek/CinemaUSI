@extends('layouts.app')

@section('title', 'Rezervacija karata')

@section('content')
    <div class="flex justify-center items-center min-h-[70vh]">
        <div class="w-full max-w-md bg-[#191B1F] rounded-xl shadow-lg p-8 text-center">
            <h2 class="text-xl font-semibold mb-4">Rezervacija karata</h2>

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-600/20 border border-red-600 rounded-lg">
                    @foreach($errors->all() as $error)
                        <p class="text-red-400 text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="mb-6 text-left bg-[#0F1115] p-4 rounded-lg">
                <h3 class="font-semibold">{{ $screening->movie->name }}</h3>
                <p class="text-sm text-gray-400">{{ \Carbon\Carbon::parse($screening->showtime)->format('d.m.Y H:i') }}</p>
                <p class="text-sm text-gray-400">Sala: {{ $screening->hall->name }}</p>
            </div>

            <div class="mb-4 flex justify-between items-center">
                <span class="text-gray-300">Broj slobodnih mesta:</span>
                <span class="font-bold text-white">{{ $availableSeats }}</span>
            </div>

            @if($availableSeats > 0)
                <form method="POST" action="{{ route('reservation.store') }}">
                    @csrf
                    <input type="hidden" name="screening_id" value="{{ $screening->id }}">

                    <div class="mb-6 flex justify-between items-center">
                        <label for="tickets" class="text-gray-300">Odaberi broj karata (max {{ $maxTickets }})</label>
                        <input id="tickets" type="number" name="tickets" value="1" min="1" max="{{ $maxTickets }}"
                               class="w-20 px-2 py-1 bg-[#0F1115] border border-gray-700 rounded-md text-center text-white focus:outline-none focus:ring-2 focus:ring-gray-500">
                    </div>

                    @error('tickets')
                    <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                    @enderror

                    <div class="flex justify-between gap-4">
                        <a href="{{ route('movie.details', $screening->movie->id) }}"
                           class="w-1/2 bg-gray-700 hover:bg-gray-600 text-white py-2 rounded-md text-center">
                            Odustani
                        </a>
                        <button type="submit"
                                class="w-1/2 bg-[#2C2F36] hover:bg-gray-700 text-white py-2 rounded-md">
                            Kreiraj rezervaciju
                        </button>
                    </div>
                </form>
            @else
                <p class="text-red-400 mb-4">Nema dostupnih mesta za ovu projekciju.</p>
                <a href="{{ route('movie.details', $screening->movie->id) }}"
                   class="block bg-gray-700 hover:bg-gray-600 text-white py-2 rounded-md text-center">
                    Nazad
                </a>
            @endif
        </div>
    </div>
@endsection
