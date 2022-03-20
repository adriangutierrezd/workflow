{{-- Workout name --}}
<div class="bg-white rounded-lg shadow-lg p-8 my-4">
    <div>
        <div>
            <x-jet-label class="text-base">¿Qué estás entrenando?</x-jet-label>
            <x-jet-input type="text" class="w-full" wire:model="name" placeholder="Por ejemplo: Piernas"></x-jet-input>
            <x-jet-input-error for="name"></x-jet-input-error>
        </div>
    </div>
    <div class="flex justify-end items-center h-full">
        <x-button class="mt-4 justify-center" wire:click="save" wire:loading.attr="disabled" wire:target="save">
            Guardar
        </x-button>
    </div>
</div>

