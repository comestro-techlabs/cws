<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h1 class="text-xl font-semibold text-gray-800">
                        Manage Assignments
                    </h1>
                    <div class="flex flex-wrap gap-3">
                        <a wire:navigate href="{{ route('admin.assignment.course') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                            <i class="bi bi-book-half mr-2"></i>
                            View Courses
                        </a>
                        <a wire:navigate href="{{ route('admin.assignment') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="bi bi-plus-lg mr-2"></i>
                            New Assignment
                        </a>
                    </div>
                </div>

                <!-- Filters -->
                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="relative">
                        <input type="search" wire:model.live="search"
                            class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400"
                            placeholder="Search assignments...">
                        <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <select wire:model.live="course_id"
                        class="w-full py-2 pl-4 pr-8 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400">
                        <option value="">All Courses</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Assignments Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($assignments as $assignment)
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="p-5">
                        <!-- Header -->
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-semibold text-gray-800 line-clamp-2">{{ $assignment->title }}</h3>
                            <div class="flex items-center">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:change="toggleStatus({{ $assignment->id }})"
                                        class="sr-only peer" {{ $assignment->status ? 'checked' : '' }}>
                                    <div class="w-9 h-5 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-500"></div>
                                </label>
                            </div>
                        </div>

                        <!-- Course & Batch Info -->
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="bi bi-book mr-2"></i>
                                {{ $assignment->course->title }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="bi bi-people mr-2"></i>
                                {{ $assignment->batch->batch_name }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="bi bi-calendar3 mr-2"></i>
                                {{ $assignment->created_at->format('M d, Y') }}
                            </div>
                        </div>

                        <!-- Status Badge -->
                        <div class="mb-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $assignment->status ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $assignment->status ? 'Published' : 'Draft' }}
                            </span>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-wrap gap-2">
                            <a wire:navigate href="{{ route('admin.assignment.view', $assignment->id) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition-colors text-sm">
                                <i class="bi bi-eye mr-1"></i> View
                            </a>
                            <a wire:navigate href="{{ route('admin.assignment.edit', $assignment->id) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition-colors text-sm">
                                <i class="bi bi-pencil mr-1"></i> Edit
                            </a>
                            <button wire:click="delete({{ $assignment->id }})"
                                wire:confirm="Are you sure you want to delete this assignment?"
                                class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 rounded hover:bg-red-100 transition-colors text-sm">
                                <i class="bi bi-trash mr-1"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-12 bg-white rounded-lg">
                        <i class="bi bi-folder2-open text-4xl text-gray-400"></i>
                        <p class="mt-2 text-gray-500">No assignments found</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($assignments->hasPages())
        <div class="mt-6 bg-white rounded-lg shadow-sm">
            <div class="px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button wire:click="previousPage" wire:loading.attr="disabled"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </button>
                    <button wire:click="nextPage" wire:loading.attr="disabled"
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing <span class="font-medium">{{ $assignments->firstItem() }}</span> to
                            <span class="font-medium">{{ $assignments->lastItem() }}</span> of
                            <span class="font-medium">{{ $assignments->total() }}</span> assignments
                        </p>
                    </div>
                    <div>
                        {{ $assignments->links() }}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
