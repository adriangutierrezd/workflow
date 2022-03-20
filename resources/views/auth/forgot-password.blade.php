<x-auth-layout>
    @section('title','Workflow - ¿Has olvidado tu contraseña?')
    <div class="grid grid-cols-1 min-h-screen">
        <div class="min-h-screen flex flex-col items-center jusitfy-center bg-white px-4">
            <div class="my-auto w-2/3 md:w-1/3">
                <img class="mr-auto mb-6 h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
                <div class="text-left">
                    <h1>
                        ¿Has olvidado tu contraseña?
                    </h1>
                </div>
                <div class="my-4 text-sm text-gray-600">
                    No te preocupes, para recuperarla solo debes indicarnos cuál es tu correo electrónico y hacer click en el link que te vamos a enviar para crear una nueva
                </div>
                {{-- Form --}}
                <div class="my-8">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <x-jet-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
            
                        <div class="block">
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        </div>
            
                        <div class="flex items-center justify-end mt-4">
                            <x-jet-button>
                                {{ __('Email Password Reset Link') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-auth-layout>
