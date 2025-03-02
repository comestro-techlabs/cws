<div class="min-h-screen bg-white mt-24 pt-6">
    <!-- Header and Course Title -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
                {{ $course->title }}
            </h1>
        </div>
    </header>

    <div class="flex flex-col md:flex-row">
        <!-- Right Side: Course Content Details (Visible on top for mobile and small devices) -->
        <div class="w-full md:w-2/3 bg-white p-4 overflow-y-auto h-screen order-1 md:order-2">
            <h2 class="text-xl font-semibold mb-4">Course Content</h2>
            <div class="space-y-4">
                <img src="{{ $course->image }}" alt="Course Image" class="w-full h-64 object-cover rounded-lg">
                <p class="text-gray-700">{{ $course->description }}</p>
                <!-- Add more course content details here -->
            </div>
        </div>

        <!-- Left Side: Scrollable Accordions (Visible on bottom for mobile and small devices) -->
        <div class="w-full md:w-1/3 bg-white p-4 overflow-y-auto h-screen order-2 md:order-1">
            <h2 class="text-xl font-semibold mb-4">Chapters</h2>
            <div x-data="{ open: null }">
                @foreach($chapters as $chapter)
                    <div class="mb-4">
                        <button @click="open === {{ $chapter->id }} ? open = null : open = {{ $chapter->id }}" class="w-full text-left bg-gray-200 p-2 rounded-lg">
                            {{ $chapter->chapter_name }}
                        </button>
                        <div x-show="open === {{ $chapter->id }}" class="mt-2 pl-4">
                            @foreach($chapter->topics as $topic)
                                <div class="bg-gray-100 p-2 rounded-lg mb-2">
                                    {{ $topic->topic_name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
