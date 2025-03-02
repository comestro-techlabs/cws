<div class="bg-gray-100 h-screen p-6">
   

    <div class="mx-auto max-w-3xl w-full p-6 bg-white shadow-lg rounded-xl">
        <!-- Header Section -->
        <div class="flex flex-wrap justify-between items-center border-b border-gray-200 pb-4 mb-6 space-y-2">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 flex items-center gap-2">
                Assignment Details 
                <i class="bi bi-arrow-down-circle-fill text-purple-800 animate-bounce"></i>
            </h2>
            <a wire:navigate href="{{ route('admin.assignment.manage') }}"
               class="bg-purple-800 text-white px-4 py-2 rounded-lg shadow-md hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300 flex items-center gap-2">
                <i class="bi bi-arrow-left"></i> Go Back
            </a>
        </div>

        <!-- Assignment Details Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4">
            <!-- Title -->
            <div class="space-y-1">
                <label class="block text-sm font-semibold text-gray-700">Title</label>
                <p class="text-lg font-medium text-gray-900 bg-gray-50 p-2 rounded-md">{{ $assignment->title }}</p>
            </div>

            <!-- Course -->
            <div class="space-y-1">
                <label class="block text-sm font-semibold text-gray-700">Course</label>
                <p class="text-lg font-medium text-gray-900 bg-gray-50 p-2 rounded-md">{{ $assignment->course->title ?? 'N/A' }}</p>
            </div>

            <!-- Description -->
            <div class="space-y-1 md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700">Description</label>
                <div class="text-gray-800 prose max-w-none bg-gray-50 p-3 rounded-md border border-gray-200">
                    {!! $assignment->description ?? '<span class="text-gray-500 italic">No description provided.</span>' !!}
                </div>
            </div>

            <!-- Batch -->
            <div class="space-y-1">
                <label class="block text-sm font-semibold text-gray-700">Batch</label>
                <p class="text-lg font-medium text-gray-900 bg-gray-50 p-2 rounded-md">{{ $assignment->batch->batch_name ?? 'N/A' }}</p>
            </div>

            <!-- Status -->
            <div class="space-y-1">
                <label class="block text-sm font-semibold text-gray-700">Status</label>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $assignment->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} shadow-sm">
                    {{ $assignment->status ? 'Active' : 'Inactive' }}
                </span>
            </div>

            <!-- Date Created -->
            <div class="space-y-1">
                <label class="block text-sm font-semibold text-gray-700">Date Created</label>
                <p class="text-lg font-medium text-gray-900 bg-gray-50 p-2 rounded-md">{{ $assignment->created_at->format('Y-m-d') }}</p>
            </div>

            <!-- Date Updated -->
            <div class="space-y-1">
                <label class="block text-sm font-semibold text-gray-700">Last Updated</label>
                <p class="text-lg font-medium text-gray-900 bg-gray-50 p-2 rounded-md">{{ $assignment->updated_at->format('Y-m-d') }}</p>
            </div>
        </div>
    </div>
</div>