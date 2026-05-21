<x-admin-layout title="Inicio Panel">
    <!-- Fila de Estadísticas -->
    <div class="admin-stats-grid">
        <article class="stat-card">
            <span class="stat-card-label">Total Ventas</span>
            <span class="stat-card-value">$324,500.00</span>
            <span class="stat-card-footer">Últimos 30 días</span>
        </article>

        <article class="stat-card">
            <span class="stat-card-label">Pedidos Pendientes</span>
            <span class="stat-card-value accent-purple">12</span>
            <span class="stat-card-footer">Requieren atención</span>
        </article>

        <article class="stat-card">
            <span class="stat-card-label">Consultas Activas</span>
            <span class="stat-card-value accent-purple">4</span>
            <span class="stat-card-footer">Mensajes sin responder</span>
        </article>

        <article class="stat-card">
            <span class="stat-card-label">Comentarios Nuevos</span>
            <span class="stat-card-value">8</span>
            <span class="stat-card-footer">Pendientes de moderación</span>
        </article>

        <article class="stat-card">
            <span class="stat-card-label">Stock Crítico</span>
            <span class="stat-card-value accent-error">3</span>
            <span class="stat-card-footer">Productos con bajo stock</span>
        </article>
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
                            <td><span class="admin-badge admin-badge-pending">Pendiente</span></td>
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
                            <td><span class="admin-badge admin-badge-success">Entregado</span></td>
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
                            <td><span class="admin-badge admin-badge-info">Enviado</span></td>
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
                            <td><span class="admin-badge admin-badge-success">Entregado</span></td>
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
