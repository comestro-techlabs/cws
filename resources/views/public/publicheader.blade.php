<nav class="bg-white  fixed w-full z-[999] top-0 left-0 border-b border-gray-200  roboto-bold">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4 py-5">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap ">
                <img src="{{ asset('assets/comestro.png') }}" class="md:h-14 h-12 " alt="">
            </span>
        </a>

        <!-- Hamburger menu button for mobile view -->
        <button data-collapse-toggle="navbar-sticky" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-sticky" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <!-- Navigation Links -->
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul
                class="flex flex-col p-4 md:p-0 mt-4 font-normal border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                <li>
                    <a href="/"
                        class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 "
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="{{ route('public.about') }}"
                        class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 ">About
                        Us</a>
                </li>
                <li>
                    <a href="{{ route('public.training') }}"
                        class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 ">Training</a>
                </li>
                <li>
                    <button id="mega-menu-dropdown-button" data-dropdown-toggle="mega-menu-dropdown"
                        class="flex items-center justify-between w-full py-2 px-3 text-gray-900 border-b border-gray-100 md:w-auto hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 ">
                        Services <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div id="mega-menu-dropdown"
                        class="absolute z-10 grid hidden w-auto grid-cols-2 text-sm bg-white border border-gray-100 rounded-lg shadow-md ">
                        <div class="p-4 pb-0 text-gray-900 md:pb-4 ">
                            <ul class="space-y-4" aria-labelledby="mega-menu-dropdown-button">
                                <li>
                                    <a href="{{ route('public.services.web-design') }}"
                                        class="text-gray-500  hover:text-blue-600">Web Design</a>
                                </li>
                                <li>
                                    <a href="{{ route('public.services.web-dev') }}"
                                        class="text-gray-500  hover:text-blue-600">Web Development</a>
                                </li>
                                <li>
                                    <a href="{{ route('public.services.mobile-app') }}"
                                        class="text-gray-500  hover:text-blue-600">Mobile App Development</a>
                                </li>
                                <li>
                                    <a href="{{ route('public.services.seo-services') }}"
                                        class="text-gray-500  hover:text-blue-600">SEO Services</a>
                                </li>
                                <li>
                                    <a href="{{ route('public.services.software-dev') }}"
                                        class="text-gray-500  hover:text-blue-600">Software Development</a>
                                </li>
                            </ul>
                        </div>
                        <div class="p-4 pb-0 text-gray-900 md:pb-4 ">
                            <ul class="space-y-4">
                                <li>
                                    <a href="{{ route('public.services.native-app') }}"
                                        class="text-gray-500  hover:text-blue-600 ">Native App Development</a>
                                </li>
                                <li>
                                    <a href="{{ route('public.services.ecommerce') }}"
                                        class="text-gray-500  hover:text-blue-600 ">E-Commerce Website Development</a>
                                </li>
                                <li>
                                    <a href="{{ route('public.services.coaching') }}"
                                        class="text-gray-500  hover:text-blue-600 ">Coaching Manangement System</a>
                                </li>
                                <li>
                                    <a href="{{ route('public.services.invent-sol') }}"
                                        class="text-gray-500  hover:text-blue-600 ">Inventory Solutions</a>
                                </li>
                            </ul>
                        </div>
                        <div class="p-4 w-48 pb-0 text-gray-900 md:pb-4 ">
                            <h2 class="mb-2 font-semibold text-gray-900 ">Our Services</h2>
                            <p class="mb-2 text-gray-500 ">At Comestro, we have a portfolio of brands that cater to a
                                variety of preferences.</p>
                            <a href="{{ route('public.services.services') }}"
                                class="inline-flex items-center text-sm font-medium text-blue-600 hover:underline hover:text-blue-600 ">
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
                        class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 ">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Auth Section -->
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            @auth
                @if (Auth::user()->isAdmin)
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 text-center ">Admin
                        Panel</a>
                @else
                    <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName"
                        class="flex items-center text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-blue-600  md:me-0 focus:ring-4 focus:ring-gray-100  capitalize px-3 py-2 border"
                        type="button">
                        <span class="sr-only">Open user menu</span>
                        {{ Auth::user()->name }}
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div id="dropdownAvatarName" class="hidden z-10 w-44 bg-white rounded-lg shadow ">
                        <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdownAvatarNameButton">
                            <li><a href="{{ route('student.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100 ">My
                                    Learning</a></li>
                            <li><a href="{{ route('auth.logout') }}"
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100 ">Logout</a></li>
                        </ul>
                    </div>
                @endif
            @endauth

            @guest
                <a href="{{ route('auth.login') }}"
                    class="text-white md:flex items-center bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-4 hidden md:block py-2 text-center  gap-1">
                    <svg class="size-7 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.1"
                            d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    Login</a>
            @endguest
            @guest
                <a href="{{ route('auth.login') }}"
                    class="text-white items-center bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-4 block md:hidden py-2 text-center  gap-1">
                    <svg class="size-7 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.1"
                            d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg></a>
            @endguest
        </div>
    </div>
</nav>
