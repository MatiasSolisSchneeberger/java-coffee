<x-layout title="Panel de Administración">
    <div style="padding: 2rem; max-width: 1200px; margin: 0 auto;">
        <h1>Panel de Administración</h1>
        <p>Bienvenido al panel de control exclusivo para administradores.</p>
        <p>Has iniciado sesión como: {{ auth()->user()->nombre }} {{ auth()->user()->apellido }} ({{ auth()->user()->email }})</p>
        
        <form action="/logout" method="POST" style="margin-top: 1rem;">
            @csrf
            <x-ui.button type="submit">Cerrar Sesión</x-ui.button>
        </form>
    </div>
</x-layout>
