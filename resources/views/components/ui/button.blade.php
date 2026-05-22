{{-- Hay que envolver el texto en un span para que no se rompa el padding --}}
<button {{ $attributes->merge(['class' => 'btn ' . ($variant ?? 'primary')]) }}>
    {{ $slot }}
</button>
