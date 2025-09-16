@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Movies</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @forelse($movies as $movie)
            <div class="w-48 h-72 bg-[#0F1115] rounded-lg flex flex-col items-center justify-center shadow-md">
                <span class="text-gray-500">Poster</span>
                <p class="mt-3 text-sm">{{ $movie->name }}</p>
            </div>
        @empty
            <p>No movies found.</p>
        @endforelse
    </div>
@endsection
