<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

    <title>{{ $title ?? 'public' }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @livewireStyles
</head>

<body class="flex flex-col min-h-screen">
    <nav id="navbar" class="fixed top-0 z-50 w-full bg-white transition-all duration-300">
        <livewire:public.header />
    </nav>
    @if(Route::currentRouteName() === 'v2.public.homepage')
        <livewire:public.herosection />
    @endif
    {{ $slot }}
    <div class="mt-auto">
        <livewire:public.footer />
    </div>
    @livewireScripts
</body>

</html>
