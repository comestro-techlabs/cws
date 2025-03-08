<div class="bg-gray-50 min-h-screen pt-6 mt-5 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header and Search -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Explore Courses</h1>
            <p class="text-gray-600 mt-1">Discover new skills and advance your career</p>
        </div>
        
        <!-- Search and Filters -->
        <div class="bg-white rounded-lg shadow-sm mb-8 p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row gap-4 items-center">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input wire:model.live="search" type="text" placeholder="Search for courses..." 
                        class="w-full pl-10 pr-4 py-2.5 text-gray-800 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:outline-none transition duration-200">
                </div>
                
                <!-- Additional filters could go here -->
                <button wire:loading.attr="disabled" class="px-6 py-2.5 bg-purple-700 text-white rounded-lg hover:bg-purple-800 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200 whitespace-nowrap">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <span>Search</span>
                    </div>
                </button>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($courses as $course)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:border-purple-200 hover:shadow-md transition duration-200">
                    <div class="relative">
                        <img src="{{ asset('storage/course_images/' . $course->course_image) }}" alt="{{ $course->title }}" 
                            class="w-full h-48 object-cover">
                        
                        <!-- Badge for featured courses -->
                        @if($course->is_featured)
                        <div class="absolute top-3 right-3 bg-orange-500 text-xs font-medium px-2.5 py-1 rounded-full text-white">
                            Featured
                        </div>
                        @endif
                    </div>
                    
                    <div class="p-5 space-y-3 flex-grow">
                        <h2 class="text-lg font-semibold text-gray-900 leading-tight line-clamp-2 hover:text-purple-700 transition-colors">
                            <a href="{{ route('student.viewCourses', ['courseId' => $course->id]) }}">{{ $course->title }}</a>
                        </h2>
                        
                        <div class="flex items-center text-sm text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1.5 text-purple-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <span>{{ $course->instructor }}</span>
                        </div>

                        <!-- Rating display -->
                        @if(isset($course->rating))
                        <div class="flex items-center">
                            <div class="flex text-orange-400">
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
                            <span class="text-xs text-gray-500 ml-1.5">{{ $course->rating }} ({{ $course->reviews_count ?? 0 }} reviews)</span>
                        </div>
                        @endif
                        
                        <!-- Course details -->
                        <div class="flex flex-wrap gap-2 pt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                {{ $course->duration }} hours
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                </svg>
                                {{ $course->level ?? 'Beginner' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="px-5 py-4 flex justify-between items-center border-t border-gray-100">
                        <div>
                            <span class="text-lg font-semibold text-gray-900">₹{{ $course->discounted_fees }}</span>
                            @if(isset($course->original_fees) && $course->original_fees > $course->discounted_fees)
                                <span class="text-sm text-gray-500 line-through ml-2">₹{{ $course->original_fees }}</span>
                            @endif
                        </div>
                        
                        @if (auth()->user() && auth()->user()->is_member)
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
                <div class="col-span-full py-16 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-400 mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No courses found</h3>
                    <p class="text-gray-600 max-w-md mx-auto">Try adjusting your search or filters to find what you're looking for.</p>
                    <button wire:click="resetFilters" class="mt-4 px-4 py-2 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition duration-200 text-sm">
                        Reset Filters
                    </button>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $courses->links() }}
        </div>
    </div>
</div>
