@props([
    'title' => 'Por favor, corrige los siguientes errores:',
    'messages' => []
])

@if(count($messages) > 0)
    <div {{ $attributes->merge(['class' => 'terminal-error-alert']) }}>
        <p><strong>{{ $title }}</strong></p>
        <ul>
            @foreach ($messages as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
