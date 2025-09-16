@extends('layouts.app')

@section('title', 'Moje rezervacije')

@section('content')
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold">Moje rezervacije</h1>
    </div>

    <div class="flex flex-wrap justify-center gap-6">
        @foreach ($reservations as $reservation)
            <div class="w-64 bg-[#191B1F] rounded-lg shadow-md p-6 text-center">
                <p class="text-lg font-semibold mb-3">Film: {{ $reservation['movie'] }}</p>
                <div class="bg-[#0F1115] px-4 py-2 rounded text-gray-300 font-medium mb-4">
                    Termin: {{ $reservation['time'] }}
                </div>
                <form method="POST" action="#">
                    @csrf
                    <button type="submit"
                            class="w-full bg-[#2C2F36] hover:bg-gray-700 text-white py-2 rounded-md">
                        Otkaži
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
