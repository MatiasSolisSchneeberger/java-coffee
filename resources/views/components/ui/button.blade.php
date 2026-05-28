@props([
    'variant' => 'primary',
    'size' => 'default',
    'loading' => false,
    'disabled' => false,
])

@php
    $baseClass = 'btn';
    $variantClass = match ($variant) {
        'primary' => 'primary',
        'secondary' => 'secondary',
        'danger' => 'danger',
        'outline' => 'outline',
        default => 'primary',
    };

    $sizeClass = match ($size) {
        'small' => 'btn-sm',
        'large' => 'btn-lg',
        default => '',
    };

    $classes = "$baseClass $variantClass $sizeClass";
@endphp

<button {{ $attributes->merge(['class' => $classes, 'disabled' => $disabled || $loading]) }}>
    {{ $slot }}

    @if ($loading)
        <div class="btn-spinner"></div>
    @endif
</button>
