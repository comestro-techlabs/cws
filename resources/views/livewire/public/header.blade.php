<div>
    <!-- component -->
    <div class=" shadow-2xl border-2 border-primary  w-full flex relative justify-between items-center mx-auto px-8 h-20 rounded-full backdrop-blur bg-white bg-opacity-20 ">
        <!-- logo -->
        <div class="inline-flex">
            <a class="_o6689fn" href="/">
                <div class="hidden md:block">
                    <a href="{{route('public.index')}}" class="flex ms-2 md:me-24">
                        <img src="{{ asset('assets/LearnSyntax.png') }}" class="h-6 sm:h-8" alt="">
                    </a>
                </div>
            </a>
        </div>

        <!-- end logo -->

        <!-- menu items -->
        <div class="flex-initial">
            <div class="flex justify-center items-center ">
                <div class="flex mr-4 items-center">
                    <a class="inline-block py-2 px-3 hover:bg-gray-200 rounded-full" href="{{route('v2.public.homepage')}}" wire:navigate>
                        <div class="flex items-center relative cursor-pointer whitespace-nowrap">Home</div>
                    </a>
                </div>
                <div class="flex mr-4 items-center">
                    <a class="inline-block py-2 px-3 hover:bg-gray-200 rounded-full" href="{{route('v2.public.workshop')}}" wire:navigate>
                        <div class="flex items-center relative cursor-pointer whitespace-nowrap">Workshop</div>
                    </a>
                </div>
                <div class="flex mr-4 items-center">
                    
                    <div class="min-h-screen flex items-center justify-center">
        <div class="relative inline-block text-left">
            <button id="dropdown-button" class="inline-flex justify-center w-full px-4 py-2    border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500 hover:bg-gray-200">
                Courses
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div id="dropdown-menu" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">
                    <a  class="flex block rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer" role="menuitem">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" id="light" width="18px" class="mr-2"></svg>Free Courses
                      </a>
                    <a href="{{route('v2.public.viewallcourses.all-courses')}}" wire:navigate class="flex block rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer" role="menuitem">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="crown" width="18px" class="mr-2"><path fill="gold" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.86L12 17.77 5.82 21l1.18-6.86-5-4.87 6.91-1.01L12 2z
"></path></svg> Pro Courses
                    </a>
                   
                </div>
            </div>
        </div>
    </div>
                </div>
            </div>
        </div>
        <!-- end menu items -->

        <!-- login -->
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
            <a href="{{ route('v2.auth.login') }}" wire:navigate
                class="text-primary hidden md:flex items-center font-light border border-indigo-600 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-sm hover:text-white text-sm px-4  py-2 text-center">
                Login</a>
            <a href="{{ route('v2.auth.register') }}" wire:navigate
                class="text-white md:flex items-center font-light bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-sm text-sm px-4  py-2 text-center">
                Join Us</a>
            @endguest

        </div>

        <!-- end login -->
    </div>
</div>