<nav class="flex justify-between items-center py-2 px-6 bg-white shadow w-full rounded-full">
    <div class="flex items-center justify-start w-full">
        <div class="flex flex-row items-center">
            <!-- Hamburger button (only on small screens) -->
            <button @click="sidebarOpen = !sidebarOpen" class="p-2 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
            <!-- Logo (visible on larger screens) -->
            <img class="h-8 w-34 hidden sm:block" src="{{ asset('assets/LearnSyntax.png') }}" />
        </div>
    </div>

    <div class="flex gap-5 sm:mb-0 self-center ml-auto relative">
        @auth
            <button type="button" class="relative text-gray-600 hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-6 fill-purple-700">
                    <path
                        d="M5.85 3.5a.75.75 0 0 0-1.117-1 9.719 9.719 0 0 0-2.348 4.876.75.75 0 0 0 1.479.248A8.219 8.219 0 0 1 5.85 3.5ZM19.267 2.5a.75.75 0 1 0-1.118 1 8.22 8.22 0 0 1 1.987 4.124.75.75 0 0 0 1.48-.248A9.72 9.72 0 0 0 19.266 2.5Z" />
                    <path fill-rule="evenodd"
                        d="M12 2.25A6.75 6.75 0 0 0 5.25 9v.75a8.217 8.217 0 0 1-2.119 5.52.75.75 0 0 0 .298 1.206c1.544.57 3.16.99 4.831 1.243a3.75 3.75 0 1 0 7.48 0 24.583 24.583 0 0 0 4.83-1.244.75.75 0 0 0 .298-1.205 8.217 8.217 0 0 1-2.118-5.52V9A6.75 6.75 0 0 0 12 2.25ZM9.75 18c0-.034 0-.067.002-.1a25.05 25.05 0 0 0 4.496 0l.002.1a2.25 2.25 0 1 1-4.5 0Z"
                        clip-rule="evenodd" />
                </svg>
                @if(!empty($unreadCount))
                    <span
                        class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full w-4 h-4 flex items-center justify-center">
                        {{ $unreadCount }}
                    </span>
                @endif
            </button>
            <div class="relative">
                <button id="avatarButton"
                    class="flex items-center space-x-2 text-gray-700 hover:text-purple-600 focus:outline-none transition border border-gray-200 px-3 py-1 rounded-full"
                    type="button">
                    <div class="w-8 h-8 rounded-full bg-purple-600 text-white flex items-center justify-center">
                        <span class="text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                    </div>
                    <div class="hidden md:flex flex-col items-start">
                        <span class="font-medium">{{ auth()->user()->name }}</span>
                        <span class="text-sm text-gray-500 -mt-1">{{ auth()->user()->email }}</span>
                    </div>
                </button>

                <!-- Dropdown Menu -->
                <div id="dropdownMenu"
                    class="absolute right-0 top-full mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-10 hidden">
                    <div class="py-2 px-4 text-sm text-gray-700">
                        <span class="block font-semibold">{{ auth()->user()->email }}</span>
                    </div>
                    <a wire:navigate href="{{ route('admin.logout') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-100 hover:text-purple-600 transition">Logout</a>
                </div>
            </div>
        @endauth
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const avatarButton = document.getElementById('avatarButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        avatarButton.addEventListener('click', (e) => {
            e.stopPropagation(); 
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!avatarButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                dropdownMenu.classList.add('hidden');
            }
        });
    });
</script>