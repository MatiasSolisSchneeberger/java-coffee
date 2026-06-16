# Reporte de Pendientes: Sistema de Calificaciones y Comentarios

Este reporte detalla lo que se ha implementado de la funcionalidad de comentarios en los productos (incluyendo los cambios provistos por tu compañero) y las partes esenciales que aún **faltan desarrollar** para completar los requerimientos del proyecto.

---

## 1. Cambios Integrados Correctamente (De tu compañero)

Se incorporaron los cambios enviados en el archivo `cambios-compa.md`:
* **Ruta de Envío:** Se agregó en [web.php](file:///c:/Users/Matia/OneDrive/Documents/Facultad/3er%20A%C3%B1o/1er%20Cuatrimestre/Taller-de-Programacion-I/Practica/java-coffee/routes/web.php) la ruta `POST /producto/{slug}/calificar` dentro del grupo de middleware de clientes autenticados.
* **Controlador de Guardado:** Se añadió el método `storeComment` en [ProductoController.php](file:///c:/Users/Matia/OneDrive/Documents/Facultad/3er%20A%C3%B1o/1er%20Cuatrimestre/Taller-de-Programacion-I/Practica/java-coffee/app/Http/Controllers/ProductoController.php), el cual valida el input (`rating` y `comentario`), busca el producto por slug y registra el comentario con estado `'pendiente'` asociado al usuario autenticado.

---

## 2. Lo Que Falta Implementar (Tareas Pendientes)

### A. Gestión de Comentarios por el Cliente (Dashboard `/cliente`)
El cliente debe poder gestionar sus propias opiniones, pero actualmente no hay soporte para esto en el frontend ni en el backend:

1. **Pasar comentarios a la vista:** En [ClienteController.php](file:///c:/Users/Matia/OneDrive/Documents/Facultad/3er%20A%C3%B1o/1er%20Cuatrimestre/Taller-de-Programacion-I/Practica/java-coffee/app/Http/Controllers/ClienteController.php), dentro del método `index`, falta consultar los comentarios del usuario logueado e incluirlos en el `compact` enviado a la vista:
   ```php
   $comentarios = \App\Models\Comentario::where('usuario_id', $usuario->id)
       ->with('producto')
       ->latest()
       ->get();
   ```
2. **Interfaz de usuario (Tab de Comentarios):** En la vista del cliente [cliente.blade.php](file:///c:/Users/Matia/OneDrive/Documents/Facultad/3er%20A%C3%B1o/1er%20Cuatrimestre/Taller-de-Programacion-I/Practica/java-coffee/resources/views/pages/auth/cliente.blade.php) falta:
   * Agregar un botón en la barra lateral de navegación para "Mis Comentarios/Calificaciones" (con su respectivo ícono y contador).
   * Crear la sección `<section class="dashboard-tab-content" id="tab-comentarios">` para listar los comentarios del cliente, mostrando el producto calificado, las estrellas, el texto, la fecha, el estado de moderación (`pendiente`, `aprobado`, `rechazado`) y los botones de acción para **Editar** y **Eliminar**.
3. **Rutas y Métodos de Edición/Eliminación:**
   * En `routes/web.php` faltan las rutas para que el cliente actualice o borre sus opiniones:
     * `PUT /cliente/comentarios/{id}`
     * `DELETE /cliente/comentarios/{id}`
   * En `ClienteController.php` (u otro controlador) faltan los métodos correspondientes que validen que el comentario pertenezca al usuario autenticado antes de modificarlo o eliminarlo de la base de datos.

### B. Funcionalidades del Administrador (Moderación Real en `/admin/comentarios`)
Actualmente, la vista de administración está simulada con JavaScript en el navegador. Falta la lógica real del lado del servidor:

1. **Rutas de Moderación:** En `routes/web.php` (dentro del grupo de admin) faltan rutas reales para:
   * Aprobar un comentario (actualizar `estado = 'aprobado'`).
   * Rechazar/Eliminar un comentario.
   * Filtrar por estado (`pendiente`, `aprobado`, `todos`) de manera dinámica mediante base de datos.
2. **Controlador del Administrador:** Se requiere un controlador o funciones de cierre (closures) reales en las rutas para procesar estas solicitudes en la base de datos, en lugar de los `alert()` de simulación javascript en [index.blade.php](file:///c:/Users/Matia/OneDrive/Documents/Facultad/3er%20A%C3%B1o/1er%20Cuatrimestre/Taller-de-Programacion-I/Practica/java-coffee/resources/views/pages/auth/admin/comentarios/index.blade.php).
3. **Peticiones AJAX/Fetch:** Reemplazar las funciones javascript simuladas `approveComment` y `deleteComment` en la vista de administración por llamadas `fetch()` reales a las rutas del backend que actualicen la interfaz una vez confirmada la base de datos.

### C. Ajuste Visual en la Vista del Producto
* **Mostrar Autor:** En la vista de detalle del producto [[producto].blade.php](file:///c:/Users/Matia/OneDrive/Documents/Facultad/3er%20A%C3%B1o/1er%20Cuatrimestre/Taller-de-Programacion-I/Practica/java-coffee/resources/views/pages/frontend/%5Bproducto%5D.blade.php) en el bucle `@foreach ($comentarios as $com)` se omitió renderizar el nombre del usuario (`$com['usuario_nombre']`). Debajo o al lado de la fecha debería aparecer el autor del comentario.
