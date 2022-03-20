<div>
    {{-- Computer table --}}
    <div class=" flex-col my-4 mt-8 hidden lg:flex">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ejercicio
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Series
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Repeticiones
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Peso
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($clusters as $cluster)
                                <tr wire:key="cluster-wk-{{ $cluster->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="text-left">{{ $cluster->excercise_name }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="text-center">{{ $cluster->sets }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="text-center">{{ $cluster->reps }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="text-center">{{ $cluster->weight }} kg</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-row justify-center">
                                            {{-- Edit button --}}
                                            <x-button class="mx-2"
                                                wire:click="editCluster({{ $cluster }})"
                                                wire:loading.attr="disabled"
                                                wire:target="editCluster({{ $cluster }})">
                                                <i class="bi bi-pencil text-base"></i>
                                            </x-button>

                                            {{-- Delete button --}}
                                            <x-button-light color="red" class="mx-2"
                                                wire:click="$emit('deleteClt', {{ $cluster->id }})">
                                                <i class="bi bi-x-lg"></i>
                                            </x-button-light>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- Mobile table --}}
    <div class="flex flex-col my-4 mt-8 lg:hidden">
        @foreach ($clusters as $cluster)
            <div class="my-5 overflow-x-auto rounded-lg">
                <div class="align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden border-b border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 flex flex-row">

                            <thead class="bg-gray-50">
                                <tr class="flex flex-col flex-no wrap h-full justify-around">
                                    <th scope="col"
                                        class="flex flex-col flex-no wrap px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Ejercicio
                                    </th>
                                    <th scope="col"
                                        class="flex flex-col flex-no wrap px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Series
                                    </th>
                                    <th scope="col"
                                        class="flex flex-col flex-no wrap px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Repeticiones
                                    </th>
                                    <th scope="col"
                                        class="flex flex-col flex-no wrap px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Peso
                                    </th>
                                    <th scope="col"
                                        class="flex flex-col flex-no wrap px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Nota
                                    </th>
                                    <th scope="col"
                                        class="flex flex-col flex-no wrap px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white w-full">
                                <tr class="flex flex-col flex-no wrap divide-y divide-gray-200">
                                    <td class="px-6 py-4">
                                        <p class="text-left">{{ $cluster->excercise_name }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="text-left">{{ $cluster->sets }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="text-left">{{ $cluster->reps }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="text-left">{{ $cluster->weight }} kg</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($cluster->note != null)
                                            <p class="text-left">{{ $cluster->note }}</p>
                                        @else
                                            <p class="text-left text-gray-400">Sin notas</p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-row justify-start">
                                            {{-- Edit button --}}
                                            <x-button class="mx-2"
                                                wire:click="editCluster({{ $cluster }})"
                                                wire:loading.attr="disabled"
                                                wire:target="editCluster({{ $cluster }})">
                                                <i class="bi bi-pencil text-base"></i>
                                            </x-button>

                                            {{-- Delete button --}}
                                            <x-button-light color="red" class="mx-2"
                                                wire:click="$emit('deleteClt', {{ $cluster->id }})">
                                                <i class="bi bi-x-lg"></i>
                                            </x-button-light>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Modal --}}
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar ejercicio
        </x-slot>
        <x-slot name="content">
            {{-- Ejercicio --}}
            <div class="flex flex-col items-start w-full mb-4">
                <x-jet-label>Ejercicio</x-jet-label>
                <x-jet-input wire:model.lazy="nameEdit" list="excercises" class="form-control w-full"
                    placeholder="P.e: Sentadillas" type="text" />
                <datalist id="excercises">
                    @forelse ($this->excercises as $excercise)
                        <option value="{{ $excercise->name }}">
                        @empty
                        <option value="dd"></option>

                    @endforelse
                </datalist>
                <x-jet-input-error for="nameEdit" />
            </div>
            {{-- Series --}}
            <div class="flex flex-col items-start w-full mb-4">
                <x-jet-label>Series</x-jet-label>
                <x-jet-input type="number" min="1" class="w-full" wire:model="setsEdit"></x-jet-input>
                <x-jet-input-error for="setsEdit" />
            </div>
            {{-- Repes --}}
            <div class="flex flex-col items-start w-full mb-4">
                <x-jet-label>Repeticiones</x-jet-label>
                <x-jet-input type="number" min="1" class="w-full" wire:model="repsEdit"></x-jet-input>
                <x-jet-input-error for="repsEdit" />
            </div>
            {{-- Peso --}}
            <div class="flex flex-col items-start w-full mb-4">
                <x-jet-label>Peso</x-jet-label>
                <x-jet-input type="number" min="0" class="w-full" wire:model="weightEdit"></x-jet-input>
                <x-jet-input-error for="weightEdit" />
            </div>
            {{-- Nota --}}
            <div class="flex flex-col items-start w-full mb-4">
                <x-jet-label>Anotaciones:</x-jet-label>
                <textarea cols="30" rows="4"
                    placeholder="Aquí puedes hacer anotaciones sobre el ejercicio. Por ejemplo: fallo en la técnica tercera serie"
                    class="w-full form-control" wire:model.lazy="clusterNoteEdit"></textarea>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="hideEditModal">Cancelar</x-jet-secondary-button>
            <x-jet-button wire:click="updateCluster" wire:loading.attr="disabled" wire:target="updateCluster">Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>



    @push('scripts')
        <script>
            Livewire.on('deleteClt', cluster => {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás deshacer esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar de todos modos'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('clusters.cluster-list', 'deleteCluster', cluster);
                        Swal.fire(
                            '¡Eliminado!',
                            'Has eliminado el registro con éxito',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>
