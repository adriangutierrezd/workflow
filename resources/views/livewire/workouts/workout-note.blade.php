    {{-- Workout note --}}
    <div class="flex flex-col my-4 p-6 bg-white rounded-lg shadow-lg">
        <h2>¿Quieres anotar algo sobre el entrenamiento?</h2>
        <textarea cols="10" rows="3"
            placeholder="Por ejemplo: 200mg cafeína de pre-entreno"
            class="form-control" wire:model="note"></textarea>
        <x-button class="ml-auto mt-2" wire:click="save" wire:loading.attr="disabled"
            wire:target="save">
            Guardar nota
        </x-button>
    </div>