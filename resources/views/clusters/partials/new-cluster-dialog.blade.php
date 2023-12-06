<div>
    <x-primary-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'new-cluster-form')">
        <x-plus-icon/>
    </x-primary-button>

    <x-modal name="new-cluster-form" id="new-cluster-form-modal" maxWidth="lg" focusable>

        <div class="p-6">

            <form method="POST" id="newClusterForm" action="{{ route('clusters.store') }}">
                @csrf

                <input type="hidden" name="workout_id" value="{{ $workout->id }}">

                <label class="form-label" for="excercise_id">{{__('Excercise')}}</label>
                <select
                id="excercise_selector"
                class="form-field mb-4 select2-selector"
                name="excercise_id" required>
                    <option value="" selected disabled>{{__('Pick an excercise')}}</option>
                    @foreach ($excercises as $excercise)
                        <option value="{{ $excercise->id }}">{{ $excercise->name }}</option>
                    @endforeach
                </select>

                <label class="form-label" for="sets">{{__('Sets')}}</label>
                <input type="number" step="1" min="1" max="255" name="sets"
                class="form-field mb-4" required>

                <label class="form-label" for="reps">{{__('Reps')}}</label>
                <input type="number" step="1" min="1" max="65535" name="reps"
                class="form-field mb-4" required>

                <label class="form-label" for="weight">{{__('Weight')}}</label>
                <input type="number" step="0.01" min="0" max="99999.99" name="weight"
                class="form-field mb-4" required>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
    
                    <x-primary-button id="btnCreateCluster" class="ml-3">
                        {{ __('Create') }}
                    </x-primary-button>
                </div>
            </form>

        </div>

    </x-modal>
</div>
@push('scripts')
    <script defer type="module" src="{{ asset('js/excerciseSearch.js') }}"></script>
@endpush
