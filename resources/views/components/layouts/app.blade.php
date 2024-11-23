<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />

    <title>{{ $title ?? 'Page Title' }}</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

     <!-- Livewire Styles -->
     @livewireStyles

     <!-- Filament Styles -->
     {{-- @filamentStyles --}}
</head>

<body>
    @livewire('notifications')
    {{ $slot }}
    @livewireScripts
</body>

</html>
