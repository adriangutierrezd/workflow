{{-- Workout date --}}
<div class="bg-white rounded-lg shadow-lg p-8 my-4">
    <div>
        <div>
            <x-jet-label class="text-base">Fecha:</x-jet-label>
            <x-jet-input type="date" class="w-full" wire:model="date"></x-jet-input>
            <x-jet-input-error for="date"></x-jet-input-error>
        </div>
    </div>
    <div class="flex justify-end items-center h-full">
        <x-button class="mt-4 justify-center" wire:click="save" wire:loading.attr="disabled" wire:target="save">
            Guardar
        </x-button>
    </div>
</div>