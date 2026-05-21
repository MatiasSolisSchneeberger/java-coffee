<x-admin-layout title="Gestión de Pedidos">
    <div class="admin-panel-card">
        <div class="admin-panel-card-header">
            <h2 class="admin-panel-card-title">Listado de Pedidos Recibidos</h2>
            <div class="admin-search-wrapper" style="max-width: 300px;">
                <select class="admin-form-field admin-form-select" onchange="filterOrders(this.value)">
                    <option value="todos">Todos los estados</option>
                    <option value="pendiente">Pendientes</option>
                    <option value="preparando">Preparando</option>
                    <option value="enviado">Enviados</option>
                    <option value="entregado">Entregados</option>
                </select>
            </div>
        </div>

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Contacto</th>
                        <th>Detalle de Compra</th>
                        <th>Total</th>
                        <th>Pago</th>
                        <th>Estado Envío</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Pedido 1 -->
                    <tr>
                        <td><strong>#1005</strong></td>
                        <td>
                            <div>Carlos Rodríguez</div>
                            <div style="font-size: var(--text-xs); color: var(--color-text-muted);">Dir: Av. Rivadavia 4500, CABA</div>
                        </td>
                        <td>
                            <div>11-2345-6789</div>
                            <div style="font-size: var(--text-xs); color: var(--color-text-muted);">carlos.rod@email.com</div>
                        </td>
                        <td>
                            <div style="font-size: var(--text-xs);">
                                • 2x Café Colombia Bourbon Amarillo ($17,000.00)<br>
                                • 1x Taza Cerámica Térmica ($4,800.00)
                            </div>
                        </td>
                        <td><strong>$21,800.00</strong></td>
                        <td>Efectivo</td>
                        <td>
                            <select class="admin-form-field admin-form-select admin-btn-sm" style="width: auto; display: inline-block; padding: 2px 25px 2px 8px; height: auto;" onchange="updateStatus(1005, this.value)">
                                <option value="pendiente" selected>Pendiente</option>
                                <option value="preparando">Preparando</option>
                                <option value="enviado">Enviado</option>
                                <option value="entregado">Entregado</option>
                            </select>
                        </td>
                        <td>
                            <button class="admin-btn admin-btn-secondary admin-btn-sm" onclick="alert('Detalle de Pedido #1005:\nCliente: Carlos Rodríguez\nDirección: Av. Rivadavia 4500, CABA\nTeléfono: 11-2345-6789\nTotal: $21,800.00\nPago: Efectivo\n\nItems:\n- 2x Café Colombia Bourbon Amarillo\n- 1x Taza Cerámica Térmica')">Ver Ficha</button>
                        </td>
                    </tr>

                    <!-- Pedido 2 -->
                    <tr>
                        <td><strong>#1004</strong></td>
                        <td>
                            <div>María Gómez</div>
                            <div style="font-size: var(--text-xs); color: var(--color-text-muted);">Dir: Calle Florida 150, 4to B, CABA</div>
                        </td>
                        <td>
                            <div>11-9876-5432</div>
                            <div style="font-size: var(--text-xs); color: var(--color-text-muted);">maria.gomez@email.com</div>
                        </td>
                        <td>
                            <div style="font-size: var(--text-xs);">
                                • 1x Cafetera Italiana Volturno 6 Pocillos ($19,500.00)
                            </div>
                        </td>
                        <td><strong>$19,500.00</strong></td>
                        <td>Tarjeta</td>
                        <td>
                            <select class="admin-form-field admin-form-select admin-btn-sm" style="width: auto; display: inline-block; padding: 2px 25px 2px 8px; height: auto;" onchange="updateStatus(1004, this.value)">
                                <option value="pendiente">Pendiente</option>
                                <option value="preparando">Preparando</option>
                                <option value="enviado">Enviado</option>
                                <option value="entregado" selected>Entregado</option>
                            </select>
                        </td>
                        <td>
                            <button class="admin-btn admin-btn-secondary admin-btn-sm" onclick="alert('Detalle de Pedido #1004:\nCliente: María Gómez\nDirección: Calle Florida 150, 4to B, CABA\nTeléfono: 11-9876-5432\nTotal: $19,500.00\nPago: Tarjeta\n\nItems:\n- 1x Cafetera Italiana Volturno 6 Pocillos')">Ver Ficha</button>
                        </td>
                    </tr>

                    <!-- Pedido 3 -->
                    <tr>
                        <td><strong>#1003</strong></td>
                        <td>
                            <div>Juan Pérez</div>
                            <div style="font-size: var(--text-xs); color: var(--color-text-muted);">Dir: Av. Santa Fe 2300, 12A, CABA</div>
                        </td>
                        <td>
                            <div>11-5555-4444</div>
                            <div style="font-size: var(--text-xs); color: var(--color-text-muted);">juan.perez@email.com</div>
                        </td>
                        <td>
                            <div style="font-size: var(--text-xs);">
                                • 1x Café Colombia Bourbon Amarillo ($8,500.00)<br>
                                • 1x Cafetera Italiana Volturno 6 Pocillos ($19,500.00)
                            </div>
                        </td>
                        <td><strong>$28,000.00</strong></td>
                        <td>Transferencia</td>
                        <td>
                            <select class="admin-form-field admin-form-select admin-btn-sm" style="width: auto; display: inline-block; padding: 2px 25px 2px 8px; height: auto;" onchange="updateStatus(1003, this.value)">
                                <option value="pendiente">Pendiente</option>
                                <option value="preparando">Preparando</option>
                                <option value="enviado" selected>Enviado</option>
                                <option value="entregado">Entregado</option>
                            </select>
                        </td>
                        <td>
                            <button class="admin-btn admin-btn-secondary admin-btn-sm" onclick="alert('Detalle de Pedido #1003:\nCliente: Juan Pérez\nDirección: Av. Santa Fe 2300, 12A, CABA\nTeléfono: 11-5555-4444\nTotal: $28,000.00\nPago: Transferencia\n\nItems:\n- 1x Café Colombia Bourbon Amarillo\n- 1x Cafetera Italiana Volturno 6 Pocillos')">Ver Ficha</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function updateStatus(orderId, status) {
            alert("Simulación: Pedido #" + orderId + " cambiado al estado '" + status.toUpperCase() + "'.");
        }

        function filterOrders(filter) {
            alert("Simulación: Filtrando pedidos por estado '" + filter.toUpperCase() + "'.");
        }
    </script>
</x-admin-layout>
