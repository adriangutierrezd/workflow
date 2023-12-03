<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5 grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="p-4 bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
        <div class="flex items-center justify-start space-x-4">
            <div class="bg-blue-200 text-blue-500 rounded p-2">
                <x-rectangule-stack-icon/>
            </div>

            <h3 class="font-semibold text-xl" data-label="planned-workouts">{{ count($workouts) }}</h3>
        </div>
        <p class="my-2">{{__('Planned workouts')}}</p>
    </div>

    <div class="p-4 bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
        <div class="flex items-center justify-start space-x-4">
            <div class="bg-emerald-200 text-emerald-500 rounded p-2">
                <x-check-circle-icon/>
            </div>

            <h3 class="font-semibold text-xl" data-label="completed-workouts">
                @isset($workoutsByStatus['Completado'])
                    {{ count($workoutsByStatus['Completado']) }}
                @else
                    0
                @endisset
            </h3>
        </div>
        <p class="my-2">{{__('Completed workouts')}}</p>
    </div>

    <div class="p-4 bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
        <div class="flex items-center justify-start space-x-4">
            <div class="bg-red-200 text-red-500 rounded p-2">
                <x-x-circle-icon/>
            </div>

            <h3 class="font-semibold text-xl" data-label="cancelled-workouts">
                @isset($workoutsByStatus['Cancelado'])
                    {{ count($workoutsByStatus['Cancelado']) }}
                @else
                    0
                @endisset
            </h3>
        </div>
        <p class="my-2">{{__('Cancelled workouts')}}</p>
    </div>
</div>
