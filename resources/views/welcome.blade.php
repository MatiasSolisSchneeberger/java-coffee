<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        {{-- tailwind --}}
        <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
        {{-- estilos --}}
        <link rel="stylesheet" href="{{ asset('assets/index.css') }}">
    @endif
</head>

<x-Layout>
    <main>
        <h1>Java Coffee</h1>
        <p>El mejor café de la ciudad</p>
    </main>
</x-Layout>

</html>
