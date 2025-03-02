<div>
    <!-- Navbar -->
    <div class="shadow-2xl  w-full flex relative justify-between items-center mx-auto px-8 py-3 rounded-full backdrop-blur bg-white bg-opacity-20">

        <!-- Hamburger Menu Button (Only Visible on Small Screens) -->
        <button id="menu-toggle" class="md:hidden focus:outline-none">
            <svg class="w-8 h-8 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Logo -->
        <div class="inline-flex">
            <a class="_o6689fn" href="/">
                <div class="hidden md:block">
                    <a href="{{route('public.index')}}" class="flex ms-2 md:me-24">
                        <img src="{{ asset('assets/LearnSyntax.png') }}" class="h-6 sm:h-8" alt="">
                    </a>
                </div>
            </a>
        </div>



        <!-- Menu Items (Hidden on Small Screens) -->
        <div class="hidden md:flex space-x-4">
            <a class="py-2 px-3 hover:bg-gray-200 rounded-full" href="{{route('v2.public.homepage')}}" wire:navigate >Home</a>
            <a class="py-2 px-3 hover:bg-gray-200 rounded-full" href="{{route('v2.public.workshop')}}" wire:navigate>Workshop</a>
            <div class="relative group">
                <button wire:click="toggleDropdown" class="py-2 px-3 hover:bg-gray-200 rounded-full flex items-center">
                    Courses
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div id="dropdown-menu" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 {{ $isDropdownOpen ? '' : 'hidden' }}">
                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#">Free Courses</a>
                    <a href="{{route('v2.public.viewallcourses.all-courses')}}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pro Courses</a>
                </div>
            </div>
        </div>

        <!-- Login/Signup (Always Visible) -->
        <div class="flex md:order-2 space-x-2 md:space-x-1 rtl:space-x-reverse">
            @auth
            @if (Auth::user()->isAdmin)
            <a href="{{ route('admin.dashboard') }}" wire:navigate
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 text-center ">Admin
                Panel</a>
            @else
            <div class="relative inline-block text-left">
                <div>
                    <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100" id="menu-button" aria-expanded="true" aria-haspopup="true">
                        {{ Auth::user()->name }}
                        <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div class="dropdown-menu absolute hidden bg-white shadow-lg rounded-md mt-1 w-48 ring-1 ring-black ring-opacity-5 focus:outline-none" aria-labelledby="menu-button">
                    <div class="py-1">
                        <a href="{{ route('v2.student.dashboard') }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Learning</a>
                        <a wire:click="logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                    </div>
                </div>
            </div>
            @endif
            @endauth
            @guest
            <a href="{{ route('v2.auth.login') }}" wire:navigate class="text-primary  md:flex items-center font-light border border-indigo-600 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-sm hover:text-white text-sm px-4  py-2 text-center">Login</a>
            <a href="{{ route('v2.auth.register') }}" wire:navigate class="text-white md:flex items-center font-light bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-sm text-sm px-4  py-2 text-center">Join Us</a>
            @endguest
        </div>
    </div>

    <!-- Sidebar (Hidden by Default) -->
    <div id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-white shadow-lg transform -translate-x-full transition-transform duration-300 z-50">
        <button id="close-sidebar" class="absolute top-4 right-4 text-gray-800">
            ✖
        </button>
        <div class="flex flex-col mt-16 space-y-4 p-4">
            <a class="py-2 px-3 hover:bg-gray-200 rounded" href="{{route('v2.public.homepage')}}" wire:navigate>Home</a>
            <a class="py-2 px-3 hover:bg-gray-200 rounded" href="{{route('v2.public.workshop')}}" wire:navigate>Workshop</a>
            <a class="py-2 px-3 hover:bg-gray-200 rounded" href="" wire:navigate>Free Courses</a>
            <a class="py-2 px-3 hover:bg-gray-200 rounded" href="{{route('v2.public.viewallcourses.all-courses')}}" wire:navigate>Pro Courses</a>
        </div>
    </div>

    <!-- JavaScript for Sidebar Toggle -->
    <script>
        document.getElementById("menu-toggle").addEventListener("click", function() {
            document.getElementById("sidebar").classList.remove("-translate-x-full");
        });

        document.getElementById("close-sidebar").addEventListener("click", function() {
            document.getElementById("sidebar").classList.add("-translate-x-full");
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Livewire.on('dropdownToggled', (data) => {
                let dropdownMenu = document.getElementById('dropdown-menu');
                if (data.isOpen) {
                    dropdownMenu.classList.remove('hidden');
                } else {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>

</div>
