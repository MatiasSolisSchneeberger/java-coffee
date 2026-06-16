<x-layouts.admin-layout title="Gestión de Pedidos">
    <div class="admin-panel-card">
        <div class="admin-panel-card-header">
            <h2 class="admin-panel-card-title">Listado de Pedidos Recibidos</h2>
            <div class="admin-search-wrapper" style="max-width: 300px;">
                <select class="admin-form-field admin-form-select" onchange="filterOrders(this.value)">
                    <option value="todos" {{ ($estado ?? 'todos') === 'todos' ? 'selected' : '' }}>Todos los estados</option>
                    <option value="pendiente" {{ ($estado ?? '') === 'pendiente' ? 'selected' : '' }}>Pendientes</option>
                    <option value="preparando" {{ ($estado ?? '') === 'preparando' ? 'selected' : '' }}>Preparando</option>
                    <option value="enviado" {{ ($estado ?? '') === 'enviado' ? 'selected' : '' }}>Enviados</option>
                    <option value="entregado" {{ ($estado ?? '') === 'entregado' ? 'selected' : '' }}>Entregados</option>
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
                                <button class="admin-btn admin-btn-secondary admin-btn-sm" 
                                        onclick="showOrderDetails({{ json_encode([
                                            'id' => $pedido->id,
                                            'cliente' => $pedido->usuario ? ($pedido->usuario->nombre . ' ' . $pedido->usuario->apellido) : 'Anónimo',
                                            'email' => $pedido->usuario ? $pedido->usuario->email : '-',
                                            'telefono' => $pedido->usuario ? $pedido->usuario->telefono : '-',
                                            'direccion' => $pedido->direccion_envio . ', ' . ($pedido->provincia ? $pedido->provincia->nombre : 'Desconocida'),
                                            'total' => '$' . number_format($pedido->total, 2),
                                            'metodo_pago' => $pedido->metodo_pago,
                                            'estado' => strtoupper($pedido->estado),
                                            'items' => $pedido->detalles->map(function($det) {
                                                return [
                                                    'nombre' => $det->producto ? $det->producto->nombre : 'Producto Eliminado',
                                                    'cantidad' => $det->whitespace_normalized_quantity ?? $det->cantidad,
                                                    'precio' => '$' . number_format($det->precio_unitario, 2),
                                                    'subtotal' => '$' . number_format($det->subtotal, 2)
                                                ];
                                            })
                                        ]) }})">Ver Ficha</button>
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
            window.location.href = '/admin/pedidos?estado=' + filter;
        }

        function showOrderDetails(pedido) {
            document.getElementById('modal-titulo').textContent = 'Ficha de Pedido #' + pedido.id;
            document.getElementById('modal-cliente').textContent = pedido.cliente;
            document.getElementById('modal-email').textContent = pedido.email;
            document.getElementById('modal-telefono').textContent = pedido.telefono;
            document.getElementById('modal-direccion').textContent = pedido.direccion;
            document.getElementById('modal-total').textContent = pedido.total;
            document.getElementById('modal-metodo-pago').textContent = pedido.metodo_pago;
            document.getElementById('modal-estado').textContent = pedido.estado;
            
            const tbody = document.getElementById('modal-items-body');
            tbody.innerHTML = '';
            
            pedido.items.forEach(function(item) {
                const tr = document.createElement('tr');
                
                const tdNombre = document.createElement('td');
                tdNombre.textContent = item.nombre;
                tr.appendChild(tdNombre);
                
                const tdCantidad = document.createElement('td');
                tdCantidad.textContent = item.cantidad;
                tr.appendChild(tdCantidad);
                
                const tdPrecio = document.createElement('td');
                tdPrecio.textContent = item.precio;
                tr.appendChild(tdPrecio);
                
                const tdSubtotal = document.createElement('td');
                tdSubtotal.textContent = item.subtotal;
                tr.appendChild(tdSubtotal);
                
                tbody.appendChild(tr);
            });
            
            document.getElementById('pedido-modal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('pedido-modal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('pedido-modal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>

    <!-- Modal de Ficha de Pedido -->
    <div id="pedido-modal" class="admin-modal" style="display: none;">
        <div class="admin-modal-content">
            <div class="admin-modal-header">
                <h3 class="admin-modal-title" id="modal-titulo">Ficha de Pedido</h3>
                <button class="admin-modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="admin-modal-body">
                <div class="modal-info-grid">
                    <div>
                        <strong>Cliente:</strong>
                        <span id="modal-cliente"></span>
                    </div>
                    <div>
                        <strong>Email:</strong>
                        <span id="modal-email"></span>
                    </div>
                    <div>
                        <strong>Teléfono:</strong>
                        <span id="modal-telefono"></span>
                    </div>
                    <div>
                        <strong>Dirección:</strong>
                        <span id="modal-direccion"></span>
                    </div>
                    <div>
                        <strong>Total:</strong>
                        <span id="modal-total"></span>
                    </div>
                    <div>
                        <strong>Método Pago:</strong>
                        <span id="modal-metodo-pago"></span>
                    </div>
                    <div>
                        <strong>Estado Envío:</strong>
                        <span id="modal-estado"></span>
                    </div>
                </div>
                <h4 style="margin-top: var(--spacing-md); border-bottom: var(--border-thin); padding-bottom: var(--spacing-xs); color: var(--color-primary);">Detalle de Items</h4>
                <div class="admin-table-wrapper" style="margin-top: var(--spacing-sm);">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="modal-items-body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin-layout>
