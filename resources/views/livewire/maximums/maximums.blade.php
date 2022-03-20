<div class="relative">
    @section('title','Workflow - RMs')
    {{-- Notifications --}}
    <x-jet-action-message on="saved" class="fixed bottom-2 md:top-20 right-2">
        <div class="bg-indigo-600 text-white shadow-lg rounded-md p-4">
            Cambios guradados.
        </div>
    </x-jet-action-message>

    <h1>Repeticiones máximas</h1>
    <p class="mb-2">Añade un ejercicio desde el botón "Añadir ejercicio" y posteriormente, añade tus nuevas marcas con los enlaces "Añadir".</p>

    <div class="flex items-center justify-end">
        <x-button class="mb-4 sm:mb-4" wire:click="$set('open', true)" wire:loading.attr="disabled">Añadir ejercicio</x-button>
    </div>


    {{-- MRExcercises  --}}
    <div class=" flex-col my-8 flex">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="p-4">
                        <x-jet-input type="text" placeholder="Busca un ejercicio" wire:model="search" class="form-control w-full"/>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Ejercicio
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            RM Actual
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:block">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($mres as $mre)
                                    <tr class="hover:bg-gray-200" wire:key="$mre-{{$mre->id}}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <p>{{$mre->excercise->name}}</p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap hidden md:block">
                                            @php
                                                $maxRep = $mre->maximum_reps()->orderBy('weight', 'desc')->limit(1)->get();
                                                $maxRep  = json_decode($maxRep, true);
                                            @endphp
                                            @if (empty($maxRep))
                                                <p class="text-gray-400">Sin registros</p>
                                            @else
                                                <p>{{$maxRep[0]['weight']}} Kg</p>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-row justify-center">
                                                <a class="text-blue-600 mx-2 cursor-pointer" wire:click="addMaxRep({{ $mre }})" wire:loading.attr="disabled" wire:target="addMaxRep({{ $mre }})">Añadir </a> 
                                                <span>|</span>
                                                <a class="text-blue-600 mx-2" href="{{route('maximums.show', $mre)}}">Ver </a>
                                                <span>|</span>
                                                <a class="text-blue-600 mx-2 cursor-pointer"  wire:click="$emit('deleteMre', {{$mre}})">Eliminar</a>
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

    {{-- CREATE MRE MODAL --}}
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Añadir ejercicio 
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label>Ejercicio:</x-jet-label>
                <x-jet-input wire:model.lazy="name" list="excercises" class="form-control w-full"
                        placeholder="P.e: Sentadillas" type="text" />
                <datalist id="excercises">
                    @forelse ($this->excercises as $excercise)
                        <option value="{{ $excercise->name }}">
                    @empty
                    @endforelse
                </datalist>
                <x-jet-input-error for="name" />
            </div>
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
            wire:click="$set('open', false)"
            >Cancelar</x-jet-secondary-button>
            <x-jet-button 
            wire:click="save"
            wire:loading.attr="disabled"
            wire:target="save"
            >Añadir</x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    {{-- CREATE MAX REP MODAL --}}
    <x-jet-dialog-modal wire:model="openMaxRepModal">
        <x-slot name="title">
            Añadir marca 
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
            wire:click="$set('openMaxRepModal', false)"
            >Cancelar</x-jet-secondary-button>
            <x-jet-button 
            wire:click="saveMaxRep"
            wire:loading.attr="disabled"
            wire:target="saveMaxRep"
            >Añadir</x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('scripts')
    <script>
        Livewire.on('deleteMre', mre => {
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
                        Livewire.emitTo('maximums.maximums', 'delete', mre);
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
