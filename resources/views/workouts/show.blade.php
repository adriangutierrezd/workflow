<x-app-layout>
    @section('title','Workflow - Ver entrenamiento')
    <div>
        @if ((date("d/m/y") == ($workout->created_at)->format('d/m/y')))
        <h1>Editar entrenamiento de hoy</h1>
    @else
        <h1>Editar entrenamiento del {{($workout->created_at)->format('d/m/y')}}</h1>
    @endif

        <div class="flex justify-end items-center">
            {{-- Edit button --}}
            <x-button-link  href="{{ route('workouts.edit', $workout) }}">Editar</x-button-link>
        </div>

        {{-- Computer table --}}
        <div class="hidden flex-col my-4 mt-8 lg:flex">
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
                                        Nota
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($clusters as $cluster)
                                    <tr class="hover:bg-gray-100">
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
                                            @if ($cluster->note != null)
                                                <p class="text-center">{{ $cluster->note }}</p>
                                            @else
                                                <p class="text-center text-gray-400">Sin notas</p>
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

        {{-- Mobile table --}}
        <div class="flex flex-col my-4 mt-8 lg:hidden">
            @foreach ($clusters as $cluster)
                <div class="my-5 overflow-x-auto rounded-lg">
                    <div class="align-middle inline-block min-w-full px-4">
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
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Workout note --}}
        <div class="my-6 bg-white p-8 rounded-lg shadow-lg">
            @if ($workout->note != null)
                <p class="mb-2 font-bold text-lg">Anotaciones:</p>
                <p>{{ $workout->note }}</p>
            @else
                <div class="flex justify-center items-center">
                    <p class="font-bold text-lg">No hay anotaciones</p>
                </div>
            @endif
        </div>




    </div>
</x-app-layout>



