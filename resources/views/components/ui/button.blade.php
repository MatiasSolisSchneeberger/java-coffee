{{-- Hay que envolver el texto en un span para que no se rompa el padding --}}
<button class="btn {{ $variant ?? 'primary' }} {{ $class ?? '' }}">
    {{ $slot }}
</button>
