<div>
    <section class="container mx-auto">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mt-4">
            <h2 class="card-heading-2">{{$title}}</h2>

            @if(!isset($displayDatePicker) || (isset($displayDatePicker) && $displayDatePicker)) 

                <div x-data="{ isDateRangeOpen: false }" @close-modal.camel="isDateRangeOpen = false" id="dateRangeDropdown" class="relative inline-block mt-2 md:mt-0">

                    <button 
                    id="dateRangeDropdownBtn"
                    @click="isDateRangeOpen = !isDateRangeOpen"
                    class="relative font-semibold z-10 font-regular p-2 text-gray-700 bg-white border border-transparent rounded-md dark:text-white focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:bg-gray-800 focus:outline-none flex space-x-2 ml-auto">
                        <span id="dateRangeDropdownInfo"></span>
                        <svg class="w-5 h-5 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
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
                    <div class="border border-gray-200 dark:border-gray-700 md:rounded-lg">
    
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="workouts-list">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        {{__('Title')}}
                                    </th>
    
                                    <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        {{__('Date')}}
                                    </th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        {{__('State')}}
                                    </th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">{{__('People')}}</th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">{{__('Progress')}}</th>
    
                                    <th scope="col" class="py-3.5 px-4">
                                        <span class="sr-only">{{__('Edit')}}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">

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
                    <h3 class="text-lg font-medium leading-6 text-gray-800 dark:text-white" id="modal-title">{{__('Delete workout')}}</h3>
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