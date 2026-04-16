@props(['productos' => []])

<section class="lista-productos-container">

    <h2>Nuestros Productos</h2>
    <section class="lista-productos">
        @forelse ($productos as $producto)
            <x-ui.card :producto="$producto" />
        @empty
            <p>No hay productos disponibles.</p>
        @endforelse
    </section>
</section>
