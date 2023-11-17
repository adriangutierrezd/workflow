<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-start space-x-4">
                    <div class="bg-blue-200 text-blue-500 rounded p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
                        </svg>  
                    </div>    

                    <h3 class="font-semibold text-xl">23</h3>
                </div>
                <p class="my-2">Entrenamientos planificados</p>
                <span class="flex items-center justify-start space-x-2">
                    <p>+18%</p>
                    <p class="text-gray-600">frente a la semana pasada</p>
                </span>
            </div>

            <div class="p-4 bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-start space-x-4">
                    <div class="bg-emerald-200 text-emerald-500 rounded p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>   
                    </div>    

                    <h3 class="font-semibold text-xl">16</h3>
                </div>
                <p class="my-2">Entrenamientos finalizados</p>
                <span class="flex items-center justify-start space-x-2">
                    <p>-3 %</p>
                    <p class="text-gray-600">frente a la semana pasada</p>
                </span>
            </div>

            <div class="p-4 bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-start space-x-4">
                    <div class="bg-red-200 text-red-500 rounded p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>    

                    <h3 class="font-semibold text-xl">5</h3>
                </div>
                <p class="my-2">Entrenamientos cancelados</p>
                <span class="flex items-center justify-start space-x-2">
                    <p>+ 4%</p>
                    <p class="text-gray-600">frente a la semana pasada</p>
                </span>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-4">
            @include('trainer.partials.workouts-state-pie')
            @include('trainer.partials.next-workouts')
        </div>



    </div>
</x-app-layout>
