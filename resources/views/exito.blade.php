<x-layout title="Mensaje Enviado">
    <div class="success-page">
        <div class="success-card">

            {{-- Ícono de Éxito --}}
            <div class="success-icon-wrapper">
                <div class="success-icon-bg">
                    <svg class="success-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>

            {{-- Mensaje --}}
            <h1 class="success-title">
                ¡Envío <span>Exitoso</span>!
            </h1>

            <p class="success-message">
                Hola <strong>{{ $nombre }}</strong>, recibimos tu mensaje con éxito.
                Un asesor comercial se comunicará contigo a la brevedad a tu correo:
                <strong>{{ $email }}</strong>. <br>
                <span>¡Muchas gracias!</span>
            </p>

            {{-- Botón para Volver --}}
            <div class="success-footer">
                <a href="{{ url('/') }}" class="success-btn">
                    Volver al Inicio
                </a>
            </div>

        </div>
    </div>
</x-layout>
