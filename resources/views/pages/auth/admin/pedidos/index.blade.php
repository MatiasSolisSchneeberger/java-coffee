<x-layouts.admin-layout title="Gestión de Pedidos">
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
                    @forelse ($pedidos as $pedido)
                        <tr>
                            <td><strong>#{{ $pedido->id }}</strong></td>
                            <td>
                                <div>{{ $pedido->usuario ? ($pedido->usuario->nombre . ' ' . $pedido->usuario->apellido) : 'Anónimo' }}</div>
                                <div style="font-size: var(--text-xs); color: var(--color-text-muted);">Dir: {{ $pedido->direccion_envio }}, {{ $pedido->provincia ? $pedido->provincia->nombre : 'Desconocida' }}</div>
                            </td>
                            <td>
                                <div>{{ $pedido->usuario ? $pedido->usuario->telefono : '-' }}</div>
                                <div style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ $pedido->usuario ? $pedido->usuario->email : '-' }}</div>
                            </td>
                            <td>
                                <div style="font-size: var(--text-xs);">
                                    @foreach ($pedido->detalles as $det)
                                        • {{ $det->cantidad }}x {{ $det->producto ? $det->producto->nombre : 'Producto Eliminado' }} (${{ number_format($det->precio_unitario, 2) }})<br>
                                    @endforeach
                                </div>
                            </td>
                            <td><strong>${{ number_format($pedido->total, 2) }}</strong></td>
                            <td>{{ $pedido->metodo_pago }}</td>
                            <td>
                                <select class="admin-form-field admin-form-select admin-btn-sm" style="width: auto; display: inline-block; padding: 2px 25px 2px 8px; height: auto;" onchange="updateStatus({{ $pedido->id }}, this.value)">
                                    <option value="pendiente" {{ $pedido->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="preparando" {{ $pedido->estado === 'preparando' ? 'selected' : '' }}>Preparando</option>
                                    <option value="enviado" {{ $pedido->estado === 'enviado' ? 'selected' : '' }}>Enviado</option>
                                    <option value="entregado" {{ $pedido->estado === 'entregado' ? 'selected' : '' }}>Entregado</option>
                                    <option value="cancelado" {{ $pedido->estado === 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                </select>
                            </td>
                            <td>
                                @php
                                    $fichaText = "Detalle de Pedido #" . $pedido->id . ":\\n" .
                                                 "Cliente: " . addslashes($pedido->usuario ? ($pedido->usuario->nombre . ' ' . $pedido->usuario->apellido) : 'Anónimo') . "\\n" .
                                                 "Dirección: " . addslashes($pedido->direccion_envio) . ", " . addslashes($pedido->provincia ? $pedido->provincia->nombre : 'Desconocida') . "\\n" .
                                                 "Teléfono: " . addslashes($pedido->usuario ? $pedido->usuario->telefono : '-') . "\\n" .
                                                 "Total: $" . number_format($pedido->total, 2) . "\\n" .
                                                 "Pago: " . addslashes($pedido->metodo_pago) . "\\n\\n" .
                                                 "Items:\\n";
                                    foreach ($pedido->detalles as $det) {
                                        $fichaText .= "- " . $det->cantidad . "x " . addslashes($det->producto ? $det->producto->nombre : 'Producto Eliminado') . "\\n";
                                    }
                                @endphp
                                <button class="admin-btn admin-btn-secondary admin-btn-sm" onclick="alert('{{ $fichaText }}')">Ver Ficha</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; color: var(--color-text-muted); padding: 15px;">No hay pedidos registrados en el sistema.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function updateStatus(orderId, status) {
            // Hacemos la llamada al endpoint que acabamos de crear
            fetch(`/admin/pedidos/${orderId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    // Enviamos el token CSRF que genera Laravel de fondo
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ estado: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Podés reemplazar este alert por una notificación flotante/toast si preferís
                    alert(data.message);
                } else {
                    alert('Ocurrió un inconveniente al actualizar el estado.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error de conexión con el servidor.');
            });
        }

        function filterOrders(filter) {
            alert("Simulación: Filtrando pedidos por estado '" + filter.toUpperCase() + "'.");
        }
    </script>
</x-layouts.admin-layout>
