<div class="p-4 bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
    
    <header>
        <h2 class="card-heading-2">Entrenamientos por estado</h2>
    </header>



</div>
@push('scripts')
    <script>
        window.workoutsByStatus = @json($workoutsByStatus)
    </script>
    <script defer type="module" src="{{ asset('js/workouts-state-pie.js') }}"></script>
@endpush