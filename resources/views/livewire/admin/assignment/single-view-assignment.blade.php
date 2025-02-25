<div class="bg-gray-100 h-screen p-4">
    <div class="mx-auto p-6 bg-white shadow-md rounded-lg border border-orange-500">
        <div class="flex flex-wrap justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                Assignments Details <i class="bi bi-arrow-down-circle-fill"></i>
            </h2>
            <a wire:navigate href="{{ route('admin.assignment.manage') }}"
                class="bg-blue-500 text-white px-2 py-2 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 sm:mb-0 flex items-center gap-1">
                <i class="bi bi-arrow-left"></i> Back to Assignments List
            </a>
        </div>

        <!-- Display Assignment Details -->
        <div class="p-4 space-y-4">
            <!-- Title -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Title</label>
                <p class="text-lg text-gray-900">{{ $assignment->title }}</p>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Description</label>
                <div class="text-gray-900 prose">{!! $assignment->description ?? 'No description provided.' !!}</div>
            </div>

            <!-- Course -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Course</label>
                <p class="text-gray-900">{{ $assignment->course->title ?? 'N/A' }}</p>
            </div>

            <!-- Batch -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Batch</label>
                <p class="text-gray-900">{{ $assignment->batch->batch_name ?? 'N/A' }}</p>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Status</label>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $assignment->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $assignment->status ? 'Active' : 'Inactive' }}
                </span>
            </div>

            <!-- Date Created -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Date Created</label>
                <p class="text-gray-900">{{ $assignment->created_at->format('Y-m-d') }}</p>
            </div>

            <!-- Date Updated -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Last Updated</label>
                <p class="text-gray-900">{{ $assignment->updated_at->format('Y-m-d') }}</p>
            </div>
        </div>
    </div>
</div>