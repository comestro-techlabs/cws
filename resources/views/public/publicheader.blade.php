<nav class="bg-white dark:bg-gray-900 fixed w-full z-[999] top-0 left-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4 py-5">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
                <img src="{{ asset('assets/comestro.png') }}" class="h-14" alt="">
            </span>
        </a>
        @auth


            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <!-- Show Join Now button if no one is logged in -->
                @if (Auth::user()->isAdmin)
                    <!-- Show Admin Panel link if an admin is logged in -->
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Admin
                        Panel</a>
                @else
                    <!-- Show User Dropdown Menu if a student is logged in -->
                    <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName"
                        class="flex items-center text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:me-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white capitalize px-3 py-2 border"
                        type="button">
                        <span class="sr-only">Open user menu</span>
                        {{ Auth::user()->name }}
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="dropdownAvatarMenuDesktop"
                        class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg dark:bg-gray-700">
                        <!-- User Info -->
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                            <div class="font-medium">{{ Auth::user()->name }}</div>
                            <div class="truncate text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                            <li><a href="{{ route('student.dashboard') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">My
                                    Learning</a></li>
                            <li><a href="{{ route('auth.logout') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Logout</a>
                            </li>
                        </ul>
                    </div>
                @endif

            </div>
        @endauth
    </div>
    <!-- Mobile View: Avatar and Dropdown Toggle -->
    @auth
        <div class="md:hidden flex items-center">
            <button id="dropdownAvatarButtonMobile" data-dropdown-toggle="dropdownAvatarMenuMobile"
                class="flex items-center text-sm font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white">
                <div
                    class="relative w-10 h-10 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-600 border border-gray-300 dark:border-gray-500">
                    @if (Auth::user()->avatar_url)
                        <img class="w-full h-full object-cover" src="{{ Auth::user()->avatar_url }}"
                            alt="{{ Auth::user()->name }}"
                            onerror="this.onerror=null;this.src='/path/to/default-avatar.jpg';">
                    @else
                        <div
                            class="flex items-center justify-center w-full h-full bg-gray-300 text-gray-700 dark:bg-gray-500 dark:text-gray-300 text-lg font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                    @endif
                </div>
                <span class="ml-3">{{ Auth::user()->name }}</span>
                <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <!-- Dropdown Menu for Mobile -->
            <div id="dropdownAvatarMenuMobile"
                class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg dark:bg-gray-700">
                <!-- User Info -->
                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                    <div class="font-medium">{{ Auth::user()->name }}</div>
                    <div class="truncate text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                </div>
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                    <li><a href="{{ route('student.dashboard') }}"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">My
                            Learning</a></li>
                    <li><a href="{{ route('auth.logout') }}"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    @endauth

    {{-- Hamburger menu button for mobile view  --}}
    <button data-collapse-toggle="navbar-sticky" type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
        aria-controls="navbar-sticky" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 1h15M1 7h15M1 13h15" />
        </svg>
    </button>

    <!-- Dropdown menu -->
    <div id="dropdownAvatarName"
        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
        </div>
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
            aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
            <li>
                <a href="{{ route('student.dashboard') }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
            </li>
            <li>
                <a href="#"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
            </li>
            <li>
                <a href="#"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
            </li>
        </ul>
        <div class="py-2">
            <a href="{{ route('auth.logout') }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                out</a>
        </div>
    </div>
    </div>

    <!-- Navbar items -->
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
        <ul
            class="flex flex-col p-4 md:p-0 mt-4 font-normal border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            <li>
                <a href="/"
                    class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500"
                    aria-current="page">Home</a>
            </li>
            <li>
                <a href="{{ route('public.about') }}"
                    class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About
                    Us</a>
            </li>
            <li>
                <a href="{{ route('public.training') }}"
                    class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Training</a>
            </li>
            <li>
                <button id="mega-menu-dropdown-button" data-dropdown-toggle="mega-menu-dropdown"
                    class="flex items-center justify-between w-full py-2 px-3 text-gray-900 border-b border-gray-100 md:w-auto hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">
                    Services <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div id="mega-menu-dropdown"
                    class="absolute z-10 grid hidden w-auto grid-cols-2 text-sm bg-white border border-gray-100 rounded-lg shadow-md dark:border-gray-700 md:grid-cols-3 dark:bg-gray-700">
                    <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
                        <ul class="space-y-4" aria-labelledby="mega-menu-dropdown-button">
                            <li>
                                <a href="/web-design"
                                    class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500">
                                    Web Design
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('public.services.web-dev') }}"
                                    class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500">
                                    Web Development
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('public.services.mobile-app') }}"
                                    class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500">
                                    Mobile App Development
                                </a>
                            </li>
                            <li>
                                <a href="{{route('public.services.seo-services')}}"
                                    class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500">
                                    SEO Services
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500">
                                    Software Development
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
                        <ul class="space-y-4">
                            <li>
                                <a href="#"
                                    class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500">
                                    Native App Development
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('public.services.ecommerce') }}"
                                    class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500">
                                    E-Commerce Website Development
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('public.services.coaching') }}"
                                    class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500">
                                    Coaching Manangement System
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500">
                                    Inventery Solutions
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="p-4 w-48 pb-0 text-gray-900 md:pb-4 dark:text-white">
                        <h2 class="mb-2 font-semibold text-gray-900 dark:text-white">Our Serices</h2>
                        <p class="mb-2 text-gray-500 dark:text-gray-400">At Flowbite, we have a portfolio of brands
                            that cater to a variety of preferences.</p>
                        <a href="{{ route('public.services.services') }}"
                            class="inline-flex items-center text-sm font-medium text-blue-600 hover:underline hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-700">
                            Explore our Services
                            <svg class="w-3 h-3 ms-2 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>
            </li>

            <li>
                <a href="/contact"
                    class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
            </li>
            @guest
                <li>
                    <a href="{{ route('auth.login') }}"
                        class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Login</a>
                </li>
            @endguest
        </ul>
    </div>
    </div>
</nav>
