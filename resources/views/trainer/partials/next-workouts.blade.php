<article class="p-4 bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
    
    <header>
        <h2 class="card-heading-2">{{__('Upcoming workouts')}}</h2>
    </header>

    <main class="flex flex-col h-full">
        <ul
            class="flex overflow-x-auto text-sm
            font-medium text-center text-gray-500
            dark:text-gray-400 mt-4" id="week-days-container"
        >
            @foreach($weekDays as $weekDay)
                @if($weekDay['date'] == date('Y-m-d'))
                    <li
                    aria-current="page"
                    data-date="{{ $weekDay['date'] }}"
                    class="week-day-selector week-day-active">
                        <span>{{ $weekDay['number'] }}</span>
                        <span>{{ Str::limit(__($weekDay['name']), 3, '') }}</span>
                    </li>
                @else
                    <li
                    data-date="{{ $weekDay['date'] }}"
                    class="week-day-selector week-day-default">
                        <span>{{ $weekDay['number'] }}</span>
                        <span>{{ Str::limit(__($weekDay['name']), 3, '') }}</span>
                    </li>
                @endif
            @endforeach
        </ul>

        <section
            class="mt-2 flex flex-col justify-start grow
            max-h-40 md:max-h-96 overflow-y-auto"
            id="workouts-by-date-container"
        >

        </section>

    </main>

</article>
@push('scripts')
    <script>
        const weekDays = @json($weekDays);
        const workoutsByWeek = @json($workoutsByDate);
    </script>
    <script defer type="module" src="{{ asset('js/workouts-week-days-selector.js') }}"></script>
@endpush
