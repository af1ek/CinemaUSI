@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="flex justify-center items-center min-h-[70vh]">
        <div class="w-full max-w-sm bg-[#191B1F] rounded-xl shadow-lg p-8">
            <h2 class="text-xl font-semibold mb-6">Register</h2>

            <form method="POST" action="#">
                @csrf
                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm mb-2">Email</label>
                    <input id="email" type="email" name="email" required
                           class="w-full px-3 py-2 bg-transparent border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500"
                           placeholder="ime@domen.rs">
                </div>

                <!-- Username -->
                <div class="mb-4">
                    <label for="username" class="block text-sm mb-2">Korisničko ime</label>
                    <input id="username" type="text" name="username" required
                           class="w-full px-3 py-2 bg-transparent border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500"
                           placeholder="npr. milan_j">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm mb-2">Lozinka</label>
                    <input id="password" type="password" name="password" required
                           class="w-full px-3 py-2 bg-transparent border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500">
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm mb-2">Potvrdite lozinku</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           class="w-full px-3 py-2 bg-transparent border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500">
                </div>

                <button type="submit"
                        class="w-full bg-gray-700 hover:bg-gray-600 text-white py-2 rounded-md">
                    Register
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-400">
                Već imate nalog?
                <a href="{{ route('login') }}" class="text-gray-200 hover:underline">Ulogujte se ovde!</a>
            </p>
        </div>
    </div>
@endsection
