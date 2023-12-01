<div class="p-4 bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
    
    <header>
        <h2 class="card-heading-2">{{__('Workouts by state')}}</h2>
    </header>

    <main id="workouts-state-pie-container" style="width:100%;height:400px">

    </main>


</div>
@push('scripts')
    <script>
        window.workoutsByStatus = @json($workoutsByStatus)
    </script>
    <script defer type="module" src="{{ asset('js/workouts-state-pie.js') }}"></script>
@endpush