<div>
    <x-primary-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'new-excercise-form')">
        <x-plus-icon/>
        <span class="hidden md:block ml-2">{{__('Add excercise')}}</span>
    </x-primary-button>

    <x-modal name="new-excercise-form" id="new-excercise-form-modal" maxWidth="lg" focusable>

        <div class="p-6">

            <form method="POST" id="new-excercise-modal" action="#">
                @csrf

                <div>
                    <h3 class="modal-title text-center" id="modal-title">{{__('Add excercise')}}</h3>

                    <div class="mt-2">
                        <label class="dark:text-white" for="name">{{__('Name')}}</label>
                        <x-text-input
                            type="text"
                            name="name"
                            id="name"
                            class="block w-full mb-3"
                            maxLength="50"
                            required
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button type="button" x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
    
                    <x-primary-button type="submit" id="btn-create-excercise" class="ml-3">
                        {{ __('Create') }}
                    </x-primary-button>
                </div>
            </form>

        </div>

    </x-modal>
</div>
