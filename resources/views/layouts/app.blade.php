<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'CineMax')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-[#0E0F12] text-gray-200 min-h-screen flex flex-col">

{{--<header class="flex justify-between items-center px-6 py-4 border-b border-gray-800">--}}
{{--    <div class="text-2xl font-bold">CineMax</div>--}}
{{--    <nav class="flex items-center gap-6">--}}
{{--        <a href="{{ route('home') }}" class="hover:text-gray-400">Početna</a>--}}
{{--        <a href="#" class="hover:text-gray-400">Filmovi</a>--}}
{{--        <a href="/login" class="hover:text-gray-400">Login</a>--}}
{{--        <a href="/register" class="hover:text-gray-400">Register</a>--}}
{{--    </nav>--}}
{{--</header>--}}
<header class="flex justify-between items-center px-6 py-4 border-b border-gray-800">
    <div class="text-2xl font-bold">CineMax</div>
    <nav class="flex items-center gap-6">
        <a href="{{ route('home') }}" class="hover:text-gray-400">Početna</a>
        <a href="{{ route('movie.all') }}" class="hover:text-gray-400">Filmovi</a>

        @guest
            <a href="{{ route('login') }}" class="hover:text-gray-400">Login</a>
            <a href="{{ route('register') }}" class="hover:text-gray-400">Register</a>
        @endguest

        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="hover:text-gray-400">Logout</button>
            </form>
        @endauth

        <form action="{{ route('movie.single') }}" method="GET" class="ml-6">
            <input
                type="text"
                name="q"
                placeholder="Search..."
                class="px-3 py-1 rounded-md bg-gray-900 text-gray-200 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
            >
        </form>
    </nav>
</header>


<main class="flex-1 px-8 py-10">
    @yield('content')
</main>

<footer class="border-t border-gray-800 px-6 py-6 flex justify-between items-center text-sm text-gray-500">
    <span>© 2025 CineMax</span>
    <div class="flex gap-4">
        <a href="#">Facebook</a>
        <a href="#">Instagram</a>
        <a href="#">Twitter</a>
    </div>
</footer>

</body>
</html>
