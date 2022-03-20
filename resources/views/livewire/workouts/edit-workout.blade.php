<div class="relative">
    @section('title','Workflow - Editar entrenamiento')
    {{-- Notifications --}}
    <x-jet-action-message on="saved" class="fixed bottom-2 md:top-20 right-2">
        <div class="bg-indigo-600 text-white shadow-lg rounded-md p-4">
            Cambios guradados.
        </div>
    </x-jet-action-message>

    @php
        $date = date('d/m/y', strtotime($workout->date));
    @endphp
    @if (date('d/m/y') == $date)
        <h1>Editar entrenamiento de hoy</h1>
    @else
        <h1>Editar entrenamiento del <?php echo $date ?></h1>
    @endif
    

    @livewire('workouts.workout-name', ['workout' => $workout])
    @livewire('clusters.create-cluster', ['workout' => $workout])
    @livewire('clusters.cluster-list', ['workout' => $workout])
    @livewire('workouts.workout-note', ['workout' => $workout])
    @livewire('workouts.workout-date', ['workout' => $workout])

</div>
