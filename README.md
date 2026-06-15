# Java Coffee - E-commerce de Café de Especialidad

Bienvenido al proyecto **Java Coffee**, una aplicación web e-commerce de café de especialidad desarrollada sobre **Laravel 12**. Este proyecto forma parte de las entregas prácticas para la materia **Taller de Programación I (Año 2026)**.

El sistema cuenta con un catálogo dinámico de productos, gestión de carrito de compras en tiempo real con validación de stock y precios, historial de pedidos, administración completa de productos, consultas y moderación de comentarios de clientes.

---

## 🛠️ Requisitos e Instalación Local

Sigue estos pasos para levantar el proyecto en tu entorno local:

### 1. Clonar el repositorio e instalar dependencias
```bash
# Instalar dependencias de PHP (Laravel)
composer install

# Instalar dependencias de frontend y compilar
npm install
npm run build
```

### 2. Configurar variables de entorno
Copia el archivo de configuración `.env.example` a un nuevo archivo `.env`:
```bash
cp .env.example .env
```
Genera la clave única de la aplicación:
```bash
php artisan key:generate
```

### 3. Configurar la Base de Datos
Abre el archivo `.env` en la raíz y configura tu base de datos local (MySQL/MariaDB o SQLite).

**Ejemplo de configuración SQLite (Recomendado por su simplicidad):**
```env
DB_CONNECTION=sqlite
# Nota: Laravel creará automáticamente database/database.sqlite si no existe al migrar.
```

### 4. Correr las migraciones y seeders
Ejecuta las migraciones para crear la estructura de tablas y siembra los datos iniciales de prueba (provincias, productos con imágenes, usuarios de prueba, pedidos, consultas y comentarios):
```bash
php artisan migrate --seed
```

### 5. Iniciar el servidor local
Levanta el servidor de desarrollo de Laravel:
```bash
php artisan serve
```
La aplicación estará disponible en [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## 👥 Cuentas de Prueba Pre-sembradas

El seeder inicial genera las siguientes credenciales para probar los diferentes roles del sistema:

*   **Administrador:**
    *   **Email:** `admin@javacoffee.com`
    *   **Contraseña:** `admin123`
*   **Cliente Común (con carrito y favoritos):**
    *   **Email:** `juan@cliente.com`
    *   **Contraseña:** `cliente123`
*   **Cliente con historial de pedidos:**
    *   **Email:** `ana.pedidos@cliente.com`
    *   **Contraseña:** `cliente123`

---

## 📘 Documentación Adicional

Para ver la documentación completa y detallada de la arquitectura de la aplicación, el esquema de base de datos e instrucciones detalladas, consulta:

*   [Documentación de Arquitectura y Base de Datos](file:///C:/Users/Matia/OneDrive/Documents/Facultad/3er%20A%C3%B1o/1er%20Cuatrimestre/Taller-de-Programacion-I/Practica/java-coffee/.docs/documentacion_sistema.md)
*   [Listado de Tareas Pendientes para Desarrollo](file:///C:/Users/Matia/OneDrive/Documents/Facultad/3er%20A%C3%B1o/1er%20Cuatrimestre/Taller-de-Programacion-I/Practica/java-coffee/tareas_pendientes.md)
*   [Reglas de Negocio, Autenticación y Vistas](file:///C:/Users/Matia/OneDrive/Documents/Facultad/3er%20A%C3%B1o/1er%20Cuatrimestre/Taller-de-Programacion-I/Practica/java-coffee/.docs/contexto-auth.md)
*   [Trabajo Práctico: Migraciones, Modelos y Controladores](file:///C:/Users/Matia/OneDrive/Documents/Facultad/3er%20A%C3%B1o/1er%20Cuatrimestre/Taller-de-Programacion-I/Practica/java-coffee/.docs/Migrations%20%C2%B7%20Models%20%C2%B7%20Controllers%20%C2%B7%20Git.md)
