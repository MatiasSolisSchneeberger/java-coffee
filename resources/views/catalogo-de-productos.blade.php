<x-layout>
    <main>
        <div class="catalogo-container">

            {{-- Botón toggle: visible solo en mobile (< 640px) --}}
            <button class="filtros-toggle" id="filtros-toggle" aria-expanded="false" aria-controls="filtros-sidebar">
                <x-icons.filter class="filtros-toggle-icon" />
                <span class="filtros-toggle-label">Mostrar filtros</span>
                <x-icons.chevron-down class="filtros-toggle-chevron" />
            </button>

            {{-- Columna de Filtros --}}
            <aside class="filtros-sidebar" id="filtros-sidebar">
                <h3>Filtros</h3>

                <div class="filtro-grupo">
                    <h4>Categorías</h4>
                    <label><input type="checkbox" /> Café en Grano</label>
                    <label><input type="checkbox" /> Cápsulas</label>
                    <label><input type="checkbox" /> Molido</label>
                    <label><input type="checkbox" /> Descafeinado</label>
                </div>

                <div class="filtro-grupo">
                    <h4>Intensidad</h4>
                    <label><input type="checkbox" /> Suave</label>
                    <label><input type="checkbox" /> Media</label>
                    <label><input type="checkbox" /> Fuerte</label>
                    <label><input type="checkbox" /> Extrema</label>
                </div>

                <div class="filtro-grupo">
                    <h4>Origen</h4>
                    <label><input type="checkbox" /> Colombia</label>
                    <label><input type="checkbox" /> Brasil</label>
                    <label><input type="checkbox" /> Etiopía</label>
                    <label><input type="checkbox" /> Blend</label>
                </div>

                <div class="filtro-grupo">
                    <h4>Precio Máximo</h4>
                    <input type="range" min="0" max="100000" value="50000" />
                </div>
            </aside>

            {{-- Columna de Productos --}}
            <section class="productos-grid">
                @forelse ($productos as $producto)
                    <x-ui.card :producto="$producto" />
                @empty
                    <p>No hay productos disponibles.</p>
                @endforelse
            </section>

        </div>
    </main>

    <script>
        (function() {
            const btn = document.getElementById('filtros-toggle');
            const sidebar = document.getElementById('filtros-sidebar');
            const label = btn?.querySelector('.filtros-toggle-label');

            if (!btn || !sidebar) return;

            btn.addEventListener('click', () => {
                const isOpen = sidebar.classList.toggle('is-open');
                btn.setAttribute('aria-expanded', isOpen);
                if (label) label.textContent = isOpen ? 'Ocultar filtros' : 'Mostrar filtros';
                btn.classList.toggle('is-open', isOpen);
            });
        })();
    </script>
</x-layout>
