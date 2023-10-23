<div x-data="{ isOpen: false }" class="relative flex justify-center">

    <button @click="isOpen = true" class="flex px-4 py-2 mx-auto tracking-wide text-white transition-colors 
    duration-300 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none 
    focus:ring focus:ring-blue-300 focus:ring-opacity-80">
        
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        
        <span class="ml-2">Añadir entrenamiento</span>
    </button>

    <!-- Fondo oscuro alrededor del modal -->
    <div x-show="isOpen" x-cloak class="fixed inset-0 z-10 overflow-y-auto bg-black opacity-50" @click="isOpen = false"></div>

    <!-- El modal en sí -->
    <div x-show="isOpen" 
        x-cloak
        x-transition:enter="transition duration-300 ease-out"
        x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave="transition duration-150 ease-in"
        x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        class="fixed inset-0 z-20 overflow-y-auto" 
        aria-labelledby="modal-title" role="dialog" aria-modal="true"
    >
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <form method="POST" action="{{ route('workouts.store') }}" class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl rtl:text-right dark:bg-gray-900 sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
                @csrf

                <div>
                    <div class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>

                    <div class="mt-2">
                        <h3 class="text-lg text-center font-medium leading-6 text-gray-800 mb-4 capitalize dark:text-white" id="modal-title">Crear entrenamiento</h3>

                        <label class="dark:text-white" for="title">Título</label>
                        <input type="text" name="title" id="title" class="block my-2 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <label class="dark:text-white" for="date">Fecha del entrenamiento</label>
                        <input type="date" name="date" id="date" value="{{date('Y-m-d')}}" class="block mt-2 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    </div>
                </div>

                <div class="mt-5 sm:flex sm:items-center justify-end">

                    <div class="sm:flex sm:items-center ">
                        <button type="button" @click="isOpen = false" class="w-full px-4 py-2 mt-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:mt-0 sm:w-auto sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                            Cancelar
                        </button>

                        <button type="submit" class="w-full px-4 py-2 mt-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300
                        transform bg-blue-600 rounded-md sm:w-auto sm:mt-0 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                            Crear
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>