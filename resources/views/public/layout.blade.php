<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') {{ env('APP_NAME') }} | Best Programming Training Center in Purnea Bihar</title>
    @yield('meta')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('build/assets/app-DqeXZnGt.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @livewireStyles
</head>

<body>
    <!-- Fixed Navigation Bar -->
    <nav id="navbar" class="fixed top-0 z-50 w-full bg-white transition-all duration-300">
        @include('public.publicheader')
    </nav>
    <div class="bg-gradient-to-r  to-purple-100 via-purple-300 from-purple-50">
        <!-- Content Section -->
        <div class="md:pt-[30px] ">
            @if (request()->route() && request()->route()->getName() === 'public.index')
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
            @endif
        </div>
    </div>


    <aside id="logo-sidebar"
        class="fixed sm:hidden sm:w-0 top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 "
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <span class="ms-3">Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('public.about') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <span class="ms-3">About Us</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('public.training') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <span class="ms-3">Courses</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('public.portfolio') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <span class="ms-3">Portfolio</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('public.workshops') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <span class="ms-3">Workshop</span>
                    </a>
                </li>
                <li>
                    <a href="/contact" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <span class="ms-3">Contact</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>


    <div class="sm:p-0 sm:ml-0">

        @section('content')

        @show

    </div>




    <footer class="bg-secondary text-gray-50 py-4">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <ul class="flex flex-wrap justify-center space-x-4 text-sm">
                <li><a href="{{ route('public.about') }}" class="hover:underline">About</a></li>
                <li><a href="{{ route('public.training') }}" class="hover:underline">Courses</a></li>
                <li><a href="{{ route('public.contact') }}" class="hover:underline">Contact</a></li>
                <li><a href="{{ route('public.privacy') }}" class="hover:underline">Privacy Policy</a></li>
                <li><a href="{{ route('public.terms-conditions') }}" class="hover:underline">Terms & Conditions</a>
                </li>
            </ul>
            <p class="text-gray-300 text-xs my-2">Learn Syntax is a unit of <strong>Comestro Techlabs Pvt. Ltd.</strong>
            </p>
            <p class="text-gray-300 text-xs">&copy; 2024 Learn Syntax. All rights reserved.</p>
        </div>
    </footer>

    {{-- captcha --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    @yield('js')

    @livewireScripts
    <script type="module" src="{{ asset('build/assets/app-l0sNRNKZ.js') }}"></script>
</body>

</html>
