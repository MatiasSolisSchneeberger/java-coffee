@php
    // Genero un id unico a cada uno, por tema de css así no se rompe todo
    $anchorName = '--ancla-' . uniqid();
@endphp

<div class="dropdown-basico">

    <div class="dropdown-trigger-wrapper" style="anchor-name: {{ $anchorName }};" onclick="toggleDropdown(this)">
        {{ $trigger }}
    </div>

    <div class="dropdown-content" style="position-anchor: {{ $anchorName }};">
        {{ $slot }}
    </div>

</div>
