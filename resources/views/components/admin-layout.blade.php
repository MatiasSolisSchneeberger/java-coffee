@props(['title' => null])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ !empty($title) ? "$title | Java Coffee Admin" : 'Java Coffee Admin' }}</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/favicon.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body class="cascadia-mono-400 admin-body">
    <div class="admin-wrapper">
        <!-- Sidebar Izquierdo -->
        <aside class="admin-sidebar">
            <div class="admin-brand">
                <span class="brand-text">JAVA_COFFEE</span>
                <span class="brand-subtext">// ADMIN_PANEL</span>
            </div>

            <nav class="admin-nav">
                <ul class="admin-nav-list">
                    <li>
                        <a href="/admin" class="admin-nav-link {{ request()->is('admin') ? 'active' : '' }}">
                            <span class="nav-icon">></span> Inicio
                        </a>
                    </li>
                    <li>
                        <a href="/admin/productos"
                            class="admin-nav-link {{ request()->is('admin/productos*') || request()->is('admin/producto*') ? 'active' : '' }}">
                            <span class="nav-icon">></span> Productos
                        </a>
                    </li>
                    <li>
                        <a href="/admin/pedidos"
                            class="admin-nav-link {{ request()->is('admin/pedidos*') ? 'active' : '' }}">
                            <span class="nav-icon">></span> Pedidos
                        </a>
                    </li>
                    <li>
                        <a href="/admin/consultas"
                            class="admin-nav-link {{ request()->is('admin/consultas*') ? 'active' : '' }}">
                            <span class="nav-icon">></span> Consultas
                        </a>
                    </li>
                    <li>
                        <a href="/admin/comentarios"
                            class="admin-nav-link {{ request()->is('admin/comentarios*') ? 'active' : '' }}">
                            <span class="nav-icon">></span> Comentarios
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="admin-sidebar-footer">
                <a href="/" class="store-link">
                    <span class="nav-icon">&lt;</span> Volver a la Tienda
                </a>
                <form action="/logout" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </aside>

        <!-- Contenedor Principal Derecho -->
        <div class="admin-main">
            <!-- Header Superior -->
            <header class="admin-header">
                <div class="admin-header-title">
                    <h1>{{ $title ?? 'Panel de Administración' }}</h1>
                </div>
                <div class="admin-user-profile">
                    @auth
                        <span class="user-status-dot"></span>
                        <span class="user-name">{{ auth()->user()->nombre }} {{ auth()->user()->apellido }}</span>
                        <span class="user-role">(Admin)</span>
                    @else
                        <span class="user-status-dot offline"></span>
                        <span class="user-name">Administrador</span>
                    @endauth
                </div>
            </header>

            <!-- Contenido Dinámico -->
            <main class="admin-content-area">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script type="module" src="{{ asset('js/index.js') }}"></script>
</body>

</html>
