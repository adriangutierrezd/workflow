<div x-data="{ isOpen: false }" class="relative flex justify-center">

    <button @click="isOpen = true" class="flex px-4 py-2 mx-auto tracking-wide text-white transition-colors 
    duration-300 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none 
    focus:ring focus:ring-blue-300 focus:ring-opacity-80">
        
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        
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

            <form method="POST" action="{{ route('clusters.store') }}" class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl rtl:text-right dark:bg-gray-900 sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
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
@push('scripts')
    <script defer type="module" src="{{ asset('js/excerciseSearch.js') }}"></script>
@endpush    