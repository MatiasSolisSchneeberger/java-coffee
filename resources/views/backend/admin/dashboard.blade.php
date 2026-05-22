<x-admin-layout title="Inicio Panel">
    <!-- Fila de Estadísticas -->
    <div class="admin-stats-grid">
        <x-ui.stat-card label="Total Ventas" value="$324,500.00" footer="Últimos 30 días" iconColor="primary" />

        <x-ui.stat-card class="accent-purple" label="Pedidos Pendientes" value="12" footer="Requieren atención" iconColor="secondary" />

        <x-ui.stat-card class="accent-purple" label="Consultas Activas" value="4" footer="Mensajes sin responder" iconColor="coffee" />

        <x-ui.stat-card label="Comentarios Nuevos" value="8" footer="Pendientes de moderación" iconColor="primary" />

        <x-ui.stat-card class="accent-error" label="Stock Crítico" value="3" footer="Productos con bajo stock" iconColor="primary" />
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
                        <tr>
                            <td>#1005</td>
                            <td>Carlos Rodríguez</td>
                            <td>$14,500.00</td>
                            <td>Efectivo</td>
                            <td><x-ui.status-badge status="pendiente" /></td>
                            <td>
                                <a href="/admin/pedidos"
                                    class="admin-btn admin-btn-secondary admin-btn-sm">Gestionar</a>
                            </td>
                        </tr>
                        <tr>
                            <td>#1004</td>
                            <td>María Gómez</td>
                            <td>$8,200.00</td>
                            <td>Tarjeta</td>
                            <td><x-ui.status-badge status="entregado" /></td>
                            <td>
                                <a href="/admin/pedidos"
                                    class="admin-btn admin-btn-secondary admin-btn-sm">Gestionar</a>
                            </td>
                        </tr>
                        <tr>
                            <td>#1003</td>
                            <td>Juan Pérez</td>
                            <td>$24,000.00</td>
                            <td>Transferencia</td>
                            <td><x-ui.status-badge status="enviado" /></td>
                            <td>
                                <a href="/admin/pedidos"
                                    class="admin-btn admin-btn-secondary admin-btn-sm">Gestionar</a>
                            </td>
                        </tr>
                        <tr>
                            <td>#1002</td>
                            <td>Ana López</td>
                            <td>$5,400.00</td>
                            <td>Tarjeta</td>
                            <td><x-ui.status-badge status="entregado" /></td>
                            <td>
                                <a href="/admin/pedidos"
                                    class="admin-btn admin-btn-secondary admin-btn-sm">Gestionar</a>
                            </td>
                        </tr>
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
                <article class="recent-comment-item">
                    <header class="recent-comment-header">
                        <span class="recent-comment-user">Matias Schnee</span>
                        <span class="comment-stars">★★★★★</span>
                    </header>
                    <p class="recent-comment-text">"El mejor café de especialidad que probé en Buenos Aires. Tostado
                        ideal."</p>
                </article>

                <article class="recent-comment-item">
                    <header class="recent-comment-header">
                        <span class="recent-comment-user">Laura Benítez</span>
                        <span class="comment-stars">★★★★☆</span>
                    </header>
                    <p class="recent-comment-text">"Muy rica la cafetera de prensa francesa, llegó rápido y bien
                        embalada."</p>
                </article>

                <article class="recent-comment-item">
                    <header class="recent-comment-header">
                        <span class="recent-comment-user">Esteban Quito</span>
                        <span class="comment-stars">★★★★★</span>
                    </header>
                    <p class="recent-comment-text">"Excelente la atención al cliente, me explicaron muy bien las
                        variedades."</p>
                </article>
            </div>
        </section>
    </div>
</x-admin-layout>
