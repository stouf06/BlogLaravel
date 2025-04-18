<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <nav class="bg-white shadow-md">
    <div class="flex items-center justify-between px-4 py-3 mx-auto max-w-7xl">
        <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">< Mon Blog</a>

        <!-- Menu burger -->
        <div class="sm:hidden">
            <button @click="open = !open" class="text-gray-600 focus:outline-none" x-data="{ open: false }">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Liens desktop -->
        <div class="items-center hidden space-x-4 sm:flex">
            @auth
                @if(Auth::user()->is_admin ?? false)
                    <a href="{{ route('admin.articles.index') }}" class="text-gray-700 hover:text-blue-600">Admin</a>
                @endif
                <span class="text-gray-600">Bonjour, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline">Déconnexion</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Connexion</a>
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Inscription</a>
            @endauth
        </div>
    </div>

    <!-- Menu mobile -->
    <div class="px-4 pt-2 pb-4 space-y-2 sm:hidden" x-show="open" x-data="{ open: false }" style="display: none;">
        @auth
            @if(Auth::user()->is_admin ?? false)
                <a href="{{ route('admin.articles.index') }}" class="block text-gray-700 hover:text-blue-600">Admin</a>
            @endif
            <div class="text-gray-600">Bonjour, {{ Auth::user()->name }}</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:underline">Déconnexion</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block text-blue-600 hover:underline">Connexion</a>
            <a href="{{ route('register') }}" class="block text-blue-600 hover:underline">Inscription</a>
        @endauth
    </div>
</nav>

        <div class="min-h-screen bg-gray-100">
           {{-- @include('layouts.navigation') --}}

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="px-4 py-10">
                @yield('content')
            </main>

        </div>
    </body>
</html>
