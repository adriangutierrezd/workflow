<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Statics') }}
        </h2>
    </x-slot>

    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8  flex items-center justify-end">
            <div x-data="{ isDateRangeOpen: false }" @close-modal.camel="isDateRangeOpen = false" id="dateRangeDropdown" class="relative inline-block">

                <button 
                id="dateRangeDropdownBtn"
                @click="isDateRangeOpen = !isDateRangeOpen"
                class="relative font-semibold z-10 font-regular p-2 text-gray-700 bg-white border border-transparent rounded-md dark:text-white focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:bg-gray-800 focus:outline-none flex space-x-2">
                    <span id="dateRangeDropdownInfo">Del xx al xx</span>
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
                class="absolute right-0 z-20 w-48 p-4 mt-2 origin-top-right bg-white rounded-md shadow-xl dark:bg-gray-800">
        
                    <form method="GET" action="#" id="date-range-form">
                        <x-input-label for="initialDate" class="form-label font-semibold">De:</x-input-label>
                        <input type="date" name="initialDate" class="form-field" value="{{$initialDate}}">
        
                        <x-input-label for="endDate" class="form-label font-semibold">A:</x-input-label>
                        <input type="date" name="endDate" class="form-field" value="{{$endDate}}">
        
                        <x-primary-button 
                        type="submit"
                        class="w-full mt-3 justify-center">
                            Cargar
                        </x-primary-button>
                    </form>
        
                </div>
        
        
            </div>
        </div>

    </div>

    <div class="py-6">
        @include('workouts.partials.workouts-data-abstract', ['workouts' => [], 'workoutsByStatus' => []])
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-">
        <div class="p-4 bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
            @include('statics.partials.statics-per-excercise')
        </div>
    </div>

    @push('scripts')
        <script>
            window.User = @json($targetUser)
        </script>
        <script type="module" src="{{asset('js/statics.js')}}" defer></script>
    @endpush
</x-app-layout>
