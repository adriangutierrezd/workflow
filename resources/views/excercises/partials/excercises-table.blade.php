<div>
    <h2 class="card-heading-2">{{__('Excercises')}}</h2>
    <div class="flex flex-col mt-6">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-8 align-middle md:px-6 lg:px-8">
                <div class="border border-gray-200 dark:border-gray-700 md:rounded-lg">

                    <table class="records-table" id="excercises-list">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 px-4">
                                    {{__('Name')}}
                                </th>

                                <th scope="col" class="px-12 py-3.5">
                                    {{__('Author')}}
                                </th>

                                <th scope="col" class="py-3.5 px-4">
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <x-modal name="edit-excercise-form" id="edit-excercise-form-modal" maxWidth="lg" focusable>
        <div class="p-6">
            <div class="flex flex-col items-center justify-center">

                <div class="mt-2 text-center">
                    <h3 class="modal-title" id="modal-title">{{__('Edit excercise')}}</h3>
                </div>
                
                <form id="update-excercise-form" class="w-full">

                    <input type="hidden" name="update-excercise-id">
                    <label class="dark:text-white" for="nameEdit">{{__('Name')}}</label>
                    <x-text-input
                        type="text"
                        name="nameEdit"
                        class="block w-full mb-3"
                        maxLength="50"
                        required
                    />
                    <x-input-error :messages="$errors->get('nameEdit')" class="mt-2" />
                    
    
                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>
            
                        <x-primary-button id="update-excercise-button" class="ml-3">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>
    
    
            </div>
        </div>
    </x-modal>

    <x-modal name="delete-excercise-form" id="delete-excercise-form-modal" maxWidth="lg" focusable>

        <div class="p-6">
            <div class="flex flex-col items-center justify-center">

                <div class="mt-2 text-center">
                    <h3 class="modal-title" id="modal-title">{{__('Delete excercise')}}</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        {{__('If you continue, this excercise will be erased from all your workouts')}}
                    </p>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <input type="hidden" name="deleteExcerciseId">

    
                    <x-danger-button id="deleteExcerciseButton" class="ml-3">
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>
            </div>

        </div>

    </x-modal>
</div>
@push('scripts')
    <script defer type="module" src="{{ asset('js/excercises.js') }}"></script>
@endpush