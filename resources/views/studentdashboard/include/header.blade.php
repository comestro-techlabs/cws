<nav class="bg-white w-full z-20 border-b border-gray-200 ">

  <div class="max-w-screen-xl flex items-center justify-between mx-auto px-4 py-2">

    <div class="flex gap-3 items-center">
      <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
        type="button"
        class="inline-flex items-center p-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200   ">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg">
          <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
          </path>
        </svg>
      </button>
      <!-- Logo Section -->
      <a href="{{ route('student.dashboard') }}" class="flex items-center rtl:space-x-reverse">
        <img src="{{ asset('assets/learnSyntax.png') }}" class="h-6" alt="Dashboard Logo">
      </a>
    </div>

    <!-- Right-side Section -->
    <div class="flex items-center space-x-4 rtl:space-x-reverse">
      <!-- Notifications Icon -->
      <button type="button" class="relative text-gray-600  hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11.5a6.5 6.5 0 00-13 0v2.658c0 .379-.214.725-.553.947L3 17h5m6 0v1a3 3 0 01-6 0v-1m6 0H9" />
        </svg>
        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full w-4 h-4 flex items-center justify-center">3</span>
      </button>

      <!-- Profile Dropdown -->
      <span class="hidden md:inline text-sm font-medium">@if(auth()->check())
        {{ auth()->user()->name }}

        <button id="membership-pay-button"
          class="flex items-center justify-center w-48 h-12 bg-indigo-400 border-4 border-double text-black mt-2 shadow-xl px-6 py-3 transition duration-300 ease-in-out transform hover:scale-105 space-x-3 rounded-lg">
          <span>Become Member</span>
        </button>
        @endif
      </span>


      <!-- Mobile Menu Toggle -->

    </div>
  </div>


</nav>
