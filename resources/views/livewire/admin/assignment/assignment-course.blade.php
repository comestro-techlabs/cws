
<div>
    <div class="col-span-1 md:col-span-6">
        @forelse ($courses as $course)
            <div class="bg-white border shadow-lg mb-10 rounded-xl overflow-hidden">
                <div class="p-4">
                    <div class="flex flex-col sm:flex-row">
                        <a href="{{ route('assignments.review', $course->slug) }}" class="flex-shrink-0 mb-3 sm:mb-0 sm:mr-4">
                            <img src="{{ asset('storage/course_images/' . $course->course_image) }}" alt="{{ $course->title }}"
                                class="w-32 h-32 rounded-lg object-cover">
                        </a>

                        <div class="flex flex-col justify-between flex-grow min-w-[200px]">
                            <div>
                                <h4 class="text-lg font-semibold mb-2">
                                    <a href="{{ route('assignments.review', $course->slug) }}"
                                        class="hover:text-blue-600">{{ $course->title }}</a>
                                </h4>
                                <p class="text-gray-600 text-sm mb-4">
                                    Total Assignments: {{ $course->assignments->count() }}
                                </p>
                            </div>
                            <div>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        {{ $course->unique_user_count ?? 0 }}
                                        {{ Str::plural('Student', $course->unique_user_count ?? 0) }}
                                    </span>
                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        Total Users Purchased: {{ $course->total_users }}
                                    </span>
                                </div>
                                <!-- Optional: Show published status -->
                                @if($course->is_published) <!-- Adjust based on your column name -->
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded mt-2 inline-block">
                                        Published
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-4">
                <p class="text-gray-600">No published courses found.</p>
            </div>
        @endforelse
    </div>

</div>