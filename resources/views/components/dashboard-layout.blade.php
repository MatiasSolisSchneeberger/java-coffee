@props(['title' => null, 'type' => 'client'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ !empty($title) ? "$title | Java Coffee " . ($type === 'admin' ? 'Admin' : 'Dashboard') : 'Java Coffee' }}</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/favicon.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @endif
</head>

<body class="cascadia-mono-400 {{ $type === 'admin' ? 'admin-body' : '' }}">
    <div {{ $attributes->merge(['class' => 'dashboard-layout-container ' . ($type === 'admin' ? 'layout-admin' : 'layout-client')]) }}>
        
        <!-- Mobile Top Header Bar -->
        <header class="dashboard-mobile-header">
            <div class="mobile-header-brand">
                @if ($type === 'admin')
                    <span class="mobile-brand-text">JAVA_COFFEE <span class="mobile-brand-tag">// ADMIN</span></span>
                @else
                    <span class="mobile-brand-text">JAVA_COFFEE <span class="mobile-brand-tag">// CLIENTE</span></span>
                @endif
            </div>
            <div class="mobile-header-actions">
                @if ($type === 'client')
                    <a href="/productos" class="mobile-action-btn" title="Volver a la Tienda">
                        <x-icons.shopping-bag class="icon-sm" />
                    </a>
                @else
                    <a href="/" class="mobile-action-btn" title="Volver a la Tienda">
                        <x-icons.chevron-left class="icon-sm" />
                    </a>
                @endif
                <form action="/logout" method="POST" class="mobile-logout-form">
                    @csrf
                    <button type="submit" class="mobile-action-btn btn-logout" title="Cerrar Sesión">
                        <x-icons.logout-2 class="icon-sm" />
                    </button>
                </form>
            </div>
        </header>

        <!-- Sidebar -->
        <aside class="dashboard-sidebar-wrapper">
            <!-- User Avatar & Profile Section -->
            @auth
                @php
                    $initials = strtoupper(substr(auth()->user()->nombre, 0, 1)) . strtoupper(substr(auth()->user()->apellido, 0, 1));
                    $fullName = auth()->user()->nombre . ' ' . auth()->user()->apellido;
                    $role = $type === 'admin' ? 'Administrador' : 'Cliente Java Coffee';
                @endphp
            @else
                @php
                    $initials = 'JC';
                    $fullName = 'Invitado';
                    $role = $type === 'admin' ? 'Administrador' : 'Usuario';
                @endphp
            @endauth

            <div class="user-avatar-section">
                <div class="avatar-circle {{ $type === 'admin' ? 'avatar-admin' : '' }}">
                    <span>{{ $initials }}</span>
                </div>
                <div class="user-info">
                    <h3 class="user-name">{{ $fullName }}</h3>
                    <span class="user-role-badge">{{ $role }}</span>
                </div>
            </div>

            <!-- Sidebar Navigation List -->
            <nav class="dashboard-navigation">
                <ul class="dashboard-nav-list">
                    @if (isset($navigation))
                        {{ $navigation }}
                    @endif
                </ul>
            </nav>

            <!-- Sidebar Footer Section -->
            <div class="sidebar-footer">
                <a href="{{ $type === 'admin' ? '/' : '/productos' }}" class="store-back-link">
                    <x-icons.chevron-left class="icon-xs" />
                    <span>Volver a la Tienda</span>
                </a>
                <form action="/logout" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-button">
                        <x-icons.logout-2 class="icon-sm" />
                        <span>Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Content Area -->
        <div class="dashboard-content-wrapper">
            <!-- Desktop Header Bar -->
            <header class="dashboard-desktop-header">
                <div class="header-title-section">
                    @if ($title)
                        <h1>{{ $title }}</h1>
                    @endif
                </div>
                <div class="header-right-section">
                    <div class="admin-user-profile">
                        <span class="user-status-dot"></span>
                        <span class="user-name">{{ $fullName }}</span>
                        <span class="user-role">({{ $type === 'admin' ? 'Admin' : 'Cliente' }})</span>
                    </div>
                </div>
            </header>

            <!-- Main slot content -->
            <main class="dashboard-main-content">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Foot scripts -->
    <script type="module" src="{{ asset('js/index.js') }}"></script>
</body>

</html>
