@props(['status'])

@php
    $normalized = strtolower(str_replace(' ', '_', $status));
    
    // Map to CSS classes
    $statusClass = 'status-default';
    if (in_array($normalized, ['entregado', 'success', 'activo', 'pagado', 'respondido', 'respondió'])) {
        $statusClass = 'status-success';
    } elseif (in_array($normalized, ['pendiente', 'pending', 'en_espera'])) {
        $statusClass = 'status-pending';
    } elseif (in_array($normalized, ['en_camino', 'enviado', 'info'])) {
        $statusClass = 'status-info';
    } elseif (in_array($normalized, ['cancelado', 'error', 'inactivo', 'rechazado'])) {
        $statusClass = 'status-error';
    }
    
    // Label translation/formatting if needed
    $label = ucfirst(str_replace('_', ' ', $status));
@endphp

<span {{ $attributes->merge(['class' => 'status-badge ' . $statusClass]) }}>
    {{ $slot->isEmpty() ? $label : $slot }}
</span>
