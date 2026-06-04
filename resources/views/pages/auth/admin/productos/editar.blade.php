<x-layouts.admin-layout title="Editar Producto">
    <div class="admin-panel-card">
        <div class="admin-panel-card-header">
            <h2 class="admin-panel-card-title">Modificando: {{ str_replace('-', ' ', ucwords($slug ?? 'cafe-colombia-bourbon-amarillo', '-')) }}</h2>
        </div>

        <form action="/admin/productos/{{ $producto->id }}" method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf
            @method('PUT')

            <!-- Fila 1: Nombre y Slug -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label for="nombre" class="admin-form-label">Nombre del Producto</label>
                    <input type="text" id="nombre" name="nombre" class="admin-form-field" value="{{ $producto->nombre }}" required>
                </div>
                <div class="admin-form-group">
                    <label for="slug" class="admin-form-label">Slug (URL del producto)</label>
                    <input type="text" id="slug" name="slug" class="admin-form-field" value="{{ $slug }}" required>
                </div>
            </div>

            <!-- Fila 2: Categoría, Precio, Oferta y Stock -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label for="categoria_id" class="admin-form-label">Categoría</label>
                    <select id="categoria_id" name="categoria_id" class="admin-form-field admin-form-select" required>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="admin-form-group">
                    <label for="precio" class="admin-form-label">Precio ($)</label>
                    <input type="number" id="precio" name="precio" step="0.01" class="admin-form-field" value="{{ $producto->precio }}" required>
                </div>
                <div class="admin-form-group">
                    <label for="oferta" class="admin-form-label">Precio Oferta ($ - Opcional)</label>
                    <input type="number" id="oferta" name="oferta" step="0.01" class="admin-form-field" value="{{ $producto->oferta }}" placeholder="Sin oferta activa">
                </div>
                <div class="admin-form-group">
                    <label for="stock" class="admin-form-label">Stock Actual</label>
                    <input type="number" id="stock" name="stock" class="admin-form-field" value="{{ $producto->stock }}" required>
                </div>
            </div>

            <!-- Fila 3: Origen, Tueste, Peso y Estado -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label for="origen" class="admin-form-label">Origen</label>
                    <input type="text" id="origen" name="origen" class="admin-form-field" value="{{ $producto->origen ? $producto->origen->nombre : '' }}" placeholder="Ej. Colombia, Brasil">
                </div>
                <div class="admin-form-group">
                    <label for="tueste" class="admin-form-label">Tipo de Tueste / Variante</label>
                    <input type="text" id="tueste" name="tueste" class="admin-form-field" value="{{ $producto->tueste }}" placeholder="Ej. Media, Fuerte">
                </div>
                <div class="admin-form-group">
                    <label for="peso_gramos" class="admin-form-label">Peso (en gramos)</label>
                    <input type="number" id="peso_gramos" name="peso_gramos" class="admin-form-field" value="{{ $producto->peso_gramos }}" placeholder="Ej. 250, 500" required>
                </div>
                <div class="admin-form-group">
                    <label for="estado" class="admin-form-label">Estado</label>
                    <select id="estado" name="estado" class="admin-form-field admin-form-select" required>
                        <option value="activo" {{ $producto->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ $producto->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Descripciones -->
            <div class="admin-form-group">
                <label for="descripcion" class="admin-form-label">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="admin-form-field admin-form-textarea" required>{{ $producto->descripcion }}</textarea>
            </div>

            <!-- Imágenes Actuales -->
            @if(isset($producto->imagenes) && count($producto->imagenes) > 0)
                <div class="admin-form-group">
                    <label class="admin-form-label">Imágenes Actuales (Marcar para eliminar)</label>
                    <div style="display: flex; gap: var(--spacing-md); flex-wrap: wrap; margin-top: var(--spacing-sm);">
                        @foreach($producto->imagenes as $imagen)
                            <div style="border: 1px solid var(--color-border); padding: var(--spacing-xs); border-radius: var(--border-radius); text-align: center; background-color: var(--color-bg-light); display: flex; flex-direction: column; align-items: center; gap: var(--spacing-xs);">
                                <img src="/storage/productos/{{ $imagen->url }}" alt="Imagen de {{ $producto->nombre }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: var(--border-radius-sm);">
                                <label style="display: flex; align-items: center; gap: 4px; font-size: var(--text-sm); cursor: pointer; color: var(--color-error);">
                                    <input type="checkbox" name="eliminar_imagenes[]" value="{{ $imagen->id }}">
                                    <span>Eliminar</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Subir Nuevas Imágenes -->
            <div class="admin-form-group">
                <label for="imagenes" class="admin-form-label">Añadir Nuevas Imágenes</label>
                <input type="file" id="imagenes" name="imagenes[]" class="admin-form-field" accept="image/*" multiple>
                <small style="color: var(--color-text-muted); margin-top: 4px; display: block;">Puedes seleccionar múltiples imágenes para agregar al producto.</small>
            </div>

            <!-- Acciones -->
            <div class="admin-form-actions">
                <a href="/admin/productos" class="admin-btn admin-btn-secondary">Cancelar</a>
                <button type="submit" class="admin-btn admin-btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>

    <!-- Script básico para autocompletar slug -->
    <script>
        document.getElementById('nombre').addEventListener('input', function() {
            var slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-')        // collapse whitespace and replace by -
                .replace(/-+/g, '-');        // collapse dashes
            document.getElementById('slug').value = slug;
        });
    </script>
</x-layouts.admin-layout>
