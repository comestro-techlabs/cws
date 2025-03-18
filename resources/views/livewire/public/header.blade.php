<div>
    <!-- Navbar -->
    <div class="fixed top-0 left-0 right-0 z-50 px-5 sm:px-4 lg:px-8 py-2">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white/90 backdrop-blur-xl rounded-full border border-slate-200  px-6 md:px-10 py-2 md:py-4 flex items-center justify-between transition-all duration-300">
                <!-- Hamburger Menu Button (Mobile) -->
                <button id="menu-toggle" class="lg:hidden focus:outline-none group p-2 rounded-lg hover:bg-gray-100">
                    <div class="relative w-6 h-6 flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-600 transition-colors duration-200"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </div>
                </button>

                <!-- Logo -->
                <div class="flex-shrink-0 lg:ml-0">
                    <a href="{{route('public.index')}}" wire:navigate class="flex items-center">
                        <img src="{{ asset('assets/LearnSyntax.png') }}" class="md:h-8 h-5  transition-transform duration-200 hover:scale-105" alt="Learn Syntax Logo">
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-2">
                    <a href="{{route('public.index')}}" wire:navigate
                        class="relative px-4 py-2 text-sm font-medium text-gray-600 rounded-lg transition-all duration-200 group hover:text-blue-600">
                        <span class="relative z-10 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Explore
                        </span>
                        <span class="absolute inset-0 bg-blue-50 rounded-lg scale-95 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200"></span>
                    </a>
                    <a href="{{route('public.viewallcourses.all-courses')}}" wire:navigate
                        class="relative px-4 py-2 text-sm font-medium text-gray-600 rounded-lg transition-all duration-200 group hover:text-blue-600">
                        <span class="relative z-10 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Learn for Free
                        </span>
                        <span class="absolute inset-0 bg-blue-50 rounded-lg scale-95 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200"></span>
                    </a>
                    <a href="{{route('public.viewallcourses.all-courses')}}" wire:navigate
                        class="relative px-4 py-2 text-sm font-medium text-gray-600 rounded-lg transition-all duration-200 group hover:text-blue-600">
                        <span class="relative z-10 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                            Premium Courses
                        </span>
                        <span class="absolute inset-0 bg-blue-50 rounded-lg scale-95 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200"></span>
                    </a>
                    <a href="{{route('public.workshop')}}" wire:navigate
                        class="relative px-4 py-2 text-sm font-medium text-gray-600 rounded-lg transition-all duration-200 group hover:text-blue-600">
                        <span class="relative z-10 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Live Workshops
                        </span>
                        <span class="absolute inset-0 bg-blue-50 rounded-lg scale-95 opacity-0 group-hover:opacity-100 group-hover:scale-100 transition-all duration-200"></span>
                    </a>
                </nav>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-3">
                    @auth
                        @if (Auth::user()->isAdmin)
                            <a href="{{ route('admin.dashboard') }}" wire:navigate
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 active:scale-95 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="hidden md:flex">Admin Panel</span>
                            </a>
                        @else
                            <div class="relative"
                                x-data="{ open: false, fullName: '{{ Auth::user()->name }}', shortName: '{{ substr(Auth::user()->name, 0, 2) }}' }">
                                <button @click="open = !open" @click.away="open = false"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    <span class="md:inline hidden" x-text="fullName"></span>
                                    <!-- Full name on medium screens and up -->
                                    <span class="md:hidden" x-text="shortName"></span> <!-- First 2 chars on mobile -->
                                    <svg class="w-5 h-5 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div x-show="open"
                                    class="absolute right-0 w-48 mt-2 origin-top-right bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95">
                                    <div class="py-1">
                                        <a href="{{ route('student.dashboard') }}" wire:navigate
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                            My Learning
                                        </a>
                                        <button wire:click="logout"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                            Logout
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endauth
                    @guest
                        <a href="{{ route('auth.login') }}" wire:navigate
                            class="relative inline-flex items-center px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 rounded-lg hover:from-blue-700 hover:via-indigo-700 hover:to-blue-800 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 shadow-md hover:shadow-xl group overflow-hidden">
                            <span class="relative z-10">Join Us</span>
                            <span class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 animate-gradient"></span>
                            <svg class="w-5 h-5 ml-2 -mr-1 transition-transform duration-300 transform group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar -->
    <div id="sidebar"
        class="fixed inset-y-0 left-0 z-50 w-72 bg-white/95 backdrop-blur-xl transform -translate-x-full transition-transform duration-300 ease-in-out overflow-y-auto shadow-2xl">
        <div class="p-6">
            <div class="flex items-center justify-between mb-8">
                <img src="{{ asset('assets/LearnSyntax.png') }}" class="h-8" alt="Learn Syntax Logo">
                <button id="close-sidebar" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="space-y-2">
                <a href="{{route('public.index')}}" wire:navigate
                    class="flex items-center px-4 py-2.5 text-base font-medium text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
                    <svg class="w-5 h-5 mr-2 text-gray-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Explore
                </a>
                <a href="{{route('public.viewallcourses.all-courses')}}" wire:navigate
                    class="flex items-center px-4 py-2.5 text-base font-medium text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
                    <svg class="w-5 h-5 mr-2 text-gray-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Learn for Free
                </a>
                <a href="{{route('public.viewallcourses.all-courses')}}" wire:navigate
                    class="flex items-center px-4 py-2.5 text-base font-medium text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
                    <svg class="w-5 h-5 mr-2 text-gray-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    Premium Courses
                </a>
                <a href="{{route('public.workshop')}}" wire:navigate
                    class="flex items-center px-4 py-2.5 text-base font-medium text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
                    <svg class="w-5 h-5 mr-2 text-gray-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Live Workshops
                </a>
            </nav>
        </div>
    </div>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.body.style.overflow = 'hidden';
        });

        document.getElementById('close-sidebar').addEventListener('click', function () {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.body.style.overflow = '';
        });
    </script>
</div>