@props(['producto' => null])

@php
    $portada = '/images/productos/error-404.png';
    if ($producto) {
        if (isset($producto['imagenes']) && is_array($producto['imagenes']) && count($producto['imagenes']) > 0) {
            $portada = '/images/productos/' . $producto['imagenes'][0];
        } elseif (isset($producto['imagen'])) {
            $portada = '/images/productos/' . $producto['imagen'];
        }
    }
@endphp

@if ($producto)
    <article class="card">
        <div class="card-image-wrapper">
            <img src="{{ $portada }}" alt="{{ $producto['nombre'] }}">
            @if (isset($producto['oferta']) && $producto['oferta'] > 0)
                <span class="card-badge">Oferta</span>
            @endif
        </div>

        <div class="card-content">
            <span class="card-type badge-code"
                style="color: var(--color-secondary); border-color: var(--color-secondary);">{{ $producto['tipo'] }}</span>
            <h3 class="card-title">{{ $producto['nombre'] }}</h3>

            <p class="card-description">
                {{ $producto['descripcion'] }}
            </p>

            <div class="card-footer">
                <div class="card-price">
                    @if (isset($producto['oferta']) && $producto['oferta'] > 0)
                        <span class="price-current">${{ number_format($producto['oferta'], 2) }}</span>
                        <span class="price-original">${{ number_format($producto['precio'], 2) }}</span>
                    @else
                        <span class="price-current">${{ number_format($producto['precio'], 2) }}</span>
                    @endif
                </div>

                <div class="card-actions">
                    <x-ui.button variant="outline" class="icon" title="Agregar al carrito">
                        <x-icons.shopping-bag />
                    </x-ui.button>
                    <a class="btn-ver-producto" href="/producto/{{ $producto['slug'] }}">
                        <x-ui.button>
                            Ver Producto
                            <x-icons.chevron-right />
                        </x-ui.button>
                    </a>
                </div>
            </div>
        </div>
    </article>
@else
    <article class="card">
        <div class="card-image-wrapper">
            <img src="/images/hero-section.png" alt="Producto de ejemplo">
        </div>

        <div class="card-content">
            <span class="card-type badge-code"
                style="color: var(--color-secondary); border-color: var(--color-secondary);">Ejemplo</span>
            <h3 class="card-title">Producto 1</h3>

            <p class="card-description">
                Este es un producto con ciertas características muy interesante
            </p>

            <div class="card-footer">
                <div class="card-price">
                    <span class="price-current">$0.00</span>
                </div>

                <div class="card-actions">
                    <x-ui.button variant="outline" class="icon" title="Agregar al carrito">
                        <x-icons.shopping-bag />
                    </x-ui.button>
                    <x-ui.button class="btn-ver-producto">
                        Ver Producto
                        <x-icons.chevron-right />
                    </x-ui.button>
                </div>
            </div>
        </div>
    </article>
@endif
