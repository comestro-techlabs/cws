<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8 mt-12">
    <div class="max-w-7xl mx-auto space-y-8">
        <!-- Header with Glassmorphism Effect -->
        <header class="bg-white/60 backdrop-blur-lg rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-8 text-center">
                <div class="relative inline-block">
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl opacity-75 blur-lg"></div>
                    <div class="relative bg-white p-4 rounded-2xl shadow-md">
                        <img src="{{ asset('storage/' . $course->image) }}" class="w-24 h-24 mx-auto object-cover rounded-xl" alt="course_image">
                    </div>
                </div>
                <h1 class="mt-6 text-4xl font-extrabold text-gray-900">{{ $course->title }}</h1>
                <p class="mt-3 text-xl text-gray-600">{{ $course->subtitle }}</p>
            </div>
        </header>

        <!-- Content Container -->
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Course Description (Main Content) -->
            <div class="md:col-span-2 bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                <div class="space-y-6">
                    <img src="{{ asset('assets/images/preview_1.0.png') }}" class="w-full rounded-2xl shadow-md object-cover" alt="Course Preview">
                    <div class="prose max-w-none">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Course Overview</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $course->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Chapters Sidebar with Modern Accordion -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Course Chapters</h2>
                <div x-data="{ activeChapter: null }">
                    @foreach($chapters as $chapter)
                    <div class="mb-4 border-b last:border-b-0 border-gray-100">
                        <button 
                            @click="activeChapter = activeChapter === {{ $chapter->id }} ? null : {{ $chapter->id }}"
                            class="w-full flex justify-between items-center py-4 text-left text-gray-800 hover:text-blue-600 transition"
                        >
                            <span class="font-semibold">{{ $chapter->chapter_name }}</span>
                            <svg 
                                :class="{'rotate-180': activeChapter === {{ $chapter->id }}}"
                                class="w-5 h-5 text-gray-500 transition-transform duration-300" 
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
                            class="pl-4 mt-2 space-y-2"
                        >
                            @foreach($chapter->topics as $topic)
                            <a 
                                href="{{ route('v2.topics.show', ['course_id' => $course->id, 'chapter_id' => $chapter->id, 'topic_id' => $topic->id]) }}"
                                class="block py-2 px-4 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition"
                                wire:navigate
                            >
                                {{ $topic->topic_name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>