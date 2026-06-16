<x-layouts.admin-layout title="Editar Estado de Usuario">
    <div class="admin-panel-card">
        <form action="/admin/usuarios/{{ $usuario->id }}" method="POST" class="admin-form">
            @csrf
            @method('PUT')

            <!-- Errores de Validación -->
            @if ($errors->any())
                <div style="background-color: rgba(231, 76, 60, 0.15); color: #e74c3c; padding: var(--spacing-md); border-radius: var(--radius-md); margin-bottom: var(--spacing-md); border: 1px solid rgba(231, 76, 60, 0.3);">
                    <ul style="margin: 0; padding-left: var(--spacing-md);">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Datos Informativos (Read-only) -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label class="admin-form-label">Nombre Completo</label>
                    <input type="text" class="admin-form-field" value="{{ $usuario->nombre }} {{ $usuario->apellido }}" style="background-color: var(--color-bg-muted); color: var(--color-text-muted);" readonly>
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Email</label>
                    <input type="email" class="admin-form-field" value="{{ $usuario->email }}" style="background-color: var(--color-bg-muted); color: var(--color-text-muted);" readonly>
                </div>
            </div>

            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label class="admin-form-label">Teléfono</label>
                    <input type="text" class="admin-form-field" value="{{ $usuario->telefono ?? 'S/T' }}" style="background-color: var(--color-bg-muted); color: var(--color-text-muted);" readonly>
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Dirección</label>
                    <input type="text" class="admin-form-field" value="{{ $usuario->direccion ?? 'Sin Dirección' }} {{ $usuario->provincia ? '(' . $usuario->provincia->nombre . ')' : '' }}" style="background-color: var(--color-bg-muted); color: var(--color-text-muted);" readonly>
                </div>
            </div>

            <!-- Fila Única Editable: Estado -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label class="admin-form-label">Rol del Usuario</label>
                    <input type="text" class="admin-form-field" value="{{ ucfirst($usuario->rol) }}" style="background-color: var(--color-bg-muted); color: var(--color-text-muted); text-transform: uppercase;" readonly>
                </div>
                <div class="admin-form-group">
                    <label for="estado" class="admin-form-label">Estado de Acceso</label>
                    @if (Auth::id() === $usuario->id)
                        <input type="hidden" name="estado" value="activo">
                        <select id="estado" class="admin-form-field admin-form-select" disabled>
                            <option value="activo" selected>Activo (No puedes auto-banearte o desactivar tu propia cuenta)</option>
                        </select>
                    @else
                        <select id="estado" name="estado" class="admin-form-field admin-form-select" required>
                            <option value="activo" {{ old('estado', $usuario->estado) === 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="baneado" {{ old('estado', $usuario->estado) === 'baneado' ? 'selected' : '' }}>Baneado</option>
                        </select>
                    @endif
                </div>
            </div>

            <!-- Acciones -->
            <div class="admin-form-actions">
                <a href="/admin/usuarios" class="admin-btn admin-btn-secondary">Cancelar</a>
                <button type="submit" class="admin-btn admin-btn-primary">Actualizar Estado</button>
            </div>
        </form>
    </div>
</x-layouts.admin-layout>
