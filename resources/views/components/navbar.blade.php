<section class="navbar">
    {{-- Logo --}}
    <x-logo />
    <nav>
        <ul>
            <li>
                <a href="/catalogo-de-productos">
                    <x-ui.button>
                        Ver Productos
                    </x-ui.button>
                </a>
            </li>
            <li>
                <a href="/catalogo-de-productos">
                    <x-ui.button variant="ghost">
                        Quienes Somos
                    </x-ui.button>
                </a>
            </li>
            <li>
                <x-ui.dropdown>
                    <x-slot name="trigger">

                        <x-ui.button variant="ghost">
                            <span>
                                Ver mas
                            </span>
                            <x-icons.chevron-down class="chevron" />
                        </x-ui.button>

                    </x-slot>

                    <a href="/perfil">Perfil</a>
                    <a href="/configuracion">Configuración</a>
                </x-ui.dropdown>
            </li>
        </ul>
    </nav>
    {{-- botones CTA --}}
    <aside>
        <a>
            <x-ui.button variant="secondary">Iniciar Sesión</x-ui.button>
        </a>
        <a>
            <x-ui.button variant="primary">Registrarse</x-ui.button>
        </a>
    </aside>
    {{-- nav mobile --}}
    <aside class="nav-mobile">
        <x-ui.dropdown>
            <x-slot name="trigger">
                <x-ui.button variant="secondary" class="icon">
                    <x-icons.menu />
                </x-ui.button>
            </x-slot>
            <a href="/catalogo-de-productos">
                <x-icons.shopping-bag />
                <span>
                    Ver Productos
                </span>
            </a>
            <a href="/catalogo-de-productos">
                <x-icons.building-store />
                <span>
                    Quienes Somos
                </span>
            </a>
            <hr>
            <a href="/perfil">
                <x-icons.user />
                <span>
                    Perfil
                </span>
            </a>
            <a href="/configuracion">
                <x-icons.settings />
                <span>
                    Configuración
                </span>

            </a>
            <hr>
            <a href="/login">
                <x-icons.user />
                <span>
                    Iniciar Sesión
                </span>
            </a>
            <a href="/register">
                <x-icons.user-plus />
                <span>
                    Registrarse
                </span>
            </a>
        </x-ui.dropdown>
    </aside>
</section>
