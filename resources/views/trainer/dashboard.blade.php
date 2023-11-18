<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        @include('workouts.partials.workouts-data-abstract', ['workouts' => $workouts, 'workoutsByStatus' => $workoutsByStatus])

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
            @include('trainer.partials.workouts-state-pie', ['workoutsByStatus' => $workoutsByStatus, 'workoutsByDate' => $workoutsByDate])
            @include('trainer.partials.next-workouts', ['weekDays' => $weekDays])
        </div>



        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <div class="p-4 bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                @include('workouts.partials.workouts-table', ['title' => __('In progress workouts'), 'allowedStates' => ['En progreso']])
            </div>
        </div>


    </div>
</x-app-layout>
