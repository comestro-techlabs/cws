<nav
    class="flex justify-between items-center py-2 px-6 bg-white shadow w-full rounded-full">
    <div class="flex items-center justify-start w-full">
        <div class="flex flex-row items-center">
            <!-- Hamburger button (only on small screens) -->
            <button @click="sidebarOpen = !sidebarOpen" class=" p-2 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>

            </button>

            <!-- Logo (visible on larger screens) -->
            <img class="h-6 w-38 hidden sm:block" src="{{ asset('assets/LearnSyntax.png') }}" />
        </div>
    </div>
    </div>

    <div class="sm:mb-0 self-center ml-auto relative">
        @auth
            <button id="avatarButton" class="flex items-center space-x-2 p-2 focus:outline-none">
                <img class="w-8 h-8 rounded-full" src="{{ asset('assets/sadique.jpg') }}" alt="User Avatar">
                <span class="hidden text-gray-700">{{ auth()->user()->name }}</span>
            </button>

            <div id="dropdownMenu"
                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-10 hidden">
                <div class="py-2 px-4 text-sm text-gray-700">
                    <span class="block font-semibold">{{ auth()->user()->email }}</span>
                </div>
                <a wire:navigate href="{{ route('admin.logout') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-b-lg">Logout</a>
            </div>
        @endauth
    </div>
</nav>
<script>
    const avatarButton = document.getElementById('avatarButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    avatarButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    window.addEventListener('click', (event) => {
        if (!event.target.closest('#avatarButton') && !event.target.closest('#dropdownMenu')) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>