<x-layout title="Comercialización">
    <div class="ide-page">
        <div class="ide-window">
            <!-- Header IDE -->
            <div class="ide-header">
                <div class="ide-controls">
                    <span class="control close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </span>
                    <span class="control minimize">
                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </span>
                    <span class="control maximize">
                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <polyline points="9 21 3 21 3 15"></polyline>
                            <line x1="21" y1="3" x2="14" y2="10"></line>
                            <line x1="3" y1="21" x2="10" y2="14"></line>
                        </svg>
                    </span>
                </div>
                <div class="ide-title">comercializacion.md - Java Coffee</div>
            </div>

            <div class="ide-body">
                <!-- Sidebar -->
                <div class="ide-sidebar">
                    <div class="sidebar-title">EXPLORADOR</div>
                    <ul class="sidebar-tree">
                        <li class="folder open"><span>▼</span> JAVA-COFFEE</li>
                        <ul class="folder-content">
                            <li class="folder open"><span>▼</span> docs</li>
                            <ul class="folder-content">
                                <li class="file">
                                    <a href="/quienes-somos">
                                        <span>📄</span> quienes-somos.md
                                    </a>
                                </li>
                                <li class="file">
                                    <a href="/terminos-y-usos">
                                        <span>📄</span> terminos-y-usos.md
                                    </a>
                                </li>
                                <li class="file active"><span>📄</span> comercializacion.md</li>
                                <li class="file">
                                    <a href="/contacto">
                                        <span>📄</span> contacto.md
                                    </a>
                                </li>
                            </ul>
                        </ul>
                    </ul>
                </div>

                <!-- Editor -->
                <div class="ide-editor">
                    <div class="code-content">
                        <div class="code-line"><span class="md-h1"># Comercialización</span></div>
                        <div class="code-line"><span class="md-quote">> Conocé nuestras formas de pago, envíos y
                                opciones de entrega.</span></div>
                        <div class="code-line"><span class="md-quote">> Queremos que tu experiencia con Java Coffee sea
                                excelente desde la compra hasta la primera taza.</span></div>
                        <div class="code-line"></div>
                        <div class="code-line"><span class="md-h2">## Formas de Pago</span></div>
                        <div class="code-line"><span class="md-list">-</span> <span class="md-bold">**Efectivo (10%
                                OFF):**</span> <span class="md-text">Aboná tus pedidos en efectivo al retirar en nuestra
                                sucursal y obtené un 10% de descuento automático en tu compra final.</span></div>
                        <div class="code-line"><span class="md-list">-</span> <span class="md-bold">**Transferencia (5%
                                OFF):**</span> <span class="md-text">Transferí fácil y rápido desde cualquier banco o
                                billetera virtual.</span></div>
                        <div class="code-line"><span class="md-list">-</span> <span class="md-bold">**Tarjetas:**</span>
                            <span class="md-text">Aceptamos todas las tarjetas de crédito y débito. Disfrutá de hasta 3
                                cuotas sin interés en compras bancarizadas.</span></div>
                        <div class="code-line"></div>
                        <div class="code-line"><span class="md-h2">## Envíos y Entregas</span></div>
                        <div class="code-line"><span class="md-list">-</span> <span class="md-bold">**Retiro en Sucursal
                                (Take Away):**</span></div>
                        <div class="code-line"> <span class="md-text">↳ Costo: ¡Gratis!</span></div>
                        <div class="code-line"> <span class="md-text">↳ Tiempo: Te avisamos por email/WhatsApp cuando
                                esté listo (aprox. 30 minutos).</span></div>
                        <div class="code-line"></div>
                        <div class="code-line"><span class="md-list">-</span> <span class="md-bold">**Envío a
                                Domicilio:**</span></div>
                        <div class="code-line"> <span class="md-text">↳ Costo: Se calcula en el carrito según tu
                                código postal.</span></div>
                        <div class="code-line"> <span class="md-text">↳ Tiempo: Despachamos en 24hs hábiles. Demora 2
                                a 5 días según tu zona.</span></div>
                        <div class="code-line"> <span class="md-text">↳ Tracking: Te enviamos un código de seguimiento
                                en tiempo real.</span></div>
                        <div class="code-line"></div>
                        <div class="code-line"><span class="md-h2">## Soporte de Envíos</span></div>
                        <div class="code-line"><span class="md-text">¿Tenés dudas sobre tu pedido o envío?</span>
                        </div>
                        <div class="code-line"><span class="md-text">Nuestro equipo de soporte está disponible de
                                Lunes a Viernes de 9 a 18hs para ayudarte.</span></div>
                        <div class="code-line"><span class="md-text">Contactanos en <span
                                    class="md-link">[Consultas]</span><span class="md-url">(<a
                                        href="{{ url('/consultas') }}">/consultas</a>)</span></span></div>
                        <!-- Empty lines to fill space -->
                        @for ($i = 0; $i < 10; $i++)
                            <div class="code-line"></div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Footer IDE -->
            <div class="ide-footer">
                <div class="footer-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="15" y1="9" x2="9" y2="15" />
                        <line x1="9" y1="9" x2="15" y2="15" />
                    </svg>
                    0
                </div>
                <div class="footer-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                        <line x1="12" y1="9" x2="12" y2="13" />
                        <line x1="12" y1="17" x2="12.01" y2="17" />
                    </svg>
                    0
                </div>
                <div class="footer-spacer"></div>
                <div class="footer-item">Ln 22, Col 45</div>
                <div class="footer-item">Spaces: 4</div>
                <div class="footer-item">UTF-8</div>
                <div class="footer-item">Markdown</div>
            </div>
        </div>
    </div>
</x-layout>
