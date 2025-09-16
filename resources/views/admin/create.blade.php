@extends('layouts.app')

@section('title', $type === 'movie' ? 'Dodaj film' : 'Dodaj projekciju')

@section('content')
    <div class="flex justify-center">
        <div class="w-full max-w-lg bg-[#191B1F] rounded-xl shadow-lg p-8">
            <h1 class="text-2xl font-bold mb-6 text-center">
                {{ $type === 'movie' ? 'Dodaj film' : 'Dodaj projekciju' }}
            </h1>

            @if ($type === 'movie')
                <form method="POST" action="{{ route('movie.store') }}" enctype="multipart/form-data" class="flex flex-col gap-4">
                    @csrf
                    <div>
                        <label class="block mb-2 text-gray-300">Naziv</label>
                        <input type="text" name="name" class="w-full px-3 py-2 bg-[#0F1115] border border-gray-700 rounded-md text-white">
                        @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-gray-300">Žanr</label>
                        <input type="text" name="genre" class="w-full px-3 py-2 bg-[#0F1115] border border-gray-700 rounded-md text-white">
                        @error('genre')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-gray-300">Trajanje (min)</label>
                        <input type="number" name="length" class="w-full px-3 py-2 bg-[#0F1115] border border-gray-700 rounded-md text-white">
                        @error('length')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-gray-300">Opis</label>
                        <textarea name="description" class="w-full px-3 py-2 bg-[#0F1115] border border-gray-700 rounded-md text-white"></textarea>
                        @error('description')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-gray-300">Poster</label>
                        <input type="file" name="poster" class="w-full text-gray-300">
                        @error('poster')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between gap-4 mt-4">
                        <a href="{{ route('admin.index') }}" class="w-1/2 bg-gray-700 hover:bg-gray-600 text-white py-2 rounded-md text-center">Odustani</a>
                        <button type="submit" class="w-1/2 bg-[#2C2F36] hover:bg-gray-700 text-white py-2 rounded-md">Dodaj film</button>
                    </div>
                </form>
            @elseif ($type === 'projection')
                <form method="POST" action="{{ route('screening.store') }}" class="flex flex-col gap-4">
                    @csrf
                    <div>
                        <label class="block mb-2 text-gray-300">Film</label>
                        <select name="movie_id" class="w-full px-3 py-2 bg-[#0F1115] border border-gray-700 rounded-md text-white">
                            <option value="">Odaberite film...</option>
                            @foreach($movies as $movie)
                                <option value="{{ $movie->id }}">{{ $movie->name }}</option>
                            @endforeach
                        </select>
                        @error('movie_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-gray-300">Sala</label>
                        <select name="hall_id" class="w-full px-3 py-2 bg-[#0F1115] border border-gray-700 rounded-md text-white">
                            <option value="">Odaberite salu...</option>
                            @foreach($halls as $hall)
                                <option value="{{ $hall->id }}">{{ $hall->name }} ({{ $hall->total_seats }} mesta)</option>
                            @endforeach
                        </select>
                        @error('hall_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-gray-300">Termin</label>
                        <input type="datetime-local" name="showtime" class="w-full px-3 py-2 bg-[#0F1115] border border-gray-700 rounded-md text-white">
                        @error('showtime')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="flex justify-between gap-4 mt-4">
                        <a href="{{ route('admin.index') }}" class="w-1/2 bg-gray-700 hover:bg-gray-600 text-white py-2 rounded-md text-center">Odustani</a>
                        <button type="submit" class="w-1/2 bg-[#2C2F36] hover:bg-gray-700 text-white py-2 rounded-md">Dodaj projekciju</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection

