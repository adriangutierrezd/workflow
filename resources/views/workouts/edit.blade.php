<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit workout') }}: {{ $workout->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="main-container">
            <div class="main-container-content">

                <div class="flex items-center justify-end">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <button class="relative z-10 block p-2 text-gray-700 bg-white border border-transparent rounded-md dark:text-white focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:bg-gray-800 focus:outline-none">
                                    <svg class="w-5 h-5 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </button>
                        </x-slot>
    
                        <x-slot name="content">
                            <div class="relative">

                                <button 
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'workout-properties-form')"                      
                                class="flex w-full items-center p-3 text-sm text-gray-600 transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                    <span class="mx-2">
                                        {{__('Properties')}}
                                    </span>
                                </button>
                            </div>


                            @can('assign', $workout)
                                <div 
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'assign-workout-form')"
                                    id="assignWorkoutModal" class="relative flex justify-center">
                                    <button @click="isAsignModalOpen = true" 
                                    class="flex w-full items-center p-3 text-sm text-gray-600 capitalize 
                                    transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 
                                    dark:hover:bg-gray-700 dark:hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                    
                        
                                        <span class="mx-2">
                                            {{__('Assign')}}
                                        </span>
                                    </button>
                                </div> 

                                @if($workout->user_id != $workout->owner_id)
                                    <div 
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'delete-assign-workout-form')"
                                        class="relative flex justify-center">
                                        <button class="flex w-full items-center p-3 text-sm text-gray-600 capitalize 
                                        transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 
                                        dark:hover:bg-gray-700 dark:hover:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                            </svg>

                                            <span class="mx-2">
                                                {{__('Remove assignment')}}
                                            </span>
                                        </button>
                                    </div>
                                @endif
                            @endcan

                            <div 
                                class="relative flex justify-center">
                                <button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'delete-workout-form')"
                                class="flex w-full items-center p-3 text-sm text-gray-600 capitalize 
                                transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 
                                dark:hover:bg-gray-700 dark:hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                        
                                    <span class="mx-2">
                                        {{__('Delete')}}
                                    </span>
                                </button>
                            </div>
                    
                        </x-slot>
                    </x-dropdown>
                </div>

                
                <div class="flex items-center justify-end my-3">
                    @include('clusters.partials.new-cluster-dialog', ['workout' => $workout, 'excercises' => $excercises])

                </div>

                @include('clusters.partials.clusters-table', ['workout' => $workout, 'excercises' => $excercises])

            </div>
        </div>
    </div>

    <x-modal name="workout-properties-form" id="workout-properties-form-modal" maxWidth="lg" focusable>

        <div class="p-6">
            <div class="flex flex-col items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                </svg>
    
                <h3 class="text-lg text-center font-medium leading-6 text-gray-800 mb-4 dark:text-white mt-3">{{__('Workout properties')}}</h3>
            </div>


            <form action="{{route('workouts.update', $workout->id)}}" method="POST" class="grid grid-cols-1 gap-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="title">{{__('Title')}}</label>
                    <x-text-input type="text" maxlength="50" name="title" id="title" value="{{ $workout->title }}" class="block w-full mb-3" required maxLength="50" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="date">{{__('Date')}}</label>
                    <x-text-input type="date" value="{{ $workout->date }}" name="date" id="date" class="block w-full mb-3" required />
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="status">{{__('State')}}</label>
                    <select name="status_id" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                        @foreach ($workoutStatuses as $item)
                            <option @php echo $workout->status->id === $item->id ? 'selected' : '' @endphp value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('status_id')" class="mt-2" />
                </div>

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

    </x-modal>

    <x-modal name="assign-workout-form" id="assign-workout-form-modal" maxWidth="lg" focusable>

        <div class="p-6">
            <div class="flex flex-col items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-black dark:text-white w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                </svg>
    
                <h3 class="text-lg text-center font-medium leading-6 text-gray-800 mb-4 dark:text-white mt-3">{{__('Assign workout')}}</h3>

                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    {{__('By assigning the training to this person, the former owner (if any) will lose access.')}}
                </p>
            </div>


            <form id="assignWorkoutForm">

                <input type="hidden" name="workout_id" id="workout_id" value="{{$workout->id}}">

                <select 
                id="client_selector"
                class="form-field my-4" 
                name="user_id" required>
                    <option value="" selected disabled>{{__('Pick an user')}}</option>
                    @foreach($clients as $client)
                        <option @php echo $workout->user_id === $client->id ? 'selected' : '' @endphp value="{{$client->id}}">{{$client->name}}</option>
                    @endforeach
                </select>


                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
    
                    <x-primary-button class="ml-3">
                        {{ __('Assign') }}
                    </x-primary-button>
                </div>

            </form>



        </div>

    </x-modal>

    <x-modal name="delete-assign-workout-form" id="delete-assign-workout-form-modal" maxWidth="lg" focusable>

        <div class="p-6">
            <div class="flex flex-col items-center justify-center">

                <div>
                    <div class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </div>

                    <div class="mt-2 text-center">
                        <h3 class="text-lg font-medium leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">{{__('Remove assignment')}}</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            {{__('If you continue, the assigned user will lose access to this training.')}}
                        </p>
                    </div>
                </div>
            </div>


            <form action="{{route('workouts.update', $workout)}}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="user_id" readonly value="{{ Auth::user()->id }}">
                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
    
                    <x-danger-button class="ml-3">
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>
            </form>
        </div>

    </x-modal>

    <x-modal name="delete-workout-form" id="delete-workout-form-modal" maxWidth="lg" focusable>

        <div class="p-6">
            <div class="flex flex-col items-center justify-center">

                <div>
                    <div class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </div>

                    <div class="mt-2 text-center">
                        <h3 class="text-lg font-medium leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">{{__('Delete workout')}}</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            {{__('If you continue, the training will be permanently deleted.')}}
                        </p>
                    </div>
                </div>


                <form action="{{route('workouts.destroy', $workout)}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>
        
                        <x-danger-button class="ml-3">
                            {{ __('Delete') }}
                        </x-danger-button>
                    </div>
                </form>
        </div>

    </x-modal>

    @push('scripts')

        @if(Auth::user()->isTrainer())
            <script src="{{ asset('js/assign-workout.js') }}" defer type="module"></script>
        @endif
    @endpush
</x-app-layout>
