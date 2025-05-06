<div>
    <x-slot:title>Learn Syntax | Coding Classes in Purnea – C, C++, Python, JavaScript (Bihar)</x-slot>
        <x-slot:description>Learn Syntax – The best coding institute in Purnea, Bihar. Master C, C++, Python,
            JavaScript, and more with expert-led courses and real-world projects.</x-slot>

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
                            <a href="{{ route('v2.courses.show', ['course_slug' => $blogCourse->course_slug]) }}"
                                class="flex items-center p-4 border border-gray-200 rounded-md hover:shadow-md transition-all">
                                <div class="flex items-center">
                                    <span class="text-blue-500 mr-3">
                                        <img src="{{ asset('storage/' . $blogCourse->image) }}" alt="" class="w-6 h-6">
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
                <div class="max-w-7xl flex flex-col items-center justify-center mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="lg:text-center">
                        <h2 class="text-base text-[#662d91] font-semibold tracking-wide uppercase">Benefits</h2>
                        <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                            Why Choose Our Platform?
                        </p>
                    </div>

                    <div class="mt-10">
                        <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                            <div class="relative">
                                <div>
                                    <div
                                        class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-[#662d91] text-white">
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 16l-4-4m0 0l4-4m-4 4h16" />
                                        </svg>
                                    </div>
                                    <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Live Classes</p>
                                </div>
                                <dd class="mt-2 ml-16 text-base text-gray-500">
                                    Interactive live sessions with industry experts
                                </dd>
                            </div>
                            <div class="relative">
                                <dt>
                                    <div
                                        class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-[#662d91] text-white">
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m-6 4v6m0-6H3m6 0h6" />
                                        </svg>
                                    </div>
                                    <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Mock Tests</p>
                                </dt>
                                <dd class="mt-2 ml-16 text-base text-gray-500">
                                    Regular mock tests to evaluate your progress
                                </dd>
                            </div>
                            <div class="relative">
                                <dt>
                                    <div
                                        class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-[#662d91] text-white">
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 21v-2a4 4 0 00-8 0v2m8-10a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                    <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Certificates</p>
                                </dt>
                                <dd class="mt-2 ml-16 text-base text-gray-500">
                                    Earn certificates upon course completion
                                </dd>
                            </div>
                            <div class="relative">
                                <dt>
                                    <div
                                        class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-[#662d91] text-white">
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 17v-6h6v6m-6 0H5m10 0h4" />
                                        </svg>
                                    </div>
                                    <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Assignments</p>
                                </dt>
                                <dd class="mt-2 ml-16 text-base text-gray-500">
                                    Hands-on assignments to reinforce learning
                                </dd>
                            </div>
                            <div class="relative">
                                <dt>
                                    <div
                                        class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-[#662d91] text-white">
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Records View</p>
                                </dt>
                                <dd class="mt-2 ml-16 text-base text-gray-500">
                                    Access your learning history and progress
                                </dd>
                            </div>
                            <div class="relative">
                                <dt>
                                    <div
                                        class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-[#662d91] text-white">
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z" />
                                        </svg>
                                    </div>
                                    <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Attendance</p>
                                </dt>
                                <dd class="mt-2 ml-16 text-base text-gray-500">
                                    Track your attendance and stay consistent
                                </dd>
                            </div>
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
                            <div 
                                class="flex flex-col rounded-lg shadow-sm  border border-slate-100 overflow-hidden transform transition duration-500 hover:scale-105">
                                <div class="flex-shrink-0">
                                    <img class="h-48 w-full object-cover"
                                        src="{{ $course->course_image }}" alt="{{ $course->title }}">
                                </div>
                                <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                                    <div class="flex-1">
                                        <div class="flex justify-between items-center">
                                            <div class="">
                                                <span
                                                    class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium {{ $course->course_type === 'online' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                                    {{ ucfirst($course->course_type) }}
                                                </span>
                                                <span
                                                    class="ml-2 inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                                    {{ $course->duration }} Weeks
                                                </span>
                                            </div>
                                            <button wire:click="share({{ $course->id }})"
                                                class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 transition-colors">
                                                Share
                                                <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <a href="{{ route('public.courseDetail', ['slug' => $course->slug]) }}"
                                            class="block mt-2">
                                            <p class="text-xl font-semibold text-gray-900">{{ $course->title }}</p>
                                            <p class="mt-3 text-base text-gray-500">
                                                {{ Str::limit($course->description, 100) }}
                                            </p>
                                        </a>
                                    </div>
                                    <div class="mt-6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                @if ($course->discounted_fees > 0)
                                                    <span
                                                        class="text-2xl font-bold text-gray-900">₹{{ $course->discounted_fees }}</span>
                                                    <span
                                                        class="ml-2 text-sm text-gray-500 line-through">₹{{ $course->fees }}</span>
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
                        @if($shareMessage)
                            <p class="text-xs text-green-600 mt-4">{{ $shareMessage }}</p>
                        @endif
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
                                    <div
                                        class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-500 hover:shadow-2xl">
                                        <div class="px-6 py-8">
                                            <div class="flex items-center">
                                                @if($student->image)
                                                    <img class="h-12 w-12 rounded-full object-cover"
                                                        src="{{ $student->image }}?tr=w-300,h-300,fo-auto" alt="{{ $student->name }}">
                                                @else
                                                    <div
                                                        class="h-12 w-12 rounded-full bg-[#662d91] flex items-center justify-center">
                                                        <span
                                                            class="text-xl font-bold text-white">{{ substr($student->name, 0, 1) }}</span>
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
                <div
                    class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        <span class="block">Ready to dive in?</span>
                        <span class="block text-[#662d91]">Start your journey today.</span>
                    </h2>
                    <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                        <div class="inline-flex rounded-md shadow">
                            <a href="#"
                                class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#662d91] hover:bg-purple-800">
                                Get Started
                            </a>
                        </div>
                        <div class="ml-3 inline-flex rounded-md shadow">
                            <a href="#"
                                class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-[#662d91] bg-white hover:bg-purple-50">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
            </div>


</div>
<script>
     document.addEventListener('livewire:initialized', function () {
         Livewire.on('shareCourse', (event) => {
             console.log('Share event received:', event);
 
             const data = Array.isArray(event) ? event[0] : event;
             const url = data.url || window.location.href;
             const title = data.title || 'Untitled Course';
             const description = data.description || 'Learn something new!';
             const image = data.image || '';
 
             const shareText = `${title}\n${description}\n${url}\nImage: ${image}`;
 
             if (navigator.share) {
                 navigator.share({
                     title: title,
                     text: `${title}\n${description}`,
                     url: url,
                 })
                 .then(() => console.log('Shared successfully'))
                 .catch((error) => console.log('Error sharing:', error));
             } else {
                 navigator.clipboard.writeText(shareText)
                     .then(() => {
                         alert(`Copied to clipboard:\n${shareText}`);
                     })
                     .catch((error) => {
                         console.log('Error copying:', error);
                         alert(`Failed to copy. Here’s the info:\n${shareText}`);
                     });
             }
         });
     });
</script>