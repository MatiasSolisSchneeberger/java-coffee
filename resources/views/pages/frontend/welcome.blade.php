<x-layouts.layout>
    <main>
        <x-secciones.hero-section />
        <x-secciones.presentacion-empresa />
        <x-secciones.servicios />
        <x-secciones.lista-productos :productos="$productos" />
    </main>
</x-layouts.layout>
