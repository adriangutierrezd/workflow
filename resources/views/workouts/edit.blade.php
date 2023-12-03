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
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent
                                text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400
                                bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300
                                focus:outline-none transition ease-in-out duration-150"
                            >
                                <button
                                    class="relative z-10 block p-2 text-gray-700 bg-white border
                                    border-transparent rounded-md dark:text-white focus:border-blue-500
                                    focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300
                                    dark:focus:ring-blue-400 focus:ring dark:bg-gray-800 focus:outline-none"
                                >
                                    <x-chevron-down-icon/>
                                </button>
                            </button>
                        </x-slot>
    
                        <x-slot name="content">
                            <div class="relative">

                                <button
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'workout-properties-form')"
                                    class="flex w-full items-center p-3 text-sm
                                    text-gray-600 transition-colors duration-300
                                    transform dark:text-gray-300 hover:bg-gray-100
                                    dark:hover:bg-gray-700 dark:hover:text-white"
                                >
                                    <x-pencil-icon/>
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
                                        <x-person-icon/>
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
                                            <x-person-minus-icon/>
                                            <span class="mx-2">
                                                {{__('Remove assignment')}}
                                            </span>
                                        </button>
                                    </div>
                                @endif
                            @endcan

                            <div ¡
                                class="relative flex justify-center">
                                <button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'delete-workout-form')"
                                class="flex w-full items-center p-3 text-sm text-gray-600 capitalize
                                transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100
                                dark:hover:bg-gray-700 dark:hover:text-white">
                                    <x-trash-icon/>
                                    <span class="mx-2">
                                        {{__('Delete')}}
                                    </span>
                                </button>
                            </div>
                    
                        </x-slot>
                    </x-dropdown>
                </div>

                
                <div class="flex items-center justify-end my-3">
                    @include(
                        'clusters.partials.new-cluster-dialog',
                        ['workout' => $workout, 'excercises' => $excercises]
                    )

                </div>

                @include(
                    'clusters.partials.clusters-table',
                    ['workout' => $workout, 'excercises' => $excercises]
                )

            </div>
        </div>
    </div>

    <x-modal name="workout-properties-form" id="workout-properties-form-modal" maxWidth="lg" focusable>

        <div class="p-6">
            <div class="flex flex-col items-center justify-center">
                <x-pencil-icon/>
                <h3 class="modal-title">{{__('Workout properties')}}</h3>
            </div>


            <form action="{{route('workouts.update', $workout->id)}}" method="POST" class="grid grid-cols-1 gap-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="form-label" for="title">{{__('Title')}}</label>
                    <x-text-input
                        type="text"
                        maxlength="50"
                        name="title"
                        id="title"
                        value="{{ $workout->title }}"
                        class="block w-full mb-3"
                        required
                    />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <label class="form-label" for="date">{{__('Date')}}</label>
                    <x-text-input
                        type="date"
                        value="{{ $workout->date }}"
                        name="date"
                        id="date"
                        class="block w-full mb-3"
                        required
                    />
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </div>

                <div>
                    <label class="form-label" for="status">{{__('State')}}</label>
                    <select
                        name="status_id"
                        class="block w-full input-select">
                        @foreach ($workoutStatuses as $item)
                            <option
                                @php echo $workout->status->id === $item->id ? 'selected' : '' @endphp
                                value="{{ $item->id }}">{{ $item->name }}
                            </option>
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
                <x-person-icon/>
                <h3 class="modal-title">{{__('Assign workout')}}</h3>
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
                        <option
                            @php echo $workout->user_id === $client->id ? 'selected' : '' @endphp
                            value="{{$client->id}}">{{$client->name}}
                        </option>
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
                        <x-person-minus-icon/>
                    </div>

                    <div class="mt-2 text-center">
                        <h3 class="modal-title" id="modal-title">{{__('Remove assignment')}}</h3>
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
                        <x-trash-icon/>
                    </div>

                    <div class="mt-2 text-center">
                        <h3 class="modal-title" id="modal-title">{{__('Delete workout')}}</h3>
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
