<div>
    <x-primary-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'new-client-form')">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        
        <span class="ml-2">Añadir entrenamiento</span>
    </x-primary-button>

    <x-modal name="new-client-form" id="new-client-form-modal" maxWidth="lg" focusable>

        <div class="p-6">

            <form method="POST" action="{{ route('workouts.store') }}">
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
                        <input type="text" name="title" id="title" class="block my-2 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <label class="dark:text-white" for="date">Fecha del entrenamiento</label>
                        <input type="date" name="date" id="date" value="{{date('Y-m-d')}}" class="block mt-2 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button type="button" x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
    
                    <x-primary-button type="submit" class="ml-3">
                        {{ __('Create') }}
                    </x-primary-button>
                </div>
            </form>

        </div>

    </x-modal>
</div>