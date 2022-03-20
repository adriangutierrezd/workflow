@props(['color' => 'gray'])

<button {{ $attributes->merge(['type' => 'submit', 'class' => "inline-flex items-center px-4 py-2 bg-$color-100 border border-$color-200 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-$color-200 active:bg-$color-300 focus:outline-none focus:border-$color-300 focus:ring focus:ring-$color-100 disabled:opacity-25 transition"]) }}>
    {{ $slot }}
</button>
