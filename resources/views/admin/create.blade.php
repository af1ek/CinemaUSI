@extends('layouts.app')

@section('title', $type === 'movie' ? 'Dodaj film' : 'Dodaj projekciju')

@section('content')
    <div class="flex justify-center">
        <div class="w-full max-w-lg bg-[#191B1F] rounded-xl shadow-lg p-8">
            <h1 class="text-2xl font-bold mb-6 text-center">
                {{ $type === 'movie' ? 'Dodaj film' : 'Dodaj projekciju' }}
            </h1>

            @if ($type === 'movie')
                <form method="POST" action="" enctype="multipart/form-data" class="flex flex-col gap-4">
                    @csrf
                    <div>
                        <label class="block mb-2 text-gray-300">Naziv</label>
                        <input type="text" name="naziv" class="w-full px-3 py-2 bg-[#0F1115] border border-gray-700 rounded-md text-white">
                    </div>

                    <div>
                        <label class="block mb-2 text-gray-300">Žanr</label>
                        <input type="text" name="zanr" class="w-full px-3 py-2 bg-[#0F1115] border border-gray-700 rounded-md text-white">
                    </div>

                    <div>
                        <label class="block mb-2 text-gray-300">Trajanje (min)</label>
                        <input type="number" name="trajanje" class="w-full px-3 py-2 bg-[#0F1115] border border-gray-700 rounded-md text-white">
                    </div>

                    <div>
                        <label class="block mb-2 text-gray-300">Opis</label>
                        <textarea name="opis" class="w-full px-3 py-2 bg-[#0F1115] border border-gray-700 rounded-md text-white"></textarea>
                    </div>

                    <div>
                        <label class="block mb-2 text-gray-300">Poster</label>
                        <input type="file" name="poster" class="w-full text-gray-300">
                    </div>

                    <div class="flex justify-between gap-4 mt-4">
                        <a href="{{ route('admin.index') }}" class="w-1/2 bg-gray-700 hover:bg-gray-600 text-white py-2 rounded-md text-center">Odustani</a>
                        <button type="submit" class="w-1/2 bg-[#2C2F36] hover:bg-gray-700 text-white py-2 rounded-md">Dodaj film</button>
                    </div>
                </form>
            @elseif ($type === 'projection')
                <form method="POST" action="" class="flex flex-col gap-4">
                    @csrf
                    <div>
                        <label class="block mb-2 text-gray-300">Film</label>
                        <select name="film_id" class="w-full px-3 py-2 bg-[#0F1115] border border-gray-700 rounded-md text-white">
                            <option value="">Odaberite film...</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-gray-300">Sala</label>
                        <select name="sala_id" class="w-full px-3 py-2 bg-[#0F1115] border border-gray-700 rounded-md text-white">
                            <option value="">Odaberite salu...</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-gray-300">Termin</label>
                        <input type="datetime-local" name="termin" class="w-full px-3 py-2 bg-[#0F1115] border border-gray-700 rounded-md text-white">
                    </div>

                    <div>
                        <label class="block mb-2 text-gray-300">Slobodna mesta</label>
                        <input type="number" name="slobodna_mesta" class="w-full px-3 py-2 bg-[#0F1115] border border-gray-700 rounded-md text-white">
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


{{--{{ route('movies.store') }}--}}

{{--{{ route('projekcijas.store') }}--}}
