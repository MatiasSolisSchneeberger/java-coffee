<x-admin-layout title="Editar Producto">
    <div class="admin-panel-card">
        <div class="admin-panel-card-header">
            <h2 class="admin-panel-card-title">Modificando: {{ str_replace('-', ' ', ucwords($slug ?? 'cafe-colombia-bourbon-amarillo', '-')) }}</h2>
        </div>

        <form action="/admin/productos" method="POST" class="admin-form" onsubmit="event.preventDefault(); alert('Simulación: Cambios del producto guardados correctamente.'); window.location.href='/admin/productos';">
            @csrf
            @method('PUT')

            <!-- Fila 1: Nombre y Slug -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label for="nombre" class="admin-form-label">Nombre del Producto</label>
                    <input type="text" id="nombre" name="nombre" class="admin-form-field" value="Café Colombia Bourbon Amarillo" required>
                </div>
                <div class="admin-form-group">
                    <label for="slug" class="admin-form-label">Slug (URL del producto)</label>
                    <input type="text" id="slug" name="slug" class="admin-form-field" value="{{ $slug ?? 'cafe-colombia-bourbon-amarillo' }}" required>
                </div>
            </div>

            <!-- Fila 2: Tipo, Precio y Precio de Oferta -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label for="tipo" class="admin-form-label">Categoría / Tipo</label>
                    <select id="tipo" name="tipo" class="admin-form-field admin-form-select" required>
                        <option value="Café en Grano" selected>Café en Grano</option>
                        <option value="Cafeteras">Cafeteras</option>
                        <option value="Accesorios">Accesorios</option>
                        <option value="Merchandising">Merchandising</option>
                    </select>
                </div>
                <div class="admin-form-group">
                    <label for="precio" class="admin-form-label">Precio ($)</label>
                    <input type="number" id="precio" name="precio" step="0.01" class="admin-form-field" value="8500.00" required>
                </div>
                <div class="admin-form-group">
                    <label for="oferta" class="admin-form-label">Precio Oferta ($ - Opcional)</label>
                    <input type="number" id="oferta" name="oferta" step="0.01" class="admin-form-field" value="" placeholder="Sin oferta activa">
                </div>
            </div>

            <!-- Fila 3: Stock e Imagen -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label for="stock" class="admin-form-label">Stock Actual</label>
                    <input type="number" id="stock" name="stock" class="admin-form-field" value="24" required>
                </div>
                <div class="admin-form-group">
                    <label for="imagen" class="admin-form-label">Cambiar Imagen de Portada (Simulación)</label>
                    <input type="file" id="imagen" name="imagen" class="admin-form-field" style="padding-top: var(--spacing-sm);">
                </div>
            </div>

            <!-- Descripciones -->
            <div class="admin-form-group">
                <label for="descripcion" class="admin-form-label">Descripción Corta</label>
                <textarea id="descripcion" name="descripcion" class="admin-form-field admin-form-textarea" required>Variedad Bourbon Amarillo cultivada en las alturas de Colombia. Perfil de taza dulce y notas frutales intensas.</textarea>
            </div>

            <div class="admin-form-group">
                <label for="descripcion_larga" class="admin-form-label">Descripción Larga / Detalles del Producto</label>
                <textarea id="descripcion_larga" name="descripcion_larga" class="admin-form-field admin-form-textarea" style="min-height: 200px;">Este café proviene de la finca La Esperanza, en la región de Antioquia, Colombia. Cultivado a 1800 metros sobre el nivel del mar, es cosechado a mano en su punto óptimo de maduración. El proceso de lavado resalta su acidez brillante y cuerpo sedoso. Posee notas de cata a chocolate con leche, caramelo y un postgusto prolongado a cítricos dulces como mandarina y durazno.</textarea>
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
</x-admin-layout>
