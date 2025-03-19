<div class="min-h-screen bg-gradient-to-b from-purple-50 to-white pt-8 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header with animated gradient -->
        <div class="relative mb-10 p-8 rounded-2xl bg-gradient-to-r from-purple-600 to-blue-600 overflow-hidden">
            <div class="relative z-10">
                <h1 class="text-3xl font-bold text-white mb-2">Explore Courses</h1>
                <p class="text-purple-100">Level up your skills with our curated courses</p>
            </div>
            <!-- Animated background elements -->
            <div class="absolute top-0 right-0 w-full h-full">
                <div class="absolute right-0 top-0 w-1/3 h-full bg-gradient-to-l from-white/10 to-transparent transform -skew-x-12"></div>
                <div class="absolute left-0 bottom-0 w-1/2 h-1/2 bg-gradient-to-t from-white/10 to-transparent rounded-full filter blur-xl"></div>
            </div>
        </div>

        <!-- Enhanced Search Bar -->
        <div class="bg-white rounded-xl shadow-[0_2px_8px_-3px_rgba(0,0,0,0.07)] mb-8 p-4 transform transition-all duration-200 hover:shadow-[0_4px_12px_-2px_rgba(0,0,0,0.08)]">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-grow relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <svg class="w-5 h-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input wire:model.live="search" type="text"
                        class="w-full pl-12 pr-4 py-3 text-gray-800 bg-gray-50 border-0 rounded-lg focus:ring-2 focus:ring-purple-500 transition-all duration-200"
                        placeholder="Search for courses...">
                </div>

                <!-- Advanced Filters Button -->
                <div class="flex gap-2">
                    <button class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition duration-200 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        Filters
                    </button>
                    <button class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200 flex items-center gap-2">
                        Search
                    </button>
                </div>
            </div>
        </div>

        <!-- Courses Grid with Animation -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($courses as $course)
            <div class="group bg-white rounded-xl shadow-[0_2px_8px_-3px_rgba(0,0,0,0.07)] overflow-hidden border border-gray-100 hover:border-purple-200 hover:shadow-[0_8px_16px_-6px_rgba(79,70,229,0.12)] transition-all duration-300 transform hover:-translate-y-1">
                <!-- Course Image with Overlay -->
                <div class="relative aspect-w-16 aspect-h-9">
                    <img src="{{ asset('storage/course_images/' . $course->course_image) }}"
                        class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-300"
                        alt="{{ $course->title }}">
                    @if($course->is_featured)
                    <div class="absolute top-4 right-4">
                        <div class="px-3 py-1 bg-gradient-to-r from-orange-500 to-pink-500 rounded-full">
                            <span class="text-xs font-semibold text-white">Featured</span>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="p-5 space-y-4">
                    <!-- Course Title and Instructor -->
                    <div class="h-14"> <!-- Added fixed height container -->
                        <h2 class="text-lg font-semibold text-gray-900 leading-tight line-clamp-2 hover:text-purple-700 transition-colors">
                            <a href="{{ route('student.viewCourses', ['courseId' => $course->id]) }}">{{ $course->title }}</a>
                        </h2>
                    </div>

                    <!-- Rest of the card content -->
                    <div class="flex items-center text-sm text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1.5 text-purple-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        <span>{{ $course->instructor }}</span>
                    </div>

                    @if($course->rating->count() > 0)
                    @php
                    // Calculate the average rating from the reviews relationship
                    $avgRating = $course->rating->avg('rating');
                    @endphp

                    <div class="flex items-center">
                        <div class="flex text-orange-400">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <=$avgRating)
                              
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
                        <span class="text-xs text-gray-500 ml-1.5">
                            {{ number_format($avgRating, 2) }} ({{ $course->rating->count() }} reviews)
                        </span>
                    </div>
                    @else
                    <p>No reviews yet.</p>
                    @endif


                    <!-- Course Stats -->
                    <div class="flex flex-wrap gap-3">
                        <div class="flex items-center text-sm text-gray-600">
                            <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span>{{ $course->duration }} hours</span>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                            </svg>
                            {{ $course->level ?? 'Beginner' }}
                        </span>
                    </div>
                </div>

                <!-- Action Footer -->
                <div class="px-5 py-4 bg-gray-50 flex justify-between items-center">
                    @php
                    $subs = (auth()->check() && auth()->user()->hasActiveSubscription() && auth()->user()->courses()->wherePivot('is_subs', 1)->count() == 0)
                    @endphp
                <div>
                    @if ($subs)
                    <span class="text-lg font-semibold text-gray-900"><del>₹{{ $course->discounted_fees }}</del></span>
                    @else
                    <span class="text-lg font-semibold text-gray-900">₹{{ $course->discounted_fees }}</span>
                    @endif

                    @if (isset($course->original_fees) && $course->original_fees > $course->discounted_fees)
                        <span class="text-sm text-gray-500 line-through ml-2">₹{{ $course->original_fees }}</span>
                    @endif                    
                </div>
                @if (auth()->check() && auth()->user()->hasActiveSubscription() && auth()->user()->courses()->wherePivot('is_subs', 1)->count() == 0)
                    <button wire:click="enrollCourse({{ $course->id }})" wire:loading.attr="disabled"
                        class="px-4 py-2 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-200 text-sm">
                        Free
                    </button>             
                @elseif (auth()->check() && auth()->user()->hasActiveSubscription())
                    <button wire:click="enrollCourse({{ $course->id }})" wire:loading.attr="disabled"
                        class="px-4 py-2 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-200 text-sm">
                        Enroll Now
                    </button>             
                @else
                    <a wire:navigate href="{{ route('student.viewCourses', ['courseId' => $course->id]) }}"
                        class="px-4 py-2 bg-purple-700 text-white font-medium rounded-lg hover:bg-purple-800 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200 text-sm inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        View Course
                    </a>
                @endif
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="text-center py-16 bg-white rounded-xl shadow-[0_2px_8px_-3px_rgba(0,0,0,0.07)]">
                    <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No courses found</h3>
                    <p class="text-gray-600 max-w-md mx-auto mb-6">Try adjusting your search or filters to find what you're looking for.</p>
                    <button wire:click="resetFilters"
                        class="inline-flex items-center px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200">
                        Reset Filters
                    </button>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Improved Pagination -->
        <div class="mt-12">
            @if ($courses->hasPages())
                <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
                    <div class="flex justify-between flex-1 sm:hidden">
                        <span>
                            @if ($courses->onFirstPage())
                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md select-none">
                                    Previous
                                </span>
                            @else
                                <button wire:click="previousPage('page')" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-purple focus:border-purple-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                    Previous
                                </button>
                            @endif
                        </span>

                        <span>
                            @if ($courses->hasMorePages())
                                <button wire:click="nextPage('page')" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-purple focus:border-purple-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                    Next
                                </button>
                            @else
                                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md select-none">
                                    Next
                                </span>
                            @endif
                        </span>
                    </div>

                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700 leading-5">
                                Showing
                                <span class="font-medium">{{ $courses->firstItem() }}</span>
                                to
                                <span class="font-medium">{{ $courses->lastItem() }}</span>
                                of
                                <span class="font-medium">{{ $courses->total() }}</span>
                                results
                            </p>
                        </div>

                        <div>
                            <span class="relative z-0 inline-flex rounded-md shadow-sm">
                                {{-- Previous Page Link --}}
                                @if ($courses->onFirstPage())
                                    <span aria-disabled="true" aria-label="Previous">
                                        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5" aria-hidden="true">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </span>
                                @else
                                    <button wire:click="previousPage('page')" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-purple-300 focus:shadow-outline-purple active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Previous">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                                    @if ($page == $courses->currentPage())
                                        <span aria-current="page">
                                            <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-purple-600 border border-purple-600 cursor-default leading-5 select-none">{{ $page }}</span>
                                        </span>
                                    @else
                                        <button wire:click="gotoPage({{ $page }}, 'page')" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-purple-300 focus:shadow-outline-purple active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                            {{ $page }}
                                        </button>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($courses->hasMorePages())
                                    <button wire:click="nextPage('page')" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-purple-300 focus:shadow-outline-purple active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Next">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                @else
                                    <span aria-disabled="true" aria-label="Next">
                                        <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5" aria-hidden="true">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </span>
                                @endif
                            </span>
                        </div>
                    </div>
                </nav>
            @endif
        </div>
    </div>
</div>