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
                            Ver mas
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
    {{-- registrarse --}}
    {{-- Login --}}

    {{-- nav mobile --}}

</section>
