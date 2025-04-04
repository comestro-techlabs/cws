  <div class="group relative bg-white rounded-lg border border-gray-100 shadow-sm transition-all duration-200 hover:shadow-md hover:border-blue-100 overflow-hidden">
    <a href="{{ route('public.courseDetail', [ 'slug' => $course->slug]) }}" class="block">
        <!-- Course Image with Overlay -->
        <div class="relative aspect-w-16 aspect-h-9 bg-gray-100">
            <img src="storage/{{ $course->course_image }}"
                 alt="{{ $course->title }}"
                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

            <!-- Category Badge -->
            <div class="absolute top-4 left-4">
                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-white/90 backdrop-blur-sm text-blue-600 transition-colors duration-200 group-hover:bg-blue-600 group-hover:text-white">
                    {{ optional($course->category)->cat_title }}
                </span>
            </div>
        </div>

        <!-- Course Content -->
        <div class="p-5">
            <!-- Title -->
            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                {{ $course->title }}
            </h3>

            <!-- Course Stats -->
            <div class="flex items-center space-x-4 mb-4 text-sm text-gray-600">
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-blue-600 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    <span>{{ $course->lessons_count ?? '0' }} Lessons</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-blue-600 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ $course->duration ?? '8' }} Hours</span>
                </div>
            </div>

            <!-- Batch Info -->
            @if (!empty($course->batches) && count($course->batches) > 0)
                <div class="flex items-center text-sm text-green-700 mb-4">
                    <svg class="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Starts {{ \Carbon\Carbon::parse($course->batches[0]->start_date)->format('F j, Y') }}</span>
                </div>
            @else
                <div class="flex items-center text-sm text-gray-500 mb-4">
                    <svg class="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>New batch coming soon</span>
                </div>
            @endif

            <!-- Action Button -->
            @auth
                <form action="{{ route('public.enrollCourse', ['courseId' => $course->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-blue-600 text-white rounded-lg py-2 px-4 text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                        Enroll Now
                    </button>
                </form>
            @else
                <a href="{{ route('auth.login') }}" class="block w-full bg-gray-900 text-white rounded-lg py-2 px-4 text-sm font-medium text-center hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200">
                    Login to Enroll
                </a>
            @endauth
        </div>
    </a>
</div>
