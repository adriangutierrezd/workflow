<x-guest-layout>
    @section('title','Workflow - Verificación en 2 pasos')
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div x-data="{ recovery: false }">
            <div class="mb-4 text-sm text-gray-600" x-show="! recovery">
                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
            </div>

            <div class="mb-4 text-sm text-gray-600" x-show="recovery">
                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
            </div>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <x-jet-label for="code" value="{{ __('Code') }}" />
                    <x-jet-input id="code" class="block mt-1 w-full" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                </div>

                <div class="mt-4" x-show="recovery">
                    <x-jet-label for="recovery_code" value="{{ __('Recovery Code') }}" />
                    <x-jet-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                                    x-show="! recovery"
                                    x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('Use a recovery code') }}
                    </button>

                    <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                                    x-show="recovery"
                                    x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('Use an authentication code') }}
                    </button>

                    <x-jet-button class="ml-4">
                        {{ __('Log in') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>


<x-auth-layout>
    <div class="grid grid-cols-1 min-h-screen">
        <div class="min-h-screen flex flex-col items-center jusitfy-center bg-white px-4">
            <div class="my-auto w-2/3 md:w-1/3">
                <img class="mr-auto mb-6 h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
                {{-- Form --}}
                <div class="my-8" x-data="{ recovery: false }">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="mb-4 text-sm text-gray-600" x-show="! recovery">
                        {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                    </div>
        
                    <div class="mb-4 text-sm text-gray-600" x-show="recovery">
                        {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                    </div>
                    <x-jet-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('two-factor.login') }}">
                        @csrf
        
                        <div class="mt-4" x-show="! recovery">
                            <x-jet-label for="code" value="{{ __('Code') }}" />
                            <x-jet-input id="code" class="block mt-1 w-full" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                        </div>
        
                        <div class="mt-4" x-show="recovery">
                            <x-jet-label for="recovery_code" value="{{ __('Recovery Code') }}" />
                            <x-jet-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                        </div>
        
                        <div class="flex items-center justify-end mt-4">
                            <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                                            x-show="! recovery"
                                            x-on:click="
                                                recovery = true;
                                                $nextTick(() => { $refs.recovery_code.focus() })
                                            ">
                                {{ __('Use a recovery code') }}
                            </button>
        
                            <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                                            x-show="recovery"
                                            x-on:click="
                                                recovery = false;
                                                $nextTick(() => { $refs.code.focus() })
                                            ">
                                {{ __('Use an authentication code') }}
                            </button>
        
                            <x-jet-button class="ml-4">
                                {{ __('Log in') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-auth-layout>
