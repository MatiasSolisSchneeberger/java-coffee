@props(['title' => null])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ !empty($title) ? "$title | Java Coffee" : 'Java Coffee' }}</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/favicon.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        {{-- tailwind --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        {{-- estilos --}}
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @endif
</head>


<body class="cascadia-mono-400">
    <x-navbar />
    {{ $slot }}
    <script type="module" src="{{ asset('js/index.js') }}"></script>
    <x-footer />
</body>

</html>
