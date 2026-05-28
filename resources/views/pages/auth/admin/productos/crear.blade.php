<x-layouts.admin-layout title="Añadir Nuevo Producto">
    <div class="admin-panel-card">
        <form action="/admin/productos" method="POST" class="admin-form">
            @csrf

            <!-- Fila 1: Nombre y Slug -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label for="nombre" class="admin-form-label">Nombre del Producto</label>
                    <input type="text" id="nombre" name="nombre" class="admin-form-field"
                        placeholder="Ej. Café Colombia Excelso" required>
                </div>
                <div class="admin-form-group">
                    <label for="slug" class="admin-form-label">Slug (URL del producto)</label>
                    <input type="text" id="slug" name="slug" class="admin-form-field"
                        placeholder="Ej. cafe-colombia-excelso" required>
                </div>
            </div>

            <!-- Fila 2: Categoría, Precio, Oferta y Stock -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label for="categoria_id" class="admin-form-label">Categoría</label>
                    <select id="categoria_id" name="categoria_id" class="admin-form-field admin-form-select" required>
                        <option value="">Seleccione una opción</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="admin-form-group">
                    <label for="precio" class="admin-form-label">Precio ($)</label>
                    <input type="number" id="precio" name="precio" step="0.01" class="admin-form-field"
                        placeholder="0.00" required>
                </div>
                <div class="admin-form-group">
                    <label for="oferta" class="admin-form-label">Precio Oferta ($ - Opcional)</label>
                    <input type="number" id="oferta" name="oferta" step="0.01" class="admin-form-field"
                        placeholder="0.00">
                </div>
                <div class="admin-form-group">
                    <label for="stock" class="admin-form-label">Stock</label>
                    <input type="number" id="stock" name="stock" class="admin-form-field" placeholder="0" required>
                </div>
            </div>

            <!-- Fila 3: Origen, Tueste y Peso -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label for="origen" class="admin-form-label">Origen</label>
                    <input type="text" id="origen" name="origen" class="admin-form-field" placeholder="Ej. Colombia, Brasil">
                </div>
                <div class="admin-form-group">
                    <label for="tueste" class="admin-form-label">Tipo de Tueste / Variante</label>
                    <input type="text" id="tueste" name="tueste" class="admin-form-field" placeholder="Ej. Media, Fuerte">
                </div>
                <div class="admin-form-group">
                    <label for="peso_gramos" class="admin-form-label">Peso (en gramos)</label>
                    <input type="number" id="peso_gramos" name="peso_gramos" class="admin-form-field" placeholder="Ej. 250, 500" required>
                </div>
            </div>

            <!-- Descripción -->
            <div class="admin-form-group">
                <label for="descripcion" class="admin-form-label">Descripción Corta</label>
                <textarea id="descripcion" name="descripcion" class="admin-form-field admin-form-textarea"
                    placeholder="Breve resumen del producto que se muestra en el catálogo..." required></textarea>
            </div>

            <!-- Acciones -->
            <div class="admin-form-actions">
                <a href="/admin/productos" class="admin-btn admin-btn-secondary">Cancelar</a>
                <button type="submit" class="admin-btn admin-btn-primary">Guardar Producto</button>
            </div>
        </form>
    </div>

    <!-- Script básico para autocompletar slug -->
    <script>
        document.getElementById('nombre').addEventListener('input', function() {
            var slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes
            document.getElementById('slug').value = slug;
        });
    </script>
</x-layouts.admin-layout>
