<div>
    @section('title') Workflow - RMs de {{$mreExcercise->name}} @endsection
    {{-- Notifications --}}
    <x-jet-action-message on="saved" class="fixed bottom-2 md:top-20 right-2">
        <div class="bg-indigo-600 text-white shadow-lg rounded-md p-4">
            Cambios guradados.
        </div>
    </x-jet-action-message>
    <h1>RMs de {{$mreExcercise->name}}</h1>
    <div class="flex items-center justify-end">
        <x-button class="mb-4 sm:mb-4" wire:click="$set('openSave', true)" wire:loading.attr="disabled">Añadir nueva RM</x-button>
    </div>

    {{-- RMs List --}}
    <div class="flex-col my-8 flex">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Peso
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nota
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($maxReps as $maxRep)
                                    <tr class="hover:bg-gray-200" wire:key="$mre-{{$maxRep->id}}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <p>{{$maxRep->weight}} Kg</p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                            $date = date('d/m/y', strtotime($maxRep->date));
                                            @endphp
                                            <p><?php echo $date ?></p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($maxRep->note != null)
                                            @php
                                                $noteCropped = Str::limit($maxRep->note, 60);
                                            @endphp
                                            <p><?php echo $noteCropped ?></p>
                                            @else
                                                <p class="text-gray-400">Sin notas</p>
                                                
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-row justify-center">
                                                <a class="text-blue-600 mx-2 cursor-pointer" wire:click="editMaxRep({{$maxRep->id}})">Editar</a>
                                                <span>|</span>
                                                <a class="text-blue-600 mx-2 cursor-pointer"  wire:click="$emit('deleteMaxRep', {{$maxRep}})">Eliminar</a>
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


    {{-- UPDATE MAX REP MODAL --}}
    <x-jet-dialog-modal wire:model="openEdit">
        <x-slot name="title">
            Actualizar marca 
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label>Peso:</x-jet-label>
                <x-jet-input type="number" wire:model="weight" class="form-control w-full" min="0"/>
                <x-jet-input-error for="weight" />
            </div>
            <div class="mb-4">
                <x-jet-label class="text-base">Fecha:</x-jet-label>
                <x-jet-input type="date" class="w-full" wire:model="date"></x-jet-input>
                <x-jet-input-error for="date"></x-jet-input-error>
            </div>
            <div class="mb-4">
                <x-jet-label>Nota:</x-jet-label>
                <textarea cols="10" rows="3"
                placeholder="¿Quieres anotar algo sobre la marca?"
                class="form-control w-full" wire:model="note"></textarea>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button 
            wire:click="hideEditModal"
            >Cancelar</x-jet-secondary-button>
            <x-jet-button 
            wire:click="update"
            wire:loading.attr="disabled"
            wire:target="update"
            >Actualizar</x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>


    {{-- CREATE MAX REP MODAL --}}
    <x-jet-dialog-modal wire:model="openSave">
        <x-slot name="title">
            Crear marca 
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label>Peso:</x-jet-label>
                <x-jet-input type="number" wire:model="weight" class="form-control w-full" min="0"/>
                <x-jet-input-error for="weight" />
            </div>
            <div class="mb-4">
                <x-jet-label class="text-base">Fecha:</x-jet-label>
                <x-jet-input type="date" class="w-full" wire:model="date"></x-jet-input>
                <x-jet-input-error for="date"></x-jet-input-error>
            </div>
            <div class="mb-4">
                <x-jet-label>Nota:</x-jet-label>
                <textarea cols="10" rows="3"
                placeholder="¿Quieres anotar algo sobre la marca?"
                class="form-control w-full" wire:model="note"></textarea>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button 
            wire:click="$set('openSave', false)"
            >Cancelar</x-jet-secondary-button>
            <x-jet-button 
            wire:click="save"
            wire:loading.attr="disabled"
            wire:target="save"
            >Actualizar</x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>


    @push('scripts')
        <script>
            Livewire.on('deleteMaxRep', maxRep => {
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
                            Livewire.emitTo('maximums.maximum-reps', 'delete', maxRep);
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
