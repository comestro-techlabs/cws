<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    @livewireStyles
</head>

<body x-data="{ sidebarOpen: true }" class="bg-gray-100">
    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
         class="fixed inset-0 z-30 transition-opacity duration-300 sm:hidden"
         :class="{'opacity-50': sidebarOpen, 'opacity-0': !sidebarOpen}">
    </div>

    <!-- Sidebar -->
    <div x-show="sidebarOpen"
         :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
         class="fixed top-0 left-0 z-40 w-64 h-screen bg-white p-4 border-r overflow-x-hidden transform transition-transform duration-300 ease-in-out sm:translate-x-0 sm:block">
        <x-side-nav/>
    </div>

    <!-- Main content -->
    <main :class="{'sm:ml-64': sidebarOpen, 'ml-0': !sidebarOpen}"
          class="flex-1 p-4 transition-all duration-300 sm:ml-64">
        <x-admin-header />
        {{ $slot }}
    </main>

    {{-- toastr --}}
    {{-- <div class="flex justify-end items-center ">
        <div
            x-data="noticesHandler()"
            class="fixed top-5 right-5 flex flex-col items-end space-y-3 p-4 z-50"
            @notice.window="add($event.detail)"
            style="pointer-events:none">
            <template x-for="notice in notices" :key="notice.id">
                <div
                    x-show="visible.includes(notice)"
                    x-transition:enter="transition ease-in duration-200"
                    x-transition:enter-start="transform opacity-0 translate-x-5"
                    x-transition:enter-end="transform opacity-100 translate-x-0"
                    x-transition:leave="transition ease-out duration-500"
                    x-transition:leave-start="transform opacity-100 translate-x-0"
                    x-transition:leave-end="transform opacity-0 translate-x-5"
                    @click="remove(notice.id)"
                    class="rounded-lg px-4 py-3 w-72 bg-slate-100  shadow-lg text-black font-medium text-sm cursor-pointer flex items-center justify-between"
                   
                    style="pointer-events:all">
                    <span x-text="notice.text"></span>
                    <button @click="remove(notice.id)" class="ml-2 text-white font-bold">×</button>
                </div>
            </template>
        </div>
    </div> --}}

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- toastr --}}
    {{-- <script>
        function noticesHandler() {
            return {
                notices: [],
                visible: [],
                add(notice) {
                    notice.id = Date.now();
                    this.notices.push(notice);
                    this.fire(notice.id);
                },
                fire(id) {
                    this.visible.push(this.notices.find(notice => notice.id === id));
                    setTimeout(() => {
                        this.remove(id);
                    }, 1000);
                },
                remove(id) {
                    this.visible = this.visible.filter(notice => notice.id !== id);
                },
            };
        }
    </script> --}}

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('success', (data) => {
                const message = data[0].message;
                toastr.success(message, 'Success');
            });
        });


        // Avatar Dropdown Script
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
    @livewireScripts
</body>

</html>
