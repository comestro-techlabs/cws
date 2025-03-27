<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8 mt-12">
    <div class="max-w-7xl mx-auto space-y-8">
        <!-- Header with Modern Gradient -->
        <header class="bg-white/60 backdrop-blur-lg rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-8 text-center">
                <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
                    {{ $course->title }}
                </h1>
            </div>
        </header>

        <!-- Content Container -->
        <div class="grid md:grid-cols-3 gap-8 ">
            <!-- Chapters Sidebar with Modern Accordion -->
            <div class="md:col-span-1 bg-white rounded-2xl shadow-lg p-6 border border-gray-100 h-fit order-2">
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
                                href="{{ route('v2.topics.show', ['course_slug' => $course->course_slug, 'chapter_slug' => $chapter->chapter_slug, 'topic_slug' => $topic->topic_slug]) }}"
                                class="block py-2 px-4 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition {{ $selectedTopic && $selectedTopic->id === $topic->id ? 'bg-blue-50 text-blue-600' : '' }}"
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

            <!-- Topic Content Section -->
            <div class="md:col-span-2 bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                @if($selectedTopic)
                <div class="space-y-6">
                    <h2 class="text-3xl font-bold text-gray-900 text-center mb-6">
                        {{ $selectedTopic->topic_name }}
                    </h2>

                    <div class="relative mb-6">
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl opacity-75 blur-lg"></div>
                        <img 
                            src="{{ asset('assets/images/preview_1.0.png') }}" 
                            class="relative w-full rounded-2xl shadow-lg object-cover" 
                            alt="Topic Preview"
                        >
                    </div>

                    <div class="prose max-w-none">
                        <p class="text-gray-700 leading-relaxed">{{ $selectedTopic->topic_description }}</p>
                    </div>

                    <!-- Posts Section -->
                    <div class="mt-8">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">Related Posts</h3>
                        @if(count($posts) > 0)
                            @foreach($posts as $post)
                            <div class="bg-gray-50 p-6 rounded-2xl shadow-md mb-4 hover:shadow-lg transition">
                                <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $post->title }}</h4>
                                <p class="text-gray-600 mb-3">{{ $post->content }}</p>
                                @if($post->image_path)
                                <div class="relative mt-4">
                                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl opacity-75 blur-lg"></div>
                                    <img 
                                        src="{{ asset($post->image_path) }}" 
                                        class="relative w-full rounded-2xl shadow-md object-cover" 
                                        alt="Post Image"
                                    >
                                </div>
                                @endif
                            </div>
                            @endforeach
                        @else
                        <div class="text-center py-8 bg-gray-50 rounded-2xl">
                            <p class="text-gray-600 italic">No posts available for this topic.</p>
                        </div>
                        @endif
                    </div>
                </div>
                @else
                <div class="flex items-center justify-center h-full text-center">
                    <p class="text-xl text-gray-500 italic">
                        Please select a topic to view its content.
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>