<x-layout title="Registro de Clientes">
    <div class="login-page">

        <header class="login-header">
            <h1 class="login-title">Crear Cuenta</h1>
            <p class="login-label">Completa tus datos para registrarte.</p>
        </header>

        <div class="login-container">
            <div class="login-form-card">
                <x-ui.error-alert title="Error al registrarte:" :messages="$errors->all()" style="margin-bottom: 20px;" />
                <form action="/registro" method="POST" class="login-form">
                    @csrf

                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-input" placeholder="Juan"
                            value="{{ old('nombre') }}" required autofocus>
                        @error('nombre')
                            <small style="color: red; display: block;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-input" placeholder="Pérez"
                            value="{{ old('apellido') }}" required>
                        @error('apellido')
                            <small style="color: red; display: block;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-input"
                            placeholder="usuario@ejemplo.com" value="{{ old('email') }}" required>
                        @error('email')
                            <small style="color: red; display: block;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="telefono" class="form-label">Teléfono (Opcional)</label>
                        <input type="text" name="telefono" id="telefono" class="form-input"
                            placeholder="+54 11 1234-5678" value="{{ old('telefono') }}">
                        @error('telefono')
                            <small style="color: red; display: block;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="direccion" class="form-label">Dirección (Opcional)</label>
                        <input type="text" name="direccion" id="direccion" class="form-input"
                            placeholder="Av. Siempreviva 742" value="{{ old('direccion') }}">
                        @error('direccion')
                            <small style="color: red; display: block;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-input" placeholder="••••••••"
                            required>
                        @error('password')
                            <small style="color: red; display: block;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="••••••••" required>
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
