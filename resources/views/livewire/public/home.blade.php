<div>
    <!-- Course Section -->
    <div class="pt-24 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Our <span class="text-[#662d91]">Courses</span></h2>
                <p class="mt-4 text-xl text-gray-600 max-w-2xl mx-auto">
                    Discover curated courses that blend industry insights with practical knowledge.
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($courses as $item)
                <div class="flex flex-col bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="relative">
                        <img src="{{ asset('storage/course_images/' . $item->course_image) }}" alt="{{ $item->title }}"
                            class="w-full h-52 object-cover" />
                        <!-- Course Type Label -->
                        <div class="absolute top-4 left-4 flex items-center space-x-1">
                            <div class="px-3 py-1 {{ $item->course_type === 'online' ? 'bg-blue-600' : 'bg-green-600' }} text-white rounded-full text-sm font-medium flex items-center shadow-lg">
                                @if($item->course_type === 'online')
                                    <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                @endif
                                {{ ucfirst($item->course_type) }}
                            </div>
                        </div>
                        <!-- Existing Rating Badge -->
                        <div class="absolute top-4 right-4 flex items-center space-x-1">
                            <div class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-sm font-medium text-[#662d91] flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                5.0
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 p-6 space-y-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 line-clamp-1">{{ $item->title }}</h3>
                            <p class="mt-2 text-gray-600 line-clamp-2">{{ $item->description }}</p>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-5 h-5 mr-2 text-[#662d91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $item->duration }} Weeks
                            </div>

                            <div class="flex items-center justify-between">
                                <div>
                                    @if ($item->discounted_fees > 0)
                                        <p class="text-2xl font-bold text-gray-900">₹{{ $item->discounted_fees }}</p>
                                        <p class="text-sm text-gray-500 line-through">₹{{ $item->fees }}</p>
                                    @else
                                        <p class="text-lg font-bold text-green-600">Free</p>
                                    @endif
                                </div>
                            </div>

                            <a href="{{route('public.courseDetail', ['slug' => $item->slug])}}" wire:navigate
                                class="block w-full px-4 py-3 text-center font-medium text-white bg-[#662d91] rounded-lg hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-200">
                                Enroll Now
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="{{route('public.viewallcourses.all-courses')}}" wire:navigate
                    class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-[#662d91] rounded-lg hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-200">
                    View All Courses
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="bg-gradient-to-b from-gray-50 to-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Popular Course <span class="text-[#662d91]">Categories</span></h2>
                <p class="mt-4 text-xl text-gray-600 max-w-2xl mx-auto">
                    Find the perfect path for your programming journey
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white rounded-xl p-6 text-center shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-purple-100 mb-6">
                        <svg class="w-8 h-8 text-[#662d91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Web Development</h3>
                    <p class="text-gray-600">HTML, CSS, JavaScript, React, Angular, Vue</p>
                </div>

                <div class="bg-white rounded-xl p-6 text-center shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-purple-100 mb-6">
                        <svg class="w-8 h-8 text-[#662d91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Mobile Development</h3>
                    <p class="text-gray-600">Android, iOS, React Native, Flutter</p>
                </div>

                <div class="bg-white rounded-xl p-6 text-center shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-purple-100 mb-6">
                        <svg class="w-8 h-8 text-[#662d91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Data Science</h3>
                    <p class="text-gray-600">Python, R, SQL, Machine Learning</p>
                </div>

                <div class="bg-white rounded-xl p-6 text-center shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-purple-100 mb-6">
                        <svg class="w-8 h-8 text-[#662d91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Cybersecurity</h3>
                    <p class="text-gray-600">Network Security, Ethical Hacking</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-[#662d91] to-purple-800 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-white">
                Ready to Start Your Coding Journey?
            </h2>
            <p class="mt-4 text-xl text-blue-100 max-w-2xl mx-auto">
                Join thousands of students who have transformed their careers through our programming courses.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#" class="inline-flex items-center justify-center px-6 py-3 text-base font-medium rounded-lg text-[#662d91] bg-white hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-200">
                    Get Started Today
                </a>
                <a href="#" class="inline-flex items-center justify-center px-6 py-3 text-base font-medium rounded-lg text-white bg-purple-500 bg-opacity-30 hover:bg-opacity-40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-200">
                    Browse All Courses
                </a>
            </div>
        </div>
    </div>

    <!-- Alumni Section -->
    <div class="relative bg-gradient-to-b from-gray-50 to-white py-24">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'30\' height=\'30\' viewBox=\'0 0 30 30\' fill=\'none\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z\' fill=\'rgba(0,0,0,0.07)\'/%3E%3C/svg%3E')"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Our <span class="text-[#662d91]">Alumni</span> Success Stories</h2>
                <p class="mt-4 text-xl text-gray-600">
                    Join the ranks of our successful graduates who have transformed their careers through our programming courses
                </p>
            </div>

            @if ($placedStudents->isNotEmpty())
            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($placedStudents as $student)
                <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                    <!-- Quote Icon -->
                    <div class="absolute -top-4 left-6">
                        <div class="w-8 h-8 bg-[#662d91] rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 01-3.5 3.5c-1.073 0-2.099-.49-2.748-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 01-3.5 3.5c-1.073 0-2.099-.49-2.748-1.179z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="relative">
                        <div class="h-40 overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-purple-200 scrollbar-track-transparent">
                            <p class="text-gray-600 italic leading-relaxed">{{ $student->content }}</p>
                        </div>

                        <!-- Student Info -->
                        <div class="mt-6 pt-6 border-t border-gray-100">
                            <div class="flex items-center">
                                @if($student->image)
                                    <img src="{{ asset('/storage/placedstudent/' . $student->image) }}"
                                        alt="{{ $student->name }}"
                                        class="h-14 w-14 rounded-full object-cover border-2 border-purple-50"
                                    />
                                @else
                                    <div class="h-14 w-14 rounded-full bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                                        <span class="text-xl font-bold text-white">{{ substr($student->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div class="ml-4">
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $student->name }}</h4>
                                    <div class="flex items-center mt-1">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-[#662d91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <p class="ml-2 text-sm text-gray-600">{{ $student->position }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
                <div class="mt-16 text-center text-gray-500">No alumni stories available at the moment.</div>
            @endif

            <!-- Stats -->
            <div class="mt-20 grid grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white rounded-xl p-6 text-center shadow-lg">
                    <div class="text-3xl font-bold text-[#662d91]">95%</div>
                    <div class="mt-2 text-sm text-gray-600">Placement Rate</div>
                </div>
                <div class="bg-white rounded-xl p-6 text-center shadow-lg">
                    <div class="text-3xl font-bold text-[#662d91]">500+</div>
                    <div class="mt-2 text-sm text-gray-600">Alumni Network</div>
                </div>
                <div class="bg-white rounded-xl p-6 text-center shadow-lg">
                    <div class="text-3xl font-bold text-[#662d91]">50+</div>
                    <div class="mt-2 text-sm text-gray-600">Partner Companies</div>
                </div>
                <div class="bg-white rounded-xl p-6 text-center shadow-lg">
                    <div class="text-3xl font-bold text-[#662d91]">₹12L</div>
                    <div class="mt-2 text-sm text-gray-600">Avg. Package</div>
                </div>
            </div>
        </div>
    </div>
</div>
