<div>
    <section class="container mx-auto">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mt-4">
            <h2 class="card-heading-2">{{$title}}</h2>

            @if(!isset($displayDatePicker) || (isset($displayDatePicker) && $displayDatePicker))

                <div x-data="{ isDateRangeOpen: false }"
                    @close-modal.camel="isDateRangeOpen = false" id="dateRangeDropdown"
                    class="relative inline-block mt-2 md:mt-0"
                >

                    <button
                    id="dateRangeDropdownBtn"
                    @click="isDateRangeOpen = !isDateRangeOpen"
                    class="date-range-selector-button">
                        <span id="dateRangeDropdownInfo"></span>
                        <x-chevron-down-icon/>
                    </button>

                    <div
                    x-show="isDateRangeOpen"
                    x-cloak
                    @click.away="isDateRangeOpen = false"
                    @keyup.escape.window="isDateRangeOpen = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="date-range-picker">

                        
                        <form method="GET" action="#" id="date-range-form">
                            <x-input-label for="initialDate" class="form-label font-semibold">De:</x-input-label>
                            <input type="date" name="initialDate" class="form-field" value="{{ $initialDate }}">

                            <x-input-label for="endDate" class="form-label font-semibold">A:</x-input-label>
                            <input type="date" name="endDate" class="form-field" value="{{ $endDate }}">

                            <x-primary-button
                            type="submit"
                            class="w-full mt-3 justify-center">
                                {{__('Load')}}
                            </x-primary-button>
                        </form>

                    </div>

        
                </div>
            @endif

        </div>
    
        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-8 align-middle md:px-6 lg:px-8">
                    <div class="border overflow-hidden border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="records-table" id="workouts-list">
                            <thead>
                                <tr>
                                    <th scope="col" class="py-3.5 px-4">
                                        {{__('Title')}}
                                    </th>
    
                                    <th scope="col" class="px-12 py-3.5">
                                        {{__('Date')}}
                                    </th>
    
                                    <th scope="col" class="px-4 py-3.5">
                                        {{__('State')}}
                                    </th>
    
                                    <th scope="col" class="px-4 py-3.5">{{__('People')}}</th>
    
                                    <th scope="col" class="px-4 py-3.5">{{__('Progress')}}</th>
    
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
    </section>

    <x-modal name="delete-workout-form" id="deleteWorkoutModal" maxWidth="lg" focusable>

        <div class="p-6">
            <div class="flex flex-col items-center justify-center">

                <div class="mt-2 text-center">
                    <h3 class="modal-title" id="modal-title">{{__('Delete workout')}}</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        {{__('If you continue, the training will be permanently deleted.')}}
                    </p>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <input type="hidden" name="workoutDeleteId" id="workoutDeleteId">
    
                    <x-danger-button id="deleteBtn" class="ml-3">
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>
        </div>
    </x-modal>

</div>
@push('scripts')
    <script>
        const displayStatesJson = @json($allowedStates ?? [])
    </script>
    <script defer type="module" src="{{ asset('js/workouts.js') }}"></script>
@endpush
