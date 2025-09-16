@extends('layouts.app')

@section('title', 'Admin Panel')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

        <div>
            <h1 class="text-2xl font-bold mb-6">Admin Panel</h1>

            <div class="flex flex-col gap-4 w-60">
                <a href="{{ route('admin.create', ['type' => 'movie'])  }}"
                   class="bg-[#2C2F36] hover:bg-gray-700 text-white py-2 px-4 rounded-md text-center">
                    Dodaj novi film
                </a>
                <a href="{{ route('admin.create', ['type' => 'projection'])  }}"
                   class="bg-[#2C2F36] hover:bg-gray-700 text-white py-2 px-4 rounded-md text-center">
                    Dodaj novu projekciju
                </a>
            </div>
        </div>
    </div>
@endsection
