<div class="relative">
    {{-- Notifications --}}
    <x-jet-action-message on="saved" class="fixed bottom-2 md:top-20 right-2">
        <div class="bg-indigo-600 text-white shadow-lg rounded-md p-4">
            Cambios guradados.
        </div>
    </x-jet-action-message>
    @section('title','Workflow - Crear entrenamiento')
    <h1>¿Qué estás haciendo hoy?</h1>


    
    @livewire('workouts.workout-name', ['workout' => $workout])
    @livewire('clusters.create-cluster', ['workout' => $workout])
    @livewire('clusters.cluster-list', ['workout' => $workout])
    @livewire('workouts.workout-note', ['workout' => $workout])
    @livewire('workouts.workout-date', ['workout' => $workout])
</div>
