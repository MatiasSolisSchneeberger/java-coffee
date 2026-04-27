<x-layout title="Registro de Clientes">
    <div class="login-page">

        <header class="login-header">
            <h1 class="login-title">Crear Cuenta</h1>
            <p class="login-label">Completa tus datos para registrarte.</p>
        </header>

        <div class="login-container">
            <div class="login-form-card">
                <form action="/registro" method="POST" class="login-form">
                    @csrf

                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre Completo</label>
                        <input type="text" name="nombre" id="nombre" class="form-input" placeholder="Juan Pérez"
                            required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-input"
                            placeholder="usuario@ejemplo.com" required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-input" placeholder="••••••••"
                            required>
                    </div>

                    <x-ui.button type="submit" class="login-submit-btn">
                        <span>Registrarse</span>
                    </x-ui.button>

                    <div class="register-link-container">
                        ¿Ya tienes cuenta? <a href="/login">Inicia sesión</a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</x-layout>
