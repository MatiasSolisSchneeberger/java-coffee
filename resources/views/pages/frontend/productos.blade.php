<x-layouts.layout>
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

        <div class="catalogo-container">

            {{-- Botón toggle: visible solo en mobile (< 640px) --}}
            <button class="filtros-toggle" id="filtros-toggle" aria-expanded="false" aria-controls="filtros-sidebar">
                <x-icons.filter class="filtros-toggle-icon" />
                <span class="filtros-toggle-label">Mostrar filtros</span>
                <x-icons.chevron-down class="filtros-toggle-chevron" />
            </button>

            {{-- Columna de Filtros --}}
            <aside class="filtros-sidebar" id="filtros-sidebar">
                <form method="GET" action="/productos" id="filtros-form">
                    <h3>
                        <span class="term-user">guest@javacoffee</span><span class="term-colon">:</span><span class="term-path">~/filtros</span><span class="term-prompt">$ ./config</span>
                    </h3>

                    <div class="filtro-grupo">
                        <span class="filtro-label">Categoría</span>
                        <x-ui.dropdown>
                            <x-slot:trigger>
                                <button type="button" class="filtro-select-btn">
                                    <span>
                                        @if(request('categoria'))
                                            {{ $categorias->firstWhere('id', request('categoria'))->nombre ?? 'Todas las categorías' }}
                                        @else
                                            Todas las categorías
                                        @endif
                                    </span>
                                    <x-icons.chevron-down class="chevron icon-sm" />
                                </button>
                            </x-slot:trigger>
                            
                            <a href="javascript:void(0)" onclick="setFilterAndSubmit('categoria', '')" style="{{ !request('categoria') ? 'background-color: var(--color-primary); color: var(--bg-base); font-weight: var(--font-semibold);' : '' }}">Todas las categorías</a>
                            @foreach ($categorias as $cat)
                                <a href="javascript:void(0)" onclick="setFilterAndSubmit('categoria', '{{ $cat->id }}')" style="{{ request('categoria') == $cat->id ? 'background-color: var(--color-primary); color: var(--bg-base); font-weight: var(--font-semibold);' : '' }}">
                                    {{ $cat->nombre }}
                                </a>
                            @endforeach
                        </x-ui.dropdown>
                        <input type="hidden" name="categoria" id="hidden-categoria" value="{{ request('categoria') }}">
                    </div>

                    <div class="filtro-grupo">
                        <span class="filtro-label">Presentación</span>
                        <x-ui.dropdown>
                            <x-slot:trigger>
                                <button type="button" class="filtro-select-btn">
                                    <span>
                                        {{ request('tueste') ?: 'Todas las presentaciones' }}
                                    </span>
                                    <x-icons.chevron-down class="chevron icon-sm" />
                                </button>
                            </x-slot:trigger>
                            
                            <a href="javascript:void(0)" onclick="setFilterAndSubmit('tueste', '')" style="{{ !request('tueste') ? 'background-color: var(--color-primary); color: var(--bg-base); font-weight: var(--font-semibold);' : '' }}">Todas las presentaciones</a>
                            @foreach ($tuestes as $tueste)
                                <a href="javascript:void(0)" onclick="setFilterAndSubmit('tueste', '{{ $tueste }}')" style="{{ request('tueste') == $tueste ? 'background-color: var(--color-primary); color: var(--bg-base); font-weight: var(--font-semibold);' : '' }}">
                                    {{ $tueste }}
                                </a>
                            @endforeach
                        </x-ui.dropdown>
                        <input type="hidden" name="tueste" id="hidden-tueste" value="{{ request('tueste') }}">
                    </div>

                    <div class="filtro-grupo">
                        <span class="filtro-label">Origen</span>
                        <x-ui.dropdown>
                            <x-slot:trigger>
                                <button type="button" class="filtro-select-btn">
                                    <span>
                                        @if(request('origen'))
                                            {{ $origenes->firstWhere('id', request('origen'))->nombre ?? 'Todos los orígenes' }}
                                        @else
                                            Todos los orígenes
                                        @endif
                                    </span>
                                    <x-icons.chevron-down class="chevron icon-sm" />
                                </button>
                            </x-slot:trigger>
                            
                            <a href="javascript:void(0)" onclick="setFilterAndSubmit('origen', '')" style="{{ !request('origen') ? 'background-color: var(--color-primary); color: var(--bg-base); font-weight: var(--font-semibold);' : '' }}">Todos los orígenes</a>
                            @foreach ($origenes as $origen)
                                <a href="javascript:void(0)" onclick="setFilterAndSubmit('origen', '{{ $origen->id }}')" style="{{ request('origen') == $origen->id ? 'background-color: var(--color-primary); color: var(--bg-base); font-weight: var(--font-semibold);' : '' }}">
                                    {{ $origen->nombre }}
                                </a>
                            @endforeach
                        </x-ui.dropdown>
                        <input type="hidden" name="origen" id="hidden-origen" value="{{ request('origen') }}">
                    </div>

                    <div class="filtro-grupo">
                        <span class="filtro-label">Estado de Oferta</span>
                        <x-ui.dropdown>
                            <x-slot:trigger>
                                <button type="button" class="filtro-select-btn">
                                    <span>
                                        @if(request('oferta') === '1')
                                            Solo en Oferta
                                        @elseif(request('oferta') === '0')
                                            Precio Regular
                                        @else
                                            Todos los productos
                                        @endif
                                    </span>
                                    <x-icons.chevron-down class="chevron icon-sm" />
                                </button>
                            </x-slot:trigger>
                            
                            <a href="javascript:void(0)" onclick="setFilterAndSubmit('oferta', '')" style="{{ (request('oferta') === null || request('oferta') === '') ? 'background-color: var(--color-primary); color: var(--bg-base); font-weight: var(--font-semibold);' : '' }}">Todos los productos</a>
                            <a href="javascript:void(0)" onclick="setFilterAndSubmit('oferta', '1')" style="{{ request('oferta') === '1' ? 'background-color: var(--color-primary); color: var(--bg-base); font-weight: var(--font-semibold);' : '' }}">Solo en Oferta</a>
                            <a href="javascript:void(0)" onclick="setFilterAndSubmit('oferta', '0')" style="{{ request('oferta') === '0' ? 'background-color: var(--color-primary); color: var(--bg-base); font-weight: var(--font-semibold);' : '' }}">Precio Regular</a>
                        </x-ui.dropdown>
                        <input type="hidden" name="oferta" id="hidden-oferta" value="{{ request('oferta') }}">
                    </div>

                    <div class="filtro-grupo">
                        <span class="filtro-label">Precio Máximo: <span id="precio-max-val" style="color: var(--color-primary); font-weight: var(--font-bold);">${{ number_format(request('precio_max', $maxPrecio), 2) }}</span></span>
                        <input type="range" name="precio_max" id="precio_max_slider" min="{{ $minPrecio }}" max="{{ $maxPrecio }}" step="0.5" value="{{ request('precio_max', $maxPrecio) }}" style="width: 100%; cursor: pointer;" />
                    </div>

                    @if (request()->filled('categoria') || request()->filled('origen') || request()->filled('tueste') || request()->filled('oferta') || request()->filled('precio_max'))
                        <div class="filtro-limpiar">
                            <a href="/productos" class="btn-limpiar">
                                ./limpiar.sh
                            </a>
                        </div>
                    @endif
                </form>
            </aside>

            {{-- Columna de Productos --}}
            <section class="productos-grid">
                @forelse ($productos as $producto)
                    <x-ui.card :producto="$producto" />
                @empty
                    <p style="grid-column: 1 / -1; text-align: center; padding: var(--spacing-xl); color: var(--color-text-muted);">
                        No hay productos que coincidan con los filtros seleccionados.
                    </p>
                @endforelse

                {{-- Enlaces de paginación con estética de Terminal --}}
                @if(isset($paginador) && $paginador->hasPages())
                    <div class="paginacion-container">
                        {{-- Botón Primero --}}
                        @if($paginador->onFirstPage())
                            <span class="pag-btn disabled">&lt;&lt; PRIMERO</span>
                        @else
                            <a href="{{ $paginador->url(1) }}" class="pag-btn">&lt;&lt; PRIMERO</a>
                        @endif

                        {{-- Botón Anterior --}}
                        @if($paginador->onFirstPage())
                            <span class="pag-btn disabled">&lt; ANT</span>
                        @else
                            <a href="{{ $paginador->previousPageUrl() }}" class="pag-btn">&lt; ANT</a>
                        @endif

                        {{-- Páginas intermedias --}}
                        @foreach($paginador->getUrlRange(max(1, $paginador->currentPage() - 2), min($paginador->lastPage(), $paginador->currentPage() + 2)) as $page => $url)
                            @if($page == $paginador->currentPage())
                                <span class="pag-btn active">[{{ $page }}]</span>
                            @else
                                <a href="{{ $url }}" class="pag-btn">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Botón Siguiente --}}
                        @if($paginador->hasMorePages())
                            <a href="{{ $paginador->nextPageUrl() }}" class="pag-btn">SIG &gt;</a>
                        @else
                            <span class="pag-btn disabled">SIG &gt;</span>
                        @endif

                        {{-- Botón Último --}}
                        @if($paginador->currentPage() == $paginador->lastPage())
                            <span class="pag-btn disabled">ÚLTIMO &gt;&gt;</span>
                        @else
                            <a href="{{ $paginador->url($paginador->lastPage()) }}" class="pag-btn">ÚLTIMO &gt;&gt;</a>
                        @endif
                    </div>
                @endif
            </section>

        </div>
    </main>

    <script>
        // JS helper para los dropdowns personalizados
        function setFilterAndSubmit(name, value) {
            const input = document.getElementById('hidden-' + name);
            if (input) {
                input.value = value;
                const form = document.getElementById('filtros-form');
                if (form) form.submit();
            }
        }

        (function() {
            // Toggle sidebar en mobile
            const btn = document.getElementById('filtros-toggle');
            const sidebar = document.getElementById('filtros-sidebar');
            const label = btn?.querySelector('.filtros-toggle-label');

            if (btn && sidebar) {
                btn.addEventListener('click', () => {
                    const isOpen = sidebar.classList.toggle('is-open');
                    btn.setAttribute('aria-expanded', isOpen);
                    if (label) label.textContent = isOpen ? 'Ocultar filtros' : 'Mostrar filtros';
                    btn.classList.toggle('is-open', isOpen);
                });
            }

            // Auto-submit y actualización en tiempo real de los filtros
            const form = document.getElementById('filtros-form');
            const slider = document.getElementById('precio_max_slider');
            const sliderVal = document.getElementById('precio-max-val');

            if (slider && sliderVal) {
                slider.addEventListener('input', (e) => {
                    sliderVal.textContent = `$${parseFloat(e.target.value).toFixed(2)}`;
                });
                slider.addEventListener('change', () => {
                    if (form) form.submit();
                });
            }
        })();
    </script>
</x-layouts.layout>
