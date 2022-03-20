<x-auth-layout>
    @section('title','Workflow - Confirma tu contraseña')
    <div class="grid grid-cols-1 min-h-screen">
        <div class="min-h-screen flex flex-col items-center jusitfy-center bg-white px-4">
            <div class="my-auto w-2/3 md:w-1/3">
                <img class="mr-auto mb-6 h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
                <div class="text-left">
                    <h1>
                        Confirma tu contraseña
                    </h1>
                </div>
                <div class="my-4 text-sm text-gray-600">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </div>
                {{-- Form --}}
                <div class="my-8">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <x-jet-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
            
                        <div>
                            <x-jet-label for="password" value="{{ __('Password') }}" />
                            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
                        </div>
            
                        <div class="flex justify-end mt-4">
                            <x-jet-button class="ml-4">
                                {{ __('Confirm') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-auth-layout>
