<x-layouts.admin-layout title="Administración de Usuarios">
    <div class="admin-panel-card">
        <!-- Toolbar con Búsqueda y Filtros -->
        <div class="admin-toolbar">
            <form action="/admin/usuarios" method="GET" style="display: flex; gap: var(--spacing-sm); flex-wrap: wrap; flex-grow: 1;">
                <div class="admin-search-wrapper" style="flex-grow: 1; min-width: 250px;">
                    <input type="text" name="buscar" value="{{ $buscar }}" class="admin-form-field" placeholder="Buscar por nombre, apellido o email...">
                </div>

                <div style="min-width: 150px;">
                    <select name="rol" class="admin-form-field admin-form-select">
                        <option value="">Todos los Roles</option>
                        <option value="admin" {{ $rol === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="cliente" {{ $rol === 'cliente' ? 'selected' : '' }}>Cliente</option>
                    </select>
                </div>

                <div style="min-width: 150px;">
                    <select name="estado" class="admin-form-field admin-form-select">
                        <option value="">Todos los Estados</option>
                        <option value="activo" {{ $estado === 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="baneado" {{ $estado === 'baneado' ? 'selected' : '' }}>Baneado</option>
                    </select>
                </div>

                <button type="submit" class="admin-btn admin-btn-secondary">
                    <x-icons.search class="icon-sm" style="margin-right: var(--spacing-sm);" /> Buscar
                </button>
                @if($buscar || $rol || $estado)
                    <a href="/admin/usuarios" class="admin-btn admin-btn-secondary" title="Limpiar filtros">Limpiar</a>
                @endif
            </form>
        </div>

        @if (session('success'))
            <div style="background-color: rgba(46, 204, 113, 0.15); color: #2ecc71; padding: var(--spacing-md); border-radius: var(--radius-md); margin-bottom: var(--spacing-md); border: 1px solid rgba(46, 204, 113, 0.3);">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="background-color: rgba(231, 76, 60, 0.15); color: #e74c3c; padding: var(--spacing-md); border-radius: var(--radius-md); margin-bottom: var(--spacing-md); border: 1px solid rgba(231, 76, 60, 0.3);">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabla de Usuarios -->
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Email</th>
                        <th>Teléfono / Dirección</th>
                        <th>Provincia</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $u)
                        <tr>
                            <td>#{{ $u->id }}</td>
                            <td><strong>{{ $u->nombre }} {{ $u->apellido }}</strong></td>
                            <td>{{ $u->email }}</td>
                            <td>
                                <span style="font-size: var(--text-xs); color: var(--color-text-muted);">
                                    {{ $u->telefono ?? 'S/T' }} <br>
                                    {{ $u->direccion ?? 'Sin Dirección' }}
                                </span>
                            </td>
                            <td>{{ $u->provincia ? $u->provincia->nombre : '-' }}</td>
                            <td>
                                <span style="font-size: var(--text-xs); font-weight: bold; text-transform: uppercase;">
                                    {{ $u->rol }}
                                </span>
                            </td>
                            <td>
                                @if ($u->estado === 'activo')
                                    <x-ui.status-badge status="entregado">Activo</x-ui.status-badge>
                                @else
                                    <x-ui.status-badge status="cancelado">Baneado</x-ui.status-badge>
                                @endif
                            </td>
                            <td>
                                <div class="admin-btn-group">
                                    <a href="/admin/usuarios/{{ $u->id }}/editar"
                                        class="admin-btn admin-btn-secondary admin-btn-sm">
                                        <x-icons.settings class="icon-xs" style="margin-right: 4px;" />
                                        Editar Estado
                                    </a>
                                    @if ($u->estado === 'activo' && Auth::id() !== $u->id)
                                        <form id="baja-form-{{ $u->id }}"
                                            action="/admin/usuarios/{{ $u->id }}/baja" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                        <x-ui.button variant="danger" size="default"
                                            onclick="confirmBaja({{ $u->id }}, '{{ addslashes($u->nombre . ' ' . $u->apellido) }}')">
                                            <x-icons.x-circle class="icon-xs" />
                                            <span>Banear</span>
                                        </x-ui.button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; color: var(--color-text-muted); padding: 15px;">
                                No se encontraron usuarios en el sistema.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script de Interacción para Confirmar Baja -->
    <script>
        function confirmBaja(userId, userName) {
            if (confirm("¿Estás seguro de que deseas banear al usuario '" + userName + "'? Su estado pasará a Baneado y no podrá iniciar sesión.")) {
                document.getElementById('baja-form-' + userId).submit();
            }
        }
    </script>
</x-layouts.admin-layout>
