<x-layouts.admin-layout title="Editar Usuario">
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

            <!-- Fila 1: Nombre y Apellido -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label for="nombre" class="admin-form-label">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" class="admin-form-field" placeholder="Nombre" required>
                </div>
                <div class="admin-form-group">
                    <label for="apellido" class="admin-form-label">Apellido</label>
                    <input type="text" id="apellido" name="apellido" value="{{ old('apellido', $usuario->apellido) }}" class="admin-form-field" placeholder="Apellido" required>
                </div>
            </div>

            <!-- Fila 2: Email y Contraseña -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label for="email" class="admin-form-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $usuario->email) }}" class="admin-form-field" placeholder="ejemplo@correo.com" required>
                </div>
                <div class="admin-form-group">
                    <label for="password" class="admin-form-label">Contraseña (Dejar en blanco para conservar la actual)</label>
                    <input type="password" id="password" name="password" class="admin-form-field" placeholder="Nueva contraseña (mínimo 6 caracteres)">
                </div>
            </div>

            <!-- Fila 3: Teléfono y Dirección -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label for="telefono" class="admin-form-label">Teléfono (Opcional)</label>
                    <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $usuario->telefono) }}" class="admin-form-field" placeholder="Ej. 1133445566">
                </div>
                <div class="admin-form-group">
                    <label for="direccion" class="admin-form-label">Dirección (Opcional)</label>
                    <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $usuario->direccion) }}" class="admin-form-field" placeholder="Calle, Número, Piso/Dpto">
                </div>
            </div>

            <!-- Fila 4: Provincia, Rol y Estado -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label for="provincia_id" class="admin-form-label">Provincia (Opcional)</label>
                    <select id="provincia_id" name="provincia_id" class="admin-form-field admin-form-select">
                        <option value="">Seleccione una Provincia</option>
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia->id }}" {{ old('provincia_id', $usuario->provincia_id) == $provincia->id ? 'selected' : '' }}>
                                {{ $provincia->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="admin-form-group">
                    <label for="rol" class="admin-form-label">Rol</label>
                    @if (Auth::id() === $usuario->id)
                        <input type="hidden" name="rol" value="{{ $usuario->rol }}">
                        <select id="rol" class="admin-form-field admin-form-select" disabled>
                            <option value="admin" selected>Administrador (No puedes cambiar tu propio rol)</option>
                        </select>
                    @else
                        <select id="rol" name="rol" class="admin-form-field admin-form-select" required>
                            <option value="cliente" {{ old('rol', $usuario->rol) === 'cliente' ? 'selected' : '' }}>Cliente</option>
                            <option value="admin" {{ old('rol', $usuario->rol) === 'admin' ? 'selected' : '' }}>Administrador</option>
                        </select>
                    @endif
                </div>
                <div class="admin-form-group">
                    <label for="estado" class="admin-form-label">Estado</label>
                    @if (Auth::id() === $usuario->id)
                        <input type="hidden" name="estado" value="{{ $usuario->estado }}">
                        <select id="estado" class="admin-form-field admin-form-select" disabled>
                            <option value="activo" selected>Activo (No puedes desactivar tu propia cuenta)</option>
                        </select>
                    @else
                        <select id="estado" name="estado" class="admin-form-field admin-form-select" required>
                            <option value="activo" {{ old('estado', $usuario->estado) === 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ old('estado', $usuario->estado) === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    @endif
                </div>
            </div>

            <!-- Acciones -->
            <div class="admin-form-actions">
                <a href="/admin/usuarios" class="admin-btn admin-btn-secondary">Cancelar</a>
                <button type="submit" class="admin-btn admin-btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>
</x-layouts.admin-layout>
