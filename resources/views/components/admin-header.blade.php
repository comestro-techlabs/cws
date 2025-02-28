<nav class="font-sans flex flex-col text-center content-center sm:flex-row sm:text-left sm:justify-between py-2 px-6 bg-white shadow sm:items-baseline w-full rounded-full">
    <div class="mb-2 sm:mb-0 flex flex-row">
        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </div>

    <div class="sm:mb-0 self-center ml-auto relative">
        @auth
        <button id="avatarButton" class="flex items-center space-x-2 p-2 focus:outline-none">
            <img class="w-8 h-8 rounded-full" src="{{ asset('assets/sadique.jpg') }}" alt="User Avatar">
            <span class="text-gray-700">{{ auth()->user()->name }}</span>
        </button>

        <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-10 hidden">
            <div class="py-2 px-4 text-sm text-gray-700">
                <span class="block font-semibold">{{ auth()->user()->email }}</span> 
                <!-- the actual user name -->
            </div>
            <a wire:navigate href="{{ route('admin.logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-b-lg">Logout</a>
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
