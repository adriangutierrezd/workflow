<x-auth-layout>
    @section('title','Workflow - Iniciar sesión')
    <div class="grid grid-cols-1 lg:grid-cols-2 min-h-screen">
        <div class="min-h-screen flex flex-col items-center jusitfy-center bg-gray-50">
            <div class="my-auto w-2/3">
                <img class="mr-auto mb-6 h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
                <div class="text-left">
                    <h1>
                        Inicia sesión en tu cuenta de <span class="text-indigo-600">Workflow</span>
                    </h1>
                </div>
                <div class="my-8 flex items-center justify-center">
                    <a href="/login-google" class="flex items-center px-4 py-2 border rounded-sm border-black">
                        <i class="bi bi-google mr-8"></i>
                        Iniciar sesión con Google
                    </a>
                </div>
                <hr>
                {{-- Form --}}
                <div class="my-8">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <x-jet-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
            
                        <div>
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        </div>
            
                        <div class="mt-4">
                            <x-jet-label for="password" value="{{ __('Password') }}" />
                            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        </div>
            
                        <div class="block mt-4">
                            <label for="remember_me" class="flex items-center">
                                <x-jet-checkbox id="remember_me" name="remember" />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>
            
                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
            
                            <x-jet-button class="ml-4">
                                {{ __('Log in') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
                <p class="text-center">¿No tienes cuenta? <a href="{{route('register')}}" class="text-indigo-600 hover:underline">Crea una nueva</a></p>
            </div>
        </div>
        <div class="hidden lg:block min-h-screen filter grayscale">
            <img class="h-screen w-full object-cover"
            src="images/dumbells.jpg"
            >
        </div>
    </div>
</x-auth-layout>
