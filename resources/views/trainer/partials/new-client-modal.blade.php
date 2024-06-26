<div>
    <x-primary-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'new-client-form')">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
    </x-primary-button>

    <x-modal name="new-client-form" id="new-client-form-modal" maxWidth="lg" focusable>

        <div class="p-6">
            <div class="flex flex-col items-center justify-center">
                <x-person-plus-icon/>
                <h3 class="modal-title">{{__('Add client')}}</h3>
            </div>

            <form method="POST" id="newClientForm">
                @csrf
                
                <select
                id="client_selector"
                class="form-field mb-4"
                name="user_id" required>
                    <option value="" selected disabled>{{__('Pick an user')}}</option>
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
