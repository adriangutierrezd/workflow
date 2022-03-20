<nav class="bg-blueGray-800">
    <div class="max-w-7xl mx-auto px-2 md:px-6 lg:px-8 relative">


        {{-- Computer --}}
        <div class="relative hidden items-center justify-between h-16 md:flex">
            {{-- Links --}}
            <div class="flex-1 flex items-center justify-center md:items-stretch md:justify-start">
                {{-- Logo --}}
                <a class="flex-shrink-0 flex items-center" href="{{ route('workouts.index') }}">
                    <img class="block lg:hidden h-8 w-auto"
                        src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
                    <img class="hidden lg:block h-8 w-auto"
                        src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
                        alt="Workflow">
                </a>
                {{-- Items --}}
                <div class="hidden md:block md:ml-6">
                    <div class="flex space-x-4">

                        
                        <x-nav-link href="{{ route('workouts.index') }}" :active="request()->routeIs('workouts.*')">
                            {{ __('Entrenamientos') }}
                        </x-nav-link>

                        <x-nav-link href="{{ route('excercises.index') }}" :active="request()->routeIs('excercises.index')">
                            {{ __('Ejercicios') }}
                        </x-nav-link>

                        <x-nav-link href="{{ route('maximums.index') }}" :active="request()->routeIs('maximums.*')">
                            {{ __('Repeticiones máximas') }}
                        </x-nav-link>

                        <x-nav-link href="{{ route('statics.index') }}" :active="request()->routeIs('statics.*')">
                            {{ __('Estadísticas') }}
                        </x-nav-link>
                        
                        @if ((auth()->user()->role) == 'admin')
                            <x-nav-link href="{{ route('excercise-categories.index') }}" :active="request()->routeIs('excercise-categories.index')">
                                {{ __('Categorías (EJ)') }}
                            </x-nav-link>
                        @endif
                    </div>
                </div>
            </div>
            {{-- User --}}
            <div class="absolute inset-y-0 right-0 hidden items-center pr-2 md:static md:inset-auto md:ml-6 md:pr-0 md:flex">
                {{-- Sign up user --}}
                @auth
                    <div class="ml-3 relative" x-data="{ open: false }" >
                        <div>
                            <button 
                            x-on:click="open = ! open"
                            type="button"
                                class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Abrir opciones de usuario</span>
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        </div>
                        <div 
                        x-show="open" @click.outside="open = false"
                        :class="{'block': open, 'hidden': !open}"
                        x-transition
                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-nones z-50"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <x-jet-dropdown-link href="{{route('home')}}" :active="request()->routeIs('home')">Inicio</x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{route('profile.show')}}" :active="request()->routeIs('profile.show')">Perfil</x-jet-dropdown-link>



                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{route('logout')}}" :active="request()->routeIs('logout')" 
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();"
                                    >Cerrar sesión</x-jet-dropdown-link>

                            </form>


                        </div>
                    </div>
                    {{-- Not sign up user --}}
                @else
                    <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                        {{ __('Register') }}</x-nav-link>

                    <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                            {{ __('Log in') }}</x-nav-link>
            @endauth
            </div>
        </div>
        
        {{-- Mobile --}}
        <div class="flex items-center justify-between h-16 md:hidden">
            {{-- Logo --}}
            <a href="{{ route('workouts.index') }}">
                <div class="flex-shrink-0 flex items-center">
                    <img class="block lg:hidden h-8 w-auto"
                        src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
                    <img class="hidden lg:block h-8 w-auto"
                        src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
                        alt="Workflow">
                </div>
            </a>

            <div x-data="{ open:false }" class="md:hidden">
                {{-- Hamburguer icon --}}
                <button
                    class="inline-flex items-center justify-center p-2 rounded-md text-blue-200 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false" 
                    type="button" 
                    x-on:click="open = ! open">
            
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                {{-- Items --}}
                <div class="bg-blueGray-800 absolute left-0 w-full z-50 md:hidden" id="mobile-menu" x-show="open" x-transition
                @click.outside="open = false"
                >
                    <div class="px-2 pt-2 pb-3 space-y-1 flex flex-col">


                            <x-nav-link href="{{ route('workouts.index') }}" :active="request()->routeIs('workouts.*')">
                                {{ __('Entrenamientos') }}
                            </x-nav-link>
    
                            <x-nav-link href="{{ route('excercises.index') }}" :active="request()->routeIs('excercises.index')">
                                {{ __('Ejercicios') }}
                            </x-nav-link>

                            <x-nav-link href="{{ route('maximums.index') }}" :active="request()->routeIs('maximums.*')">
                                {{ __('Repeticiones máximas') }}
                            </x-nav-link>

                            <x-nav-link href="{{ route('statics.index') }}" :active="request()->routeIs('statics.*')">
                                {{ __('Estadísticas') }}
                            </x-nav-link>
                        
                        @if ((auth()->user()->role) == 'admin')
                            <x-nav-link href="{{ route('excercise-categories.index') }}" :active="request()->routeIs('excercise-categories.index')">
                                {{ __('Categorías (EJ)') }}
                            </x-nav-link>
                        @endif

                        <div class="border-t border-gray-100 opacity-40"></div>
                        
                        {{-- Sign up users --}}
                        @auth
                        <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                            Inicio</x-nav-link>
                            <x-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                {{ __('Profile') }}</x-nav-link>


                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-nav-link href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                {{ __('Log Out') }}    
                                </x-nav-link>
                            </form>
                        {{-- Not sign up users --}}
                        @else
                            <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                                {{ __('Register') }}</x-nav-link>

                            <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                                    {{ __('Log in') }}</x-nav-link>
                        @endauth


                    </div>
                </div>
            
            </div>
        </div>



    </div>
</nav>