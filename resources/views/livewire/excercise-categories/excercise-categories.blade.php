<div class="relative">
    @section('title','Workflow - Categorías')
    {{-- Notifications --}}
    <x-jet-action-message on="saved" class="fixed bottom-2 md:top-20 right-2">
        <div class="bg-indigo-600 text-white shadow-lg rounded-md p-4">
            Cambios guradados.
        </div>
    </x-jet-action-message>
    <h1>Categorías de ejercicios:</h1>
    
    {{-- Create new category form --}}
    <div class="bg-white rounded-lg shadow-lg p-6 my-6">

        <div class="flex flex-col items-center justify-start w-full">
            <x-jet-label class="mr-auto">Nombre:</x-jet-label>
            <x-jet-input type="text" class="form-control w-full" wire:model="name"/>
            <x-jet-input-error for="name"/>
            <div class="my-4 ml-auto flex justify-end items-center">
                

                <x-button
                wire:click="create"
                wire:loading.attr="disabled"
                wire:target="create"
                >
                    Añadir
                </x-button>
            </div>
        </div>
    </div>
    
    {{-- Categories --}}
        <div class="flex flex-col my-6">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nº Ejercicios
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($categories as $category)
                                    @php
                                        $id = $category->id;
                                    @endphp
                                    <tr wire:key="excercise-category-{{$category->id}}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <p class="text-base text-gray-900">{{ $category->name }}</p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <p class="text-base text-gray-900 text-center">
                                                {{ count($category->excercises) }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-row justify-center">
                                                <a class="text-blue-600 mx-2 cursor-pointer"  wire:click="edit({{$category->id}})"
                                                    wire:loading.attr="disabled"
                                                    wire:target="edit({{$category->id}})">Editar</a>
                                                <span>|</span>
                                                <a class="text-blue-600 mx-2 cursor-pointer"  wire:click="$emit('deleteCategory', {{$category}})">Eliminar</a>
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


        
    {{-- Modal --}}
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar categoría
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label>Nombre</x-jet-label>
                <x-jet-input type="text" class="form-control w-full" wire:model="nameEdit"/>
                <x-jet-input-error for="nameEdit"/>
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
            Livewire.on('deleteCategory', category => {
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
                            Livewire.emitTo('excercise-categories.excercise-categories', 'delete', category);
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
