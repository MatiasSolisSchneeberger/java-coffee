<x-admin-layout title="Añadir Nuevo Producto">
    <div class="admin-panel-card">
        <form action="/admin/productos" method="POST" class="admin-form" onsubmit="event.preventDefault(); alert('Simulación: Formulario de creación de producto enviado correctamente.'); window.location.href='/admin/productos';">
            @csrf

            <!-- Fila 1: Nombre y Slug -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label for="nombre" class="admin-form-label">Nombre del Producto</label>
                    <input type="text" id="nombre" name="nombre" class="admin-form-field" placeholder="Ej. Café Colombia Excelso" required>
                </div>
                <div class="admin-form-group">
                    <label for="slug" class="admin-form-label">Slug (URL del producto)</label>
                    <input type="text" id="slug" name="slug" class="admin-form-field" placeholder="Ej. cafe-colombia-excelso" required>
                </div>
            </div>

            <!-- Fila 2: Tipo, Precio y Precio de Oferta -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label for="tipo" class="admin-form-label">Categoría / Tipo</label>
                    <select id="tipo" name="tipo" class="admin-form-field admin-form-select" required>
                        <option value="">Seleccione una opción...</option>
                        <option value="Café en Grano">Café en Grano</option>
                        <option value="Cafeteras">Cafeteras</option>
                        <option value="Accesorios">Accesorios</option>
                        <option value="Merchandising">Merchandising</option>
                    </select>
                </div>
                <div class="admin-form-group">
                    <label for="precio" class="admin-form-label">Precio ($)</label>
                    <input type="number" id="precio" name="precio" step="0.01" class="admin-form-field" placeholder="8500.00" required>
                </div>
                <div class="admin-form-group">
                    <label for="oferta" class="admin-form-label">Precio Oferta ($ - Opcional)</label>
                    <input type="number" id="oferta" name="oferta" step="0.01" class="admin-form-field" placeholder="7500.00">
                </div>
            </div>

            <!-- Fila 3: Stock e Imagen -->
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label for="stock" class="admin-form-label">Stock Inicial</label>
                    <input type="number" id="stock" name="stock" class="admin-form-field" placeholder="10" required>
                </div>
                <div class="admin-form-group">
                    <label for="imagen" class="admin-form-label">Imagen de Portada (Simulación)</label>
                    <input type="file" id="imagen" name="imagen" class="admin-form-field" style="padding-top: var(--spacing-sm);">
                </div>
            </div>

            <!-- Descripciones -->
            <div class="admin-form-group">
                <label for="descripcion" class="admin-form-label">Descripción Corta</label>
                <textarea id="descripcion" name="descripcion" class="admin-form-field admin-form-textarea" placeholder="Breve resumen del producto que se muestra en el catálogo..." required></textarea>
            </div>

            <div class="admin-form-group">
                <label for="descripcion_larga" class="admin-form-label">Descripción Larga / Detalles del Producto</label>
                <textarea id="descripcion_larga" name="descripcion_larga" class="admin-form-field admin-form-textarea" placeholder="Información detallada, origen, perfil de sabor, notas de cata o características técnicas..." style="min-height: 200px;"></textarea>
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
                .replace(/\s+/g, '-')        // collapse whitespace and replace by -
                .replace(/-+/g, '-');        // collapse dashes
            document.getElementById('slug').value = slug;
        });
    </script>
</x-admin-layout>
