<nav class="bg-white dark:bg-gray-900 w-full z-20 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
      <!-- Logo Section -->
      <a href="{{ route('student.dashboard') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="{{ asset('assets/learnSyntax.png') }}" class="h-10" alt="Dashboard Logo">
        <span class="text-xl font-bold text-gray-300 dark:text-white">Student Panel</span>
      </a>

      <!-- Right-side Section -->
      <div class="flex items-center space-x-4 rtl:space-x-reverse">
        <!-- Notifications Icon -->
        <button type="button" class="relative text-gray-600 dark:text-gray-300 hover:text-blue-600">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11.5a6.5 6.5 0 00-13 0v2.658c0 .379-.214.725-.553.947L3 17h5m6 0v1a3 3 0 01-6 0v-1m6 0H9" />
          </svg>
          <span class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full w-4 h-4 flex items-center justify-center">3</span>
        </button>

        <!-- Profile Dropdown -->
        <div class="relative">
          <button type="button" class="flex items-center space-x-2 rtl:space-x-reverse text-gray-800 dark:text-white focus:outline-none hover:text-blue-600" id="profileDropdownToggle">
            <span class="hidden md:inline text-sm font-medium">@if(auth()->check())
                {{ auth()->user()->name }}
            @endif</span>
          </button>
          <!-- Dropdown Menu -->
          <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 shadow-lg rounded-lg hidden" id="profileDropdown">
            <a href="#" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Profile</a>
            <a href="#" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Settings</a>
            <a href="#" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Logout</a>
          </div>
        </div>

        <!-- Mobile Menu Toggle -->

      </div>
    </div>


  </nav>
