<div>
    <h2 class="card-heading-2">{{__('Available trainers')}}</h2>
    <div class="flex flex-col mt-6">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-8 align-middle md:px-6 lg:px-8">
                <div class="border border-gray-200 dark:border-gray-700 md:rounded-lg">

                    <table class="records-table" id="trainers-list">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 px-4">
                                    {{__('Name')}}
                                </th>

                                <th scope="col" class="py-3.5 px-4">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($trainers->isEmpty())
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <p>{{__('No trainers available')}}</p>
                                    </td>
                                </tr>
                            @else
                                @foreach($trainers as $trainer)
                                    <tr>
                                        <td>
                                            <div class="flex items-center">
                                                <img
                                                    class="object-cover w-6 h-6 rounded-full"
                                                    src="{{$trainer->getImageUrlAttribute()}}"
                                                    alt=""
                                                >
                                                <p
                                                    class="font-medium text-gray-800 dark:text-white ml-2"
                                                >
                                                    {{$trainer->name}}
                                                </p>
                                            </div>
                                        </td>
                                        <td>
                                            <x-dropdown align="left-md-right" width="48">
                                                <x-slot name="trigger">
                                                    <button
                                                        class="dropdown-dots-button"
                                                    >
                                                        <div class="ml-1">
                                                            <x-dots-icon/>
                                                        </div>
                                                    </button>
                                                </x-slot>
                            
                                                <x-slot name="content">
                                                    <button
                                                        data-trainerId="{{$trainer->id}}"
                                                        class="send-request-button flex items-center
                                                        justify-start p-2 cursor-pointer">
                                                        <x-send-message-icon/>
                                                        <span class="ml-2">{{__('Send request')}}</span>
                                                    </button>
                                                </x-slot>
                                            </x-dropdown>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <x-modal name="send-request-form" id="send-request-form-modal" maxWidth="lg" focusable>

        <div class="p-6" x-data="{ submitting: false }">
            <div class="flex flex-col items-center justify-center">
                <div>
                    <div class="mt-2 text-center">
                        <h3 class="modal-title" id="modal-title">{{__('Send request')}}</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            {{__('Send a message to this trainer to start collaborating')}}
                        </p>
                    </div>
                </div>
            </div>
            <form
                action="{{route('user-trainer-request.store')}}"
                x-on:submit="submitting = true"
                method="POST">
                @csrf

                <textarea name="message" class="form-field" cols="30" rows="4" maxlength="255"></textarea>

                <input type="hidden" name="trainer_id" id="trainer_id" readonly>
                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
    
                    <x-primary-button class="ml-3" x-bind:disabled="submitting">
                        <span
                            x-show="!submitting">
                            {{ __('Send') }}
                        </span>
                        <span x-show="submitting">
                            <x-spinner-icon/>
                        </span>
                    </x-primary-button>
                </div>
            </form>
        </div>

    </x-modal>

</div>
@push('scripts')
    <script src="{{ asset('js/trainers.js') }}" defer type="module"></script>
@endpush
