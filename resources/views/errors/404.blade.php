<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Error 404</title>
        <meta name="description" content="¡Mide tus entrenamientos con efectividad con Worflow!">
        <meta name="keywords" content="entrenamiento, powerlifting, entrenamiento con pesas, gimnasio, deporte, salud, 'registrar entrenamiento'">
        <link rel="icon" type="image/png" href="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg">
    
        <meta property="og:title" content="Mide tus entrenamientos en el gimnasio con Workflow">
        <meta property="og:description" content="Workflow es una aplicación web diseñada para todas aquellas personas que quieren llevar un reegistro completo, actualizado y escalable de sus entrenamientos.">
        <meta property="og:image" content="">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://workflow.adriangutierrezd.com">
    
        <meta name="robots" content="noindex">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.typekit.net/nqz3mby.css">
        {{-- Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

        <!-- Styles -->

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />
        @livewire('cookies')
        <div class="min-h-screen bg-gray-100 flex flex-col items-center justify-center">
            <h1>Error 404</h1>
            <img src="images/404.svg" class="h-80 my-8" alt="error 404">
            <a href="{{route('workouts.index')}}"
            class="flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
            Ir al panel de control
            </a>
        </div>
        @livewireScripts
        @isset($_COOKIE['marketing'])
            {{-- Google Analytics Script --}}
        @endisset
    </body>
</html>
