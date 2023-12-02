<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="main-container">
            <div class="main-container-content">
                <div class="flex justify-end items-center">
                    @include('workouts.partials.new-workout-dialog')
                </div>

                @include('workouts.partials.workouts-table', ['title' => __('Workouts')])
            </div>
        </div>
    </div>
</x-app-layout>
