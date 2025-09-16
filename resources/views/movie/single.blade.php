@extends('layouts.app')

@section('content')
    <main class="flex-1 px-8 py-10">
        <h1 class="text-2xl font-bold mb-6">
            @if(request('q'))
                Rezultati pretrage za: "{{ request('q') }}"
            @else
                Svi filmovi
            @endif
        </h1>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 justify-items-center">
            @forelse($movies as $movie)
                <a href="{{ route('movie.details', $movie->id) }}" class="block group">
                    <div class="w-48 h-72 bg-[#0F1115] rounded-lg flex flex-col items-center justify-center shadow-md hover:bg-[#1A1D23] hover:shadow-lg transform hover:scale-105 transition-all duration-300 cursor-pointer">
                        @if ($movie->poster)
                            <img src="{{ asset('storage/' . $movie->poster) }}"
                                 alt="{{ $movie->name }}"
                                 class="w-full h-52 object-cover rounded-t-lg">
                            <div class="p-3 w-full text-center">
                                <p class="text-sm group-hover:text-white transition-colors">{{ $movie->name }}</p>
                            </div>
                        @else
                            <div class="w-full h-52 flex items-center justify-center text-gray-500 rounded-t-lg">
                                POSTER
                            </div>
                            <div class="p-3 w-full text-center">
                                <p class="text-sm group-hover:text-white transition-colors">{{ $movie->name }}</p>
                            </div>
                        @endif
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center text-gray-400 mt-10">
                    @if(request('q'))
                        <p class="text-lg">Nema rezultata za "{{ request('q') }}"</p>
                        <a href="{{ route('movie.single') }}" class="text-blue-400 hover:text-blue-300 mt-2 inline-block">
                            Pogledaj sve filmove
                        </a>
                    @else
                        <p class="text-lg">Trenutno nema dostupnih filmova.</p>
                    @endif
                </div>
            @endforelse
        </div>
    </main>
@endsection
