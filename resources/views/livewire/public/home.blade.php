<div>

    <!-- Programming Languages Section -->
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-[#29235c] sm:text-4xl">
                    Learn programming for <span class="text-[#662d91]">Free</span>
                </h2>
                <p class="mt-4 text-xl text-gray-500 max-w-3xl mx-auto">
                    Quick-read tutorials with code examples that you can run
                    and copy–perfect for self-paced learning.
                </p>
            </div>
            <div class="mt-10 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                @foreach($blogCourses as $blogCourse)
                <a href="{{ route('v2.courses.show', ['course_id' => $blogCourse->id]) }}" class="flex items-center p-4 border border-gray-200 rounded-md hover:shadow-md transition-all">
                    <div class="flex items-center">
                        <span class="text-blue-500 mr-3">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C5.372 0 0 5.372 0 12S5.372 24 12 24c6.627 0 12-5.372 12-12S18.627 0 12 0z"></path>
                            </svg>
                        </span>
                        <span class="font-medium">{{ $blogCourse->title }}</span>
                    </div>
                </a>
                @endforeach
            </div>

        </div>
    </div>


    <!-- Features Section -->
    <div id="features" class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-[#662d91] font-semibold tracking-wide uppercase">Benefits</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Why Choose Our Platform?
                </p>
            </div>

            <div class="mt-10">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-[#662d91] text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Live Classes</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Interactive live sessions with industry experts
                        </dd>
                    </div>

                    <!-- Add more features here -->
                </dl>
            </div>
        </div>
    </div>

    <!-- Courses Section -->
    <div id="courses" class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Popular Courses
                </h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                    Choose from our wide range of programming courses
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($courses as $course)
                <div class="flex flex-col rounded-lg shadow-sm  border border-slate-100 overflow-hidden transform transition duration-500 hover:scale-105">
                    <div class="flex-shrink-0">
                        <img class="h-48 w-full object-cover" src="{{ asset('storage/course_images/' . $course->course_image) }}" alt="{{ $course->title }}">
                    </div>
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <div class="flex items-center">
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium {{ $course->course_type === 'online' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($course->course_type) }}
                                </span>
                                <span class="ml-2 inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    {{ $course->duration }} Weeks
                                </span>
                            </div>
                            <a href="{{ route('public.courseDetail', ['slug' => $course->slug]) }}" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900">{{ $course->title }}</p>
                                <p class="mt-3 text-base text-gray-500">{{ Str::limit($course->description, 100) }}</p>
                            </a>
                        </div>
                        <div class="mt-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    @if ($course->discounted_fees > 0)
                                    <span class="text-2xl font-bold text-gray-900">₹{{ $course->discounted_fees }}</span>
                                    <span class="ml-2 text-sm text-gray-500 line-through">₹{{ $course->fees }}</span>
                                    @else
                                    <span class="text-xl font-semibold text-green-600">Free</span>
                                    @endif
                                </div>
                                <div>
                                    <a href="{{ route('public.courseDetail', ['slug' => $course->slug]) }}"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#662d91] hover:bg-purple-800">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="bg-[#662d91]">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                <div class="text-center">
                    <p class="text-5xl font-extrabold text-white">95%</ </p>
                    <p class="mt-2 text-xl font-semibold text-purple-200">Placement Rate</p>
                </div>
                <div class="text-center">
                    <p class="text-5xl font-extrabold text-white">500+</p>
                    <p class="mt-2 text-xl font-semibold text-purple-200">Alumni Network</p>
                </div>
                <div class="text-center">
                    <p class="text-5xl font-extrabold text-white">50+</p>
                    <p class="mt-2 text-xl font-semibold text-purple-200">Partner Companies</p>
                </div>
                <div class="text-center">
                    <p class="text-5xl font-extrabold text-white">₹12L</p>
                    <p class="mt-2 text-xl font-semibold text-purple-200">Avg. Package</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Alumni Section -->
    @if ($placedStudents->isNotEmpty())
    <div class="bg-white py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-[#662d91] font-semibold tracking-wide uppercase">Success Stories</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Meet Our Alumni
                </p>
            </div>
            <div class="mt-12">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($placedStudents as $student)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-500 hover:shadow-2xl">
                        <div class="px-6 py-8">
                            <div class="flex items-center">
                                @if($student->image)
                                <img class="h-12 w-12 rounded-full object-cover" src="{{ asset('/storage/placedstudent/' . $student->image) }}" alt="{{ $student->name }}">
                                @else
                                <div class="h-12 w-12 rounded-full bg-[#662d91] flex items-center justify-center">
                                    <span class="text-xl font-bold text-white">{{ substr($student->name, 0, 1) }}</span>
                                </div>
                                @endif
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">{{ $student->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $student->position }}</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-gray-600 italic">{{ Str::limit($student->content, 150) }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- CTA Section -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                <span class="block">Ready to dive in?</span>
                <span class="block text-[#662d91]">Start your journey today.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#662d91] hover:bg-purple-800">
                        Get Started
                    </a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-[#662d91] bg-white hover:bg-purple-50">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>