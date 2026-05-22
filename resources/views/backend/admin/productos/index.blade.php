<x-admin-layout title="Administración de Productos">
    <div class="admin-panel-card">
        <!-- Toolbar con Búsqueda y Añadir -->
        <div class="admin-toolbar">
            <div class="admin-search-wrapper">
                <input type="text" class="admin-form-field" placeholder="Buscar producto por nombre o código...">
                <button class="admin-btn admin-btn-secondary">Buscar</button>
            </div>
            
            <a href="/admin/producto/crear" class="admin-btn admin-btn-primary">
                + Añadir Nuevo Producto
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
                    <tr>
                        <td>
                            <img src="/images/hero-section.png" alt="Café Bourbon" class="admin-table-img">
                        </td>
                        <td><strong>Café Colombia Bourbon Amarillo</strong></td>
                        <td>Café en Grano</td>
                        <td>$8,500.00</td>
                        <td>-</td>
                        <td>
                            <x-ui.status-badge status="entregado">24 unidades</x-ui.status-badge>
                        </td>
                        <td>
                            <div class="admin-btn-group">
                                <a href="/admin/producto/cafe-colombia-bourbon-amarillo" class="admin-btn admin-btn-secondary admin-btn-sm">Editar</a>
                                <button class="admin-btn admin-btn-danger admin-btn-sm" onclick="confirmDelete('Café Colombia Bourbon Amarillo')">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="/images/hero-section.png" alt="Cafetera Italiana Volturno" class="admin-table-img">
                        </td>
                        <td><strong>Cafetera Italiana Volturno 6 Pocillos</strong></td>
                        <td>Cafeteras</td>
                        <td>$22,000.00</td>
                        <td>$19,500.00</td>
                        <td>
                            <x-ui.status-badge status="pendiente">4 unidades</x-ui.status-badge>
                        </td>
                        <td>
                            <div class="admin-btn-group">
                                <a href="/admin/producto/cafetera-italiana-volturno-6-pocillos" class="admin-btn admin-btn-secondary admin-btn-sm">Editar</a>
                                <button class="admin-btn admin-btn-danger admin-btn-sm" onclick="confirmDelete('Cafetera Italiana Volturno 6 Pocillos')">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="/images/hero-section.png" alt="Café de Especialidad Geisha" class="admin-table-img">
                        </td>
                        <td><strong>Café de Especialidad Geisha Panamá</strong></td>
                        <td>Café en Grano</td>
                        <td>$14,500.00</td>
                        <td>-</td>
                        <td>
                            <x-ui.status-badge status="cancelado">Sin Stock</x-ui.status-badge>
                        </td>
                        <td>
                            <div class="admin-btn-group">
                                <a href="/admin/producto/cafe-de-especialidad-geisha-panama" class="admin-btn admin-btn-secondary admin-btn-sm">Editar</a>
                                <button class="admin-btn admin-btn-danger admin-btn-sm" onclick="confirmDelete('Café de Especialidad Geisha Panamá')">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="/images/hero-section.png" alt="Taza Cerámica Java Coffee" class="admin-table-img">
                        </td>
                        <td><strong>Taza Cerámica Térmica Java Coffee</strong></td>
                        <td>Merchandising</td>
                        <td>$4,800.00</td>
                        <td>-</td>
                        <td>
                            <x-ui.status-badge status="entregado">85 unidades</x-ui.status-badge>
                        </td>
                        <td>
                            <div class="admin-btn-group">
                                <a href="/admin/producto/taza-ceramica-termica-java-coffee" class="admin-btn admin-btn-secondary admin-btn-sm">Editar</a>
                                <button class="admin-btn admin-btn-danger admin-btn-sm" onclick="confirmDelete('Taza Cerámica Térmica Java Coffee')">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script de Interacción para Visualización de Borrado -->
    <script>
        function confirmDelete(productName) {
            if (confirm("¿Estás seguro de que deseas eliminar el producto '" + productName + "'?")) {
                alert("Simulación: Producto '" + productName + "' marcado para eliminación.");
            }
        }
    </script>
</x-admin-layout>
