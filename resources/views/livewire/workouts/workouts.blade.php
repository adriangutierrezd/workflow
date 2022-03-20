<div class="relative">
    @section('title','Workflow - Entrenamientos')
    {{-- Notifications --}}

    @if (count(auth()->user()->workouts) > 0)
        {{-- Users with workouts --}}
        <h1>Todos los entrenamientos</h1>
            {{-- Create workout --}}
            <div class="my-4 flex flex-col items-end justify-end">
                <x-button class="mb-4 sm:mb-4" wire:click="create" wire:loading.attr="disabled" wire:target="create">Añadir entrenamiento</x-button>
                <select wire:model="filter" class="form-control">
                    <option value='week'>Últimos 7 días</option>
                    <option value='month'>Últimos 30 días</option>
                    <option value='year'>Último año</option>
                    <option value='all'>Todos los entrenamientos</option>
                </select>
                
            </div>

            {{-- Computer workouts --}}
            <div class=" flex-col my-4 mt-8 flex">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:block">
                                            Nota
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($workouts as $workout)
                                    <tr class="hover:bg-gray-200  {{ (date("d/m/y") == date('d/m/y', strtotime($workout->date))) ? 'bg-gray-200' : ''}}" wire:key="workout-{{$workout->id}}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ((date("d/m/y") == date('d/m/y', strtotime($workout->date))))
                                                <p>Hoy</p>
                                            @else
                                                @php
                                                    $date = date('d/m/y', strtotime($workout->date));
                                                @endphp
                                                <p><?php echo $date ?></p>
                                            @endif
                                        </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($workout->name != null)
                                                    @php
                                                    $nameCropped = Str::limit($workout->name, 12);
                                                    @endphp
                                                    <p><?php echo $nameCropped ?></p>
                                                @else
                                                    <p class="text-gray-400">Sin nombre</p>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap hidden md:block">
                                                @if ($workout->note != null)
                                                    @php
                                                        $noteCropped = Str::limit($workout->note, 60);
                                                    @endphp
                                                    <p><?php echo $noteCropped ?></p>
                                                @else
                                                    <p class="text-gray-400">Sin notas</p>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex flex-row justify-center">
                                                    <a class="text-blue-600 mx-2" href="{{route('workouts.show', $workout)}}">Ver</a> 
                                                    <span>|</span>
                                                    <a class="text-blue-600 mx-2" href="{{route('workouts.edit', $workout)}}">Editar</a>
                                                    <span>|</span>
                                                    <a class="text-blue-600 mx-2 cursor-pointer" wire:click="$emit('deleteWorkout', {{$workout->id}})">Eliminar</a>
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

            </div>
    @else
        {{-- Users without workouts --}}
            <div class="flex flex-col items-center justify-center min-h-screen">
                <h1 class="text-center">¡Añade tu primer entrenamiento!</h1>
                <a
                class="cursor-pointer flex items-center justify-center px-8 py-3 my-8 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10"
                wire:click="create"
                wire:loading.attr="disabled"
                wire:target="create">
                Empezar
                </a>

            </div>
    @endif


    @push('scripts')
        <script>
            Livewire.on('deleteWorkout', workout => {
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
                            Livewire.emitTo('workouts.workouts', 'delete', workout);
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
