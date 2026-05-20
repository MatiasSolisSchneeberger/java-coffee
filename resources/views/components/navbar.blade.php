<section class="navbar">
    {{-- Logo --}}
    <x-logo />
    <nav>
        <ul>
            <li>
                <a href="/productos">
                    <x-ui.button variant="secondary">
                        Ver Productos
                    </x-ui.button>
                </a>
            </li>
            <li>
                <a href="/quienes-somos">
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

                    <a href="/contacto">Contacto</a>
                    <a href="/consultas">Consultas</a>
                    <a href="/terminos-y-usos">Terminos y Condiciones</a>
                    <a href="/comercializacion">Comercializacion</a>

                </x-ui.dropdown>
            </li>
        </ul>
    </nav>
    <aside>
        @auth
            <a href="{{ auth()->user()->rol === 'admin' ? '/admin' : '/cliente' }}">
                <x-ui.button variant="secondary" class="icon" style="display: flex; align-items: center; justify-content: center; padding: 0.5rem;" title="Mi Cuenta">
                    <x-icons.user style="width: 20px; height: 20px;" />
                </x-ui.button>
            </a>
        @else
            <a href="/login">
                <x-ui.button variant="secondary">Iniciar Sesión</x-ui.button>
            </a>
            <a href="/registro">
                <x-ui.button variant="primary">Registrarse</x-ui.button>
            </a>
        @endauth
    </aside>
    {{-- nav mobile --}}
    <aside class="nav-mobile">
        <x-ui.dropdown>
            <x-slot name="trigger">
                <x-ui.button variant="secondary" class="icon">
                    <x-icons.menu />
                </x-ui.button>
            </x-slot>
            <a href="/productos">
                <x-icons.shopping-bag />
                <span>Ver Productos</span>
            </a>
            <a href="/quienes-somos">
                <x-icons.building-store />
                <span>Quienes Somos</span>
            </a>
            <a href="/contacto">
                <x-icons.map-pin />
                <span>Contacto</span>
            </a>
            <a href="/consultas">
                <x-icons.coffee />
                <span>Consultas</span>
            </a>
            <a href="/terminos-y-usos">
                <x-icons.code />
                <span>Términos y Condiciones</span>
            </a>
            <a href="/comercializacion">
                <x-icons.trending-up />
                <span>Comercialización</span>
            </a>
            @auth
                <hr>
                <a href="{{ auth()->user()->rol === 'admin' ? '/admin' : '/cliente' }}">
                    <x-icons.user />
                    <span>Mi Cuenta ({{ auth()->user()->nombre }})</span>
                </a>
            @else
                <hr>
                <a href="/login">
                    <x-icons.user />
                    <span>Iniciar Sesión</span>
                </a>
                <a href="/registro">
                    <x-icons.user-plus />
                    <span>Registrarse</span>
                </a>
            @endauth
        </x-ui.dropdown>
    </aside>
</section>
