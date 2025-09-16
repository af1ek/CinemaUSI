@extends('layouts.app')

@section('title', $movie->name)

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="flex justify-center">
            <div class="w-64 h-96 bg-[#0F1115] rounded-lg shadow-md overflow-hidden">
                @if ($movie->poster)
                    <img src="{{ asset('storage/' . $movie->poster) }}"
                         alt="{{ $movie->name }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="text-gray-500">POSTER</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="md:col-span-2 bg-[#191B1F] rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-4">{{ $movie->name }}</h1>
            <p class="text-gray-300 mb-4">
                {{ $movie->description }}
            </p>
            <p class="text-gray-400 text-sm">
                Žanr: {{ $movie->genre }} &nbsp;•&nbsp; Trajanje: {{ $movie->length }} min
            </p>
        </div>
    </div>

    <div class="mt-10">
        <h2 class="text-xl font-semibold mb-4">Dostupne projekcije</h2>
        <div class="flex flex-wrap gap-6">
            @forelse ($projections as $projection)
                <div class="bg-[#191B1F] rounded-lg shadow-md p-4 w-60">
                    <div class="bg-[#0F1115] px-4 py-2 rounded text-center font-medium mb-4">
                        Termin: {{ \Carbon\Carbon::parse($projection->showtime)->format('d.m.Y H:i') }}
                    </div>
                    <a href="{{ route('reservation.create', $projection->id) }}" class="block w-full bg-[#2C2F36] hover:bg-gray-700 text-white py-2 rounded-md text-center">
                        Rezerviši
                    </a>
                </div>
            @empty
                <div class="text-center text-gray-400 w-full">
                    <p>Trenutno nema dostupnih projekcija za ovaj film.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
