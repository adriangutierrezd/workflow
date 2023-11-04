<div>
    <section class="container px-4 mx-auto">
        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Entrenamientos</h2>
    
        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="border border-gray-200 dark:border-gray-700 md:rounded-lg">
    
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="clusters-list">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                        <input type="checkbox" name="select_all" id="select_all" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
                                    </th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                        Ejercicio
                                    </th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                        Series
                                    </th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                        Peso
                                    </th>
    
                                    <th scope="col" class="relative py-3.5 px-4">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">

                            </tbody>
                        </table>
    
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
@push('scripts')
    <script defer type="module" src="{{ asset('js/clusters.js') }}"></script>
@endpush