<x-layouts.layout>
    @php
        $promedio = $producto['calificacion_promedio'] ?? 0;
        $totalCalificaciones = $producto['calificaciones_count'] ?? 0;
        $comentarios = $producto['comentarios'] ?? [];

        $imagenes = [];
        if (isset($producto['imagenes']) && is_array($producto['imagenes']) && count($producto['imagenes']) > 0) {
            $imagenes = $producto['imagenes'];
        } elseif (isset($producto['imagen'])) {
            $imagenes = [$producto['imagen']];
        } else {
            $imagenes = ['error-404.png', 'error-404.png', 'error-404.png'];
        }

        $link_img = '/storage/productos/';
    @endphp
    <main>
        @if (session('success'))
            <div style="max-width: var(--max-width); margin: 0 auto var(--spacing-md); padding: 0 var(--spacing-md);">
                <x-ui.success-alert :messages="[session('success')]" />
            </div>
        @endif

        @if (session('error'))
            <div style="max-width: var(--max-width); margin: 0 auto var(--spacing-md); padding: 0 var(--spacing-md);">
                <x-ui.error-alert title="Error:" :messages="[session('error')]" />
            </div>
        @endif
        <section class="producto-page">
            <div class="producto-layout">

                <div class="columna-principal">
                    {{-- Columna Izquierda: Galería --}}
                    <div class="producto-galeria-wrapper">
                        @if (count($imagenes) > 1)
                            <div class="producto-miniaturas">
                                @foreach ($imagenes as $index => $img)
                                    <button class="miniatura-btn {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ $link_img . $img }}"
                                            alt="{{ $producto['nombre'] }} - {{ $index + 1 }}">
                                    </button>
                                @endforeach
                            </div>
                        @endif

                        <div class="producto-imagen-principal">
                            @if (count($imagenes) > 1)
                                <button class="carousel-btn carousel-prev" id="prev-img-btn" aria-label="Anterior">
                                    <x-icons.carousel-prev />
                                </button>
                            @endif
                            <img id="main-product-img" src="{{ $link_img . $imagenes[0] }}"
                                alt="{{ $producto['nombre'] }}">
                            @if (count($imagenes) > 1)
                                <button class="carousel-btn carousel-next" id="next-img-btn" aria-label="Siguiente">
                                    <x-icons.carousel-next />
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- Descripción --}}
                    <div class="seccion-descripcion">
                        <h2>Descripción del producto</h2>
                        <p>{{ $producto['descripcion_larga'] ?? $producto['descripcion'] }}</p>
                    </div>

                    {{-- Comentarios y Calificación --}}
                    <div class="seccion-comentarios">
                        <h2>Opiniones del producto</h2>

                        @if ($totalCalificaciones > 0)
                            <div class="rating-general">
                                <span class="rating-general-num">{{ number_format($promedio, 1) }}</span>
                                <div class="rating-general-stars">
                                    <div class="flex-row">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= round($promedio))
                                                <x-icons.star />
                                            @else
                                                <x-icons.star class="icon-muted" />
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-sm icon-muted">{{ $totalCalificaciones }} calificaciones</span>
                                </div>
                            </div>

                            <div class="comentarios-lista">
                                @foreach ($comentarios as $com)
                                    <div class="comentario-item">
                                        <div class="comentario-item-meta">
                                            <div class="flex-row mb-xs">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $com['calificacion'])
                                                        <x-icons.star class="icon-xs" />
                                                    @else
                                                        <x-icons.star class="icon-xs icon-muted" />
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="comentario-fecha">{{ $com['fecha'] ?? 'Reciente' }}</span>
                                        </div>
                                        <p class="comentario-titulo">{{ $com['titulo'] ?? '' }}</p>
                                        <p class="comentario-texto">{{ $com['texto'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="rating-general flex-col mb-xs">
                                <span class="text-lg icon-muted">Aún no hay calificaciones para este producto. ¡Sé el primero en opinar!</span>
                            </div>
                        @endif

                        <div class="seccion-calificar">
                            <h3>Dejar una calificación</h3>
                            <form action="/producto/{{ $producto['slug'] }}/calificar" method="POST"
                                class="form-calificar">
                                @csrf
                                <div class="form-group">
                                    <label class="display-block mb-sm icon-muted">Tu calificación</label>
                                    <div class="star-rating-input">
                                        <input type="radio" id="star5" name="rating" value="5" /><label
                                            for="star5" title="5 estrellas">★</label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label
                                            for="star4" title="4 estrellas">★</label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label
                                            for="star3" title="3 estrellas">★</label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label
                                            for="star2" title="2 estrellas">★</label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label
                                            for="star1" title="1 estrella">★</label>
                                    </div>
                                </div>

                                <div class="form-group mt-md">
                                    <label class="display-block mb-sm icon-muted">Tu opinión (opcional)</label>
                                    <textarea name="comentario" placeholder="¿Qué te pareció el producto?"></textarea>
                                </div>

                                <x-ui.button class="mt-md w-fit">Enviar calificación</x-ui.button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="columna-lateral">
                    {{-- Columna Derecha: Información Principal y Compra --}}
                    <div class="producto-info-container">

                        <div class="producto-meta-top">
                            <span>Nuevo</span>
                            <span>|</span>
                            <span>+10mil vendidos</span>
                        </div>

                        <h1 class="producto-titulo">{{ $producto['nombre'] }}</h1>

                        <div class="producto-rating-resumen">
                            <div class="estrellas flex-row">
                                @if ($totalCalificaciones > 0)
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= round($promedio))
                                            <x-icons.star />
                                        @else
                                            <x-icons.star class="icon-muted" />
                                        @endif
                                    @endfor
                                @else
                                    <span class="text-sm icon-muted">Aún sin calificaciones</span>
                                @endif
                            </div>
                            @if ($totalCalificaciones > 0)
                                <span>({{ $totalCalificaciones }})</span>
                            @endif
                        </div>

                        <div class="mt-sm">
                            <span class="badge-code badge-secondary">{{ $producto['tipo'] }}</span>
                        </div>

                        <div class="producto-precio-info">
                            @if (isset($producto['oferta']) && $producto['oferta'] > 0)
                                <span class="precio-original">${{ number_format($producto['precio'], 2) }}</span>
                                <div class="precio-actual-wrapper">
                                    <span class="precio-actual">${{ number_format($producto['oferta'], 2) }}</span>
                                    <span class="descuento-badge">
                                        {{ round((1 - $producto['oferta'] / $producto['precio']) * 100) }}% OFF
                                    </span>
                                </div>
                            @else
                                <span class="precio-actual">${{ number_format($producto['precio'], 2) }}</span>
                            @endif
                            <span class="metodos-pago">Ver los medios de pago</span>
                        </div>

                        <div class="compra-box">
                            <div class="compra-envio">
                                <span class="compra-envio-icon">
                                    <x-icons.truck />
                                </span>
                                <div>
                                    <span class="font-semibold">Llega gratis
                                        <b>mañana</b></span><br>
                                    <span class="text-sm icon-muted">Comprando dentro de las próximas 4 h</span>
                                </div>
                            </div>

                            <div class="mt-md">
                                <p class="producto-descripcion mb-sm font-bold">
                                    Lo que tenés que saber de este producto
                                </p>
                                <ul class="caracteristicas-list">
                                    <li>Formato de venta: Unidad.</li>
                                    <li>Tipo de producto: {{ $producto['tipo'] }}.</li>
                                    <li>Un café de máxima calidad.</li>
                                </ul>
                            </div>

                            <div class="producto-acciones">
                                <form action="/carrito/agregar" method="POST" class="product-buy-form">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $producto['id'] }}">
                                    <x-ui.button type="submit" class="btn-block">
                                        Comprar ahora
                                    </x-ui.button>
                                    <x-ui.button type="submit" variant="outline">
                                        Agregar al carrito
                                    </x-ui.button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Productos Relacionados --}}
            @if (isset($relacionados) && count($relacionados) > 0)
                <div class="productos-relacionados">
                    <h2>Quienes compraron este producto también compraron</h2>
                    <div class="lista-productos">
                        @foreach ($relacionados as $rel)
                            <x-ui.card :producto="$rel" />
                        @endforeach
                    </div>
                    {{-- Add spacing at the bottom --}}
                    <div class="h-2xl"></div>
                </div>
            @endif

        </section>
    </main>

    <script src="{{ asset('js/producto.js') }}"></script>
</x-layouts.layout>
