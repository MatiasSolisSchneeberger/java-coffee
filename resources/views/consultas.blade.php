<x-layout title="Contacto">

    <div class="consultas-page">
        <div class="consultas-container">
            <div class="consultas-grid">

                {{-- Columna de Información --}}
                <div class="consultas-info">
                    <header class="consultas-header">
                        <h1 class="consultas-title">Hablemos</h1>
                        <p class="consultas-subtitle">Nos encantaría saber de vos.</p>
                    </header>

                    <p class="consultas-text">
                        Ya sea que tengas una pregunta sobre nuestros productos de café de especialidad, precios, envíos
                        o cualquier otra duda, nuestro equipo está listo para ayudarte.
                    </p>

                    <div class="contact-cards">
                        <div class="contact-card">
                            <div class="contact-icon">
                                <x-icons.map-pin />
                            </div>
                            <div class="contact-details">
                                <h3>Nuestra Ubicación</h3>
                                <p>Av. Corrientes 1234, CABA, Argentina</p>
                            </div>
                        </div>

                        <div class="contact-card">
                            <div class="contact-icon">
                                <x-icons.mail />
                            </div>
                            <div class="contact-details">
                                <h3>Escríbenos</h3>
                                <p>hola@javacoffee.com</p>
                            </div>
                        </div>

                        <div class="contact-card">
                            <div class="contact-icon">
                                <x-icons.phone />
                            </div>
                            <div class="contact-details">
                                <h3>Llámanos</h3>
                                <p>+54 11 1234-5678</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Columna de Formulario --}}
                <div class="consultas-form-card">

                    {{-- OPCIÓN 1: Bloque general al inicio --}}
                    <x-ui.error-alert title="Por favor, corrige los siguientes errores:" :messages="$errors->all()" />

                    <form action="/consultas" method="POST" class="consultas-form">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombre" class="form-label">Nombre completo</label>
                                <input type="text" name="nombre" id="nombre" class="form-input"
                                    value="{{ old('nombre') }}">

                                {{-- OPCIÓN 2: Error específico para el nombre --}}
                                @error('nombre')
                                    <small class="terminal-error-text">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-input"
                                    value="{{ old('email') }}">

                                {{-- OPCIÓN 2: Error específico para el email --}}
                                @error('email')
                                    <small class="terminal-error-text">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">

                                <label for="motivo" class="form-label">Asunto / Motivo</label>

                                <input type="text" name="motivo" id="motivo" class="form-input"
                                    placeholder="Ej. Duda sobre métodos de envío" value="{{ old('motivo') }}">

                                @error('motivo')
                                    <small class="terminal-error-text">{{ $message }}</small>
                                @enderror

                            </div>

                            <div class="form-group">

                                <label for="consulta" class="form-label">Mensaje</label>

                                <textarea name="consulta" id="consulta" class="form-input" placeholder="¿En qué te podemos ayudar hoy?...">{{ old('consulta') }}</textarea>

                                @error('consulta')
                                    <small class="terminal-error-text">{{ $message }}</small>
                                @enderror

                            </div>
                        </div>

                        {{-- Repetir lo mismo para Motivo y Mensaje... --}}

                        <x-ui.button class="consultas-submit-btn">
                            <span>Enviar Mensaje</span>
                        </x-ui.button>
                    </form>
                </div>

            </div>

            {{-- Sección de FAQ --}}
            <section class="faq-section">
                <h2 class="faq-title">Preguntas Frecuentes</h2>
                <div class="faq-grid">
                    <div class="faq-item">
                        <h3>¿Hacen envíos a todo el país?</h3>
                        <p>Sí, realizamos envíos a toda la Argentina...</p>
                    </div>
                    <div class="faq-item">
                        <h3>¿Tienen local físico para retirar?</h3>
                        <p>¡Claro! Podés retirar tu pedido...</p>
                    </div>
                    <div class="faq-item">
                        <h3>¿Los granos vienen molidos?</h3>
                        <p>Ofrecemos café en grano entero...</p>
                    </div>
                    <div class="faq-item">
                        <h3>¿Qué métodos de pago aceptan?</h3>
                        <p>Aceptamos tarjetas de crédito/débito...</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-layout>
