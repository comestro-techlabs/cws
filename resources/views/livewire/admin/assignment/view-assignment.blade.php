<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back button -->
        <div class="mb-6">
            <a href="{{ route('admin.assignment.manage') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Assignments
            </a>
        </div>

        <!-- Assignment Details Card -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="p-6">
                <!-- Header -->
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $assignment->title }}</h1>
                        <p class="mt-2 text-sm text-gray-500">
                            Created {{ $assignment->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-sm {{ $assignment->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $assignment->status ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                <!-- Course and Batch Info -->
                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Course</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $assignment->course?->title ?? 'No Course' }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Batch</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $assignment->batch?->batch_name ?? 'No Batch' }}</p>
                    </div>
                </div>

                <!-- Due Date -->
                <div class="mt-6">
                    <h3 class="text-sm font-medium text-gray-500">Due Date</h3>
                    <p class="mt-1 text-lg {{ $assignment->isOverdue() ? 'text-red-600' : 'text-gray-900' }}">
                        {{ $assignment->due_date ? $assignment->due_date->format('M d, Y h:i A') : 'No due date' }}
                        @if($assignment->isOverdue())
                            <span class="text-sm">(Overdue)</span>
                       
                        @endif
                    </p>
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <h3 class="text-sm font-medium text-gray-500">Description</h3>
                    <div class="mt-2 prose max-w-none text-gray-700">
                        {!! $assignment->description ?? 'No description provided' !!}
                    </div>
                </div>

                <!-- Submissions Overview -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900">Submissions Overview</h3>
                    <dl class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-gray-50 px-4 py-5 rounded-lg">
                            <dt class="text-sm font-medium text-gray-500">Total Submissions</dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ $assignment->uploads->count() }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 rounded-lg">
                            <dt class="text-sm font-medium text-gray-500">Graded</dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ $assignment->uploads->where('status', 'graded')->count() }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 rounded-lg">
                            <dt class="text-sm font-medium text-gray-500">Pending Review</dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ $assignment->uploads->where('status', 'submitted')->count() }}
                            </dd>
                        </div>
                    </dl>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('assignment.reviewWork', $assignment->id) }}" 
                        class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Review Submissions
                    </a>
                    <button wire:click="handleEdit"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Assignment
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
