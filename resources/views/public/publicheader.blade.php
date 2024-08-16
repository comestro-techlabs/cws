<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code with Sadiq - Navbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-800 shadow-lg  w-full z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="text-2xl font-bold text-gray-800 dark:text-white">
                    <a href="#">
                        <img src="{{asset('assets/logosmall.png')}}" class="w-[120px]" alt="">
                    </a>
                </div>

                <!-- Primary Navigation -->
                <div class="hidden md:flex space-x-6">
                    <a href="#" class="text-gray-600 dark:text-gray-200 hover:text-blue-600">Home</a>
                    <a href="#" class="text-gray-600 dark:text-gray-200 hover:text-blue-600">Courses</a>
                    <a href="#" class="text-gray-600 dark:text-gray-200 hover:text-blue-600">Blog</a>
                    <a href="#" class="text-gray-600 dark:text-gray-200 hover:text-blue-600">Contact</a>
                </div>

                <!-- Dark Mode Toggle -->
                <div class="flex items-center space-x-4">
                    <button id="theme-toggle" class="text-gray-600 dark:text-gray-200 focus:outline-none">
                        <svg id="theme-icon" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 3v3m0 12v3m9-9h-3M3 12H0m16.24 6.364l-2.12-2.121M7.879 7.879l-2.121-2.121m10.242 10.243l-2.12 2.12M7.879 16.243l-2.121 2.121M12 1.5A10.5 10.5 0 0112 22.5 10.5 10.5 0 0112 1.5z"></path>
                        </svg>
                    </button>
                    
                    <!-- Mobile Menu Button -->
                    <button id="menu-toggle" class="md:hidden text-gray-600 dark:text-gray-200 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-800">
            <a href="#" class="block px-4 py-2 text-gray-600 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Home</a>
            <a href="#" class="block px-4 py-2 text-gray-600 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Courses</a>
            <a href="#" class="block px-4 py-2 text-gray-600 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Blog</a>
            <a href="#" class="block px-4 py-2 text-gray-600 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Contact</a>
        </div>
    </nav>

    <script>
        // Dark Mode Toggle
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const body = document.body;

        themeToggle.addEventListener('click', () => {
            body.classList.toggle('dark');
            themeIcon.classList.toggle('hidden');
        });

        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
