@extends('layouts.app')

@section('title', 'Rezervacija karata')

@section('content')
    <div class="flex justify-center items-center min-h-[70vh]">
        <div class="w-full max-w-md bg-[#191B1F] rounded-xl shadow-lg p-8 text-center">
            <h2 class="text-xl font-semibold mb-6">Rezervacija karata</h2>

            <div class="mb-4 flex justify-between items-center">
                <span class="text-gray-300">Broj slobodnih mesta:</span>
                <span class="font-bold text-white">{{ $availableSeats }}</span>
            </div>

            <form method="POST" action="#">
                @csrf
                <div class="mb-6 flex justify-between items-center">
                    <label for="tickets" class="text-gray-300">Odaberi broj karata (max {{ $maxTickets }})</label>
                    <input id="tickets" type="number" name="tickets" value="1" min="1" max="{{ $maxTickets }}"
                           class="w-20 px-2 py-1 bg-[#0F1115] border border-gray-700 rounded-md text-center text-white focus:outline-none focus:ring-2 focus:ring-gray-500">
                </div>

                <div class="flex justify-between gap-4">
                    <a href="{{ url()->previous() }}"
                       class="w-1/2 bg-gray-700 hover:bg-gray-600 text-white py-2 rounded-md text-center">
                        Odustani
                    </a>
                    <button type="submit"
                            class="w-1/2 bg-[#2C2F36] hover:bg-gray-700 text-white py-2 rounded-md">
                        Kreiraj rezervaciju
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
