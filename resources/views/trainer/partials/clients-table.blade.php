<div>
    <h2 class="card-heading-2">{{__('Your clients')}}</h2>
    <div class="flex flex-col mt-6">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-8 align-middle md:px-6 lg:px-8">
                <div class="border border-gray-200 dark:border-gray-700 md:rounded-lg">

                    <table class="records-table" id="clients-list">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 px-4">
                                    {{__('Name')}}
                                </th>

                                <th scope="col" class="px-12 py-3.5">
                                    {{__('Email')}}
                                </th>

                                <th scope="col" class="px-4 py-3.5">
                                    {{__('Incorporation')}}
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

    <x-modal name="delete-client-form" id="delete-client-form-modal" maxWidth="lg" focusable>

        <div class="p-6">
            <div class="flex flex-col items-center justify-center">

                <div class="mt-2 text-center">
                    <h3 class="modal-title" id="modal-title">{{__('Delete client')}}</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        {{__('If you continue, your relationship with the customer will be erased.')}}
                    </p>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <input type="hidden" name="clientDeleteId" id="clientDeleteId">

    
                    <x-danger-button id="deleteClientButton" class="ml-3">
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>
            </div>

        </div>

    </x-modal>

</div>
@push('scripts')
    <script>
        window.User = @json(auth()->user())
    </script>
    <script defer type="module" src="{{ asset('js/clients.js') }}"></script>
@endpush
