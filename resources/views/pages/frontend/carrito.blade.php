<x-layouts.layout title="Carrito de Compras">
    <main>
        <div class="carrito-container">
            <h1 class="carrito-main-title">Tu <span>Carrito</span></h1>

            @if (session('success'))
                <x-ui.success-alert :messages="[session('success')]" />
            @endif

            @if (session('error'))
                <x-ui.error-alert title="Error:" :messages="is_array(session('error')) ? session('error') : [session('error')]" />
            @endif

            @if ($errors->any())
                <x-ui.error-alert title="Campos requeridos:" :messages="$errors->all()" />
            @endif

            @if ($items->isEmpty())
                <div class="carrito-vacio-card">
                    <div class="vacio-icon-wrapper">
                        <x-icons.coffee class="icon-xl icon-muted" />
                    </div>
                    <h2>El carrito está vacío</h2>
                    <p>Parece que aún no has agregado ningún producto a tu carrito de compras.</p>
                    <a href="/productos">
                        <x-ui.button variant="primary">
                            Ver Productos
                        </x-ui.button>
                    </a>
                </div>
            @else
                <div class="carrito-layout">
                    {{-- Lista de Items --}}
                    <div class="carrito-items-col">
                        @foreach ($items as $item)
                            @php
                                $portada = '/storage/productos/error-404.png';
                                if ($item->producto) {
                                    $productoModel = $item->producto;
                                    // Buscar si tiene imágenes asociadas
                                    $imagenes = \App\Models\ImagenProducto::where(
                                        'producto_id',
                                        $productoModel->id,
                                    )->get();
                                    if ($imagenes->count() > 0) {
                                        $portada = '/storage/productos/' . $imagenes->first()->url;
                                    }
                                }
                            @endphp
                            <article class="carrito-item-card">
                                <div class="item-img-container">
                                    <img src="{{ $portada }}" alt="{{ $item->producto->nombre }}">
                                </div>
                                <div class="item-details">
                                    <span class="badge-code">{{ $item->producto->tueste }}</span>
                                    <h3 class="item-title">{{ $item->producto->nombre }}</h3>
                                    @if ($item->producto->oferta && $item->producto->oferta > 0)
                                        <p class="item-price-unit">
                                            <span style="color: var(--color-primary); font-weight: var(--font-weight-semibold);">${{ number_format($item->producto->oferta, 2) }}</span>
                                            <span style="text-decoration: line-through; color: var(--color-text-muted); font-size: var(--text-xs); margin-left: var(--spacing-xs);">${{ number_format($item->producto->precio, 2) }}</span>
                                            c/u
                                        </p>
                                    @else
                                        <p class="item-price-unit">${{ number_format($item->producto->precio, 2) }} c/u</p>
                                    @endif
                                </div>

                                {{-- Controles de cantidad --}}
                                <div class="item-qty-actions">
                                    <form action="/carrito/actualizar/{{ $item->id }}" method="POST" class="qty-form">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="cantidad" value="{{ $item->cantidad - 1 }}">
                                        <button type="submit" class="qty-btn"
                                            {{ $item->cantidad <= 1 ? 'disabled' : '' }}>
                                            <x-icons.minus class="icon-xs" />
                                        </button>
                                    </form>

                                    <span class="qty-val">{{ $item->cantidad }}</span>

                                    <form action="/carrito/actualizar/{{ $item->id }}" method="POST" class="qty-form">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="cantidad" value="{{ $item->cantidad + 1 }}">
                                        <button type="submit" class="qty-btn"
                                            {{ $item->cantidad >= $item->producto->stock ? 'disabled' : '' }}>
                                            <x-icons.plus class="icon-xs" />
                                        </button>
                                    </form>
                                </div>

                                {{-- Subtotal del item --}}
                                <div class="item-subtotal">
                                    <p class="subtotal-price">
                                        ${{ number_format($item->producto->precio_actual * $item->cantidad, 2) }}</p>
                                </div>

                                {{-- Eliminar del carrito --}}
                                <div class="item-delete">
                                    <form action="/carrito/eliminar/{{ $item->id }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn" title="Eliminar del carrito">
                                            <x-icons.x-circle class="icon-md" />
                                        </button>
                                    </form>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{-- Formulario Checkout y Resumen --}}
                    <div class="carrito-checkout-col">
                        <div class="checkout-card">
                            <h2>Resumen de Compra</h2>

                            @php
                                $subtotalGeneral = 0;
                                foreach ($items as $item) {
                                    $subtotalGeneral += $item->producto->precio_actual * $item->cantidad;
                                }
                            @endphp

                            <div class="resumen-row">
                                <span>Productos ({{ $items->sum('cantidad') }})</span>
                                <span>${{ number_format($subtotalGeneral, 2) }}</span>
                            </div>
                            <div class="resumen-row">
                                <span>Envío</span>
                                <span class="envio-gratis">Gratis</span>
                            </div>
                            <hr class="resumen-divider">
                            <div class="resumen-row total-row">
                                <span>Total</span>
                                <span>${{ number_format($subtotalGeneral, 2) }}</span>
                            </div>

                            <form action="/carrito/comprar" method="POST" class="checkout-form">
                                @csrf
                                <h3>Datos de Entrega</h3>

                                <div class="form-group">
                                    <label for="direccion_envio" class="form-label">Dirección de Envío</label>
                                    <input type="text" name="direccion_envio" id="direccion_envio" class="form-input"
                                        value="{{ old('direccion_envio', $usuario->direccion) }}"
                                        placeholder="Calle 123, Departamento 2B, Ciudad" required
                                        data-original="{{ $usuario->direccion }}">
                                    <button type="button" class="update-profile-btn" id="update-direccion-btn" style="display: none;">
                                        ¿Desea actualizar dirección en tu perfil?
                                    </button>
                                </div>

                                <div class="form-group">
                                    <label for="provincia_id" class="form-label">Provincia</label>
                                    <select name="provincia_id" id="provincia_id" class="form-input" required
                                        data-original="{{ $usuario->provincia_id }}">
                                        <option value="" disabled {{ is_null(old('provincia_id', $usuario->provincia_id)) ? 'selected' : '' }}>Selecciona una provincia</option>
                                        @foreach ($provincias as $provincia)
                                            <option value="{{ $provincia->id }}" {{ old('provincia_id', $usuario->provincia_id) == $provincia->id ? 'selected' : '' }}>
                                                {{ $provincia->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="update-profile-btn" id="update-provincia-btn" style="display: none;">
                                        ¿Desea actualizar provincia en tu perfil?
                                    </button>
                                </div>

                                <div class="form-group">
                                    <label for="telefono" class="form-label">Teléfono de Contacto</label>
                                    <input type="text" name="telefono" id="telefono" class="form-input"
                                        value="{{ old('telefono', $usuario->telefono) }}"
                                        placeholder="+54 9 11 1234-5678" required
                                        data-original="{{ $usuario->telefono }}">
                                    <button type="button" class="update-profile-btn" id="update-telefono-btn" style="display: none;">
                                        ¿Desea actualizar teléfono en tu perfil?
                                    </button>
                                </div>

                                <h3 class="mt-md">Método de Pago</h3>
                                <div class="payment-methods">
                                    <label class="payment-option">
                                        <input type="radio" name="metodo_pago" value="Tarjeta"
                                            {{ old('metodo_pago', 'Tarjeta') === 'Tarjeta' ? 'checked' : '' }}
                                            required>
                                        <span class="option-label">Tarjeta de Crédito/Débito</span>
                                    </label>
                                    <label class="payment-option">
                                        <input type="radio" name="metodo_pago" value="Transferencia"
                                            {{ old('metodo_pago') === 'Transferencia' ? 'checked' : '' }}>
                                        <span class="option-label">Transferencia Bancaria</span>
                                    </label>
                                    <label class="payment-option">
                                        <input type="radio" name="metodo_pago" value="Efectivo"
                                            {{ old('metodo_pago') === 'Efectivo' ? 'checked' : '' }}>
                                        <span class="option-label">Efectivo al Retirar</span>
                                    </label>
                                </div>

                                <x-ui.button type="submit" class="checkout-submit-btn">
                                    <span>Confirmar y Comprar</span>
                                </x-ui.button>
                            </form>

                            <form action="/carrito/vaciar" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas vaciar tu carrito?');" class="vaciar-form">
                                @csrf
                                @method('DELETE')
                                <x-ui.button type="submit" variant="danger" class="vaciar-submit-btn">
                                    Vaciar Carrito
                                </x-ui.button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fields = [
                { id: 'direccion_envio', dbField: 'direccion', buttonId: 'update-direccion-btn', label: 'dirección' },
                { id: 'telefono', dbField: 'telefono', buttonId: 'update-telefono-btn', label: 'teléfono' },
                { id: 'provincia_id', dbField: 'provincia_id', buttonId: 'update-provincia-btn', label: 'provincia' }
            ];

            fields.forEach(field => {
                const element = document.getElementById(field.id);
                const button = document.getElementById(field.buttonId);

                if (!element || !button) return;

                const checkChange = () => {
                    const currentValue = element.value;
                    const originalValue = element.getAttribute('data-original');

                    // If value has changed, show update profile button
                    if (currentValue !== originalValue && (originalValue !== "" || currentValue !== "")) {
                        button.style.display = 'inline-flex';
                    } else {
                        button.style.display = 'none';
                    }
                };

                element.addEventListener('input', checkChange);
                element.addEventListener('change', checkChange);

                button.addEventListener('click', function() {
                    const newValue = element.value;
                    if (!newValue) return;

                    if (!confirm(`¿Estás seguro de que deseas actualizar tu ${field.label} en tu perfil?`)) {
                        return;
                    }

                    button.disabled = true;
                    button.textContent = 'Actualizando...';

                    fetch('/cliente/perfil/actualizar-campo', {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            campo: field.dbField,
                            valor: newValue
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            element.setAttribute('data-original', newValue);
                            button.style.display = 'none';
                            
                            // Visual success alert toast
                            const alertWrapper = document.createElement('div');
                            alertWrapper.style.position = 'fixed';
                            alertWrapper.style.bottom = '20px';
                            alertWrapper.style.right = '20px';
                            alertWrapper.style.zIndex = '9999';
                            alertWrapper.innerHTML = `
                                <div style="background: var(--bg-surface); border: 1px solid var(--color-success); border-left: 4px solid var(--color-success); padding: 12px 20px; border-radius: var(--border-radius); box-shadow: var(--shadow-md); color: var(--color-text-main); font-size: var(--text-sm);">
                                    ${data.message}
                                </div>
                            `;
                            document.body.appendChild(alertWrapper);
                            setTimeout(() => alertWrapper.remove(), 3000);
                        } else {
                            alert(data.message || 'Error al actualizar el perfil.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error al intentar actualizar el perfil.');
                    })
                    .finally(() => {
                        button.disabled = false;
                        button.textContent = `¿Desea actualizar ${field.label} en tu perfil?`;
                    });
                });
            });
        });
    </script>
</x-layouts.layout>
