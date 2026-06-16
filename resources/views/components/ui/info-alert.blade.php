@props([
    'title' => 'Información:',
    'messages' => []
])

@if(count($messages) > 0)
    <div {{ $attributes->merge(['class' => 'terminal-info-alert']) }}>
        <p><strong>{{ $title }}</strong></p>
        <ul>
            @foreach ($messages as $message)
                @if($message)
                    <li>{!! $message !!}</li>
                @endif
            @endforeach
        </ul>
    </div>
@endif
