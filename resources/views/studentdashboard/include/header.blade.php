<nav class="bg-white w-full z-20 border-b border-gray-200 ">

  <div class="flex items-center justify-between px-4 md:px-10 py-3 md:py-5">

    <div class="flex gap-3 items-center ">
      <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
        type="button"
        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200   ">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg">
          <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
          </path>
        </svg>
      </button>
      <!-- Logo Section -->
      <a href="{{ route('student.dashboard') }}" class="flex items-center">
        <img src="{{ asset('assets/learnSyntax.png') }}" class="h-8" alt="Dashboard Logo">
      </a>
    </div>

    <!-- Right-side Section -->
    <div class="flex items-center space-x-4">
      <!-- Notifications Icon -->
      <button type="button" class="relative text-gray-600  hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 fill-red-500">
            <path d="M5.85 3.5a.75.75 0 0 0-1.117-1 9.719 9.719 0 0 0-2.348 4.876.75.75 0 0 0 1.479.248A8.219 8.219 0 0 1 5.85 3.5ZM19.267 2.5a.75.75 0 1 0-1.118 1 8.22 8.22 0 0 1 1.987 4.124.75.75 0 0 0 1.48-.248A9.72 9.72 0 0 0 19.266 2.5Z" />
            <path fill-rule="evenodd" d="M12 2.25A6.75 6.75 0 0 0 5.25 9v.75a8.217 8.217 0 0 1-2.119 5.52.75.75 0 0 0 .298 1.206c1.544.57 3.16.99 4.831 1.243a3.75 3.75 0 1 0 7.48 0 24.583 24.583 0 0 0 4.83-1.244.75.75 0 0 0 .298-1.205 8.217 8.217 0 0 1-2.118-5.52V9A6.75 6.75 0 0 0 12 2.25ZM9.75 18c0-.034 0-.067.002-.1a25.05 25.05 0 0 0 4.496 0l.002.1a2.25 2.25 0 1 1-4.5 0Z" clip-rule="evenodd" />
          </svg>
          @if(!empty($unreadCount))
          <span class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full w-4 h-4 flex items-center justify-center">
              {{ $unreadCount }}
          </span>
          @endif
      
      </button>

      <!-- Profile Dropdown -->
      <span class="hidden md:inline text-sm font-medium capitalize">@if(auth()->check())
        {{ auth()->user()->name }}

        @endif
      </span>


      <!-- Mobile Menu Toggle -->

    </div>
  </div>


</nav>
