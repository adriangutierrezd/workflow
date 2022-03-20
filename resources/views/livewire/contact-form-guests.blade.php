<div>
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-6">
            {{-- Name --}}
            <div class="flex flex-col items-start justify-start mb-4">
                <x-jet-label>Nombre:</x-jet-label>
                <x-jet-input type="text" class="form-control w-full" wire:model="name"></x-jet-input>
                <x-jet-input-error for="name"/>
            </div>
                {{-- Email --}}
            <div class="flex flex-col items-start justify-start mb-4">
                <x-jet-label>Email:</x-jet-label>
                <x-jet-input type="email" class="form-control w-full" wire:model="email"></x-jet-input>
                <x-jet-input-error for="email"/>
            </div>
            </div>
            {{-- Message --}}
            <div class="flex flex-col items-start justify-start mb-4">
                <x-jet-label>Mensaje:</x-jet-label>
                <textarea wire:model="message" cols="30" rows="4" class="form-control w-full"></textarea>
                <x-jet-input-error for="message"/>
            </div>
            {{-- Policies --}}
            <div class="flex items-center justify-start mb-4">
                <input type="checkbox" wire:model="policy" class="form-tick appearance-none bg-white bg-check h-6 w-6 border border-gray-300 rounded-md">
                <p class="text-sm ml-4">Acepto las <a href="{{route('politica-de-cookies.show')}}" class="text-indigo-600 hover:underline">políticas de privacidad</a> y <a href="{{route('politica-de-privacidad.show')}}" class="text-indigo-600 hover:underline">políticas de cookies</a></p>
            </div>
            <x-jet-input-error for="policy" class="mb-2"/>
            {{-- CTA --}}
            <div class="flex items-center justify-center">
                <button class="inline-flex items-center px-4 py-2 bg-blueGray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blueGray-700 active:bg-blueGray-900 focus:outline-none focus:border-blueGray-900 focus:ring focus:ring-blueGray-300 disabled:opacity-25 transition"
                {{$disabled == true ? 'disabled' : ''}}
                    wire:click="$emitSelf('store')">
                        Enviar mensaje
                </button>
            </div>

    </div>
</div>
