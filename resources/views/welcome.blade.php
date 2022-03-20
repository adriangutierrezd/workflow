<x-guest-layout>
    @section('title','Workflow - Mide tus entrenamientos con eficacia')

    <x-slot name="header">
        {{-- Hero section --}}
        <div class="relative bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto">
                <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                    <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                    fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100" />
                    </svg>

                    <div x-cloak x-data="{ open: false }">
                        <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                            <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start"
                                aria-label="Global">
                                <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                                    <div class="flex items-center justify-between w-full md:w-auto">
                                        <x-logo/>
                                        <div class="-mr-2 flex items-center md:hidden">
                                            <button type="button"
                                                class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                                                aria-expanded="false" @click="open = ! open">
                                                <span class="sr-only">Abrir menú</span>
                                                <!-- Heroicon name: outline/menu -->
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 6h16M4 12h16M4 18h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="hidden md:flex md:ml-10 md:pr-4 md:space-x-8">
                                    <a href="/" class="font-medium text-gray-500 hover:text-indigo-700">Inicio</a>

                                    <a href="{{ route('workouts.index') }}"
                                        class="font-medium text-gray-500 hover:text-indigo-700">Plataforma</a>

                                    @auth
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                                class="font-medium text-gray-500 hover:text-indigo-700">{{ __('Log Out') }}</a>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="font-medium text-gray-500 hover:text-indigo-700">Iniciar sesión</a>

                                        <a href="{{ route('register') }}"
                                            class="font-medium text-indigo-600 hover:text-indigo-500">Registrarse</a>
                                    @endauth



                                </div>
                            </nav>
                        </div>

                        <div class="absolute z-10 top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden"
                            x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95">
                            <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
                                <div class="px-5 pt-4 flex items-center justify-between">
                                    <div>
                                        <img class="h-8 w-auto"
                                            src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="">
                                    </div>
                                    <div class="-mr-2">
                                        <button type="button"
                                            class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                                            @click="open = ! open">
                                            <span class="sr-only">Cerrar menú</span>
                                            <!-- Heroicon name: outline/x -->
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="px-2 pt-2 pb-3 space-y-1">

                                    <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                                        Inicio
                                    </a>

                                    <a href="{{ route('workouts.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                                        Plataforma
                                    </a>
                                    @guest
                                        <a href="{{ route('login') }}"
                                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Iniciar sesión</a>
                                    @endguest

                                </div>
                                @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();"
                                        class="block w-full px-5 py-3 text-center font-semibold text-indigo-600 bg-gray-50 hover:bg-gray-100">{{ __('Log Out') }}</a>
                                        
                                </form>
                                @else
                                    <a href="{{ route('register') }}"
                                        class="block w-full px-5 py-3 text-center font-semibold text-indigo-600 bg-gray-50 hover:bg-gray-100">Registrarse</a>
                                @endauth
                            </div>
                        </div>
                    </div>

                    <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                        <div class="sm:text-center lg:text-left">
                            <h1 class="hero-section-heading">
                                <span class="block xl:inline">Lleva el control de tus </span>
                                <span class="block text-indigo-600 xl:inline">entrenamientos</span>
                            </h1>
                            <p
                                class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">


                                Registra y analiza tus entrenamientos en el gimnasio para obtener los mejores resultados.
                            </p>
                            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                <div class="rounded-md shadow">
                                    <a href="{{route('workouts.index')}}"
                                        class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                        Empezar
                                    </a>
                                </div>

                            </div>
                        </div>
                    </main>
                </div>
            </div>
            <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
                <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full filter grayscale"
                    src="images/strings.jpg"
                    alt="">
            </div>
        </div>
    </x-slot>

    {{-- Features --}}
    <div class="py-12 bg-gray-50">
        <div class="container">
            <div class="lg:text-center">
                <h2>
                    La mejor manera de registrar tu entrenamiento
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Olvidate de las libretas, las notas del móvil o los documentos Word. Guardar tu entrenamiento en formato digital es más fácil que nunca con Workflow.
                </p>
            </div>

            <div class="mt-10">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/globe-alt -->
                                <i class="bi bi-journal-text text-2xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-semibold text-gray-900">Utilízalo en cualquier momento</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Workflow lleva un registro online de tus datos, por lo que puedes acceder a ellos en cualquier momento y desde cualquier dispositivo.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/scale -->
                                <i class="bi bi-bar-chart text-2xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-semibold text-gray-900">Sigue tu progreso</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Lleva un registro de tus entrenamientos para poder observar tu mejora y hacer entrenamientos más efectivos en el futuro.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/lightning-bolt -->
                                <i class="bi bi-menu-up text-2xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-semibold text-gray-900">Controla tus entrenamientos</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Crea, elimina y modifica tus entrenamientos cuando quieras, incluso si hace semanas que los añadiste a la plataforma.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/annotation -->
                                <i class="bi bi-phone text-2xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-semibold text-gray-900">Sencillez</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Para utilizar Workflow solo necesitas un dispositivo con conexión a Internet, como tu teléfono móvil.
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
    {{-- CTA --}}
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-white">
        <div class="container py-12 px-4 lg:flex lg:items-center lg:justify-between">
            <h2>
                <span class="block">¿Preparado?</span>
                <span class="block text-indigo-600">Empieza hoy mismo</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0  justify-end">
                <div class="inline-flex rounded-md shadow">
                    <a href="{{route('workouts.index')}}"
                        class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Empezar
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- FAQ --}}
    <div class="my-6">
        <div class="container flex flex-col">
            <h2>Preguntas frecuentes (FAQ)</h2>

            {{-- FAQs --}}

            <div class="w-full hover:shadow-sm my-4">
                <button x-data="{open:false}" @click="open = ! open" class="w-full">
                    <div class="bg-white rounded-t-lg p-4 flex items-center justify-between hover:text-indigo-600">
                        <h3 class="my-0">¿Qué tipo de entrenamientos se pueden registrar?</h3>
                        <i class="bi bi-chevron-down" x-bind:class="{ 'transform -rotate-180': open }"></i>
                    </div>
    
                    <div x-show="open" class="bg-gray-100 rounded-b-lg p-4"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
                    >
                        <p class="text-left">Workflow tiene como objetivo que puedas llevar un registro completo y organizado de tus entrenamientos de musculación, ya sea en el gimnasio, en casa o en un parque de barras.</p>
                    </div>
                </button>
            </div>

            <div class="w-full hover:shadow-sm my-4">
                <button x-data="{open:false}" @click="open = ! open" class="w-full">
                    <div class="bg-white rounded-t-lg p-4 flex items-center justify-between hover:text-indigo-600">
                        <h3 class="my-0">¿Mis entrenamientos son privados?</h3>
                        <i class="bi bi-chevron-down" x-bind:class="{ 'transform -rotate-180': open }"></i>
                    </div>
    
                    <div x-show="open" class="bg-gray-100 rounded-b-lg p-4"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
                    >
                        <p class="text-left">Sí, tú eres la única persona que puede acceder a los datos de tus entrenamientos. Por ello, puedes considerar Workflow como tu agenda personal.</p>
                    </div>
                </button>
            </div>

            <div class="w-full hover:shadow-sm my-4">
                <button x-data="{open:false}" @click="open = ! open" class="w-full">
                    <div class="bg-white rounded-t-lg p-4 flex items-center justify-between hover:text-indigo-600">
                        <h3 class="my-0">¿Puedo añadir mis propios ejercicios?</h3>
                        <i class="bi bi-chevron-down" x-bind:class="{ 'transform -rotate-180': open }"></i>
                    </div>
    
                    <div x-show="open" class="bg-gray-100 rounded-b-lg p-4"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
                    >
                        <p class="text-left">Sí, Workflow tiene una sección privada para que puedas registrar tus entrenamientos en el caso de que no estén registrados en la plataforma. Además, estos ejercicios solo podrás verlos, modificarlos o eliminarlos tú.</p>
                    </div>
                </button>
            </div>

        </div>
    </div>
    {{-- CONTACT --}}
    <div class="py-6 bg-white">
        <div class="container">
            <h2>¿Quieres preguntarnos algo?</h2>
            @livewire('contact-form-guests')
        </div>
    </div>


</x-guest-layout>
