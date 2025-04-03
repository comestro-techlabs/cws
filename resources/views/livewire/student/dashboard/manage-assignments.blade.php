<div>
    <x-loader />
    <x-access-restriction-modal />

<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-bold text-gray-900">My Assignments</h1>
        <div class="flex space-x-2">
            <button wire:loading.attr="disabled" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 rounded-md text-sm font-medium hover:bg-blue-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Filter
            </button>
            <button wire:loading.attr="disabled" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 rounded-md text-sm font-medium hover:bg-blue-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                </svg>
                Sort
            </button>
        </div>
    </div>

    <!-- Check if Courses Exist -->
    @if ($courses->isNotEmpty())
        <!-- Course Tabs -->
        <div x-data="{ activeTab: 'course-0' }">
            <!-- Course Navigation -->
            <div class="mb-4 border-b border-gray-200">
                <div class="flex overflow-x-auto hide-scrollbar space-x-4">
                    @foreach ($courses as $index => $course)
                        <button 
                            wire:loading.attr="disabled"
                            @click="activeTab = 'course-{{ $index }}'" 
                            :class="{ 'border-blue-600 text-blue-600': activeTab === 'course-{{ $index }}', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'course-{{ $index }}' }"
                            class="py-3 px-4 font-medium border-b-2 transition-colors whitespace-nowrap focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            {{ $course->title }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Course Content -->
            @foreach ($courses as $index => $course)
                <div x-show="activeTab === 'course-{{ $index }}'" class="bg-white rounded-lg border border-gray-200">
                    <div class="grid gap-4 p-4 md:grid-cols-2 lg:grid-cols-3">
                        @forelse($course->assignments as $key => $assignment)
                            <!-- Assignment Card -->
                            <div class="bg-white border border-gray-200 rounded-lg hover:border-blue-200 transition-colors h-full flex flex-col">
                                <div class="p-5 flex flex-col h-full">
                                    <!-- Assignment Status Badge -->
                                    <div class="flex justify-between items-start mb-3">
                                        <span class="text-xs font-medium text-gray-500">Assignment {{ $key + 1 }}</span>
                                        @if ($assignment->uploads->isNotEmpty())
                                            @foreach ($assignment->uploads as $upload)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 
                                                    @if ($upload->status == 'submitted') text-blue-800
                                                    @elseif($upload->status == 'graded') text-green-800
                                                    @else text-gray-800 @endif">
                                                    <span class="w-1.5 h-1.5 mr-1.5 rounded-full 
                                                        @if ($upload->status == 'submitted') bg-blue-600
                                                        @elseif($upload->status == 'graded') bg-green-600
                                                        @else bg-gray-600 @endif">
                                                    </span>
                                                    {{ ucfirst($upload->status) }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-gray-500"></span>
                                                Pending
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <!-- Assignment Title -->
                                    <h3 class="font-semibold text-gray-900 mb-2">{{ $assignment->title }}</h3>
                                    
                                    <!-- Description -->
                                    <div class="text-gray-600 text-sm mb-4 line-clamp-2 flex-grow">
                                        {!! strip_tags($assignment->description) !!}
                                    </div>
                                    
                                    <!-- Due Date & Action -->
                                    <div class="flex justify-between items-center pt-3 border-t border-gray-100 mt-auto">
                                        @if(isset($assignment->due_date))
                                            <div class="text-xs text-gray-500 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                Due: {{ $assignment->due_date }}
                                            </div>
                                        @else
                                            <div></div>
                                        @endif
                                        
                                        <div class="flex space-x-2">
                                            
                                            <a href="{{ route('student.v2view.assigment', $assignment->id) }}"
                                                wire:loading.attr="disabled"
                                                class="inline-flex items-center justify-center px-3 py-1.5 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View
                                            </a>
                                           
                                            
                                            <button wire:loading.attr="disabled" class="inline-flex items-center justify-center px-3 py-1.5 border border-gray-200 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-10 flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-lg font-medium text-gray-700 text-center">No assignments available</p>
                                <p class="text-gray-500 text-center mt-1">This course doesn't have any assignments yet.</p>
                                <button wire:loading.attr="disabled" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Refresh
                                </button>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
   
</div>

    @endif
<style>
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

</div>