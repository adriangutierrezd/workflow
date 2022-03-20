<div class="relative px-2">
    @section('title','Workflow - Ejercicios')
    {{-- Notifications --}}
    <x-jet-action-message on="saved" class="fixed bottom-2 md:top-20 right-2">
        <div class="bg-indigo-600 text-white shadow-lg rounded-md p-4">
            Cambios guradados.
        </div>
    </x-jet-action-message>

    <h1>Ejercicios:</h1>

    <p class="mb-2">Puedes registrar tus propios ejercicios, aunque en la plataforma ya hay una gran variedad. Son privados, por lo que solo podrás ver los que hayas registrado tú o el administrador.</p>


    {{-- Create excercises --}}
    <div class="bg-white rounded-lg shadow-lg p-8 my-4">
        <div class="grid gird-cols-1 sm:grid-cols-5 gap-5">
            <div class="col-span-1 sm:col-span-3">
                <x-jet-label class="text-base">Nombre del ejercicio:</x-jet-label>
                <x-jet-input type="text" class="w-full" wire:model="name"></x-jet-input>
                <x-jet-input-error for="name"></x-jet-input-error>
            </div>
            <div class="col-span-1 sm:col-span-2">
                <x-jet-label class="text-base">Categoría</x-jet-label>
                
                <select class="form-control w-full" wire:model="category">
                    <option value="" selected disabled>Selecciona una categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="category"></x-jet-input-error>
            </div>
        </div>
        <div class="flex justify-end items-center h-full">
            <x-button class="mt-4 justify-center"
            wire:click="create"
            wire:loading.attr="disabled"
            wire:target="create"
            >
                Añadir 
            </x-button>
        </div>
    </div>


    {{-- All excercises --}}
    <div class="mt-12">
        <div class="flex flex-col my-4 mt-8">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="p-4">
                            <x-jet-input type="text" placeholder="Busca un ejercicio" wire:model="search" class="form-control w-full"/>
                        </div>
                        <table class="min-w-full divide-y divide-gray-200">
                            
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:inline-block">
                                        Categoría
                                    </th>


                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($excercises as $excercise)
                                    @php
                                        $id = $excercise->id;
                                    @endphp
                                    <tr class="hover:bg-gray-200" wire:key="excercise-{{$excercise->id}}">
                                        
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <p class="text-left">{{ $excercise->name }}</p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap hidden sm:inline-block">
                                            <p class="text-left">{{ $excercise->excercise_category->name }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                                @if ($excercise->user_id == auth()->user()->id)
                                                    <div class="hidden sm:flex flex-row justify-center">
                                                        <x-button class="mx-2"
                                                        wire:click="edit({{$excercise}})"
                                                        wire:loading.attr="loading"
                                                        wire:target="edit({{$excercise}})">
                                                            <i class="bi bi-pencil text-base"></i>
                                                        </x-button>
                                                        <x-button-light class="mx-2" color="red"
                                                        wire:click="$emit('deleteExcercise', {{$excercise}})">
                                                            <i class="bi bi-x-lg"></i>
                                                        </x-button-light>
                                                    </div>
                                                    <div class="flex sm:hidden">
                                                        <a wire:click="edit({{$excercise}})" class="cursor-pointer mx-2 text-indigo-600 hover:underline">Editar</a>
                                                        |
                                                        <a wire:click="$emit('deleteExcercise', {{$excercise}})" class="cursor-pointer mx-2 text-indigo-600 hover:underline">Eliminar</a>
                                                    </div>
                                                @else
                                                    <p class="text-center">-</p>
                                                @endif

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




    {{-- Modal --}}
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar ejercicio 
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label>Nombre</x-jet-label>
                <x-jet-input type="text" class="form-control w-full" wire:model="nameEdit"/>
                <x-jet-input-error for="nameEdit"/>
            </div>
            <div class="mb-4">
                <x-jet-label>Categoría</x-jet-label>
                <select wire:model="categoryEdit" class="form-control w-full">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    
                </select>
                <x-jet-input-error for="categoryEdit"/>
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



    @push('scripts')
        <script>
            Livewire.on('deleteExcercise', excercise => {
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
                            Livewire.emitTo('excercises.excercises', 'delete', excercise);
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