<div>
    <section class="container px-4 mx-auto">
        <h2 class="card-heading-2">{{__('Sets')}}</h2>
    
        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-8 align-middle md:px-6 lg:px-8">
                    <div class="border border-gray-200 dark:border-gray-700 md:rounded-lg">
    
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="clusters-list">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                        {{__('Excercise')}}
                                    </th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                        {{__('Sets')}}
                                    </th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                        {{__('Weight')}}
                                    </th>
    
                                    <th scope="col" class="py-3.5 px-4">
                                        <span class="sr-only">{{__('Edit')}}</span>
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

    
    <x-modal name="edit-cluster-form" id="edit-cluster-form-modal" maxWidth="lg" focusable>
        <div class="p-6">
            <div class="flex flex-col items-center justify-center">

                <div class="mt-2 text-center">
                    <h3 class="text-lg font-medium leading-6 text-gray-800 dark:text-white" id="modal-title">{{__('Edit cluster')}}</h3>
                </div>
    
                
                <form id="updateClusterForm" class="w-full">
                    <input type="hidden" name="updateClusterId">
    
                    <label class="form-label" for="updateExcerciseId">{{__('Excercise')}}</label>
                    <select 
                    class="form-field mb-4 select2-selector" 
                    name="updateExcerciseId" required>
                        <option value="" selected disabled>{{__('Pick an excercise')}}</option>
                        @foreach ($excercises as $excercise)
                            <option value="{{ $excercise->id }}">{{ $excercise->name }}</option>
                        @endforeach
                    </select>
    
                    <label class="form-label" for="updateSets">{{__('Sets')}}</label>
                    <input type="number" step="1" min="1" max="255" name="updateSets"
                    class="form-field mb-4" required>
    
                    <label class="form-label" for="updateReps">{{__('Reps')}}</label>
                    <input type="number" step="1" min="1" max="65535" name="updateReps"
                    class="form-field mb-4" required>
    
                    <label class="form-label" for="updateWeight">{{__('Weight')}}</label>
                    <input type="number" step="0.1" min="0" max="99999.99" name="updateWeight"
                    class="form-field mb-4" required>
    
    
                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>
            
                        <x-primary-button class="ml-3">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>
    
    
            </div>
        </div>
    </x-modal>


    <x-modal name="delete-cluster-form" id="delete-cluster-form-modal" maxWidth="lg" focusable>
        <div class="p-6">
            <div class="flex flex-col items-center justify-center">

                <div class="mt-2 text-center">
                    <h3 class="text-lg font-medium leading-6 text-gray-800 dark:text-white" id="modal-title">{{__('Delete cluster')}}</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        {{__('If you continue, the cluster will be permanently deleted.')}}
                    </p>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <input type="hidden" name="clusterDeleteId" id="clusterDeleteId">
    
                    <x-danger-button id="deleteClusterBtn" class="ml-3">
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>
            </div>

        </div>
    </x-modal>




</div>
@push('scripts')
    <script defer type="module" src="{{ asset('js/clusters.js') }}"></script>
@endpush