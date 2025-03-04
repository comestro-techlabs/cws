<div class="min-h-screen bg-white mt-24 pt-6 px-4">
    <!-- Header and Course Title -->
    <header class="bg-primary shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 ">
            <div class="box-border size-24 border-2 p-4 ml-[35%] lg:ml-[40%] rounded-xl">
               <svg  viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M31.885 16c-8.124 0-7.617 3.523-7.617 3.523l.01 3.65h7.752v1.095H21.197S16 23.678 16 31.876c0 8.196 4.537 7.906 4.537 7.906h2.708v-3.804s-.146-4.537 4.465-4.537h7.688s4.32.07 4.32-4.175v-7.019S40.374 16 31.885 16zm-4.275 2.454c.771 0 1.395.624 1.395 1.395s-.624 1.395-1.395 1.395a1.393 1.393 0 0 1-1.395-1.395c0-.771.624-1.395 1.395-1.395z" fill="url(#a)"/>
                                                            <path d="M32.115 47.833c8.124 0 7.617-3.523 7.617-3.523l-.01-3.65H31.97v-1.095h10.832S48 40.155 48 31.958c0-8.197-4.537-7.906-4.537-7.906h-2.708v3.803s.146 4.537-4.465 4.537h-7.688s-4.32-.07-4.32 4.175v7.019s-.656 4.247 7.833 4.247zm4.275-2.454a1.393 1.393 0 0 1-1.395-1.395c0-.77.624-1.394 1.395-1.394s1.395.623 1.395 1.394c0 .772-.624 1.395-1.395 1.395z" fill="url(#b)"/>
                                                            <defs>
                                                                <linearGradient id="a" x1="19.075" y1="18.782" x2="34.898" y2="34.658" gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#387EB8"/>
                                                                    <stop offset="1" stop-color="#366994"/>
                                                                </linearGradient>
                                                                <linearGradient id="b" x1="28.809" y1="28.882" x2="45.803" y2="45.163" gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#FFE052"/>
                                                                    <stop offset="1" stop-color="#FFC331"/>
                                                                </linearGradient>
                                                            </defs>
                                                        </svg>
                                                    </div>
            <h1 class="text-3xl font-bold text-white text-center mt-4">
                {{ $course->title }}
            </h1>
            

        </div>
    </header>

    <div class="flex flex-col md:flex-row">
        <!-- Right Side: Course Content Details (Visible on top for mobile and small devices) -->
        <div class="w-full md:w-3/4 bg-white p-4 overflow-y-auto h-screen order-1 md:order-2">
            <h2 class="text-xl  font-semibold mb-4 flex justify-center">{{ $course->title }}</h2>
            <div class="space-y-4">
            <img src="{{ asset('assets/images/preview_1.0.png') }}" class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2 xl:w-1/3 mx-auto h-auto" alt="">
            <p class="text-gray-700">{{ $course->description }}</p>
                <!-- Add more course content details here -->
            </div>
        </div>

        <!-- Left Side: Scrollable Accordions (Visible on bottom for mobile and small devices) -->
        <div class="w-full md:w-1/4 bg-white p-4 overflow-y-auto h-screen order-2 md:order-1  border-2 border-dashed">
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
                       <a href="{{ route('v2.topics.show', ['course_id' => $course->id, 'chapter_id' => $chapter->id, 'topic_id' => $topic->id]) }}" wire:navigate>
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