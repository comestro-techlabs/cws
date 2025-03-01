



<nav class="flex justify-between items-center py-2 px-6 bg-white shadow w-full rounded-full">
    <div class="flex items-center justify-start w-full">
        <div class="flex flex-row items-center">
            <!-- Hamburger button (only on small screens) -->
            <button @click="sidebarOpen = !sidebarOpen" class=" p-2 focus:outline-none">
                <img class="h-8 w-8 self-center " src="{{asset('apple-touch-icon.png')}}" />
            </button>

            <!-- Logo (visible on larger screens) -->
            <img class="h-4 w-28 hidden sm:block" src="{{ asset('assets/LearnSyntax.png') }}" />
        </div>
    </div>

    <div class="sm:mb-0 self-center ml-auto relative">
        @auth
            <button id="avatarButton"
                class="flex items-center space-x-2 text-gray-700 hover:text-purple-600 focus:outline-none transition border border-gray-200 px-3 py-1 rounded-full">
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
                class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-10 hidden animate-fade-in">
                <div class="py-2 px-4 text-sm text-gray-700">
                    <span class="block font-semibold">{{ auth()->user()->email }}</span>
                </div>
                <a wire:navigate href="{{ route('admin.logout') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-100 hover:text-purple-600 transition">Logout</a>
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
