<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 relative bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">

                <div class="flex justify-end items-center">
                    @include('workouts.partials.new-workout-dialog')
                </div>

                @include('workouts.partials.workouts-table', ['title' => __('Workouts')])


            </div>
        </div>
    </div>
</x-app-layout>
