<div class="px-4 sm:px-6 lg:px-8 py-4">
    <nav class="bg-white shadow-sm rounded-full border border-gray-100">
        <div class="max-w-7xl mx-auto px-6 py-2">
            <div class="flex justify-between items-center h-12">
                <div class="flex items-center">
                    <button @click="$dispatch('toggle-sidebar')"
                            class="p-2 text-gray-700 hover:text-purple-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-purple-100 transition-colors duration-200">
                        <span class="sr-only">Open menu</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="flex-shrink-0 flex items-center ml-3 lg:ml-0">
                        <img class="h-7 w-auto" src="{{ asset('assets/LearnSyntax.png') }}" alt="Learn Syntax" />
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <button type="button" class="relative text-gray-700 hover:text-blue-600 transition duration-200 p-2 rounded-lg hover:bg-blue-50">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        @if(!empty($unreadCount))
                            <span class="absolute -top-1 -right-1 bg-orange-500 text-white text-xs font-bold rounded-full h-4 w-4 flex items-center justify-center">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </button>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 focus:outline-none transition duration-200 rounded-lg hover:bg-blue-50 px-4 py-2">
                            <div class="h-7 w-7 rounded-full bg-blue-600 flex items-center justify-center">
                                <span class="text-sm font-medium text-white">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                            </div>
                            <div class="hidden md:block text-left">
                                <div class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-gray-700">{{ auth()->user()->email }}</div>
                            </div>
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 rounded-lg shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
                             role="menu"
                             aria-orientation="vertical"
                             aria-labelledby="user-menu">

                            <a href="{{ route('student.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition duration-200" role="menuitem">Your Profile</a>
                            <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition duration-200" role="menuitem">Settings</a>
                            <a href="{{ route('admin.logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition duration-200" role="menuitem">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
