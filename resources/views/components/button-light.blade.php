@props(['color' => 'blueGray'])

<button {{ $attributes->merge(['type' => 'submit', 'class' => "inline-flex items-center px-4 py-2 bg-$color-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-$color-500 active:bg-$color-700 focus:outline-none focus:border-$color-700 focus:ring focus:ring-$color-100 disabled:opacity-25 transition"]) }}>
    {{ $slot }}
</button>
