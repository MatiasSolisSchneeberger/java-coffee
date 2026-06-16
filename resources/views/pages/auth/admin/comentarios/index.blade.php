<x-layouts.admin-layout title="Moderación de Comentarios">
    <div class="admin-panel-card">
        <div class="admin-panel-card-header">
            <h2 class="admin-panel-card-title">Comentarios y Calificaciones</h2>
            <div class="admin-search-wrapper" style="max-width: 300px;">
                <select class="admin-form-field admin-form-select" onchange="filterComments(this.value)">
                    <option value="todos" {{ ($estado ?? 'todos') === 'todos' ? 'selected' : '' }}>Todos los comentarios</option>
                    <option value="pendientes" {{ ($estado ?? '') === 'pendientes' ? 'selected' : '' }}>Pendientes de Moderación</option>
                    <option value="aprobados" {{ ($estado ?? '') === 'aprobados' ? 'selected' : '' }}>Aprobados</option>
                    <option value="rechazados" {{ ($estado ?? '') === 'rechazados' ? 'selected' : '' }}>Rechazados</option>
                </select>
            </div>
        </div>

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Producto</th>
                        <th>Calificación</th>
                        <th>Comentario</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Comentario 1 (Aprobado) -->
                    @forelse ($comentarios as $com)
                        <tr id="comment-row-{{ $com->id }}">
                            <td>
                                <strong>{{ $com->usuario ? ($com->usuario->nombre . ' ' . $com->usuario->apellido) : 'Anónimo' }}</strong><br>
                                <span style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ $com->usuario ? $com->usuario->email : '-' }}</span>
                            </td>
                            <td>
                                @if ($com->producto)
                                    <a href="/producto/{{ \Illuminate\Support\Str::slug($com->producto->nombre) }}" target="_blank" style="color: var(--color-primary); text-decoration: none;">{{ $com->producto->nombre }}</a>
                                @else
                                    <span style="color: var(--color-text-muted);">Producto Eliminado</span>
                                @endif
                            </td>
                            <td>
                                <span class="comment-stars" style="color: var(--color-primary);">
                                    {{ str_repeat('★', $com->calificacion) }}{{ str_repeat('☆', 5 - $com->calificacion) }}
                                </span>
                            </td>
                            <td>
                                <span style="font-size: var(--text-sm);">"{{ $com->comentario }}"</span>
                            </td>
                            <td>{{ $com->created_at ? $com->created_at->format('Y-m-d') : 'Reciente' }}</td>
                            <td>
                                @if ($com->estado === 'aprobado')
                                    <x-ui.status-badge status="entregado" id="comment-badge-{{ $com->id }}">Aprobado</x-ui.status-badge>
                                @elseif ($com->estado === 'pendiente')
                                    <x-ui.status-badge status="pendiente" id="comment-badge-{{ $com->id }}">Pendiente</x-ui.status-badge>
                                @else
                                    <x-ui.status-badge status="cancelado" id="comment-badge-{{ $com->id }}">Rechazado</x-ui.status-badge>
                                @endif
                            </td>
                            <td>
                                <div class="admin-btn-group">
                                    <button class="admin-btn admin-btn-primary admin-btn-sm" id="approve-btn-{{ $com->id }}" style="display: {{ $com->estado === 'pendiente' ? 'inline-block' : 'none' }};" onclick="approveComment({{ $com->id }})">Aprobar</button>
                                    <button class="admin-btn admin-btn-danger admin-btn-sm" onclick="deleteComment({{ $com->id }})">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; color: var(--color-text-muted); padding: 15px;">No hay comentarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function approveComment(id) {
            fetch(`/admin/comentarios/${id}/aprobar`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    // Actualizar interfaz visual
                    var badge = document.getElementById('comment-badge-' + id);
                    if (badge) {
                        badge.className = 'status-badge status-success';
                        badge.textContent = 'Aprobado';
                    }
                    
                    var approveBtn = document.getElementById('approve-btn-' + id);
                    if (approveBtn) approveBtn.style.display = 'none';
                } else {
                    alert('Error al aprobar el comentario.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error de conexión con el servidor.');
            });
        }

        function deleteComment(id) {
            if (confirm("¿Estás seguro de que deseas eliminar permanentemente este comentario?")) {
                fetch(`/admin/comentarios/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        var row = document.getElementById('comment-row-' + id);
                        if (row) {
                            row.style.opacity = '0.3';
                            var actionsGroup = row.querySelector('.admin-btn-group');
                            if (actionsGroup) {
                                actionsGroup.innerHTML = '<span style="font-size:var(--text-xs); color:var(--color-error)">Eliminado</span>';
                            }
                        }
                    } else {
                        alert('Error al eliminar el comentario.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error de conexión con el servidor.');
                });
            }
        }

        function filterComments(value) {
            window.location.href = '/admin/comentarios?estado=' + value;
        }
    </script>
</x-layouts.admin-layout>
