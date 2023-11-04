<div>
    <section class="container px-4 mx-auto">
        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Entrenamientos</h2>
    
        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="border border-gray-200 dark:border-gray-700 md:rounded-lg">
    
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="clusters-list">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                        <input type="checkbox" name="select_all" id="select_all" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
                                    </th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                        Ejercicio
                                    </th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                        Series
                                    </th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                        Peso
                                    </th>
    
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


    <div x-data="{ isDeleteModalOpen: false }" @close-modal.camel="isDeleteModalOpen = false" @open-modal.camel="isDeleteModalOpen = true" class="relative flex justify-center" id="deleteClusterModal">

        <div x-show="isDeleteModalOpen" 
            x-cloak
            x-transition:enter="transition duration-300 ease-out"
            x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
            x-transition:leave="transition duration-150 ease-in"
            x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
            x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
            class="fixed inset-0 z-10 overflow-y-auto" 
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
                            <h3 class="text-lg font-medium leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">Borrar cluster</h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Si continuas, el cluster se borrará permanentemente.
                            </p>
                        </div>
                    </div>
    
                    <div class="mt-5 flex items-center justify-end">
    
                        <div class="sm:flex sm:items-center ">
                            <button @click="isDeleteModalOpen = false" class="w-full outline-btn">
                                Cancelar
                            </button>

                            <input type="hidden" name="clusterDeleteId" id="clusterDeleteId">
    
                            <button id="deleteClusterBtn" class="w-full danger-btn">
                                Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-data="{ idEditModalOpen: false }" @close-modal.camel="idEditModalOpen = false" @open-modal.camel="idEditModalOpen = true" id="editClusterModal" class="relative">

        <div x-show="idEditModalOpen" 
            x-cloak
            x-transition:enter="transition duration-300 ease-out"
            x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
            x-transition:leave="transition duration-150 ease-in"
            x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
            x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
            class="fixed inset-0 z-10 overflow-y-auto" 
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    
                <div class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl rtl:text-right dark:bg-gray-900 sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
                    <div>
                        <div class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
    
                        <div class="my-2">
                            <h3 class="text-lg text-center font-medium leading-6 text-gray-800 dark:text-white" id="modal-title">Editar cluster</h3>

                            <form >
                                @csrf

                                <input type="hidden" name="workout_id" value="{{ $workout->id }}">

                                <label class="form-label" for="excercise_id">Ejercicio</label>
                                <select 
                                class="form-field mb-4" 
                                name="excercise_id" required>
                                    <option value="" selected disabled>Escoge un ejercicio</option>
                                    @foreach ($excercises as $excercise)
                                        <option value="{{ $excercise->id }}">{{ $excercise->name }}</option>
                                    @endforeach
                                </select>

                                <label class="form-label" for="sets">Series</label>
                                <input type="number" step="1" min="1" max="255" name="sets"
                                class="form-field mb-4" required>

                                <label class="form-label" for="reps">Repeticiones</label>
                                <input type="number" step="1" min="1" max="65535" name="reps"
                                class="form-field mb-4" required>

                                <label class="form-label" for="weight">Peso</label>
                                <input type="number" step="0.1" min="0" max="99999.99" name="weight"
                                class="form-field mb-4" required>

                                <div class="mt-5 flex items-center justify-end">
    
                                    <div class="sm:flex sm:items-center ">
                                        <button type="button" @click="idEditModalOpen = false" class="w-full outline-btn">
                                            Cancelar
                                        </button>
            
                
                                        <button type="submit" class="w-full primary-btn">
                                            Actualizar
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



</div>
@push('scripts')
    <script defer type="module" src="{{ asset('js/clusters.js') }}"></script>
@endpush