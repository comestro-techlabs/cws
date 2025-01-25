<div class="px-3 py-3 lg:px-24">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" >
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <a href="{{route("public.index")}}" class="flex ms-2 md:me-24">
            <img src="{{ asset('assets/LearnSyntax.png') }}" class="h-8" alt="">
        </a>
      </div>

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
                    class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 ">Courses</a>
            </li>
            <li>
                <a href="{{route('public.portfolio')}}"
                    class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 ">Portfolio</a>
            </li>
            <li>
                <a href="{{route('public.workshops')}}"
                    class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 ">Workshop</a>
            </li>

            <li>
                <a href="/contact"
                    class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 ">Contact</a>
            </li>
        </ul>
    </div>
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
                Join Us</a>
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
  </div>
