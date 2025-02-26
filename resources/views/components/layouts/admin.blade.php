<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    @livewireStyles
    @fluxAppearance
</head>

<body class="bg-zinc-50 flex min-h-screen font-sans antialiased sm:mt-8">
    <aside
        class="hidden lg:block w-64 bg-white dark:bg-zinc-800 border-r border-gray-200 dark:border-gray-700 shadow-lg sticky top-0 h-screen flex flex-col scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600 scrollbar-track-gray-100 dark:scrollbar-track-gray-800 transition-all duration-300 overflow-y-auto">
        <!-- Navigation -->
        <nav class="px-2 space-y-1 py-14 overflow-y-auto flex-1">
            <button
                class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition-all duration-200">
                <div class="flex items-center gap-3">
                    <!-- Manage Students: Group of people -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 1.857a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Manage Students
                </div>
            </button>

            <button
                class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition-all duration-200">
                <div class="flex items-center gap-3">
                    <!-- Manage Categories: Tag icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h10l3.5 3.5-7.5 7.5H3l4-11zm4 0v4m-2-2h4" />
                    </svg>
                    Manage Categories
                </div>
            </button>

            <button
                class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition-all duration-200"
                onclick="this.nextElementSibling.classList.toggle('hidden')">
                <div class="flex items-center gap-3">
                    <!-- Manage Courses: Book icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Manage Courses
                </div>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div class="hidden pl-6 space-y-1">
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Insert
                    Course</a>
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Manage
                    Course</a>
            </div>

            <button
                class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition-all duration-200"
                onclick="this.nextElementSibling.classList.toggle('hidden')">
                <div class="flex items-center gap-3">
                    <!-- Assignments: Pencil and paper -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Assignments
                </div>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div class="hidden pl-6 space-y-1">
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Insert
                    Assignment</a>
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Manage
                    Assignment</a>
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">View
                    Course</a>
            </div>

            <button
                class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition-all duration-200"
                onclick="this.nextElementSibling.classList.toggle('hidden')">
                <div class="flex items-center gap-3">
                    <!-- Manage Exam: Clipboard with check -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    Manage Exam
                </div>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div class="hidden pl-6 space-y-1">
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Insert
                    Exam</a>
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Manage
                    Exam</a>
            </div>

            <button
                class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition-all duration-200"
                onclick="this.nextElementSibling.classList.toggle('hidden')">
                <div class="flex items-center gap-3">
                    <!-- Manage Quiz: Question mark -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Manage Quiz
                </div>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div class="hidden pl-6 space-y-1">
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Insert
                    Quiz</a>
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Manage
                    Quiz</a>
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Manage
                    Result</a>
            </div>

            <button
                class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition-all duration-200"
                onclick="this.nextElementSibling.classList.toggle('hidden')">
                <div class="flex items-center gap-3">
                    <!-- Manage Portfolio: Briefcase -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Manage Portfolio
                </div>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div class="hidden pl-6 space-y-1">
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Insert
                    Portfolio</a>
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Manage
                    Portfolio</a>
            </div>

            <button
                class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition-all duration-200"
                onclick="this.nextElementSibling.classList.toggle('hidden')">
                <div class="flex items-center gap-3">
                    <!-- Manage Workshop: Wrench -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.5 21.75l-3-3a2 2 0 01.586-2.828L15 12l-3-3a2 2 0 012.828-.586l3 3a2 2 0 010 2.828l-3 3a2 2 0 01-2.828.586zM3 3l3 3m0 0l3-3m-3 3v12" />
                    </svg>
                    Manage Workshop
                </div>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div class="hidden pl-6 space-y-1">
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Insert
                    Workshop</a>
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Manage
                    Workshop</a>
            </div>

            <button
                class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition-all duration-200"
                onclick="this.nextElementSibling.classList.toggle('hidden')">
                <div class="flex items-center gap-3">
                    <!-- Manage Student: Single user -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Manage Student
                </div>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div class="hidden pl-6 space-y-1">
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Insert
                    Student</a>
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Manage
                    Student</a>
            </div>

            <button
                class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition-all duration-200"
                onclick="this.nextElementSibling.classList.toggle('hidden')">
                <div class="flex items-center gap-3">
                    <!-- Manage Message: Envelope -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Manage Message
                </div>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div class="hidden pl-6 space-y-1">
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Send
                    Message</a>
                <a href="#"
                    class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 rounded-lg transition-all duration-200">Manage
                    Messages</a>
            </div>

            <button
                class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition-all duration-200">
                <div class="flex items-center gap-3">
                    <!-- Certificate: Award badge -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 3c-2.616 0-5.03.815-7.018 2.198m12.636 0l1.382-1.382a1 1 0 011.414 0l1.414 1.414a1 1 0 010 1.414l-1.414 1.414M3 3l3 3m0 0l3-3m-3 3v12" />
                    </svg>
                    Certificate
                </div>
            </button>

            <button
                class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition-all duration-200">
                <div class="flex items-center gap-3">
                    <!-- Manage Payment: Credit card -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Manage Payment
                </div>
            </button>

            <button
                class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition-all duration-200">
                <div class="flex items-center gap-3">
                    <!-- Manage Enquiries: Chat bubble -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    Manage Enquiries
                </div>
            </button>
        </nav>

        <!-- Bottom Navigation -->
        <nav class="w-full p-4 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-800 shrink-0">
            <a href="#"
                class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition-all duration-200">
                <!-- Settings: Gear -->
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37 1 .608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Settings
            </a>
            <a href="#"
                class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition-all duration-200">
                <!-- Help: Lifebuoy -->
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18.364 5.636l-3-3a2 2 0 01.586-2.828L15 12l-3-3a2 2 0 012.828-.586l3 3a2 2 0 010 2.828l-3 3a2 2 0 01-2.828.586zM3 3l3 3m0 0l3-3m-3 3v12" />
                </svg>
                Help
            </a>
        </nav>
    </aside>

    <x-admin-header />
    <main class="w-full flex-1 p-4">
        {{ $slot }}
    </main>

    @livewireScripts
    @fluxScripts
</body>

</html>