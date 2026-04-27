<x-layout title="Quiénes Somos">
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
                <div class="ide-title">quienes_somos.md - Java Coffee</div>
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
                                <li class="file active"><span>📄</span> quienes-somos.md</li>
                                <li class="file">
                                    <a href="/comercializacion">
                                        <span>📄</span> comercializacion.md
                                    </a>
                                </li>
                                <li class="file">
                                    <a href="/contacto">
                                        <span>📄</span> contacto.md
                                    </a>
                                </li>
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
                        <div class="code-line"><span class="md-h1"># Quiénes Somos</span></div>
                        <div class="code-line"><span class="md-quote">> "El combustible indispensable para tus líneas de
                                código."</span></div>
                        <div class="code-line"></div>

                        <div class="code-line"><span class="md-h2">## Nuestra Historia</span></div>
                        <div class="code-line"><span class="md-text">Java Coffee nació en 2020, en el corazón de un
                                espacio de co-working lleno de programadores sedientos de cafeína de calidad. Lo que
                                comenzó como una pequeña barra de café para desarrolladores se convirtió rápidamente en
                                un referente del café de especialidad para toda la comunidad tecnológica.</span></div>
                        <div class="code-line"></div>
                        <div class="code-line"><span class="md-text">Nuestra trayectoria está marcada por la búsqueda
                                constante del "bean perfecto". Hemos recorrido fincas desde Colombia hasta Etiopía para
                                asegurar que cada grano que llega a tu taza sea digno de un despliegue a
                                producción.</span></div>
                        <div class="code-line"></div>

                        <!-- Imagen de la historia -->
                        <div class="code-line">
                            <span
                                class="md-comment">![Interior]({{ asset('images/quienes-somos/coffee-shop-interior.png') }})</span>
                        </div>
                        <div class="code-line">
                            <div class="md-img-container">
                                <img src="{{ asset('images/quienes-somos/coffee-shop-interior.png') }}"
                                    alt="Interior de la cafetería">
                            </div>
                        </div>
                        <div class="code-line"></div>

                        <div class="code-line"><span class="md-h2">## Misión y Objetivos</span></div>
                        <div class="code-line"><span class="md-text">Nuestra misión es democratizar el acceso al café de
                                especialidad de alta gama, proporcionando no solo un producto, sino una herramienta de
                                productividad para quienes pasan horas frente a una pantalla.</span></div>
                        <div class="code-line"></div>
                        <div class="code-line"><span class="md-list">-</span> <span
                                class="md-bold">**Calidad:**</span>
                            <span class="md-text">Solo granos con puntaje de cata superior a 85.</span>
                        </div>
                        <div class="code-line"><span class="md-list">-</span> <span
                                class="md-bold">**Comunidad:**</span> <span class="md-text">Fomentar espacios de
                                encuentro para el ecosistema IT.</span></div>
                        <div class="code-line"><span class="md-list">-</span> <span
                                class="md-bold">**Sostenibilidad:**</span> <span class="md-text">Trato directo con
                                productores y empaques compostables.</span></div>
                        <div class="code-line"></div>

                        <div class="code-line"><span class="md-h2">## Nuestro Equipo (Staff)</span></div>
                        <div class="code-line"><span class="md-text">Contamos con un equipo multidisciplinario
                                apasionado por el café y la tecnología.</span></div>
                        <div class="code-line"></div>

                        <div class="code-line"><span class="md-h3">### Juan "Root" Pérez - Fundador & Head
                                Barista</span></div>
                        <div class="code-line"><span class="md-text">Con más de 10 años de experiencia en el mundo del
                                café y un pasado como desarrollador backend, Juan es el arquitecto detrás de cada
                                blend.</span></div>
                        <div class="code-line">
                            <span class="md-comment">![Juan]({{ asset('images/quienes-somos/staff-juan.png') }})</span>
                        </div>
                        <div class="code-line">
                            <div class="md-img-container">
                                <img src="{{ asset('images/quienes-somos/staff-juan.png') }}" alt="Juan Pérez">
                            </div>
                        </div>
                        <div class="code-line"></div>

                        <div class="code-line"><span class="md-h3">### Ana "Dev" García - Especialista en
                                Tostado</span></div>
                        <div class="code-line"><span class="md-text">Ana se encarga de que las curvas de tostado sean
                                tan precisas como un algoritmo de búsqueda. Su atención al detalle garantiza la
                                consistencia en cada lote.</span></div>
                        <div class="code-line">
                            <span class="md-comment">![Ana]({{ asset('images/quienes-somos/staff-ana.png') }})</span>
                        </div>
                        <div class="code-line">
                            <div class="md-img-container">
                                <img src="{{ asset('images/quienes-somos/staff-ana.png') }}" alt="Ana García">
                            </div>
                        </div>
                        <div class="code-line"></div>

                        <div class="code-line"><span class="md-h3">### Lucas "Sudo" Martínez - Atención al
                                Cliente</span></div>
                        <div class="code-line"><span class="md-text">Lucas es la cara visible de Java Coffee. Su
                                objetivo es resolver cualquier consulta con la misma eficiencia que un comando de
                                terminal.</span></div>
                        <div class="code-line">
                            <span
                                class="md-comment">![Lucas]({{ asset('images/quienes-somos/staff-lucas.png') }})</span>
                        </div>
                        <div class="code-line">
                            <div class="md-img-container">
                                <img src="{{ asset('images/quienes-somos/staff-lucas.png') }}" alt="Lucas Martínez">
                            </div>
                        </div>
                        <div class="code-line"></div>

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
                <div class="footer-item">Ln 42, Col 1</div>
                <div class="footer-item">Spaces: 4</div>
                <div class="footer-item">UTF-8</div>
                <div class="footer-item">Markdown</div>
            </div>
        </div>
    </div>
</x-layout>
