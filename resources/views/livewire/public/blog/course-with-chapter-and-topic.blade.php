<div class="min-h-screen bg-gray-50 mt-24 pt-6 px-4">
    <!-- Header and Course Title -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-400 shadow-lg rounded-lg py-6">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <div class="box-border w-24 h-24 border-2 p-4 mx-auto rounded-xl bg-white flex items-center justify-center shadow-md">
                <img src="{{ asset('storage/' . $course->image) }}"" class="w-full" alt="">
            </div>
            <h1 class="text-4xl font-bold text-white mt-4">{{ $course->title }}</h1>
        </div>
    </header>

    <div class="flex flex-col md:flex-row gap-6 mt-6">
        <!-- Right Side: Course Content Details -->
        <div class="w-full md:w-3/4 bg-white shadow-lg rounded-xl p-6 overflow-y-auto h-screen">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">{{ $course->title }}</h2>
            <div class="space-y-6 text-center">
                <img src="{{ asset('assets/images/preview_1.0.png') }}" class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2 xl:w-1/3 mx-auto rounded-lg shadow-md" alt="">
                <p class="text-gray-700 text-lg leading-relaxed">{{ $course->description }}</p>
            </div>
        </div>

        <!-- Left Side: Scrollable Accordions -->
        <div class="w-full md:w-1/4 bg-white shadow-lg rounded-xl p-6 overflow-y-auto h-screen border border-gray-200">
            <h2 class="text-xl font-semibold mb-4">Chapters</h2>
            <div x-data="{ open: null }">
                @foreach($chapters as $chapter)
                <div class="mb-4">
                    <button @click="open === {{ $chapter->id }} ? open = null : open = {{ $chapter->id }}" 
                        class="w-full text-left bg-gray-100 hover:bg-gray-200 transition p-3 rounded-lg flex justify-between items-center shadow-sm">
                        <span class="font-medium">{{ $chapter->chapter_name }}</span>
                        <svg :class="{'rotate-180': open === {{ $chapter->id }}}" 
                            class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" 
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open === {{ $chapter->id }}" class="mt-2 pl-4 transition-all">
                        @foreach($chapter->topics as $topic)
                        <div class="bg-blue-50 hover:bg-blue-100 transition p-3 rounded-lg mb-2 shadow-sm">
                            <a href="{{ route('v2.topics.show', ['course_id' => $course->id, 'chapter_id' => $chapter->id, 'topic_id' => $topic->id]) }}" 
                                class="text-blue-700 font-medium block" wire:navigate>
                                {{ $topic->topic_name }}
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
