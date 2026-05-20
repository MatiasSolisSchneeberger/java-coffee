<x-layout title="Información de Contactos">
    <div class="ide-page">
        <div class="ide-window">
            <!-- Header IDE -->
            <div class="ide-header">
                <div class="ide-controls">
                    <span class="control close">
                        <x-icons.ide-close />
                    </span>
                    <span class="control minimize">
                        <x-icons.ide-minimize />
                    </span>
                    <span class="control maximize">
                        <x-icons.ide-maximize />
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
                    <x-icons.x-circle />
                    0
                </div>
                <div class="footer-item">
                    <x-icons.exclamation-triangle />
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
