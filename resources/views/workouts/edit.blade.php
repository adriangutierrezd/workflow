<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar entrenamiento') }}: {{ $workout->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">

                <div class="flex items-center justify-end">
                    <div x-data="{ isOptionsOpen: false }" @close-modal.camel="isOptionsOpen = false" id="optionsDropdown" class="relative inline-block">
                        <!-- Dropdown toggle button -->
                        <button @click="isOptionsOpen = !isOptionsOpen" class="relative z-10 block p-2 text-gray-700 bg-white border border-transparent rounded-md dark:text-white focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:bg-gray-800 focus:outline-none">
                            <svg class="w-5 h-5 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    
                        <!-- Dropdown menu -->
                        <div x-show="isOptionsOpen" 
                            x-cloak
                            @click.away="isOptionsOpen = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-90" 
                            class="absolute right-0 z-20 w-48 py-2 mt-2 origin-top-right bg-white rounded-md shadow-xl dark:bg-gray-800"
                        >

                            <div x-data="{ isPropertiesModalOpen: false }" class="relative">
                                <button @click="isPropertiesModalOpen = true" class="flex w-full items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                      
                                    <span class="mx-2">
                                        Propiedades
                                    </span>
                                </button>

                                <div x-show="isPropertiesModalOpen" 
                                    x-transition:enter="transition duration-300 ease-out"
                                    x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                                    x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
                                    x-transition:leave="transition duration-150 ease-in"
                                    x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
                                    x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                                    class="dark-overlay" 
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
                                                    <h3 class="text-lg text-center font-medium leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">Propiedades del entrenamiento</h3>

                                                    <form action="{{route('workouts.update', $workout->id)}}" method="POST" class="grid grid-cols-1 gap-4">
                                                        @csrf
                                                        @method('PUT')
                                                        <div>
                                                            <label class="text-gray-700 dark:text-gray-200" for="title">Título</label>
                                                            <input id="title" name="title" type="text" value="{{ $workout->title }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                                        </div>

                                                        <div>
                                                            <label class="text-gray-700 dark:text-gray-200" for="date">Fecha</label>
                                                            <input id="date" name="date" type="date" value="{{ $workout->date }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                                        </div>

                                                        <div>
                                                            <label class="text-gray-700 dark:text-gray-200" for="status">Estado</label>
                                                            <select name="status_id" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                                                @foreach ($workoutStatuses as $item)
                                                                    <option @php echo $workout->status->id === $item->id ? 'selected' : '' @endphp value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="mt-5 flex justify-end items-center">
                            
                                                            <div>
                                                                <button @click="isPropertiesModalOpen = false" 
                                                                type="button"
                                                                class="w-full px-4 py-2 mt-2 text-sm font-medium tracking-wide 
                                                                text-gray-700 capitalize transition-colors duration-300 transform 
                                                                border border-gray-200 rounded-md sm:mt-0 sm:w-auto mr-3
                                                                dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 
                                                                hover:bg-gray-100 focus:outline-none focus:ring 
                                                                focus:ring-gray-300 focus:ring-opacity-40">
                                                                    Cancelar
                                                                </button>
                                        
                                                                <button 
                                                                type="submit"
                                                                class="w-full px-4 py-2 mt-2 text-sm font-medium 
                                                                tracking-wide text-white capitalize transition-colors duration-300 
                                                                transform bg-blue-600 rounded-md sm:w-auto sm:mt-0 hover:bg-blue-500 
                                                                focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                                                                    Guardar
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


                            @can('assign', $workout)
                            <div x-data="{ isAsignModalOpen: false }" @close-modal.camel="isAsignModalOpen = false" @open-modal.camel="isAsignModalOpen = true" id="assignWorkoutModal" class="relative flex justify-center">
                                <button @click="isAsignModalOpen = true" 
                                class="flex w-full items-center p-3 text-sm text-gray-600 capitalize 
                                transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 
                                dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                  </svg>
                                  
                    
                                <span class="mx-2">
                                    Asignar
                                </span>
                                </button>
                            
                                <div x-show="isAsignModalOpen" 
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
                            
                                        <form id="assignWorkoutForm" class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl rtl:text-right dark:bg-gray-900 sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
                                            <div>
                                                <div class="flex items-center justify-center text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                                      </svg>
                                                </div>
                            
                                                <div class="mt-2 text-center">
                                                    <h3 class="text-lg font-medium leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">Asignar entrenamiento</h3>
                                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                        Al asignar el entrenamiento a esta persona, su antiguo propietario (en caso de haberlo) perderá los accesos.
                                                    </p>
                                                </div>
                                            </div>

                                            <input type="hidden" name="workout_id" id="workout_id" value="{{$workout->id}}">

                                            <select 
                                            id="client_selector"
                                            class="form-field mb-4" 
                                            name="user_id" required>
                                                <option value="" selected disabled>Escoge un usuario</option>
                                                @foreach($clients as $client)
                                                    <option @php echo $workout->user_id === $client->id ? 'selected' : '' @endphp value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>

                                            </select>
                            
                                            <div class="mt-5 flex items-center justify-end">
                            
                                                <div class="sm:flex sm:items-center ">
                                                    <button 
                                                        type="button"
                                                        @click="isAsignModalOpen = false" 
                                                        class="outline-btn">
                                                        Cancelar
                                                    </button>
                            
                                                    <button 
                                                        type="submit"
                                                        class="primary-btn">
                                                        Asignar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endcan

                            <div x-data="{ idDeleteModalOpen: false }" class="relative flex justify-center">
                                <button @click="idDeleteModalOpen = true" 
                                class="flex w-full items-center p-3 text-sm text-gray-600 capitalize 
                                transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 
                                dark:hover:bg-gray-700 dark:hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                        
                                    <span class="mx-2">
                                        Eliminar
                                    </span>
                                </button>
                            
                                <div 
                                    x-show="idDeleteModalOpen" 
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
                            
                                            <div class="mt-5 flex items-center justify-center">
                            
                                                <div class="sm:flex sm:items-center ">
                                                    <button @click="idDeleteModalOpen = false" class="w-full px-4 py-2 mt-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:mt-0 sm:w-auto sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                                                        Cancelar
                                                    </button>
                            
                                                    <form action="{{route('workouts.destroy', $workout)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button 
                                                        type="submit"
                                                        class="w-full px-4 py-2 mt-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-red-600 rounded-md sm:w-auto sm:mt-0 hover:bg-red-500 focus:outline-none focus:ring focus:ring-red-300 focus:ring-opacity-40">
                                                            Borrar
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end my-3">
                    <x-new-cluster-dialog :workout="$workout" :excercises="$excercises"/>
                </div>
                <x-clusters-table :workout="$workout" :excercises="$excercises"/>

            </div>
        </div>
    </div>

    @push('scripts')

        @if(Auth::user()->isTrainer())
            <script src="{{ asset('js/assign-workout.js') }}" defer type="module"></script>
        @endif
    @endpush
</x-app-layout>
