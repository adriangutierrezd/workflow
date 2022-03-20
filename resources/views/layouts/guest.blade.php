<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>
        <meta name="description" content="¡Mide tus entrenamientos con efectividad con Worflow!">
        <meta name="keywords" content="entrenamiento, powerlifting, entrenamiento con pesas, gimnasio, deporte, salud, 'registrar entrenamiento'">
        <link rel="icon" type="image/png" href="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg">
    
        <meta property="og:title" content="Mide tus entrenamientos en el gimnasio con Workflow">
        <meta property="og:description" content="Workflow es una aplicación web diseñada para todas aquellas personas que quieren llevar un reegistro completo, actualizado y escalable de sus entrenamientos.">
        <meta property="og:image" content="">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://workflow.adriangutierrezd.com">
    
        <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.typekit.net/nqz3mby.css">
        {{-- Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" />
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">

            @livewire('cookies')
            <!-- Page Content -->
            @if (isset($header))
                <section>
                    <div>
                        {{ $header }}
                    </div>
                </section>
            @else
                <x-guest-navigation/>
            @endif
            <main>
                {{ $slot }}
            </main>

            <x-footer></x-footer>
        </div>

        @stack('modals')

        @livewireScripts
        <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
        @isset($_COOKIE['marketing'])
            {{-- Google Analytics Script --}}
            
        @endisset
    </body>
</html>
