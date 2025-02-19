<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>{{ $title ?? 'public' }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('build/assets/app-DqeXZnGt.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @livewireStyles
</head>

<body>
    <nav id="navbar" class="fixed top-0 z-50 w-full bg-white transition-all duration-300">
        <livewire:public.header />
    </nav>
    <div class="bg-gradient-to-r  to-purple-100 via-purple-300 from-purple-50">
        <!-- Content Section -->
        <div class="md:pt-[30px] ">
            <!-- Check if current route is homepage -->
            <!-- Hero Section with Gradient -->
            <div class="relative flex items-center md:pt-12 pt-10">
                <div class="lg:px-[10%] w-full px-3 pt-5 md:py-0 gap-10 flex flex-col md:flex-row items-center">
                    <!-- Left Section: Text Content -->
                    <div
                        class="flex-1 pt-10 lg:py-10 lg:w-1/2  bg-cover bg-bottom lg:bg-none bg-[url('{{ asset('hero-bg.png') }}')] w-full">
                        <div class="rounded-2xl px-3 pb-5">
                            <h1
                                class="text-2xl sm:text-3xl md:text-4xl lg:text-6xl font-bold text-slate-800 tracking-tight">
                                Learn Syntax. <br> Learn Programming
                            </h1>
                            <p class="mt-2 w-[60%] text-md md:p-0 lg:hidden">Transform your passion for coding into a successful career </p>
                            <p class="hidden lg:flex mt-5 w-[60%] text-lg md:p-0 lg:w-[90%]"> Transform your passion for coding into a successful career at Learn Syntax, Purnea's
                                most trusted programming center. Join us for hands-on learning, expert guidance,
                                and
                                real-world projects to unlock your true potential!
                            </p>
                            </span>
                            </p>
                        </div>
                    </div>

                    <div
                        class="w-full py-5 lg:w-1/2 hidden lg:flex bg-cover h-[400px] bg-right-bottom bg-[url('{{ asset('hero-bg.png') }}')]">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ $slot }}
    <livewire:public.footer />
    @livewireScripts
</body>

</html>