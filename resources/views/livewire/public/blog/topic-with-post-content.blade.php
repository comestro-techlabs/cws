<div>
<div class="min-h-screen bg-white mt-24 pt-6">
    <!-- Header and Course Title -->
    <header class="bg-primary shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-white text-center mt-4">
                {{ $course->title }}
            </h1>
        </div>
    </header>

    <div class="flex flex-col md:flex-row">
        <!-- Right Side: Topic Content Details (Visible on top for mobile and small devices) -->
        <div class="w-full md:w-3/4 bg-white p-4 overflow-y-auto h-screen order-1 md:order-2">
            <h2 class="text-xl font-semibold mb-4 flex justify-center">{{ $selectedTopic->topic_name ?? 'Select a Topic' }}</h2>
            <div class="space-y-4">
                @if($selectedTopic)
                    <img src="{{ asset('assets/images/preview_1.0.png') }}" class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2 xl:w-1/3 mx-auto h-auto" alt="">
                    <p class="text-gray-700">{{ $selectedTopic->topic_description }}</p>
                    <!-- Add more topic content details here -->
                @else
                    <p class="text-gray-700">Please select a topic to view its content.</p>
                @endif
            </div>
        </div>

        <!-- Left Side: Scrollable Accordions (Visible on bottom for mobile and small devices) -->
        <div class="w-full md:w-1/4 bg-white p-4 overflow-y-auto h-screen order-2 md:order-1 border-2 border-dashed">
            <h2 class="text-xl font-semibold mb-4">Chapters</h2>
            <div x-data="{ open: null }">
                @foreach($chapters as $chapter)
                    <div class="mb-4">
                        <button @click="open === {{ $chapter->id }} ? open = null : open = {{ $chapter->id }}" class="w-full text-left bg-gray-200 p-2 rounded-lg flex justify-between items-center">
                            {{ $chapter->chapter_name }}
                            <svg :class="{'transform rotate-180': open === {{ $chapter->id }}}" class="w-5 h-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open === {{ $chapter->id }}" class="mt-2 pl-4">
                            @foreach($chapter->topics as $topic)
                                <div class="bg-gray-100 p-2 rounded-lg mb-2">
                                    <a href="{{ route('v2.topics.show', ['course_id' => $course->id, 'chapter_id' => $chapter->id, 'topic_id' => $topic->id]) }}">
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
</div>
