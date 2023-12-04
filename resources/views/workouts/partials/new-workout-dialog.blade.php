<div>
    <x-primary-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'new-client-form')">
        <x-plus-icon/>
        <span class="hidden md:block ml-2">{{__('Add workout')}}</span>
    </x-primary-button>

    <x-modal name="new-client-form" id="new-client-form-modal" maxWidth="lg" focusable>

        <div class="p-6">

            <form method="POST" action="{{ route('workouts.store') }}">
                @csrf

                <div>
                    <h3 class="modal-title text-center" id="modal-title">{{__('Add workout')}}</h3>

                    <div class="mt-2">
                        <label class="dark:text-white" for="title">{{__('Title')}}</label>
                        <x-text-input
                            type="text"
                            name="title"
                            id="title"
                            class="block w-full mb-3"
                            maxLength="50"
                            required
                        />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />

                        <label class="dark:text-white" for="date">{{__('Date')}}</label>
                        <x-text-input
                            type="date"
                            value="{{date('Y-m-d')}}"
                            name="date"
                            id="date"
                            class="block w-full mb-3"
                            required
                        />
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button type="button" x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
    
                    <x-primary-button type="submit" class="ml-3">
                        {{ __('Create') }}
                    </x-primary-button>
                </div>
            </form>

        </div>

    </x-modal>
</div>
