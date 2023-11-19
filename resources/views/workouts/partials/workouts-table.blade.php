<div>
    <section class="container mx-auto">
        
        <div class="flex items-center justify-between mt-4">
            <h2 class="card-heading-2">{{$title}}</h2>

            @if(!isset($displayDatePicker)  || (isset($displayDatePicker) && $displayDatePicker)) 

                <div x-data="{ isDateRangeOpen: false }" @close-modal.camel="isDateRangeOpen = false" id="dateRangeDropdown" class="relative inline-block">

                    <button 
                    @click="isDateRangeOpen = !isDateRangeOpen"
                    class="relative font-semibold z-10 font-regular p-2 text-gray-700 bg-white border border-transparent rounded-md dark:text-white focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:bg-gray-800 focus:outline-none flex space-x-2">
                        <span>Lun 13 Nov A Dom 19 Nov</span>
                        <svg class="w-5 h-5 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div
                    x-show="isDateRangeOpen"
                    x-cloack
                    @click.away="isDateRangeOpen = false"
                    @keyup.escape.window="isDateRangeOpen = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90" 
                    class="absolute right-0 z-20 w-48 p-4 mt-2 origin-top-right bg-white rounded-md shadow-xl dark:bg-gray-800">

                        
                        <form id="date-range-form">
                            <x-input-label for="initialDate" class="form-label font-semibold">De:</x-input-label>
                            <input type="date" name="initialDate" class="form-field" value="2023-11-13">

                            <x-input-label for="endDate" class="form-label font-semibold">A:</x-input-label>
                            <input type="date" name="endDate" class="form-field" value="2023-11-19">

                            <x-primary-button 
                            type="submit"
                            class="w-full mt-3 justify-center">
                                Cargar
                            </x-primary-button>
                        </form>

                    </div>

        
                </div>
            @endif

        </div>  
    
        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="border border-gray-200 dark:border-gray-700 md:rounded-lg">
    
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="workouts-list">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Título
                                    </th>
    
                                    <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Fecha
                                    </th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Estado
                                    </th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Personas</th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Progreso</th>
    
                                    <th scope="col" class="relative py-3.5 px-4">
                                        <span class="sr-only">Edit</span>
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

    <div x-data="{ isDeleteModalOpen: false }" @close-modal.camel="isDeleteModalOpen = false" @open-modal.camel="isDeleteModalOpen = true" class="relative flex justify-center" id="deleteWorkoutModal">

        <div x-show="isDeleteModalOpen" 
            x-cloak
            x-transition:enter="transition duration-300 ease-out"
            x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
            x-transition:leave="transition duration-150 ease-in"
            x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
            x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
            class="dark-overlay" 
            aria-labelledby="modal-title" role="dialog" aria-modal="true"
        >
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    
                <div class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl rtl:text-right dark:bg-gray-900 sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
                    <div>
                        <div class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </div>
    
                        <div class="mt-2 text-center">
                            <h3 class="text-lg font-medium leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">Borrar entrenamiento</h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Si continuas, el entrenamiento se borrará permanentemente.
                            </p>
                        </div>
                    </div>
    
                    <div class="mt-5 flex items-center justify-end">
    
                        <div class="sm:flex sm:items-center ">
                            <button @click="isDeleteModalOpen = false" class="w-full px-4 py-2 mt-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:mt-0 sm:w-auto sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                                Cancelar
                            </button>

                            <input type="hidden" name="workoutDeleteId" id="workoutDeleteId">
    
                            <button id="deleteBtn" class="w-full px-4 py-2 mt-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-red-600 rounded-md sm:w-auto sm:mt-0 hover:bg-red-500 focus:outline-none focus:ring focus:ring-red-300 focus:ring-opacity-40">
                                Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@push('scripts')
    <script>
        const allowedStates = @json($allowedStates ?? [])
    </script>
    <script defer type="module" src="{{ asset('js/workouts.js') }}"></script>
@endpush