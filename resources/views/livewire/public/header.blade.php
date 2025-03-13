<div>
    <!-- Navbar -->
    <div class="fixed top-0 left-0 right-0 z-50 px-4 sm:px-6 lg:px-8 py-3">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-lg px-4 sm:px-6 py-3 flex items-center justify-between">
                <!-- Hamburger Menu Button (Mobile) -->
                <button id="menu-toggle" class="lg:hidden focus:outline-none group">
                    <div class="relative w-8 h-8 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-700 group-hover:text-blue-600 transition-colors duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </div>
                </button>

                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{route('public.index')}}" wire:navigate class="flex items-center">
                        <img src="{{ asset('assets/LearnSyntax.png') }}" class="h-8 sm:h-9" alt="Learn Syntax Logo">
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-1">
                    <a href="{{route('public.index')}}" wire:navigate
                        class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                        Home
                    </a>
                    <a href="{{route('public.viewallcourses.all-courses')}}" wire:navigate
                        class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                        Free Courses
                    </a>
                    <a href="{{route('public.viewallcourses.all-courses')}}" wire:navigate
                        class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                        Pro Courses
                    </a>
                    <a href="{{route('public.workshop')}}" wire:navigate
                        class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                        Workshop
                    </a>
                </nav>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-3">
                    @auth
                        @if (Auth::user()->isAdmin)
                            <a href="{{ route('admin.dashboard') }}" wire:navigate
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Admin Panel
                            </a>
                        @else
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" @click.away="open = false"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg class="w-5 h-5 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
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
                                        <a href="{{ route('v2.student.dashboard') }}" wire:navigate
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
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-blue-600 rounded-lg hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            Join Us
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar -->
    <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-full sm:w-64 bg-white transform -translate-x-full transition-transform duration-300 ease-in-out overflow-y-auto">
        <div class="p-6">
            <div class="flex items-center justify-between mb-8">
                <img src="{{ asset('assets/LearnSyntax.png') }}" class="h-8" alt="Learn Syntax Logo">
                <button id="close-sidebar" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="space-y-2">
                <a href="{{route('public.index')}}" wire:navigate
                    class="block px-4 py-2 text-base font-medium text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                    Home
                </a>
                <a href="{{route('public.viewallcourses.all-courses')}}" wire:navigate
                    class="block px-4 py-2 text-base font-medium text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                    Free Courses
                </a>
                <a href="{{route('public.viewallcourses.all-courses')}}" wire:navigate
                    class="block px-4 py-2 text-base font-medium text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                    Pro Courses
                </a>
                <a href="{{route('public.workshop')}}" wire:navigate
                    class="block px-4 py-2 text-base font-medium text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                    Workshop
                </a>
            </nav>
        </div>
    </div>

    <!-- Sidebar Toggle Script -->
    {{-- <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.body.style.overflow = 'hidden';
        });

        document.getElementById('close-sidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.body.style.overflow = '';
        });
    </script> --}}
</div>
