<div>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50">
        <livewire:page-heading 
            title="Our Courses"
            description="Learn Syntax offers comprehensive training in Full-Stack Web Development, C Programming, Laravel, SQL Database Management, and JavaScript & React. Our hands-on courses are designed to equip you with practical skills for real-world software and web development projects." 
            image="about-header.png" 
        />

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Course Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white/80 backdrop-blur-sm rounded-lg p-4 border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-medium text-gray-500">Total Courses</h4>
                            <p class="text-2xl font-bold text-gray-900">{{ count($published_courses) }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white/80 backdrop-blur-sm rounded-lg p-4 border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-medium text-gray-500">Active Students</h4>
                            <p class="text-2xl font-bold text-gray-900">500+</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white/80 backdrop-blur-sm rounded-lg p-4 border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-medium text-gray-500">Live Projects</h4>
                            <p class="text-2xl font-bold text-gray-900">50+</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white/80 backdrop-blur-sm rounded-lg p-4 border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-2 bg-yellow-100 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-medium text-gray-500">Success Rate</h4>
                            <p class="text-2xl font-bold text-gray-900">95%</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="mb-8">
                <div class="bg-white/80 backdrop-blur-sm rounded-lg border border-gray-100 p-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="relative flex-1">
                            <input type="text" 
                                   wire:model.debounce.300ms="search"
                                   placeholder="Search courses..." 
                                   class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <div class="flex gap-4">
                            <select wire:model="category" class="border border-gray-200 rounded-lg px-4 py-2 bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">All Categories</option>
                                <option value="web">Web Development</option>
                                <option value="programming">Programming</option>
                                <option value="database">Database</option>
                            </select>
                            <select wire:model="sortBy" class="border border-gray-200 rounded-lg px-4 py-2 bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Sort By</option>
                                <option value="newest">Newest First</option>
                                <option value="popular">Most Popular</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($published_courses as $course)
                    <x-course-card :course="$course" />
                @endforeach
            </div>

            <!-- Empty State -->
            @if(count($published_courses) === 0)
            <div class="text-center py-12">
                <div class="bg-white/80 backdrop-blur-sm rounded-lg p-8 max-w-md mx-auto">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M12 14h.01M12 16h.01M12 18h.01M12 20h.01M12 22h.01"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No courses found</h3>
                    <p class="mt-2 text-sm text-gray-500">We're constantly adding new courses. Check back later for updates.</p>
                    <button wire:click="resetFilters" class="mt-4 text-sm text-blue-600 hover:text-blue-700 font-medium">
                        Reset Filters
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
