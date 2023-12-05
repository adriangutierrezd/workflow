<x-app-layout>

    <x-slot name="title">
        {{ __('Trainers') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Trainers') }}
        </h2>
    </x-slot>

    @if(Auth::user()->trainer)
    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 relative bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                
                <div class="flex items-center justify-between">
                    <h2 class="card-heading-2">{{__('Your current trainer')}}: {{Auth::user()->trainer->name}}</h2>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border
                                border-transparent text-sm leading-4 font-medium
                                rounded-md text-gray-500 dark:text-gray-400
                                bg-white dark:bg-gray-800 hover:text-gray-700
                                dark:hover:text-gray-300 focus:outline-none
                                transition ease-in-out duration-150"
                            >
                                <div class="ml-1">
                                    <x-chevron-down-icon/>
                                </div>
                            </button>
                        </x-slot>
    
                        <x-slot name="content">
                            <button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'delete-client-form')"
                            class="flex w-full items-center p-3 text-sm text-gray-600 capitalize
                            transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100
                            dark:hover:bg-gray-700 dark:hover:text-white">
                                <x-trash-icon/>
                                <span class="mx-2">
                                    {{__('Delete relationship')}}
                                </span>
                            </button>
                        </x-slot>
                    </x-dropdown>
                </div>

            </div>
        </div>
    </div>

    <x-modal name="delete-client-form" id="delete-client-form-modal" maxWidth="lg" focusable>

        <div class="p-6">
            <div class="flex flex-col items-center justify-center">

                <div class="mt-2 text-center">
                    <h3 class="modal-title" id="modal-title">{{__('Delete relationship')}}</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        {{__('If you continue, your relationship with the trainer will be erased.')}}
                    </p>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <input type="hidden" name="trainerUserId" id="trainerUserId" value="{{$trainerUserRelation->id}}">

    
                    <x-danger-button id="deleteTrainerUserButton" class="ml-3">
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>
            </div>

        </div>

    </x-modal>

    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 relative bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                
                @include('trainer.partials.trainers-table', [
                    'trainers' => $trainers
                ])

            </div>
        </div>
    </div>
</x-app-layout>
