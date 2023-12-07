<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{asset('/img/Workflow-favicon.png')}}" type="image/x-icon">
        <title>{{ config('app.name', 'Workflow') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <header class="bg-white dark:bg-gray-900">
            <nav x-data="{ isOpen: false }" class="relative bg-white dark:bg-gray-900">
                <div class="container px-6 py-4 mx-auto md:flex md:justify-between md:items-center">
                    <div class="flex items-center justify-between">
                        <a href="/">
                            <x-application-logo-big  class="h-16" />
                        </a>
            
                        <!-- Mobile menu button -->
                        <div class="flex md:hidden">
                            <button
                                x-cloak @click="isOpen = !isOpen" type="button"
                                class="text-gray-500 dark:text-gray-200 hover:text-gray-600
                                dark:hover:text-gray-400 focus:outline-none focus:text-gray-600
                                dark:focus:text-gray-400" aria-label="toggle menu"
                            >
                                <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                                </svg>
        
                                <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
            
                    <div
                        x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']"
                        class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out
                        bg-white dark:bg-gray-900 md:bg-transparent md:dark:bg-transparent md:mt-0 md:p-0
                        md:top-0 md:relative md:w-auto md:opacity-100 md:translate-x-0 md:flex md:items-center"
                    >
                        <div class="flex flex-col md:flex-row md:mx-6">

                            @if (Route::has('login'))
                                @auth
                                        <a
                                            class="welcome-nav-link"
                                            href="{{ url('/dashboard') }}"
                                        >
                                            {{__('Dashboard')}}
                                        </a>
                                    @else
                                        <a
                                            href="{{ route('login') }}"
                                            class="welcome-nav-link"
                                        >
                                            {{__('Log in')}}
                                        </a>
                
                                        @if (Route::has('register'))
                                            <a
                                                href="{{ route('register') }}"
                                                class="welcome-nav-link">
                                                {{__('Register')}}
                                            </a>
                                        @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        
            <div class="container px-6 py-16 mx-auto">
                <div class="items-center lg:flex">
                    <div class="w-full lg:w-1/2">
                        <div class="lg:max-w-lg">
                            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white lg:text-4xl">{{__('Keep track of')}}<br> {{__('your')}} <span class="text-blue-500 lowercase">{{__('Workouts')}}</span></h1>
                            
                            <p class="mt-3 text-gray-600 dark:text-gray-400">{{__('Track and analyze your workouts at the gym to get the best results')}}.</p>
                            
                            <a href="{{ route('register') }}"
                            class="inline-block px-5 py-2 mt-6 
                            text-sm tracking-wider text-white uppercase 
                            transition-colors duration-300 transform bg-blue-600 
                            rounded-lg lg:w-auto hover:bg-blue-500 focus:outline-none 
                            focus:bg-blue-500">{{__('Start now')}}</a>
                        </div>
                    </div>
        
                    <div class="flex items-center justify-center w-full mt-6 lg:mt-0 lg:w-1/2">
                        <x-hero-section-icon/>
                    </div>
                </div>
            </div>
        </header>
        <main>

            <section class="bg-white dark:bg-gray-900">
                <div class="container px-6 mx-auto">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                        <div>
                            <x-chart-bar-icon/>
                            <h3
                                class="mt-4 text-xl font-semibold text-gray-800 dark:text-white"
                            >
                                {{__('Follow your progress')}}
                            </h3>
                            <p
                                class="mt-2 text-gray-500 dark:text-gray-400"
                            >
                                {{__('Keep a record of your workouts so you can track your improvement and make future workouts more effective')}}.
                            </p>
                        </div>
            
                        <div>
                            <x-folder-open-icon/>
                            <h3
                                class="mt-4 text-xl font-semibold text-gray-800 dark:text-white"
                            >
                                {{__('Take control of your workouts')}}
                            </h3>
                            <p
                                class="mt-2 text-gray-500 dark:text-gray-400"
                            >
                                {{__("Create, delete and modify your workouts whenever you want, even if it's been weeks since you added them to the platform")}}.
                            </p>
                        </div>
            
                        <div>
                            <x-cloud-icon/>
                            <h3
                                class="mt-4 text-xl font-semibold text-gray-800 dark:text-white"
                            >
                                {{__('Use it at any time')}}
                            </h3>
                            <p
                                class="mt-2 text-gray-500 dark:text-gray-400">
                                {{__('Workflow keeps an online record of your data, so you can access it at any time and from any device.')}}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-white dark:bg-gray-900">
                <div class="container flex flex-col items-center px-4 py-12 mx-auto text-center">
                    <h2 class="max-w-2xl mx-auto text-2xl font-semibold tracking-tight text-gray-800 xl:text-3xl dark:text-white">
                        {{__('Bring your workouts to')}} <span class="text-blue-500 lowercase">{{__('The next level')}}</span>
                    </h2>
            
                    <p class="max-w-4xl mt-6 text-center text-gray-500 dark:text-gray-300">
                        {{__('Forget about notebooks, cell phone notes or Word documents. Saving your training in digital format is easier than ever with Workflow')}}
                    </p>
            
                    <div class="inline-flex w-full mt-6 sm:w-auto">
                        <a href="{{ route('register') }}" class="inline-flex uppercase items-center justify-center w-full px-6 py-2 text-white duration-300 bg-blue-600 rounded-lg hover:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                            {{__('Register')}}
                        </a>
                    </div>
                </div>
            </section>

            <section class="bg-white dark:bg-gray-900">

                <div class="container mx-auto px-4 py-12">
                    <h2 class="max-w-2xl mx-auto text-2xl text-center font-semibold tracking-tight text-gray-800 xl:text-3xl dark:text-white">
                        {{__('Do you have any questions?')}}
                    </h2>

                    <form action="{{route('mail.contact-form')}}" x-data="{ submitting: false }" @submit="submitting = true" method="POST" id="demo-form" class="grid grid-cols-1 md:grid-cols-2 mt-6 gap-4">

                        @csrf

                        <div>
                            <x-input-label class="font-semibold capitalize">{{__('Name')}}</x-input-label>
                            <x-text-input type="text" name="name" class="w-full" required minLength="3"/>
                        </div>
    
                        <div>
                            <x-input-label class="font-semibold capitalize">{{__('email')}}</x-input-label>
                            <x-text-input type="email" name="email" class="w-full" required/>
                        </div>
    
                        <div class="md:col-span-2">
                            <x-input-label class="font-semibold">{{__('Type your message')}}</x-input-label>
                            <textarea name="message" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm" cols="30" rows="5"></textarea>    
                        </div>
    
                        <button 
                            :disabled="submitting"
                            class="w-full md:col-span-2 p-3 text-sm tracking-wider text-white uppercase transition-colors duration-300 transform bg-blue-600 rounded-lg lg:w-auto hover:bg-blue-500 focus:outline-none focus:bg-blue-500">{{__('Send')}}</button>
                    </form>

                </div>
            </section>

        </main>
        <footer class="bg-white dark:bg-gray-900">
            <div class="container flex flex-col items-center justify-between p-6 mx-auto space-y-4 sm:space-y-0 sm:flex-row">
                <a href="/">
                    <x-application-logo-big  class="h-16" />
                </a>
        
                <p class="text-sm text-gray-600 dark:text-gray-300">© Copyright @php echo date('Y') @endphp. {{__('All rights reserved')}}.</p>
        
                <div class="flex -mx-2">
                    <a href="https://github.com/adriangutierrezd" target="_blank" class="mx-2 text-gray-600 transition-colors duration-300 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400" aria-label="Github">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.026 2C7.13295 1.99937 2.96183 5.54799 2.17842 10.3779C1.395 15.2079 4.23061 19.893 8.87302 21.439C9.37302 21.529 9.55202 21.222 9.55202 20.958C9.55202 20.721 9.54402 20.093 9.54102 19.258C6.76602 19.858 6.18002 17.92 6.18002 17.92C5.99733 17.317 5.60459 16.7993 5.07302 16.461C4.17302 15.842 5.14202 15.856 5.14202 15.856C5.78269 15.9438 6.34657 16.3235 6.66902 16.884C6.94195 17.3803 7.40177 17.747 7.94632 17.9026C8.49087 18.0583 9.07503 17.99 9.56902 17.713C9.61544 17.207 9.84055 16.7341 10.204 16.379C7.99002 16.128 5.66202 15.272 5.66202 11.449C5.64973 10.4602 6.01691 9.5043 6.68802 8.778C6.38437 7.91731 6.42013 6.97325 6.78802 6.138C6.78802 6.138 7.62502 5.869 9.53002 7.159C11.1639 6.71101 12.8882 6.71101 14.522 7.159C16.428 5.868 17.264 6.138 17.264 6.138C17.6336 6.97286 17.6694 7.91757 17.364 8.778C18.0376 9.50423 18.4045 10.4626 18.388 11.453C18.388 15.286 16.058 16.128 13.836 16.375C14.3153 16.8651 14.5612 17.5373 14.511 18.221C14.511 19.555 14.499 20.631 14.499 20.958C14.499 21.225 14.677 21.535 15.186 21.437C19.8265 19.8884 22.6591 15.203 21.874 10.3743C21.089 5.54565 16.9181 1.99888 12.026 2Z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </footer>
    </body>
</html>
