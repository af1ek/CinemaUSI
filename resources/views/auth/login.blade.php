@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="flex justify-center items-center min-h-[70vh]">
        <div class="w-full max-w-sm bg-[#191B1F] rounded-xl shadow-lg p-8">
            <h2 class="text-xl font-semibold mb-6">Login</h2>

            <form method="POST" action="#">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm mb-2">Email</label>
                    <input id="email" type="email" name="email" required
                           class="w-full px-3 py-2 bg-transparent border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm mb-2">Lozinka</label>
                    <input id="password" type="password" name="password" required
                           class="w-full px-3 py-2 bg-transparent border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500">
                </div>

                <button type="submit"
                        class="w-full bg-gray-700 hover:bg-gray-600 text-white py-2 rounded-md">
                    Login
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-400">
                Nemate nalog?
                <a href="/register" class="text-gray-200 hover:underline">Registrujte se ovde</a>
            </p>
        </div>
    </div>
@endsection
