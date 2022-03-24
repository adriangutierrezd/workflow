    {{-- Create new cluster --}}
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2>Añade un ejercicio:</h2>
        {{-- Form fields --}}
        <div class="grid grid-cols-1 lg:grid-cols-10 gap-5 overflow-hidden">
            <div class="col-span-10 lg:col-span-6">
                <div class="flex flex-col items-start">
                    {{-- Name --}}
                    <x-jet-label>Ejercicio</x-jet-label>
                    <x-jet-input wire:model.lazy="name" list="excercises" class="form-control w-full"
                        placeholder="P.e: Sentadillas" type="text" />
                    <datalist id="excercises">
                        @forelse ($this->excercises as $excercise)
                            <option value="{{ $excercise->name }}">
                        @empty
                            <option value="0"></option>
                        @endforelse
                    </datalist>
                    <x-jet-input-error for="name" />
                </div>
            </div>
            {{-- Sets --}}
            <div class="col-span-10 md:col-span-3 lg:col-span-1">
                <div class="flex flex-col items-start">
                    <x-jet-label>Series</x-jet-label>
                    <x-jet-input type="number" min="1" class="w-full" wire:model="sets"></x-jet-input>
                    <x-jet-input-error for="sets" />
                </div>
            </div>
            {{-- Reps --}}
            <div class="col-span-10 md:col-span-3 lg:col-span-1">
                <div class="flex flex-col items-start">
                    <x-jet-label>Repeticiones</x-jet-label>
                    <x-jet-input type="number" min="1" class="w-full" wire:model="reps"></x-jet-input>
                    <x-jet-input-error for="reps" />
                </div>
            </div>
            {{-- Weight --}}
            <div class="col-span-10 md:col-span-4 lg:col-span-2">
                <div class="flex flex-col items-start">
                    <x-jet-label>Peso</x-jet-label>
                    <x-jet-input type="number" class="w-full" wire:model="weight"></x-jet-input>
                    <x-jet-input-error for="weight" />
                </div>
            </div>
        </div>

        {{-- Note --}}
        <div class="mt-4">
            <x-jet-label>Anotaciones: </x-jet-label>
            <textarea cols="30" rows="4"
                placeholder="Aquí puedes hacer anotaciones sobre el ejercicio. Por ejemplo: fallo en la técnica tercera serie"
                class="w-full form-control" wire:model="clusterNote"></textarea>
        </div>


        {{-- Button --}}
        <div class="flex mt-2">
            <x-jet-button class="ml-auto" wire:click="createCluster" wire:loading.attr="disabled"
                wire:target="createCluster">
                Añadir
            </x-jet-button>
        </div>
    </div>
