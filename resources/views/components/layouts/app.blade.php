<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    <meta name="description" content="{{ $description ?? config('app.name') }}">

    <!-- Add these meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <meta property="og:title" content="{{ $title ?? 'Untitled Course' }}">
    <meta property="og:description" content="{{ $description ?? 'Check out this course!' }}">
    <meta property="og:url" content="{{ $url ?? url()->current() }}">
    <meta property="og:image" content="{{ $image ?? asset('storage/default_image.jpg') }}">
    <meta property="og:type" content="website">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="flex flex-col min-h-screen">
    <livewire:public.header />

    @if (Route::currentRouteName() === 'public.index')
        <livewire:public.herosection />
    @endif
   <div class="">
   {{ $slot }}
   </div>
    <div class="mt-auto">
        <livewire:public.footer />
    </div>

    @livewireScripts
    <script>
        // Add Livewire configuration
        window.livewire_app_url = "{{ config('app.url') }}";
        window.livewire_token = "{{ csrf_token() }}";
    </script>
    <!-- Add to your layout file -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>



</html>
