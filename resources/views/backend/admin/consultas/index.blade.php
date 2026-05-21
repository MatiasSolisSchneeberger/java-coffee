<x-admin-layout title="Consultas y Mensajes">
    <div class="admin-panel-card">
        <div class="admin-panel-card-header">
            <h2 class="admin-panel-card-title">Consultas de Clientes</h2>
            <div class="admin-search-wrapper" style="max-width: 300px;">
                <select class="admin-form-field admin-form-select" onchange="filterQueries(this.value)">
                    <option value="todas">Todas las consultas</option>
                    <option value="pendientes">Pendientes</option>
                    <option value="respondidas">Respondidas</option>
                </select>
            </div>
        </div>

        <div class="admin-queries-list">
            <!-- Consulta 1 (Pendiente) -->
            <article class="query-card">
                <div class="query-card-header" onclick="toggleQueryBody(1)">
                    <div class="query-info">
                        <span class="query-user">Lucía Fernández</span>
                        <span class="query-meta">l.fernandez@email.com — Asunto: Consulta sobre envíos al interior</span>
                    </div>
                    <div class="admin-btn-group">
                        <span class="admin-badge admin-badge-pending">Pendiente</span>
                        <span class="nav-icon" id="arrow-1">></span>
                    </div>
                </div>
                <div class="query-card-body" id="query-body-1" style="display: block;">
                    <p class="query-message-text">
                        "Hola, buenas tardes. Quería saber si realizan envíos de café en grano a la provincia de Córdoba y cuál es el costo aproximado por un pedido de 2 kilos. Muchas gracias."
                    </p>
                    <div class="query-response-section">
                        <h3 class="query-response-title">Responder Consulta</h3>
                        <form action="#" method="POST" class="admin-form" onsubmit="event.preventDefault(); submitResponse(1);">
                            @csrf
                            <div class="admin-form-group">
                                <label for="respuesta-1" class="admin-form-label">Mensaje de Respuesta</label>
                                <textarea id="respuesta-1" class="admin-form-field admin-form-textarea" placeholder="Escribe aquí tu respuesta para Lucía..." required></textarea>
                            </div>
                            <div class="admin-form-actions" style="margin-top: 10px; padding-top: 10px;">
                                <button type="submit" class="admin-btn admin-btn-primary admin-btn-sm">Enviar Respuesta por Email</button>
                            </div>
                        </form>
                    </div>
                </div>
            </article>

            <!-- Consulta 2 (Respondida) -->
            <article class="query-card">
                <div class="query-card-header" onclick="toggleQueryBody(2)">
                    <div class="query-info">
                        <span class="query-user">Martín Altieri</span>
                        <span class="query-meta">martin.altieri@email.com — Asunto: Stock de molinillo eléctrico</span>
                    </div>
                    <div class="admin-btn-group">
                        <span class="admin-badge admin-badge-success">Respondido</span>
                        <span class="nav-icon" id="arrow-2">></span>
                    </div>
                </div>
                <div class="query-card-body" id="query-body-2" style="display: none;">
                    <p class="query-message-text">
                        "Buenas, quería consultar cuándo vuelve a entrar stock del molinillo eléctrico de muelas cerámicas. Quería comprar uno para regalar."
                    </p>
                    <div class="query-response-section" style="border-left: 2px solid var(--color-success); background-color: rgba(34, 197, 94, 0.03);">
                        <h3 class="query-response-title" style="color: var(--color-success);">Respuesta Enviada</h3>
                        <p style="font-size: var(--text-sm); line-height: 1.5; margin: 0; color: var(--color-text-muted);">
                            "Hola Martín, ¿cómo estás? Estimamos el reingreso de los molinillos para la primera semana del próximo mes. Te sugerimos activar la alerta de stock para recibir una notificación apenas estén disponibles. Saludos!"
                        </p>
                        <div style="font-size: var(--text-xs); color: var(--color-text-muted); margin-top: 8px;">
                            Enviado por: Administrador — Fecha: 2026-05-18
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>

    <script>
        function toggleQueryBody(id) {
            var body = document.getElementById('query-body-' + id);
            var arrow = document.getElementById('arrow-' + id);
            if (body.style.display === 'none') {
                body.style.display = 'block';
                arrow.style.transform = 'rotate(90deg)';
                arrow.style.display = 'inline-block';
            } else {
                body.style.display = 'none';
                arrow.style.transform = 'rotate(0deg)';
            }
        }

        function submitResponse(id) {
            var textarea = document.getElementById('respuesta-' + id);
            alert("Simulación: Respuesta enviada por correo electrónico:\n\n\"" + textarea.value + "\"");
            textarea.value = "";
            // Simular cambio de estado visual
            var card = textarea.closest('.query-card');
            var badge = card.querySelector('.admin-badge');
            badge.className = 'admin-badge admin-badge-success';
            badge.textContent = 'Respondido';
            toggleQueryBody(id);
        }

        function filterQueries(value) {
            alert("Simulación: Filtrando consultas por estado '" + value.toUpperCase() + "'.");
        }
    </script>
</x-admin-layout>
