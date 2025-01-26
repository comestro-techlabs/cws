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
    <link rel="stylesheet" href="{{ asset('build/assets/app-B9FQpHNS.css ') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @livewireStyles
</head>

<body>



    <nav class="fixed top-0 z-50 w-full bg-white shadow-md ">

        @include('public.publicheader')

    </nav>

    <aside id="logo-sidebar"
    class="fixed sm:hidden sm:w-0 top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 "
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="/"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
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
                <a href="/contact"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <span class="ms-3">Contact</span>
                </a>
            </li>
        </ul>
    </div>
</aside>


    <div class="sm:p-0 p-4 sm:ml-0">

        @section('content')

        @show

    </div>




    <footer class=" bg-secondary text-gray-50 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full">
                <!-- About Section -->
                
                <div>
                   
                    <img src="{{asset('assets/footer_logo.png')}}" alt="" class="lg:h-16 h-11">

                    <p class="text-gray-50 md:text-md text-sm mt-4">
                        At Learn Syntax, we are committed to providing high-quality programming education that empowers
                        students to excel in the IT industry. Our hands-on approach and real-world projects ensure that
                        our students are job-ready.
                    </p>
                </div>

                <!-- Links Section -->
                <div class="md:pl-12">
                    <h3 class="text-lg font-semibold text-white mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('public.about') }}" class="">About</a>
                        </li>
                        <li>
                            <a href="{{ route('public.training') }}" class="">Courses</a>
                        </li>

                        <li>
                            <a href="{{ route('public.contact') }}" class="">Contact Us</a>
                        </li>

                        <li>
                            <a href="{{ route('public.privacy') }}" class="">Privacy & Policy</a>
                        </li>
                        <li>
                            <a href="{{ route('public.terms-conditions') }}" class="">Terms & Conditions</a>
                        </li>
                    </ul>
                </div>
                <!-- Contact Information -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Contact Us</h3>
                    <p class="text-gray-100">{{ env('APP_NAME') }} TechLabs Pvt Ltd.</p>
                    <p class="text-gray-100">Purnea, Bihar, India</p>
                    <p class="text-gray-100">Email: info@Learn Syntax.com</p>
                    <p class="text-gray-100">Phone: +91-9546805580</p>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-50 pt-8 text-center">
                <p class="text-gray-100 text-sm">
                    &copy; 2024 {{ env('APP_NAME') }}. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    @yield('js')

    @livewireScripts
    <script type="module" src="{{ asset('build/assets/app-CEsE5a7F.js') }}"></script>
</body>

</html>
