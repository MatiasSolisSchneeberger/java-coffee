@props(['productos' => []])

<section class='lista-productos-container'>

    <header>
        <h2>Nuestros Productos</h2>
        <a href="/productos">
            <x-ui.button variant="outline">
                Ver todos los productos
                <x-icons.chevron-right />
            </x-ui.button>
        </a>
    </header>
    <section class='lista-productos'>
        @forelse ($productos as $producto)
            <x-ui.card :producto="$producto" />
        @empty
            <p>No hay productos disponibles.</p>
        @endforelse
    </section>
</section>
