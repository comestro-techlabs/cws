<div>
    {{-- Hero Section --}}
    <div class="relative bg-gradient-to-r from-[#662d91] via-purple-600 to-[#662d91] bg-[size:400%] animate-gradient py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <h1 class="text-5xl font-extrabold text-white mb-6">
                    Discover Your Next Learning Journey
                </h1>
                <p class="text-xl text-purple-100 max-w-3xl mx-auto mb-8">
                    Unlock your potential with our comprehensive collection of courses designed to transform your skills and career.
                </p>
                {{-- Search Field --}}
                <div class="max-w-2xl mx-auto">
                    <div class="relative">
                        <input 
                            type="text" 
                            wire:model.live="search"
                            placeholder="Search courses by title or description..."
                            class="w-full px-5 py-4 text-lg rounded-full bg-white/20 text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-white/40 transition duration-300"
                        />
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute inset-0 bg-[url('/img/grid.svg')] opacity-10"></div>
    </div>

    {{-- Courses Grid --}}
    <div id="courses" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($courses as $course)
            <div
                wire:key="{{ $course->id }}"
                class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl">
                <div class="relative h-56">
                    <img
                        src="{{ $course->image ? asset('storage/' . $course->image) : asset('default-course-image.jpg') }}"
                        alt="{{ $course->title }}"
                        class="absolute inset-0 w-full h-full object-contain">
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3 line-clamp-2">
                        {{ $course->title }}
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ $course->description }}
                    </p>
                    <a href="{{ route('v2.courses.show', ['course_slug' => $course->course_slug]) }}"
                        class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition duration-300 flex items-center justify-center">
                        View Course Details
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-600 text-xl">No courses available at the moment.</p>
            </div>
            @endforelse
        </div>


    </div>
</div>