<x-auth-layout>
    @section('title','Workflow - Establece una nueva contraseña')
    <div class="grid grid-cols-1 min-h-screen">
        <div class="min-h-screen flex flex-col items-center jusitfy-center bg-white px-4">
            <div class="my-auto w-2/3 md:w-1/3">
                <img class="mr-auto mb-6 h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
                <div class="text-left">
                    <h1>
                        Establece una nueva contraseña
                    </h1>
                </div>

                {{-- Form --}}
                <div class="my-8">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <x-jet-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
            
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
            
                        <div class="block">
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                        </div>
            
                        <div class="mt-4">
                            <x-jet-label for="password" value="{{ __('Password') }}" />
                            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        </div>
            
                        <div class="mt-4">
                            <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                            <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        </div>
            
                        <div class="flex items-center justify-end mt-4">
                            <x-jet-button>
                                {{ __('Reset Password') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-auth-layout>
