<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="livewire:script-url" content="{{ asset('livewire/livewire.js') }}">
    
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style type="text/tailwindcss">
        @layer base {
            html {
                font-family: "Poppins", system-ui, sans-serif;
            }
        }
    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Poppins", sans-serif!important;
        }
    </style>
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    @livewireStyles
</head>

<body x-data="{ sidebarOpen: true, dropdownOpen: false }" class="bg-gray-50">
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

    <div class="flex justify-end items-center">
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
                    class="rounded-lg px-4 py-3 w-72 bg-gray-400 shadow-lg text-black font-medium text-sm cursor-pointer flex items-center justify-between"
                    style="pointer-events:all">
                    <span x-text="notice.text"></span>
                    <button @click="remove(notice.id)" class="ml-2 text-white font-bold">×</button>
                </div>
            </template>
        </div>
    </div>

    <script>
        // Initialize Pusher only once
        const pusher = new Pusher('fd3ed3ccbe3088d32dbc', {
            cluster: 'ap2',
            authEndpoint: '/broadcasting/auth',
            auth: {
                headers: {
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
                }
            }
        });
    
        // Notification handler with cooldown
        const NotificationHandler = {
            lastToastTime: 0,
            TOAST_COOLDOWN_MS: 10000,
    
            showToast({ icon, title, text }) {
                const now = Date.now();
                if (now - this.lastToastTime >= this.TOAST_COOLDOWN_MS) {
                    this.lastToastTime = now;
                    Swal.fire({
                        icon,
                        title,
                        text,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true
                    }).then(() => {
                        console.log('SweetAlert2 toast displayed successfully');
                        confetti({
                            particleCount: 100,
                            spread: 150,
                            origin: { y: 0.6 }
                        });
                    }).catch(error => {
                        console.error('SweetAlert2 or confetti error:', error);
                    });
                }
            }
        };
    
        // Subscribe to channels and bind events
        const userChannel = pusher.subscribe('my-channel');
        userChannel.bind('user-registered', function (data) {
            console.log('User-registered event handler triggered:', data);
            NotificationHandler.showToast({
                icon: 'success',
                title: 'New User Registered!',
                text: `Welcome, ${data.user?.name ?? 'User'}! Your account has been created successfully.`
            });
        });
    
        const assignmentChannel = pusher.subscribe('assignment-channel');
        assignmentChannel.bind('assignment-uploaded', function (data) {
            console.log('Assignment-uploaded event handler triggered:', data);
            NotificationHandler.showToast({
                icon: 'success',
                title: 'Assignment Uploaded!',
                text: `Assignment "${data.assignment_uploaded?.assignment_title ?? 'Untitled'}" uploaded successfully by ${data.assignment_uploaded?.student_name ?? 'User'}.`
            }); 
        });
    
        // Notices handler for custom notifications
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
                    }, 3000);
                },
                remove(id) {
                    this.visible = this.visible.filter(notice => notice.id !== id);
                }
            };
        }
    
        // Livewire success event listener
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('success', (data) => {
                if (data && data[0]?.message) {
                    toastr.success(data[0].message, 'Success');
                } else {
                    console.warn('Invalid or missing data in Livewire success event:', data);
                }
            });
        });
    </script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    @stack('scripts')
</body>
</html>