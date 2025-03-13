<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: "Poppins", sans-serif!important;
        }
    </style>
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    @livewireStyles
</head>

<body x-data="{ sidebarOpen: true }" class="bg-gray-50">
    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
         class="fixed inset-0 z-30 transition-opacity duration-300 sm:hidden"
         :class="{'opacity-50': sidebarOpen, 'opacity-0': !sidebarOpen}">
    </div>

    <!-- Sidebar -->
    <div x-show="sidebarOpen"
         :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
         class="fixed top-0 left-0 z-40 w-64 h-screen overflow-x-hidden transform transition-transform duration-300 ease-in-out sm:translate-x-0 sm:block">
        <x-side-nav/>
    </div>

    <!-- Main content -->
    <main :class="{'sm:ml-64': sidebarOpen, 'ml-0': !sidebarOpen}"
          class="flex-1 p-4 transition-all duration-300 sm:ml-64">
        <x-admin-header />
        <div class="mt-8">
        {{ $slot }}
        </div>
    </main>

    {{-- toastr --}}
    <div class="flex justify-end items-center ">
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
                    class="rounded-lg px-4 py-3 w-72 bg-gray-400  shadow-lg text-black font-medium text-sm cursor-pointer flex items-center justify-between"

                    style="pointer-events:all">
                    <span x-text="notice.text"></span>
                    <button @click="remove(notice.id)" class="ml-2 text-white font-bold">×</button>
                </div>
            </template>
        </div>
    </div>

    <!-- Scripts -->
    {{-- toastr --}}

    <script>
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
    </script>

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @livewireScripts
</body>

</html>
