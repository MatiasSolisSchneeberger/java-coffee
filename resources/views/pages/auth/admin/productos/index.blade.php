<x-layouts.admin-layout title="Administración de Productos">
    <div class="admin-panel-card">
        <!-- Toolbar con Búsqueda y Añadir -->
        <div class="admin-toolbar">
            <div class="admin-search-wrapper">
                <input type="text" class="admin-form-field" placeholder="Buscar producto por nombre o código...">
                <button class="admin-btn admin-btn-secondary">
                    <x-icons.search class="icon-sm" style="margin-right: var(--spacing-sm);" /> Buscar
                </button>
            </div>

            <a href="/admin/producto/crear" class="admin-btn admin-btn-primary">
                <x-icons.plus class="icon-sm" style="margin-right: var(--spacing-sm);" /> Añadir Nuevo Producto
            </a>
        </div>

        <!-- Tabla de Productos -->
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Precio Oferta</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productos as $producto)
                        @php
                            $portada = '/storage/productos/error-404.png';
                            if (isset($producto->imagenes) && count($producto->imagenes) > 0) {
                                $portada = '/storage/productos/' . $producto->imagenes->first()->url;
                            }
                        @endphp
                        <tr>
                            <td>
                                <img src="{{ $portada }}" alt="{{ $producto->nombre }}" class="admin-table-img">
                            </td>
                            <td><strong>{{ $producto->nombre }}</strong></td>
                            <td>{{ $producto->categoria ? $producto->categoria->nombre : 'Sin Categoría' }}</td>
                            <td>${{ number_format($producto->precio, 2) }}</td>
                            <td>
                                @if ($producto->precio_oferta > 0)
                                    ${{ number_format($producto->precio_oferta, 2) }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($producto->stock > 0)
                                    <x-ui.status-badge status="entregado">{{ $producto->stock }}
                                        unidades</x-ui.status-badge>
                                @else
                                    <x-ui.status-badge status="cancelado">Sin Stock</x-ui.status-badge>
                                @endif
                                @if ($producto->estado !== 'activo')
                                    <br><span
                                        style="font-size: var(--text-xs); color: var(--color-error)">{{ ucfirst($producto->estado) }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="admin-btn-group">
                                    <a href="/admin/producto/{{ \Illuminate\Support\Str::slug($producto->nombre) }}"
                                        class="admin-btn admin-btn-secondary admin-btn-sm">
                                        <x-icons.settings class="icon-xs" style="margin-right: 4px;" />
                                        Editar
                                    </a>
                                    <form id="delete-form-{{ $producto->id }}"
                                        action="/admin/productos/{{ $producto->id }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <x-ui.button variant="danger" size="default"
                                        onclick="confirmDelete({{ $producto->id }}, '{{ addslashes($producto->nombre) }}')">
                                        <x-icons.x-circle class="icon-xs" />
                                        <span>Eliminar</span>
                                    </x-ui.button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"
                                style="text-align: center; color: var(--color-text-muted); padding: 15px;">No hay
                                productos registrados en el sistema.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script de Interacción para Visualización de Borrado -->
    <script>
        function confirmDelete(productId, productName) {
            if (confirm("¿Estás seguro de que deseas eliminar el producto '" + productName + "'?")) {
                document.getElementById('delete-form-' + productId).submit();
            }
        }
    </script>
</x-layouts.admin-layout>
