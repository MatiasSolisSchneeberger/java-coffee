@props(['label', 'value', 'footer' => null, 'iconColor' => 'primary'])

<article {{ $attributes->merge(['class' => 'ui-stat-card']) }}>
    <div class="stat-card-main-content">
        @if (isset($icon))
            <div class="stat-icon-wrapper text-{{ $iconColor }}">
                {{ $icon }}
            </div>
        @endif
        <div class="stat-details">
            <span class="stat-label">{{ $label }}</span>
            <span class="stat-value">{{ $value }}</span>
        </div>
    </div>
    @if ($footer)
        <div class="stat-card-footer">
            {{ $footer }}
        </div>
    @endif
</article>
