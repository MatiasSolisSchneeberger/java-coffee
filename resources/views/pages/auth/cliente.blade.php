<x-layouts.dashboard-layout title="Mi Cuenta" type="client">
    <x-slot:navigation>
        <li>
            <button class="dashboard-nav-btn active" data-tab="resumen">
                <x-icons.user class="icon-sm" />
                <span>Resumen</span>
            </button>
        </li>
        <li>
            <button class="dashboard-nav-btn" data-tab="pedidos">
                <x-icons.shopping-bag class="icon-sm" />
                <span>Mis Pedidos</span>
                <span class="nav-count">{{ $pedidos->count() }}</span>
            </button>
        </li>
        <li>
            <button class="dashboard-nav-btn" data-tab="favoritos">
                <x-icons.star class="icon-sm" />
                <span>Favoritos</span>
                <span class="nav-count">{{ $favoritos->count() }}</span>
            </button>
        </li>
        <li>
            <button class="dashboard-nav-btn" data-tab="consultas">
                <x-icons.mail class="icon-sm" />
                <span>Mis Consultas</span>
                <span class="nav-count">{{ $consultas->count() }}</span>
            </button>
        </li>
        <li>
            <button class="dashboard-nav-btn" data-tab="comentarios">
                <x-icons.star class="icon-sm" />
                <span>Mis Opiniones</span>
                <span class="nav-count">{{ $comentarios->count() }}</span>
            </button>
        </li>
        <li>
            <button class="dashboard-nav-btn" data-tab="perfil">
                <x-icons.settings class="icon-sm" />
                <span>Editar Perfil</span>
            </button>
        </li>
    </x-slot:navigation>

        <!-- Sección de Alertas -->
        @if (session('success'))
            <x-ui.success-alert :messages="[session('success')]" class="mb-sm" style="margin-bottom: var(--spacing-md);" />
        @endif

        @if (session('error'))
            <x-ui.error-alert :messages="is_array(session('error')) ? session('error') : [session('error')]" class="mb-sm" style="margin-bottom: var(--spacing-md);" />
        @endif

        @if ($errors->any())
            <x-ui.error-alert :messages="$errors->all()" class="mb-sm" style="margin-bottom: var(--spacing-md);" />
        @endif

            <!-- Pestaña: Resumen -->
            <section class="dashboard-tab-content active" id="tab-resumen">
                <div class="tab-header">
                    <h2>&gt; RESUMEN_</h2>
                    <p class="tab-subtitle">Bienvenido a tu panel de control personal.</p>
                </div>

                <div class="stats-grid">
                    <x-ui.stat-card label="Pedidos Realizados" :value="$pedidos->count()" iconColor="primary">
                        <x-slot:icon>
                            <x-icons.shopping-bag class="icon-lg" />
                        </x-slot:icon>
                    </x-ui.stat-card>
                    <x-ui.stat-card label="Favoritos Guardados" :value="$favoritos->count()" iconColor="secondary">
                        <x-slot:icon>
                            <x-icons.star class="icon-lg" />
                        </x-slot:icon>
                    </x-ui.stat-card>
                    <x-ui.stat-card label="Consultas" :value="$consultas->count()" iconColor="coffee">
                        <x-slot:icon>
                            <x-icons.mail class="icon-lg" />
                        </x-slot:icon>
                    </x-ui.stat-card>
                    <x-ui.stat-card label="Opiniones" :value="$comentarios->count()" iconColor="primary">
                        <x-slot:icon>
                            <x-icons.star class="icon-lg" />
                        </x-slot:icon>
                    </x-ui.stat-card>
                </div>

                <div class="resumen-details-layout">
                    <!-- Información Rápida -->
                    <div class="info-panel">
                        <h3>Detalles de la Cuenta</h3>
                        <ul class="info-list">
                            <li>
                                <x-icons.user class="icon-sm icon-muted" />
                                <strong>Nombre:</strong> <span>{{ auth()->user()->nombre }}
                                    {{ auth()->user()->apellido }}</span>
                            </li>
                            <li>
                                <x-icons.mail class="icon-sm icon-muted" />
                                <strong>Email:</strong> <span>{{ auth()->user()->email }}</span>
                            </li>
                            <li>
                                <x-icons.phone class="icon-sm icon-muted" />
                                <strong>Teléfono:</strong>
                                <span>{{ auth()->user()->telefono ?? 'No especificado' }}</span>
                            </li>
                            <li>
                                <x-icons.map-pin class="icon-sm icon-muted" />
                                <strong>Dirección de Envío:</strong>
                                <span>{{ auth()->user()->direccion ?? 'No especificada' }}</span>
                            </li>
                        </ul>
                        <x-ui.button variant="outline" class="w-fit" onclick="window.switchTab('perfil')">
                            <span>Editar mis datos</span>
                            <x-icons.chevron-right class="icon-xs" />
                        </x-ui.button>
                    </div>

                    <!-- Resumen del Último Pedido -->
                    <div class="last-order-panel">
                        <h3>Último Pedido</h3>
                        @if ($pedidos->count() > 0)
                            @php $ultimoPedido = $pedidos->first(); @endphp
                            <div class="order-card-compact">
                                <div class="order-header-compact">
                                    <span class="order-id">Pedido #{{ $ultimoPedido->id }}</span>
                                    <span class="order-date">
                                        {{ is_string($ultimoPedido->fecha) ? \Carbon\Carbon::parse($ultimoPedido->fecha)->format('d/m/Y') : $ultimoPedido->fecha }}
                                    </span>
                                </div>
                                <div class="order-status-wrapper">
                                    <x-ui.status-badge :status="$ultimoPedido->estado" />
                                </div>
                                <div class="order-total-compact">
                                    <span>Total:</span>
                                    <strong>${{ number_format($ultimoPedido->total, 2, ',', '.') }}</strong>
                                </div>
                                <x-ui.button variant="outline" class="w-full" onclick="window.switchTab('pedidos')">
                                    <span>Ver historial de pedidos</span>
                                    <x-icons.chevron-right class="icon-xs" />
                                </x-ui.button>
                            </div>
                        @else
                            <div class="empty-state">
                                <p>Aún no has realizado pedidos.</p>
                                <a href="/productos" class="shop-now-link">Ver Catálogo de Productos</a>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <!-- Pestaña: Mis Pedidos -->
            <section class="dashboard-tab-content" id="tab-pedidos">
                <div class="tab-header">
                    <h2>&gt; MIS_PEDIDOS_</h2>
                    <p class="tab-subtitle">Historial de compras realizadas.</p>
                </div>

                <div class="pedidos-list-wrapper">
                    @forelse ($pedidos as $pedido)
                        <div class="pedido-card">
                            <div class="pedido-card-header">
                                <div class="header-main-info">
                                    <span class="pedido-code">Pedido #{{ $pedido->id }}</span>
                                    <span class="pedido-date">
                                        {{ is_string($pedido->fecha) ? \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y') : $pedido->fecha }}
                                    </span>
                                </div>
                                <div class="header-status-info">
                                    <x-ui.status-badge :status="$pedido->estado" />
                                </div>
                            </div>
                            <div class="pedido-card-body">
                                <div class="pedido-info-row">
                                    <div class="info-item">
                                        <span class="info-label">Dirección de Envío:</span>
                                        <span class="info-value">{{ $pedido->direccion_envio }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Método de Pago:</span>
                                        <span class="info-value">{{ $pedido->metodo_pago }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Total Pago:</span>
                                        <span
                                            class="info-value price-value">${{ number_format($pedido->total, 2, ',', '.') }}</span>
                                    </div>
                                </div>

                                <!-- Detalles Desplegables de los Ítems -->
                                <details class="pedido-details">
                                    <summary class="details-summary">
                                        <span class="summary-text">Ver detalle de productos</span>
                                        <x-icons.chevron-down class="summary-icon" />
                                    </summary>
                                    <div class="details-content">
                                        <table class="details-table">
                                            <thead>
                                                <tr>
                                                    <th>Producto</th>
                                                    <th>Cant.</th>
                                                    <th>Precio Unit.</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pedido->detalles as $detalle)
                                                    <tr>
                                                        <td>{{ $detalle->producto_nombre }}</td>
                                                        <td>{{ $detalle->cantidad }}</td>
                                                        <td>${{ number_format($detalle->precio_unitario, 2, ',', '.') }}
                                                        </td>
                                                        <td class="font-semibold">
                                                            ${{ number_format($detalle->subtotal, 2, ',', '.') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </details>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <p>No tienes ningún pedido registrado.</p>
                            <a href="/productos" class="shop-now-link">Comenzar a comprar</a>
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- Pestaña: Favoritos -->
            <section class="dashboard-tab-content" id="tab-favoritos">
                <div class="tab-header">
                    <h2>&gt; MIS_FAVORITOS_</h2>
                    <p class="tab-subtitle">Tus productos preferidos guardados.</p>
                </div>

                <div class="favorites-grid">
                    @forelse ($favoritos as $fav)
                        @php
                            $favProduct = is_array($fav) ? $fav : (array) $fav;
                        @endphp
                        <article class="favorite-card">
                            <div class="fav-card-image-wrapper">
                                <img src="/images/productos/{{ $favProduct['imagen'] ?? 'error-404.png' }}"
                                    alt="{{ $favProduct['nombre'] }}">
                                <span class="fav-card-type">{{ $favProduct['tipo'] }}</span>
                            </div>
                            <div class="fav-card-content">
                                <h3 class="fav-card-title">{{ $favProduct['nombre'] }}</h3>
                                <p class="fav-card-desc">{{ $favProduct['descripcion'] }}</p>
                                <div class="fav-card-footer">
                                    <span
                                        class="fav-card-price">${{ number_format($favProduct['precio'], 2, ',', '.') }}</span>
                                    <div class="fav-card-actions">
                                        <!-- Formulario preparado para agregar al carrito -->
                                        <form action="/carrito/agregar" method="POST" class="fav-action-form">
                                            @csrf
                                            <input type="hidden" name="producto_id"
                                                value="{{ $favProduct['id'] }}">
                                            <button type="submit" class="fav-btn-cart" title="Agregar al carrito">
                                                <x-icons.shopping-bag class="icon-sm" />
                                            </button>
                                        </form>

                                        <!-- Formulario preparado para quitar de favoritos -->
                                        <form action="/cliente/favoritos/eliminar/{{ $favProduct['id'] }}"
                                            method="POST" class="fav-action-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="fav-btn-remove"
                                                title="Quitar de favoritos">
                                                <x-icons.x-circle class="icon-sm" />
                                            </button>
                                        </form>

                                        <a href="/producto/{{ $favProduct['slug'] }}" class="fav-btn-view"
                                            title="Ver producto">
                                            <x-icons.chevron-right class="icon-sm" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="empty-state">
                            <p>No tienes productos favoritos guardados.</p>
                            <a href="/productos" class="shop-now-link">Explorar catálogo</a>
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- Pestaña: Consultas -->
            <section class="dashboard-tab-content" id="tab-consultas">
                <div class="tab-header">
                    <h2>&gt; MIS_CONSULTAS_</h2>
                    <p class="tab-subtitle">Seguimiento de las dudas y consultas enviadas.</p>
                </div>

                <div class="consultas-list-wrapper">
                    @forelse ($consultas as $consulta)
                        <article class="consulta-card">
                            <div class="consulta-card-header">
                                <div class="consulta-info">
                                    <span class="consulta-subject">{{ $consulta->asunto }}</span>
                                    <span class="consulta-meta">
                                        Fecha:
                                        {{ is_string($consulta->created_at) ? \Carbon\Carbon::parse($consulta->created_at)->format('d/m/Y H:i') : $consulta->created_at }}
                                    </span>
                                </div>
                                <div class="consulta-badge-group">
                                    <x-ui.status-badge :status="$consulta->estado" />
                                    <span class="consulta-arrow">&gt;</span>
                                </div>
                            </div>
                            <div class="consulta-card-body">
                                <p class="consulta-message-label">Tu Mensaje:</p>
                                <p class="consulta-message-text">
                                    "{{ $consulta->mensaje }}"
                                </p>

                                @if ($consulta->respuesta)
                                    <div class="consulta-response-section responded">
                                        <p class="consulta-response-title text-success">Respuesta del Administrador:
                                        </p>
                                        <p class="consulta-response-text responded-message">
                                            "{{ $consulta->respuesta }}"
                                        </p>
                                        <p class="consulta-response-date">
                                            Fecha respuesta:
                                            {{ is_string($consulta->updated_at) ? \Carbon\Carbon::parse($consulta->updated_at)->format('d/m/Y H:i') : $consulta->updated_at }}
                                        </p>
                                    </div>
                                @else
                                    <div class="consulta-response-section">
                                        <p class="consulta-response-title text-pending">Respuesta Pendiente</p>
                                        <p class="consulta-response-text">
                                            Tu consulta está en cola de revisión por nuestro equipo. Te responderemos
                                            por email y aquí tan pronto como sea posible.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </article>
                    @empty
                        <div class="empty-state">
                            <p>No has enviado ninguna consulta por el momento.</p>
                            <a href="/contacto" class="shop-now-link">Enviar una consulta</a>
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- Pestaña: Editar Perfil -->
            <section class="dashboard-tab-content" id="tab-perfil">
                <div class="tab-header">
                    <h2>&gt; CONFIGURACION_CUENTA_</h2>
                    <p class="tab-subtitle">Actualiza tu información personal y contraseña.</p>
                </div>

                <div class="profile-edit-card">
                    <!-- Formulario preparado para la actualización de perfil de usuario en backend -->
                    <form action="/cliente/perfil" method="POST" class="profile-form">
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-input"
                                    value="{{ old('nombre', auth()->user()->nombre) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" name="apellido" id="apellido" class="form-input"
                                    value="{{ old('apellido', auth()->user()->apellido) }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email (Identificación de cuenta)</label>
                            <input type="email" name="email" id="email" class="form-input"
                                value="{{ old('email', auth()->user()->email) }}" required>
                            <small class="form-helper">Cambiar el email modificará tu usuario de inicio de
                                sesión.</small>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" name="telefono" id="telefono" class="form-input"
                                    value="{{ old('telefono', auth()->user()->telefono) }}"
                                    placeholder="+54 11 1234-5678">
                            </div>
                            <div class="form-group">
                                <label for="direccion" class="form-label">Dirección predeterminada de envío</label>
                                <input type="text" name="direccion" id="direccion" class="form-input"
                                    value="{{ old('direccion', auth()->user()->direccion) }}"
                                    placeholder="Calle 123, Ciudad, Provincia">
                            </div>
                        </div>

                        <div class="password-change-section">
                            <h3 class="section-title">Cambiar Contraseña</h3>
                            <p class="section-desc">Deja los campos en blanco si no deseas cambiar tu contraseña
                                actual.</p>

                            <div class="form-group">
                                <label for="current_password" class="form-label">Contraseña Actual</label>
                                <input type="password" name="current_password" id="current_password"
                                    class="form-input" placeholder="••••••••">
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="password" class="form-label">Nueva Contraseña</label>
                                    <input type="password" name="password" id="password" class="form-input"
                                        placeholder="••••••••">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Confirmar Nueva
                                        Contraseña</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-input" placeholder="••••••••">
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <x-ui.button type="submit" variant="primary">
                                <span>Guardar Cambios</span>
                            </x-ui.button>
                        </div>
                    </form>
                </div>
            </section>

            <!-- Pestaña: Mis Opiniones -->
            <section class="dashboard-tab-content" id="tab-comentarios">
                <div class="tab-header">
                    <h2>&gt; MIS_OPINIONES_</h2>
                    <p class="tab-subtitle">Historial de tus calificaciones y comentarios en productos.</p>
                </div>

                <div class="comentarios-list-wrapper" style="display: flex; flex-direction: column; gap: var(--spacing-md);">
                    @forelse ($comentarios as $com)
                        <article class="consulta-card" id="comentario-card-{{ $com->id }}">
                            <div class="consulta-card-header" style="cursor: default;">
                                <div class="consulta-info">
                                    <span class="consulta-subject" style="color: var(--color-primary);">
                                        {{ $com->producto ? $com->producto->nombre : 'Producto Eliminado' }}
                                    </span>
                                    <span class="consulta-meta">
                                        Calificación: 
                                        <span style="color: var(--color-primary);">
                                            {{ str_repeat('★', $com->calificacion) }}{{ str_repeat('☆', 5 - $com->calificacion) }}
                                        </span>
                                        | Fecha: {{ $com->created_at ? $com->created_at->format('d/m/Y') : 'Reciente' }}
                                    </span>
                                </div>
                                <div class="consulta-badge-group">
                                    @if ($com->estado === 'aprobado')
                                        <x-ui.status-badge status="entregado">Aprobado</x-ui.status-badge>
                                    @elseif ($com->estado === 'pendiente')
                                        <x-ui.status-badge status="pendiente">Pendiente</x-ui.status-badge>
                                    @else
                                        <x-ui.status-badge status="cancelado">Rechazado</x-ui.status-badge>
                                    @endif
                                </div>
                            </div>
                            <div class="consulta-card-body">
                                <p class="consulta-message-text" style="margin-bottom: var(--spacing-md);">
                                    "{{ $com->comentario }}"
                                </p>

                                <div class="flex-row" style="gap: var(--spacing-sm); justify-content: flex-end;">
                                    <x-ui.button variant="outline" size="small"
                                                 onclick="openEditCommentModal({{ json_encode([
                                                     'id' => $com->id,
                                                     'producto' => $com->producto ? $com->producto->nombre : 'Producto Eliminado',
                                                     'calificacion' => $com->calificacion,
                                                     'comentario' => $com->comentario
                                                 ]) }})">
                                        Editar
                                    </x-ui.button>
                                    <form action="/cliente/comentarios/{{ $com->id }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta opinión?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui.button variant="danger" size="small" type="submit">
                                            Eliminar
                                        </x-ui.button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="empty-state">
                            <p>Aún no has dejado calificaciones o comentarios en nuestros productos.</p>
                            <a href="/productos" class="shop-now-link">Ver Catálogo de Productos</a>
                        </div>
                    @endforelse
                </div>
            </section>

    <!-- Modal de Edición de Comentario -->
    <div id="editar-comentario-modal" class="admin-modal" style="display: none;">
        <div class="admin-modal-content" style="max-width: 500px;">
            <div class="admin-modal-header">
                <h3 class="admin-modal-title">Editar Opinión</h3>
                <button class="admin-modal-close" onclick="closeEditCommentModal()">&times;</button>
            </div>
            <div class="admin-modal-body">
                <form id="editar-comentario-form" action="" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group" style="margin-bottom: var(--spacing-md);">
                        <label class="form-label" style="margin-bottom: var(--spacing-xs); display: block;">Producto</label>
                        <input type="text" id="edit-comentario-producto" class="form-input" disabled style="opacity: 0.7;">
                    </div>

                    <div class="form-group" style="margin-bottom: var(--spacing-md);">
                        <label class="form-label" style="margin-bottom: var(--spacing-xs); display: block;">Tu calificación</label>
                        <div class="star-rating-input" style="justify-content: flex-end; font-size: 2rem; display: flex; flex-direction: row-reverse; gap: var(--spacing-xs);">
                            <input type="radio" id="edit-star5" name="rating" value="5" /><label for="edit-star5" title="5 estrellas" style="cursor: pointer;">★</label>
                            <input type="radio" id="edit-star4" name="rating" value="4" /><label for="edit-star4" title="4 estrellas" style="cursor: pointer;">★</label>
                            <input type="radio" id="edit-star3" name="rating" value="3" /><label for="edit-star3" title="3 estrellas" style="cursor: pointer;">★</label>
                            <input type="radio" id="edit-star2" name="rating" value="2" /><label for="edit-star2" title="2 estrellas" style="cursor: pointer;">★</label>
                            <input type="radio" id="edit-star1" name="rating" value="1" /><label for="edit-star1" title="1 estrella" style="cursor: pointer;">★</label>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: var(--spacing-md);">
                        <label for="edit-comentario-texto" class="form-label" style="margin-bottom: var(--spacing-xs); display: block;">Tu comentario</label>
                        <textarea name="comentario" id="edit-comentario-texto" class="form-input"></textarea>
                    </div>

                    <div class="form-actions" style="display: flex; justify-content: flex-end; gap: var(--spacing-sm); margin-top: var(--spacing-lg);">
                        <x-ui.button variant="outline" type="button" onclick="closeEditCommentModal()">Cancelar</x-ui.button>
                        <x-ui.button variant="primary" type="submit">Guardar Cambios</x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openEditCommentModal(comentario) {
            document.getElementById('editar-comentario-form').action = '/cliente/comentarios/' + comentario.id;
            document.getElementById('edit-comentario-producto').value = comentario.producto;
            document.getElementById('edit-comentario-texto').value = comentario.comentario;
            
            // Marcar el botón de radio de calificación correcto
            const starInput = document.getElementById('edit-star' + comentario.calificacion);
            if (starInput) starInput.checked = true;
            
            document.getElementById('editar-comentario-modal').style.display = 'flex';
        }

        function closeEditCommentModal() {
            document.getElementById('editar-comentario-modal').style.display = 'none';
        }

        // Cerrar al hacer clic fuera del modal
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('editar-comentario-modal');
            if (event.target == modal) {
                closeEditCommentModal();
            }
        });
    </script>
    </x-layouts.dashboard-layout>
