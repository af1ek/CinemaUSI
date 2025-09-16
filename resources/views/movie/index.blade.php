@extends('layouts.app')

@section('title', 'Početna')

@section('content')
<body class="bg-[#0E0F12] text-gray-200 min-h-screen flex flex-col">

<main class="flex-1 px-8 py-10">
    <div class="grid grid-cols-2 md:grid-cols-4 justify-items-center">
        @foreach ($movies as $movie)
            <a href="{{ route('movie.details', $movie->id) }}">
                <div class="w-48 h-72 bg-[#0F1115] rounded-lg flex flex-col items-center justify-center shadow-md">
                    @if ($movie->poster)
                        <img src="{{ asset('storage/' . $movie->poster) }}"
                             alt="{{ $movie->name }}"
                             class="w-full h-52 object-cover rounded-md">
                    @else
                        <div class="w-full h-52 flex items-center justify-center text-gray-500">
                            POSTER
                        </div>
                    @endif
                    <p class="mt-3 text-sm">{{ $movie->name }}</p>
                </div>
            </a>
        @endforeach
    </div>
</main>

</body>
@endsection

