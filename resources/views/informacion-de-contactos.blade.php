<x-layout title="Información de Contactos">
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
                <div class="ide-title">contacto.md - Java Coffee</div>
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
                                    <a href="/comercializacion">
                                        <span>📄</span> comercializacion.md
                                    </a>
                                </li>
                                <li class="file active"><span>📄</span> contacto.md</li>
                                <li class="file">
                                    <a href="/terminos-y-usos">
                                        <span>📄</span> terminos-y-usos.md
                                    </a>
                                </li>
                            </ul>
                        </ul>
                    </ul>
                </div>

                <!-- Editor -->
                <div class="ide-editor">
                    <div class="code-content">
                        <div class="code-line"><span class="md-h1"># Información de Contacto</span></div>
                        <div class="code-line"><span class="md-quote">> Seguinos en nuestras redes sociales para estar al tanto de las últimas novedades.</span></div>
                        <div class="code-line"></div>
                        
                        <div class="code-line"><span class="md-h2">## Datos de la Empresa</span></div>
                        <div class="code-line"><span class="md-list">-</span> <span class="md-bold">**Titular:**</span> <span class="md-text">Juan Pérez</span></div>
                        <div class="code-line"><span class="md-list">-</span> <span class="md-bold">**Razón Social:**</span> <span class="md-text">Java Coffee S.R.L.</span></div>
                        <div class="code-line"><span class="md-list">-</span> <span class="md-bold">**Domicilio Legal:**</span> <span class="md-text">Av. Corrientes 1234, CABA, Argentina</span></div>
                        <div class="code-line"></div>

                        <div class="code-line"><span class="md-h2">## Redes Sociales</span></div>
                        <div class="code-line"><span class="md-list">-</span> <span class="md-link">[Instagram]</span><span class="md-url">(<a href="https://www.instagram.com" target="_blank">https://www.instagram.com</a>)</span></div>
                        <div class="code-line"><span class="md-list">-</span> <span class="md-link">[Facebook]</span><span class="md-url">(<a href="https://www.facebook.com" target="_blank">https://www.facebook.com</a>)</span></div>
                        <div class="code-line"><span class="md-list">-</span> <span class="md-link">[WhatsApp]</span><span class="md-url">(<a href="https://www.whatsapp.com" target="_blank">https://www.whatsapp.com</a>)</span></div>
                        <div class="code-line"></div>

                        <div class="code-line"><span class="md-h2">## Otros Medios</span></div>
                        <div class="code-line"><span class="md-list">-</span> <span class="md-bold">**Email:**</span> <span class="md-text">contacto@javacoffee.com</span></div>
                        <div class="code-line"><span class="md-list">-</span> <span class="md-bold">**Teléfono:**</span> <span class="md-text">+54 11 1234-5678</span></div>
                        <div class="code-line"></div>

                        <div class="code-line"><span class="md-h2">## ¿Tienes alguna duda?</span></div>
                        <div class="code-line"><span class="md-text">Puedes completar nuestro <span class="md-link">[Cuestionario de Consultas]</span><span class="md-url">(<a href="{{ url('/consultas') }}">/consultas</a>)</span> y te responderemos a la brevedad.</span></div>
                        <div class="code-line"></div>

                        <div class="code-line"><span class="md-h2">## Nuestra Ubicación</span></div>
                        <div class="code-line">
                            <span class="md-comment">![Mapa de Ubicación](https://maps.google.com/...)</span>
                        </div>
                        <div class="code-line">
                            <div class="md-map-container">
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3284.0167132768463!2d-58.3837591!3d-34.6037389!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bccac6198f1a1d%3A0xc0f19a0a4c281395!2sAv.%20Corrientes%201234%2C%20C1043AAZ%20Cdad.%20Aut%C3%B3noma%20de%20Buenos%20Aires!5e0!3m2!1ses-419!2sar!4v1714180000000!5m2!1ses-419!2sar" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                        
                        <!-- Empty lines to fill space -->
                        @for ($i = 0; $i < 15; $i++)
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
                <div class="footer-item">Ln 32, Col 1</div>
                <div class="footer-item">Spaces: 4</div>
                <div class="footer-item">UTF-8</div>
                <div class="footer-item">Markdown</div>
            </div>
        </div>
    </div>
</x-layout>
