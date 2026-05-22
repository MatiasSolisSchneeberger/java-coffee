@props(['title' => null])
<x-dashboard-layout :title="$title" type="admin">
    <x-slot:navigation>
        <li>
            <a href="/admin" class="admin-nav-link {{ request()->is('admin') ? 'active' : '' }}">
                <x-icons.building-store class="nav-icon" /> <span>Inicio</span>
            </a>
        </li>
        <li>
            <a href="/admin/productos"
                class="admin-nav-link {{ request()->is('admin/productos*') || request()->is('admin/producto*') ? 'active' : '' }}">
                <x-icons.adjustments-horizontal class="nav-icon" /> <span>Productos</span>
            </a>
        </li>
        <li>
            <a href="/admin/pedidos"
                class="admin-nav-link {{ request()->is('admin/pedidos*') ? 'active' : '' }}">
                <x-icons.shopping-bag class="nav-icon" /> <span>Pedidos</span>
            </a>
        </li>
        <li>
            <a href="/admin/consultas"
                class="admin-nav-link {{ request()->is('admin/consultas*') ? 'active' : '' }}">
                <x-icons.mail class="nav-icon" /> <span>Consultas</span>
            </a>
        </li>
        <li>
            <a href="/admin/comentarios"
                class="admin-nav-link {{ request()->is('admin/comentarios*') ? 'active' : '' }}">
                <x-icons.star class="nav-icon" /> <span>Comentarios</span>
            </a>
        </li>
    </x-slot:navigation>

    {{ $slot }}
</x-dashboard-layout>

