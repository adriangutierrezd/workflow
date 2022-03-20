<div>
    {{-- <a wire:click="$set('open', 1)">Abrir cookies</a> --}}
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <h2>¡Tu privacidad es importante!</h2>
        </x-slot>
        <x-slot name="content">
            <p class="mb-4">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam sunt error natus totam aliquid, dolorum accusantium quisquam <a href="{{route('politica-de-privacidad.show')}}" class="text-indigo-600 hover:underline">política de privacidad</a> beatae reprehenderit ipsum <a href="{{route('politica-de-cookies.show')}}" class="text-indigo-600 hover:underline">política de cookies</a> deserunt veniam quos aspernatur nobis architecto laboriosam temporibus.</p>

            <div class="flex items-center justify-start mb-4">
                <p class="text-sm sm:text-base mr-2">Cookies necesarias para el funcionamiento del sitio</p>
                <div id="toggle" wire:model="toggleNeeded" class="active">
                    <i class="indicator" ></i>
                </div>
            </div>
            <div class="flex items-center justify-start mb-4">
                <p class="text-sm sm:text-base mr-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                @if ($toggleMarketing == 1)
                <div id="toggle" wire:model="toggleMarketing" wire:click ="change('marketing')" class="active">
                    <i class="indicator" ></i>
                </div>
                @else
                    <div id="toggle" wire:model="toggleMarketing" wire:click="change('marketing')">
                        <i class="indicator"></i>
                    </div>
                @endif
            </div>
            <div class="flex items-center justify-start mb-4">
                <p class="text-sm sm:text-base mr-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                @if ($toggleAdvertising == 1)
                <div id="toggle" wire:model="toggleAdvertising" wire:click ="change('advertising')" class="active">
                    <i class="indicator" ></i>
                </div>
                @else
                    <div id="toggle" wire:model="toggleAdvertising" wire:click="change('advertising')">
                        <i class="indicator"></i>
                    </div>
                @endif
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button-outline color="gray"
            wire:click="$set('open', 0)">
                @isset($_COOKIE['needed'])
                    Mejor no
                @else
                    Denegar
                @endisset
                
            </x-button-outline>
            <x-jet-button
            wire:click="saveCookies">
                Aceptar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
