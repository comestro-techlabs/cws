<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-12 px-4 sm:px-6 lg:px-8 mt-12">
    <div class="max-w-7xl mx-auto space-y-8">
        <!-- Header with Glassmorphism Effect -->
        <header class="bg-white/80 backdrop-blur-lg rounded-lg shadow-md border border-gray-100 overflow-hidden">
            <div class="px-6 py-8 text-center">
                <div class="relative inline-block">
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg opacity-75 blur-lg"></div>
                    <div class="relative bg-white p-4 rounded-lg shadow-sm">
                        <img src="{{ asset('storage/' . $course->image) }}" class="w-24 h-24 mx-auto object-cover rounded-lg" alt="{{ $course->title }}">
                    </div>
                </div>
                <h1 class="mt-6 text-4xl font-bold text-gray-900">{{ $course->title }}</h1>
                <p class="mt-3 text-lg text-gray-700">{{ $course->subtitle }}</p>
                
                <!-- Course Meta Information -->
                <div class="flex justify-center items-center mt-6 space-x-6 text-sm">
                    <div class="flex items-center text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ count($chapters) }} Chapters</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>{{ $course->topics_count ?? 'Multiple' }} Lessons</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <span>Beginner Friendly</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Container -->
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Course Description (Main Content) -->
            <div class="md:col-span-2 bg-white rounded-lg shadow-md p-8 border border-gray-100">
                <div class="space-y-6">
                    <img src="{{ asset('assets/images/preview_1.0.png') }}" class="w-full rounded-lg shadow-sm object-cover h-64" alt="Course Preview">
                    
                    <div class="flex items-center space-x-4 py-3 border-b border-gray-100">
                        <button class="px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-blue-600 focus:outline-none">
                            Overview
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-blue-600 transition duration-200 focus:outline-none">
                            Resources
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-blue-600 transition duration-200 focus:outline-none">
                            Reviews
                        </button>
                    </div>
                    
                    <div class="prose max-w-none">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Course Overview</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $course->description }}</p>
                        
                        <h3 class="text-xl font-semibold text-gray-900 mt-8 mb-4">What You'll Learn</h3>
                        <ul class="space-y-2">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-blue-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Master the fundamentals of the subject</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-blue-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Build practical projects to reinforce your learning</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-blue-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Gain confidence through hands-on exercises</span>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Call to Action -->
                    <div class="mt-8 flex justify-center">
                        <a href="#chapters" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Start Learning
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Chapters Sidebar with Modern Accordion -->
            <div id="chapters" class="bg-white rounded-lg shadow-md p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Course Chapters
                </h2>
                <div x-data="{ activeChapter: null }">
                    @foreach($chapters as $chapter)
                    <div class="mb-4 border-b last:border-b-0 border-gray-100">
                        <button 
                            @click="activeChapter = activeChapter === {{ $chapter->id }} ? null : {{ $chapter->id }}"
                            class="w-full flex justify-between items-center py-4 text-left text-gray-800 hover:text-blue-600 focus:outline-none transition duration-200"
                        >
                            <span class="font-medium">{{ $chapter->chapter_name }}</span>
                            <svg 
                                :class="{'rotate-180': activeChapter === {{ $chapter->id }}}"
                                class="w-5 h-5 text-blue-600 transition-transform duration-300" 
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div 
                            x-show="activeChapter === {{ $chapter->id }}" 
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2"
                            class="pl-4 mt-2 space-y-2 pb-4"
                        >
                            @foreach($chapter->topics as $topic)
                            <a 
                                href="{{ route('v2.topics.show', ['course_slug' => $course->course_slug, 'chapter_slug' => $chapter->chapter_slug, 'topic_slug' => $topic->topic_slug]) }}"
                                class="flex items-center py-2 px-4 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-200"
                                wire:navigate
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                {{ $topic->topic_name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Instructor Info -->
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Your Instructor</h3>
                    <div class="flex items-center">
                        <img src="{{ asset('assets/instructor.jpg') }}" alt="Instructor" class="w-12 h-12 rounded-full object-cover mr-4" onerror="this.src='{{ asset('assets/default-avatar.png') }}'">
                        <div>
                            <h4 class="font-medium text-gray-900">Learn Syntax Team</h4>
                            <p class="text-sm text-gray-600">Expert Instructors</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>