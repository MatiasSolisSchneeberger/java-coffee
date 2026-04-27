<x-layout title="Inicio de Sesión">
    <div class="login-page">

        <header class="login-header">
            <h1 class="login-title">Inicio de Sesión</h1>
            <p class="login-label">Por favor ingresa email y contraseña.</p>
        </header>

        <div class="login-container">
            <div class="login-form-card">
                <form action="/login" method="POST" class="login-form">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-input"
                            placeholder="usuario@ejemplo.com" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-input" placeholder="••••••••"
                            required>
                    </div>

                    <x-ui.button type="submit" class="login-submit-btn">
                        <span>Ingresar</span>
                    </x-ui.button>

                    {{-- NUEVO CONTENEDOR DE ENLACE DE REGISTRO --}}
                    <div class="register-link-container">
                        En caso de no estar registrado, <a href="/registro">Regístrate</a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</x-layout>
