<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{__('Statics of')}} {{ $excercise->name }}
        </h2>
    </x-slot>


    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8  flex items-center justify-end">
            <div
                x-data="{ isDateRangeOpen: false }"
                @close-modal.camel="isDateRangeOpen = false" id="dateRangeDropdown"
                class="relative inline-block"
            >

                <button
                id="dateRangeDropdownBtn"
                @click="isDateRangeOpen = !isDateRangeOpen"
                class="date-range-selector-button">
                    <span id="dateRangeDropdownInfo">Del xx al xx</span>
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
                        <input type="date" name="initialDate" class="form-field" value="{{$initialDate}}">
        
                        <x-input-label for="endDate" class="form-label font-semibold">A:</x-input-label>
                        <input type="date" name="endDate" class="form-field" value="{{$endDate}}">
        
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

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <article class="p-4 bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
            <header>
                <h2 class="card-heading-2">{{__('Weight lifted per workout')}}</h2>
            </header>
            <main id="average-weight-by-session-container" style="width:100%;height:350px">

            </main>
        </article>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <article class="p-4 bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
            <header>
                <h2 class="card-heading-2">{{__('Average weight lifted per rep')}}</h2>
            </header>
            <main id="average-weight-by-rep-container" style="width:100%;height:350px">
                
            </main>
        </article>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <article class="p-4 bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
            <header>
                <h2 class="card-heading-2">{{__('Usage of exercise')}}</h2>
            </header>
            <main id="excercise-usage-container" style="width:100%">
                
            </main>
        </article>
    </div>

    @push('scripts')
        <script>
            window.User = @json($targetUser);
            window.Excercise = @json($excercise);
        </script>
        <script type="module" defer src="{{asset('js/staticsExcercise.js')}}"></script>
    @endpush
</x-app-layout>
