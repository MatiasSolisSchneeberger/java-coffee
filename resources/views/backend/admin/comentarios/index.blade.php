<x-admin-layout title="Moderación de Comentarios">
    <div class="admin-panel-card">
        <div class="admin-panel-card-header">
            <h2 class="admin-panel-card-title">Comentarios y Calificaciones</h2>
            <div class="admin-search-wrapper" style="max-width: 300px;">
                <select class="admin-form-field admin-form-select" onchange="filterComments(this.value)">
                    <option value="todos">Todos los comentarios</option>
                    <option value="pendientes">Pendientes de Moderación</option>
                    <option value="aprobados">Aprobados</option>
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
                    <tr id="comment-row-1">
                        <td>
                            <strong>Matias Schnee</strong><br>
                            <span style="font-size: var(--text-xs); color: var(--color-text-muted);">matias@email.com</span>
                        </td>
                        <td>
                            <a href="/producto/cafe-colombia-bourbon-amarillo" target="_blank" style="color: var(--color-primary); text-decoration: none;">Café Colombia Bourbon</a>
                        </td>
                        <td>
                            <span class="comment-stars">★★★★★</span>
                        </td>
                        <td>
                            <span style="font-size: var(--text-sm);">"El mejor café de especialidad que probé en Buenos Aires. Tostado ideal."</span>
                        </td>
                        <td>2026-05-20</td>
                        <td>
                            <span class="admin-badge admin-badge-success" id="comment-badge-1">Aprobado</span>
                        </td>
                        <td>
                            <div class="admin-btn-group">
                                <button class="admin-btn admin-btn-secondary admin-btn-sm" id="approve-btn-1" style="display: none;" onclick="approveComment(1)">Aprobar</button>
                                <button class="admin-btn admin-btn-danger admin-btn-sm" onclick="deleteComment(1)">Eliminar</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Comentario 2 (Pendiente) -->
                    <tr id="comment-row-2">
                        <td>
                            <strong>Nico López</strong><br>
                            <span style="font-size: var(--text-xs); color: var(--color-text-muted);">nico.l@email.com</span>
                        </td>
                        <td>
                            <a href="/producto/cafetera-italiana-volturno-6-pocillos" target="_blank" style="color: var(--color-primary); text-decoration: none;">Cafetera Italiana Volturno</a>
                        </td>
                        <td>
                            <span class="comment-stars" style="color: var(--color-text-muted);">★★☆☆☆</span>
                        </td>
                        <td>
                            <span style="font-size: var(--text-sm); font-style: italic;">"La cafetera hace rico café, pero el empaque vino algo golpeado. Deberían proteger mejor los envíos."</span>
                        </td>
                        <td>2026-05-19</td>
                        <td>
                            <span class="admin-badge admin-badge-pending" id="comment-badge-2">Pendiente</span>
                        </td>
                        <td>
                            <div class="admin-btn-group">
                                <button class="admin-btn admin-btn-primary admin-btn-sm" id="approve-btn-2" onclick="approveComment(2)">Aprobar</button>
                                <button class="admin-btn admin-btn-danger admin-btn-sm" onclick="deleteComment(2)">Eliminar</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Comentario 3 (Aprobado) -->
                    <tr id="comment-row-3">
                        <td>
                            <strong>Laura Benítez</strong><br>
                            <span style="font-size: var(--text-xs); color: var(--color-text-muted);">laura.b@email.com</span>
                        </td>
                        <td>
                            <a href="/producto/taza-ceramica-termica-java-coffee" target="_blank" style="color: var(--color-primary); text-decoration: none;">Taza Térmica Java</a>
                        </td>
                        <td>
                            <span class="comment-stars">★★★★☆</span>
                        </td>
                        <td>
                            <span style="font-size: var(--text-sm);">"Muy linda taza, mantiene el calor por bastante tiempo. Diseño cyberpunk de 10."</span>
                        </td>
                        <td>2026-05-18</td>
                        <td>
                            <span class="admin-badge admin-badge-success" id="comment-badge-3">Aprobado</span>
                        </td>
                        <td>
                            <div class="admin-btn-group">
                                <button class="admin-btn admin-btn-secondary admin-btn-sm" id="approve-btn-3" style="display: none;" onclick="approveComment(3)">Aprobar</button>
                                <button class="admin-btn admin-btn-danger admin-btn-sm" onclick="deleteComment(3)">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function approveComment(id) {
            alert("Simulación: Comentario #" + id + " aprobado con éxito. Ahora es visible públicamente.");
            // Actualizar interfaz visual
            var badge = document.getElementById('comment-badge-' + id);
            badge.className = 'admin-badge admin-badge-success';
            badge.textContent = 'Aprobado';
            
            var approveBtn = document.getElementById('approve-btn-' + id);
            approveBtn.style.display = 'none';
        }

        function deleteComment(id) {
            if (confirm("¿Estás seguro de que deseas eliminar o rechazar este comentario?")) {
                alert("Simulación: Comentario #" + id + " eliminado.");
                var row = document.getElementById('comment-row-' + id);
                row.style.opacity = '0.3';
                row.querySelector('.admin-btn-group').innerHTML = '<span style="font-size:var(--text-xs); color:var(--color-error)">Eliminado</span>';
            }
        }

        function filterComments(value) {
            alert("Simulación: Filtrando opiniones por estado '" + value.toUpperCase() + "'.");
        }
    </script>
</x-admin-layout>
