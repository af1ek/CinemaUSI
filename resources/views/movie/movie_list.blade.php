@extends('layouts.app')

@section('content')
    <main class="flex-1 px-8 py-10">
        <h1 class="text-xl font-bold mb-6">Svi filmovi</h1>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @forelse ($movies as $movie)
                <div class="w-48 h-72 bg-[#0F1115] rounded-lg flex flex-col items-center justify-between shadow-md p-3">
                    @if ($movie->poster)
                        <img src="{{ asset('storage/' . $movie->poster) }}"
                             alt="{{ $movie->name }}"
                             class="w-full h-52 object-cover rounded-md">
                    @else
                        <div class="w-full h-52 flex items-center justify-center text-gray-500">
                            POSTER
                        </div>
                    @endif

                    <p class="mt-2 text-sm text-center">{{ $movie->name }}</p>
                </div>
            @empty
                <p class="text-gray-400">Nema filmova u bazi.</p>
            @endforelse
        </div>
    </main>
@endsection
