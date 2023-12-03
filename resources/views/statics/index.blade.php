<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Statics') }}
        </h2>
    </x-slot>

    <div class="main-container">
        <div class="flex flex-col md:flex-row md:items-center justify-end mt-4">

            <div
                x-data="{ isDateRangeOpen: false }" @close-modal.camel="isDateRangeOpen = false"
                id="dateRangeDropdown" class="relative inline-block mt-2 md:mt-0">
    
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
        </div>
    </div>

    <div class="py-6">
        @include('workouts.partials.workouts-data-abstract', ['workouts' => [], 'workoutsByStatus' => []])
    </div>

    <div class="main-container">
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
