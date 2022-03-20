<div>
    @section('title', 'Workflow - Estadísticas')
    <h1>Estadísticas</h1>
    <div class=" flex-col my-4 mt-8 flex">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="p-4">
                        <x-jet-input type="text" placeholder="Busca un ejercicio" wire:model="search" class="form-control w-full"/>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ejercicio</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estadísticas</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($excercises as $excercise)
                            <tr class="hover:bg-gray-200" wire:key="excercise-{{$excercise->id}}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p>{{$excercise->name}}</p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p><a class="text-blue-600 hover:underline" href="{{route('statics.show', $excercise->id)}}">Ver estadísticas</a></p>
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
