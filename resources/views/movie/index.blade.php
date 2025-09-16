@extends('layouts.app')

@section('title', 'Početna')

@section('content')
<body class="bg-[#0E0F12] text-gray-200 min-h-screen flex flex-col">

<main class="flex-1 px-8 py-10">
    <div class="grid grid-cols-2 md:grid-cols-4 justify-items-center">
        @foreach (['Film 1', 'Film 2', 'Film 3', 'Film 4'] as $film)
            <div class="w-48 h-72 bg-[#0F1115] rounded-lg flex flex-col items-center justify-center shadow-md">
                <span class="text-gray-500">POSTER</span>
                <p class="mt-3 text-sm">{{ $film }}</p>
            </div>
        @endforeach
    </div>
</main>

</body>
@endsection

