<div>
    <x-primary-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'new-client-form')">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
    </x-primary-button>

    <x-modal name="new-client-form" id="new-client-form-modal" maxWidth="lg" focusable>

        <div class="p-6">
            <div class="flex flex-col items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
    
                <h3 class="text-lg text-center font-medium leading-6 text-gray-800 mb-4 capitalize dark:text-white mt-3">Añadir cliente</h3>
            </div>

            <form method="POST" id="newClientForm">
                @csrf
                
                <select 
                id="client_selector"
                class="form-field mb-4" 
                name="user_id" required>
                    <option value="" selected disabled>Escoge un usuario</option>
                </select>
    
                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
    
                    <x-primary-button class="ml-3">
                        {{ __('Create') }}
                    </x-primary-button>
                </div>
            </form>

        </div>

    </x-modal>
</div>

@push('scripts')
    <script defer type="module" src="{{ asset('js/excerciseSearch.js') }}"></script>
@endpush    