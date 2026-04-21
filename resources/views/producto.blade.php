<x-layout>
    @php
        $promedio = $producto['calificacion_promedio'] ?? 0;
        $totalCalificaciones = $producto['calificaciones_count'] ?? 0;
        $comentarios = $producto['comentarios'] ?? [];
    @endphp
    <main>
        <section class="producto-page">
            <div class="producto-layout">
                
                <div class="columna-principal">
                    {{-- Columna Izquierda: Galería --}}
                    <div class="producto-galeria-wrapper">
                        <div class="producto-miniaturas">
                            <button class="miniatura-btn active">
                                <img src="{{ isset($producto['imagen']) ? $producto['imagen'] : '/images/hero-section.png' }}" alt="{{ $producto['nombre'] }}">
                            </button>
                            <button class="miniatura-btn">
                                <img src="{{ isset($producto['imagen']) ? $producto['imagen'] : '/images/hero-section.png' }}" alt="{{ $producto['nombre'] }} - 2" style="filter: sepia(50%);">
                            </button>
                            <button class="miniatura-btn">
                                <img src="{{ isset($producto['imagen']) ? $producto['imagen'] : '/images/hero-section.png' }}" alt="{{ $producto['nombre'] }} - 3" style="filter: grayscale(100%);">
                            </button>
                        </div>
                        
                        <div class="producto-imagen-principal">
                            <button class="carousel-btn carousel-prev" id="prev-img-btn" aria-label="Anterior">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            </button>
                            <img id="main-product-img" src="{{ isset($producto['imagen']) ? $producto['imagen'] : '/images/hero-section.png' }}" alt="{{ $producto['nombre'] }}">
                            <button class="carousel-btn carousel-next" id="next-img-btn" aria-label="Siguiente">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>
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
                        
                        @if($totalCalificaciones > 0)
                            <div class="rating-general">
                                <span class="rating-general-num">{{ number_format($promedio, 1) }}</span>
                                <div class="rating-general-stars">
                                    <div style="display:flex;">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($promedio))
                                                <svg class="star-icon" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            @else
                                                <svg class="star-icon" fill="currentColor" viewBox="0 0 20 20" style="color: var(--color-text-muted);"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span style="color: var(--color-text-muted); font-size: var(--text-sm);">{{ $totalCalificaciones }} calificaciones</span>
                                </div>
                            </div>

                            <div class="comentarios-lista">
                                @foreach($comentarios as $com)
                                <div class="comentario-item">
                                    <div class="comentario-item-meta">
                                        <div style="display:flex; margin-bottom: var(--spacing-xs);">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $com['calificacion'])
                                                <svg class="star-icon" style="width: 14px; height: 14px;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                @else
                                                <svg class="star-icon" style="width: 14px; height: 14px; color: var(--color-text-muted);" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
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
                            <div class="rating-general" style="flex-direction: column; align-items: flex-start; gap: var(--spacing-xs);">
                                <span style="font-size: var(--text-lg); color: var(--color-text-muted);">Aún no hay calificaciones para este producto. ¡Sé el primero en opinar!</span>
                            </div>
                        @endif

                        <div class="seccion-calificar">
                            <h3>Dejar una calificación</h3>
                            <form action="/producto/{{ $producto['slug'] }}/calificar" method="POST" class="form-calificar">
                                @csrf
                                <div class="form-group">
                                    <label style="display: block; margin-bottom: var(--spacing-sm); color: var(--color-text-muted);">Tu calificación</label>
                                    <div class="star-rating-input">
                                        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 estrellas">★</label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 estrellas">★</label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 estrellas">★</label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 estrellas">★</label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 estrella">★</label>
                                    </div>
                                </div>
                                
                                <div class="form-group" style="margin-top: var(--spacing-md);">
                                    <label style="display: block; margin-bottom: var(--spacing-sm); color: var(--color-text-muted);">Tu opinión (opcional)</label>
                                    <textarea name="comentario" placeholder="¿Qué te pareció el producto?"></textarea>
                                </div>
                                
                                <x-ui.button style="margin-top: var(--spacing-md); width: fit-content;">Enviar calificación</x-ui.button>
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
                            <div class="estrellas" style="display: flex;">
                                @if($totalCalificaciones > 0)
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($promedio))
                                            <svg class="star-icon" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        @else
                                            <svg class="star-icon" fill="currentColor" viewBox="0 0 20 20" style="color: var(--color-text-muted);"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        @endif
                                    @endfor
                                @else
                                    <span style="color: var(--text-muted); font-size: var(--text-sm);">Aún sin calificaciones</span>
                                @endif
                            </div>
                            @if($totalCalificaciones > 0)
                                <span>({{ $totalCalificaciones }})</span>
                            @endif
                        </div>

                        <div style="margin-top: var(--spacing-sm);">
                            <span class="badge-code" style="color: var(--color-secondary); border-color: var(--color-secondary);">{{ $producto['tipo'] }}</span>
                        </div>

                        <div class="producto-precio-info">
                            @if (isset($producto['oferta']) && $producto['oferta'] > 0)
                                <span class="precio-original">${{ number_format($producto['precio'], 2) }}</span>
                                <div class="precio-actual-wrapper">
                                    <span class="precio-actual">${{ number_format($producto['oferta'], 2) }}</span>
                                    <span class="descuento-badge">
                                        {{ round((1 - ($producto['oferta'] / $producto['precio'])) * 100) }}% OFF
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
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                                </span>
                                <div>
                                    <span style="font-weight: var(--font-semibold);">Llega gratis <b>mañana</b></span><br>
                                    <span style="color: var(--color-text-muted); font-size: var(--text-sm);">Comprando dentro de las próximas 4 h</span>
                                </div>
                            </div>

                            <div style="margin-top: var(--spacing-md);">
                                <p class="producto-descripcion" style="margin-bottom: var(--spacing-sm); font-weight: var(--font-bold); color: var(--color-text-main);">
                                    Lo que tenés que saber de este producto
                                </p>
                                <ul class="caracteristicas-list">
                                    <li>Formato de venta: Unidad.</li>
                                    <li>Tipo de producto: {{ $producto['tipo'] }}.</li>
                                    <li>Un café de máxima calidad.</li>
                                </ul>
                            </div>

                            <div class="producto-acciones">
                                <x-ui.button class="btn-block" style="width: 100%; justify-content: center; font-size: 1rem; padding: var(--spacing-md) 0;">
                                    Comprar ahora
                                </x-ui.button>
                                <x-ui.button variant="outline" style="width: 100%; justify-content: center; font-size: 1rem; padding: var(--spacing-md) 0;">
                                    Agregar al carrito
                                </x-ui.button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Productos Relacionados --}}
            @if(isset($relacionados) && count($relacionados) > 0)
            <div class="productos-relacionados">
                <h2>Quienes compraron este producto también compraron</h2>
                <div class="lista-productos">
                    @foreach($relacionados as $rel)
                        <x-ui.card :producto="$rel" />
                    @endforeach
                </div>
                {{-- Add spacing at the bottom --}}
                <div style="height: var(--spacing-2xl);"></div>
            </div>
            @endif

        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const thumbnails = document.querySelectorAll('.miniatura-btn');
            const mainImg = document.getElementById('main-product-img');
            const prevBtn = document.getElementById('prev-img-btn');
            const nextBtn = document.getElementById('next-img-btn');
            
            if (!mainImg || thumbnails.length === 0) return;

            let currentIndex = 0;

            const images = Array.from(thumbnails).map(thumb => {
                const img = thumb.querySelector('img');
                return {
                    src: img.src,
                    filter: img.style.filter || 'none'
                };
            });

            function updateCarousel(index) {
                thumbnails[currentIndex].classList.remove('active');
                
                // Wrap around logic
                currentIndex = (index + images.length) % images.length;
                
                thumbnails[currentIndex].classList.add('active');
                mainImg.src = images[currentIndex].src;
                mainImg.style.filter = images[currentIndex].filter !== 'none' ? images[currentIndex].filter : '';
            }

            thumbnails.forEach((thumb, index) => {
                thumb.addEventListener('click', () => {
                    updateCarousel(index);
                });
            });

            prevBtn?.addEventListener('click', () => {
                updateCarousel(currentIndex - 1);
            });

            nextBtn?.addEventListener('click', () => {
                updateCarousel(currentIndex + 1);
            });
        });
    </script>
</x-layout>
