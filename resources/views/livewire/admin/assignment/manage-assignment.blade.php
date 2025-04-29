<div class=" bg-gray-50">
    <!-- Full Page Loader -->
    <x-loader />

 
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manage Assignments</h1>
                <p class="mt-1 text-sm text-gray-500">Create and manage course assignments</p>
            </div>
            <button wire:click="create"
                class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" />
                </svg>
                Create Assignment
            </button>
        </div>

        <!-- Tabs Section -->
        <div class="mb-4 sm:mb-6">
            <div class="border-b border-gray-200 overflow-x-auto ">
                <nav class=" flex space-x-4 sm:space-x-8 px-4 sm:px-0" aria-label="Tabs">
                    <button wire:click="$set('activeTab', 'latest')"
                        class="{{ $activeTab === 'latest' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Active & Upcoming
                    </button>
                    <button wire:click="$set('activeTab', 'graded')"
                        class="{{ $activeTab === 'graded' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Completed
                    </button>
                    <button wire:click="$set('activeTab', 'all')"
                        class="{{ $activeTab === 'all' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        All Assignments
                    </button>
                </nav>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="bg-white p-4 sm:p-6 rounded-lg shadow mb-4 sm:mb-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Filter by Course</label>
                    <select wire:model.live="course_id"
                        class="w-full px-4 py-2.5 text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 shadow-sm bg-white">
                        <option value="">All Courses</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" wire:model.live="search"
                        class="w-full px-4 py-2.5 text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 shadow-sm"
                        placeholder="Search assignments...">
                </div>

                <div class="flex items-end">
                    <button wire:click="clearFilter"
                        class="px-4 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 shadow-sm">
                        Clear Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if (session()->has('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Group Toggle -->
        <div class="mb-4 flex justify-end">
            <div class="inline-flex rounded-lg border border-gray-200">
                <button wire:click="$set('groupBy', 'course')" 
                    class="px-4 py-2 text-sm {{ $groupBy === 'course' ? 'bg-teal-500 text-white' : 'bg-white text-gray-700' }} rounded-l-lg">
                    Group by Course
                </button>
                <button wire:click="$set('groupBy', 'batch')"
                    class="px-4 py-2 text-sm {{ $groupBy === 'batch' ? 'bg-teal-500 text-white' : 'bg-white text-gray-700' }} rounded-r-lg">
                    Group by Batch
                </button>
            </div>
        </div>

        <!-- Grouped Assignments -->
        @forelse($groupedAssignments as $groupName => $assignments)
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 px-4 py-2 bg-gray-50 rounded-lg">
                    {{ $groupName ?? 'Ungrouped' }}
                    <span class="text-sm text-gray-500 ml-2">({{ $assignments->count() }})</span>
                </h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6">
                    @foreach($assignments as $assignment)
                        <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all border border-gray-100" 
                            aria-labelledby="assignment-{{ $assignment->id }}-title">
                            <!-- Card Header with Status -->
                            <div class="px-4 py-3 border-b flex items-center justify-between bg-gray-50">
                                <div class="flex items-center gap-2">
                                    <span class="relative flex h-3 w-3">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $assignment->status ? 'bg-green-400' : 'bg-red-400' }} opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 {{ $assignment->status ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                    </span>
                                    <span class="text-sm font-medium {{ $assignment->status ? 'text-green-700' : 'text-red-700' }}">
                                        {{ $assignment->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <button wire:click="toggleStatus({{ $assignment->id }})" 
                                        class="p-1.5 text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100"
                                        title="{{ $assignment->status ? 'Deactivate' : 'Activate' }} Assignment">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="{{ $assignment->status ? 'M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z' : 'M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z' }}"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Card Content -->
                            <div class="p-4">
                                <!-- Title and Due Date -->
                                <div class="mb-4">
                                    <h3 id="assignment-{{ $assignment->id }}-title" class="text-lg font-semibold text-gray-900">
                                        {{ $assignment->title }}
                                    </h3>
                                    <div class="mt-1 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="{{ Carbon\Carbon::parse($assignment->due_date) < now() ? 'text-red-600 font-medium' : 'text-gray-600' }}">
                                            Due {{ Carbon\Carbon::parse($assignment->due_date)->format('M d, Y h:i A') }}
                                            @if(Carbon\Carbon::parse($assignment->due_date) < now())
                                                <span class="inline-flex items-center ml-2 px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">Overdue</span>
                                            @elseif(Carbon\Carbon::parse($assignment->due_date)->diffInDays(now()) <= 3)
                                                <span class="inline-flex items-center ml-2 px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">Due Soon</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <!-- Course and Batch Info -->
                                <div class="space-y-2">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                        {{ $assignment->course?->title }}
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                        {{ $assignment->batch?->batch_name }}
                                    </div>
                                </div>

                                <!-- Submission Stats -->
                                <div class="mt-4 grid grid-cols-3 gap-2 p-2 bg-gray-50 rounded-lg">
                                    <div class="text-center" title="Total Submissions">
                                        <span class="text-xs text-gray-500">Submissions</span>
                                        <p class="font-semibold text-teal-600">{{ $assignment->uploads->count() }}</p>
                                    </div>
                                    <div class="text-center" title="Pending Reviews">
                                        <span class="text-xs text-gray-500">Pending</span>
                                        <p class="font-semibold text-yellow-600">
                                            {{ $assignment->uploads->whereNull('grade')->count() }}
                                        </p>
                                    </div>
                                    <div class="text-center" title="Graded Submissions">
                                        <span class="text-xs text-gray-500">Graded</span>
                                        <p class="font-semibold text-green-600">
                                            {{ $assignment->uploads->whereNotNull('grade')->count() }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="mt-4 pt-4 border-t flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <button wire:click="edit({{ $assignment->id }})" 
                                            class="p-1.5 text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100"
                                            title="Edit Assignment">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button wire:click="assignmentdelete({{ $assignment->id }})"
                                            class="p-1.5 text-gray-500 hover:text-red-600 rounded-full hover:bg-red-50"
                                            title="Delete Assignment">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>

                                    @if($assignment->uploads->count() > 0)
                                        <a href="{{ route('assignment.reviewWork', $assignment->id) }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                            </svg>
                                            Review Work
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="col-span-full p-4 sm:p-6 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No assignments</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating a new assignment.</p>
            </div>
        @endforelse
    </div>

    <!-- Create/Edit Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-50">
            <div class="fixed inset-0 z-50 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all w-full max-w-lg sm:max-w-2xl mx-4 sm:mx-auto">
                        <form wire:submit="save" class="p-4 sm:p-6">
                            <div class="space-y-4">
                                <!-- Course Selection -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                                    <select wire:model.live="course_id"
                                        class="w-full px-4 py-2.5 text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 shadow-sm bg-white">
                                        <option value="">Select Course</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Batch</label>
                                    <select wire:model="batch_id"
                                        class="w-full px-4 py-2.5 text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 shadow-sm bg-white">
                                        <option value="">Select Batch</option>
                                        @foreach($batches as $batch)
                                            <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('batch_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                    <input type="text" wire:model="title"
                                        class="w-full px-4 py-2.5 text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 shadow-sm">
                                    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea wire:model="description" rows="4"
                                        class="w-full px-4 py-2.5 text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 shadow-sm resize-none"></textarea>
                                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                                    <input type="datetime-local" wire:model="due_date"
                                        class="w-full px-4 py-2.5 text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 shadow-sm">
                                    @error('due_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" wire:model="status"
                                        class="rounded border-gray-300 text-teal-600">
                                    <label class="ml-2 block text-sm text-gray-900">Active</label>
                                </div>
                            </div>

                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button type="submit"
                                    class="inline-flex w-full justify-center rounded-md bg-teal-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-teal-500 sm:ml-3 sm:w-auto">
                                    {{ $editingAssignment ? 'Update' : 'Create' }}
                                </button>
                                <button type="button" wire:click="closeModal"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>