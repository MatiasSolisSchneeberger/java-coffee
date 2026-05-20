<x-layout title="Mi Cuenta">
    <div style="padding: 2rem; max-width: 1200px; margin: 0 auto;">
        <h1>Mi Cuenta de Cliente</h1>
        <p>Bienvenido a tu panel personal, {{ auth()->user()->nombre }} {{ auth()->user()->apellido }}.</p>
        <p>Email: {{ auth()->user()->email }}</p>

        <form action="/logout" method="POST" style="margin-top: 1rem;">
            @csrf
            <x-ui.button type="submit">Cerrar Sesión</x-ui.button>
        </form>
    </div>
</x-layout>
