<x-layouts.admin-layout title="Consultas y Mensajes">
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
            @forelse ($consultas as $consulta)
                <article class="query-card">
                    <div class="query-card-header" onclick="toggleQueryBody({{ $consulta->id }})">
                        <div class="query-info">
                            <span class="query-user">{{ $consulta->nombre }}</span>
                            <span class="query-meta">{{ $consulta->email }} — Asunto: {{ $consulta->asunto }}</span>
                        </div>
                        <div class="admin-btn-group">
                            @if ($consulta->estado === 'respondido')
                                <x-ui.status-badge status="entregado">Respondido</x-ui.status-badge>
                            @else
                                <x-ui.status-badge status="pendiente">Pendiente</x-ui.status-badge>
                            @endif
                            <span class="nav-icon" id="arrow-{{ $consulta->id }}">></span>
                        </div>
                    </div>
                    <div class="query-card-body" id="query-body-{{ $consulta->id }}" style="display: none;">
                        <p class="query-message-text">
                            "{{ $consulta->mensaje }}"
                        </p>
                        @if ($consulta->estado === 'respondido')
                            <div class="query-response-section" style="border-left: 2px solid var(--color-success); background-color: rgba(34, 197, 94, 0.03);">
                                <h3 class="query-response-title" style="color: var(--color-success);">Respuesta Enviada</h3>
                                <p style="font-size: var(--text-sm); line-height: 1.5; margin: 0; color: var(--color-text-muted);">
                                    "{{ $consulta->respuesta }}"
                                </p>
                                <div style="font-size: var(--text-xs); color: var(--color-text-muted); margin-top: 8px;">
                                     Enviado por: Administrador — Fecha: {{ $consulta->updated_at ? $consulta->updated_at->format('Y-m-d') : 'Reciente' }}
                                </div>
                            </div>
                        @else
                            <div class="query-response-section">
                                <h3 class="query-response-title">Responder Consulta</h3>
                                <form action="#" method="POST" class="admin-form" onsubmit="event.preventDefault(); submitResponse({{ $consulta->id }});">
                                    @csrf
                                    <div class="admin-form-group">
                                        <label for="respuesta-{{ $consulta->id }}" class="admin-form-label">Mensaje de Respuesta</label>
                                        <textarea id="respuesta-{{ $consulta->id }}" class="admin-form-field admin-form-textarea" placeholder="Escribe aquí tu respuesta para {{ $consulta->nombre }}..." required></textarea>
                                    </div>
                                    <div class="admin-form-actions" style="margin-top: 10px; padding-top: 10px;">
                                        <button type="submit" class="admin-btn admin-btn-primary admin-btn-sm">Enviar Respuesta por Email</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </article>
            @empty
                <p style="padding: 20px; color: var(--color-text-muted); text-align: center;">No hay consultas recibidas.</p>
            @endforelse
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
            var respuestaTexto = textarea.value;

            fetch(`/admin/consultas/${id}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    estado: 'respondido',
                    respuesta: respuestaTexto
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('Ocurrió un inconveniente al responder la consulta.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error de conexión con el servidor.');
            });
        }

        function filterQueries(value) {
            alert("Simulación: Filtrando consultas por estado '" + value.toUpperCase() + "'.");
        }
    </script>
</x-layouts.admin-layout>
