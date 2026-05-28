<x-layouts.admin-layout title="Inicio Panel">
    <!-- Fila de Estadísticas -->
    <div class="admin-stats-grid">
        <x-ui.stat-card label="Total Ventas" value="${{ number_format($totalVentas, 2) }}" footer="Últimos 30 días" iconColor="primary" />

        <x-ui.stat-card class="accent-purple" label="Pedidos Pendientes" value="{{ $pedidosPendientes }}" footer="Requieren atención" iconColor="secondary" />

        <x-ui.stat-card class="accent-purple" label="Consultas Activas" value="{{ $consultasActivas }}" footer="Mensajes sin responder" iconColor="coffee" />

        <x-ui.stat-card label="Comentarios Nuevos" value="{{ $comentariosNuevos }}" footer="Pendientes de moderación" iconColor="primary" />

        <x-ui.stat-card class="accent-error" label="Stock Crítico" value="{{ $stockCritico }}" footer="Productos con bajo stock" iconColor="primary" />
    </div>

    <!-- Layout de Dos Columnas -->
    <div class="admin-dashboard-layout">
        <!-- Columna Izquierda: Últimos Pedidos -->
        <section class="admin-panel-card">
            <div class="admin-panel-card-header">
                <h2 class="admin-panel-card-title">Últimos Pedidos Recibidos</h2>
                <a href="/admin/pedidos" class="admin-btn admin-btn-secondary admin-btn-sm">Ver Todos</a>
            </div>

            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Método Pago</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pedidos as $pedido)
                            <tr>
                                <td>#{{ $pedido->id }}</td>
                                <td>{{ $pedido->usuario ? ($pedido->usuario->nombre . ' ' . $pedido->usuario->apellido) : 'Anónimo' }}</td>
                                <td>${{ number_format($pedido->total, 2) }}</td>
                                <td>{{ $pedido->metodo_pago }}</td>
                                <td><x-ui.status-badge :status="$pedido->estado" /></td>
                                <td>
                                    <a href="/admin/pedidos"
                                        class="admin-btn admin-btn-secondary admin-btn-sm">Gestionar</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: var(--color-text-muted); padding: 15px;">No hay pedidos recibidos.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Columna Derecha: Comentarios Recientes -->
        <section class="admin-panel-card">
            <div class="admin-panel-card-header">
                <h2 class="admin-panel-card-title">Comentarios Recientes</h2>
                <a href="/admin/comentarios" class="admin-btn admin-btn-secondary admin-btn-sm">Moderar</a>
            </div>

            <div class="recent-comments-list">
                @forelse ($comentarios as $com)
                    <article class="recent-comment-item">
                        <header class="recent-comment-header">
                            <span class="recent-comment-user">
                                {{ $com->usuario ? ($com->usuario->nombre . ' ' . $com->usuario->apellido) : 'Anónimo' }}
                            </span>
                            <span class="comment-stars" style="color: var(--color-primary);">
                                {{ str_repeat('★', $com->calificacion) }}{{ str_repeat('☆', 5 - $com->calificacion) }}
                            </span>
                        </header>
                        <p class="recent-comment-text" style="font-size: var(--text-xs); color: var(--color-text-muted); margin-bottom: 2px;">
                            En: {{ $com->producto ? $com->producto->nombre : 'Producto desconocido' }} ({{ $com->estado }})
                        </p>
                        <p class="recent-comment-text">"{{ $com->comentario }}"</p>
                    </article>
                @empty
                    <p style="padding: 15px; color: var(--color-text-muted); text-align: center;">No hay comentarios recientes.</p>
                @endforelse
            </div>
        </section>
    </div>
</x-layouts.admin-layout>
