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
                        Ya sea que tengas una pregunta sobre nuestros productos de café de especialidad, precios, envíos o cualquier otra duda, nuestro equipo está listo para ayudarte.
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
                                {{-- SVG genérico para Mail/Contacto --}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <div class="contact-details">
                                <h3>Escríbenos</h3>
                                <p>hola@javacoffee.com</p>
                            </div>
                        </div>

                        <div class="contact-card">
                            <div class="contact-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-4.18-7.076-7.076l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                </svg>
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
                    <form action="/consultas" method="POST" class="consultas-form">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombre" class="form-label">Nombre completo</label>
                                <input type="text" name="nombre" id="nombre"
                                    class="form-input"
                                    placeholder="Juan Perez" required>
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-input"
                                    placeholder="usuario@ejemplo.com" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="motivo" class="form-label">Asunto / Motivo</label>
                            <input type="text" name="motivo" id="motivo"
                                class="form-input"
                                placeholder="Ej. Duda sobre métodos de envío" required>
                        </div>

                        <div class="form-group">
                            <label for="consulta" class="form-label">Mensaje</label>
                            <textarea name="consulta" id="consulta"
                                class="form-input"
                                placeholder="¿En qué te podemos ayudar hoy?..." required></textarea>
                        </div>

                        <x-ui.button class="consultas-submit-btn">
                            <span>Enviar Mensaje</span>
                        </x-ui.button>
                    </form>
                </div>

            </div>

            {{-- Sección de Preguntas Frecuentes (FAQ) --}}
            <section class="faq-section">
                <h2 class="faq-title">Preguntas Frecuentes</h2>
                <div class="faq-grid">
                    <div class="faq-item">
                        <h3>¿Hacen envíos a todo el país?</h3>
                        <p>Sí, realizamos envíos a toda la Argentina a través de los principales operadores logísticos. Podés calcular el costo en el carrito.</p>
                    </div>
                    <div class="faq-item">
                        <h3>¿Tienen local físico para retirar?</h3>
                        <p>¡Claro! Podés retirar tu pedido sin costo por nuestra sucursal de Av. Corrientes 1234, CABA, de lunes a viernes.</p>
                    </div>
                    <div class="faq-item">
                        <h3>¿Los granos vienen molidos?</h3>
                        <p>Ofrecemos café en grano entero para preservar la frescura, pero podemos molerlo para tu cafetera específica si nos avisas en el checkout.</p>
                    </div>
                    <div class="faq-item">
                        <h3>¿Qué métodos de pago aceptan?</h3>
                        <p>Aceptamos tarjetas de crédito/débito, transferencias bancarias y efectivo con descuentos exclusivos.</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-layout>
