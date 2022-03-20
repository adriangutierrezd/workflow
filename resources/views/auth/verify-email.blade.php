<x-auth-layout>
    @section('title','Workflow - Verificar email')
    <div class="grid grid-cols-1 min-h-screen">
        <div class="min-h-screen flex flex-col items-center jusitfy-center bg-white px-4">
            <div class="my-auto w-2/3 md:w-1/3">
                <img class="mr-auto mb-6 h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>
        
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif
                {{-- Form --}}
                <div class="my-8">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <x-jet-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
        
                        <div>
                            <x-jet-button type="submit">
                                {{ __('Resend Verification Email') }}
                            </x-jet-button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
        
                        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-auth-layout>
