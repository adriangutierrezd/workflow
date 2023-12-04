@props([
    'message',
    'type',
    'show' => true
])


@php
$classes = [
    'success' => 'bg-emerald-500',
    'warning' => 'bg-yellow-500',
    'error' => 'bg-red-500'
];

$class = $classes[$type];
@endphp



<div 
    x-data="{show: @js($show)}"    
    x-show="show"
    style="display: {{ $show ? 'block' : 'none' }};"    
    x-on:close.stop="show = false"
    class="w-full text-white {{$class}}">
    <div class="container flex items-center justify-between px-6 py-4 mx-auto">
        <div class="flex">
            
            @if($type === 'success')
                <x-check-icon />
            @elseif($type === 'warning')
                <x-warning-triangle-icon />
            @elseif($type === 'error')
                <x-error-circle-icon />
            @endif

            <p class="mx-3">{{$message}}</p>
        </div>

        <button
            x-on:click="show = false"
            class="p-1 transition-colors duration-300 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>
</div>