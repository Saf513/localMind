<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Questions Localisées')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- Assurez-vous d'avoir un fichier CSS principal --}}
    @stack('styles') {{-- Pour des feuilles de style spécifiques à la page --}}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script> {{-- JavaScript principal --}}
    <script src="{{asset('https://cdn.tailwindcss.com')}}"></script>

    @stack('scripts') {{-- Pour des scripts spécifiques à la page --}}
</head>
<body class="bg-gray-100 font-sans antialiased">

    @include('layouts.partials.header')

    <main class="container mx-auto py-6">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    @stack('modals') {{-- Pour les modales --}}
</body>
</html>