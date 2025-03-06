<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="mt-6">
            <!-- Header and Search -->
            <div class="w-full flex flex-col md:flex-row border-b pb-5 justify-between md:items-center px-4 rounded-lg mb-6 gap-4">
                <h1 class="text-2xl font-bold text-gray-800">Explore Courses</h1>
                <div class="flex items-center w-full md:w-auto">
                    <input wire:model.live="search" type="text" placeholder="Search for courses..." id="searchSample02"
                        class="w-full px-4 py-2.5 text-gray-800 focus:ring-2 focus:ring-blue-500 focus:outline-none rounded-l-lg border border-gray-300">
                    <button wire:loading.attr="disabled" class="p-2.5 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Courses Grid -->
            <div class="container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($courses as $course)
                    <div class="bg-white flex flex-col border border-gray-200 rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300">
                        <div class="relative">
                            <img src="{{ asset('storage/course_images/' . $course->course_image) }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                            <!-- Optional badge for featured courses -->
                            @if($course->is_featured)
                            <div class="absolute top-3 right-3 bg-yellow-400 text-xs font-semibold px-2 py-1 rounded-full text-gray-800">
                                Featured
                            </div>
                            @endif
                        </div>
                        <div class="p-5 space-y-4 flex-grow">
                            <h2 class="text-xl font-semibold text-gray-900 leading-tight line-clamp-2 hover:text-blue-600 transition-colors">
                                <a href="#">{{ $course->title }}</a>
                            </h2>
                            <p class="text-sm text-gray-600">Instructor: <span class="text-blue-500 font-medium">{{ $course->instructor }}</span></p>

                            <!-- Optional rating display -->
                            @if(isset($course->rating))
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $course->rating)
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-gray-300">
                                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-xs text-gray-500 ml-1">({{ $course->reviews_count ?? 0 }})</span>
                            </div>
                            @endif
                        </div>
                        <div class="px-5 pb-5 pt-2 flex justify-between items-center mt-auto border-t border-gray-100">
                            <div>
                                <span class="text-lg font-semibold text-gray-900">₹ {{ $course->discounted_fees }}</span>
                                @if(isset($course->original_fees) && $course->original_fees > $course->discounted_fees)
                                <span class="text-sm text-gray-500 line-through ml-2">₹ {{ $course->original_fees }}</span>
                                @endif
                            </div>
                            @if (auth()->user() && auth()->user()->is_member)
                                <button wire:click="enrollCourse({{ $course->id }})" wire:loading.attr="disabled"
                                    class="bg-purple-600 text-white font-medium rounded-lg px-4 py-2 hover:bg-purple-700 transition-colors text-sm">
                                    Enroll Now
                                </button>
                            @else
                                <a wire:navigate href="{{ route('student.viewCourses', ['courseId' => $course->id]) }}"
                                    class="bg-blue-600 text-white font-medium rounded-lg px-4 py-2 hover:bg-blue-700 transition-colors text-sm">
                                    <div class="flex gap-2 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                        </svg>
                                        <span>View Course</span>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-10 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-400 mb-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        <p class="text-gray-600 text-lg">No courses found.</p>
                        <p class="text-gray-500 mt-2">Try adjusting your search or filters to find what you're looking for.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="container mx-auto mt-10 flex flex-col md:flex-row items-center justify-between space-y-4">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</div>
