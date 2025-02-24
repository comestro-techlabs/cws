<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>

        <title>{{ $title ?? 'Student' }}</title>
        @livewireStyles
    </head>
    <body>
        @if(isset($title))
            <h1>{{ $title }}</h1>
        @endif
        <x-student-header />
        {{ $slot }}
        @livewireScripts
    </body>
    
</html>
