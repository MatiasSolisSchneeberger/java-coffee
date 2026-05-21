@props([
    'title' => 'Operación exitosa:',
    'messages' => []
])

@if(count($messages) > 0)
    <div {{ $attributes->merge(['class' => 'terminal-success-alert']) }}>
        <p><strong>{{ $title }}</strong></p>
        <ul>
            @foreach ($messages as $message)
                @if($message)
                    <li>{{ $message }}</li>
                @endif
            @endforeach
        </ul>
    </div>
@endif
