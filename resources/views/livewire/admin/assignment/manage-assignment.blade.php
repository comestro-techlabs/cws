<div>
    <div class="flex flex-wrap justify-between items-center p-4">
        <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-orange-400 pl-3 mb-5">
            Manage Assignments
        </h2>
        <a wire:navigate href="{{ route('admin.assignment') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 sm:mb-0 flex items-center gap-1">
            Create New Assignment
            <i class="bi bi-arrow-down-short font-bold"></i>
        </a>
    </div>

    <div class="flex justify-between p-2">
        <div class="w-full bg-white p-6 shadow-md rounded-lg">
            <div class="flex flex-col sm:flex-row sm:justify-between gap-4">
                <div>
                    <label for="course_id" class="block text-sm font-medium text-gray-700 mb-1">Filter by Course</label>
                    <div class="flex items-center gap-2">
                        <select wire:model.live="course_id" id="course_id"
                            class="w-full sm:w-64 mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                            <option value="">Select a course</option>
                            @foreach ($courses as $course)

                                <option value="{{ $course->id }}" {{ $this->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>

                            @endforeach
                        </select>
                        @if($course_id)
                            <button wire:click="clearFilter" class="text-red-500 hover:text-red-700">
                                <i class="bi bi-x-circle"></i>X
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Messages -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" wire:click="$refresh">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1 1 0 11-1.414-1.414L10.414 10l2.52-2.52a1 1 0 011.414 1.414L12.828 10l1.52 1.52zM5.652 5.151a1 1 0 011.414 1.414L9.586 10l-2.52 2.52a1 1 0 01-1.414-1.414L7.172 10 5.652 8.565z"/></svg>
                    </span>
                </div>
            @endif

            <!-- Table -->
            <div class="overflow-x-auto flex-wrap mt-4" wire:loading.class="opacity-50">
                <div wire:loading wire:target="course_id" class="absolute inset-0 flex items-center justify-center bg-gray-100 bg-opacity-50">
                    <span class="text-gray-500">Filtering...</span>
                </div>
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left border">Title</th>
                            <th class="px-4 py-2 text-left border">isPublished</th>
                            <th class="px-4 py-2 text-left border">Status</th>
                            <th class="px-4 py-2 text-left border">Course</th>
                            <th class="px-4 py-2 text-left border">Batch</th>
                            <th class="px-4 py-2 text-left border">Date</th>
                            <th class="px-4 py-2 text-left border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($assignments as $assignment)
                            <tr>
                                <td class="px-4 py-2 truncate max-w-64 border">{{ $assignment->title }}</td>
                                <td class="px-4 py-2 border">{{ $assignment->status ? 'Published' : 'Unpublished' }}</td>
                                <td class="border px-4 py-2">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" wire:change="toggleStatus({{ $assignment->id }})"
                                            class="sr-only peer" {{ $assignment->status ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-green-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                    </label>
                                </td>
                                <td class="px-4 py-2 truncate max-w-80 border">{{ $assignment->course->title }}</td>
                                <td class="px-4 py-2 truncate max-w-80 border">{{ $assignment->batch->batch_name }}</td>
                                <td class="px-4 py-2 border">{{ $assignment->created_at->format('Y-m-d') }}</td>
                                <td class="px-4 py-2 border">
                                    <div class="flex flex-wrap gap-2">
                                        <a wire:navigate href="{{ route('admin.assignment.view', $assignment->id) }}"
                                            class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-teal-500 transition flex items-center gap-1">
                                            View <i class="bi bi-eye-fill font-bold"></i>
                                        </a>
                                        <a wire:navigate href="{{ route('admin.assignment.edit', $assignment->id) }}"
                                            class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-blue-500 transition flex items-center gap-1">
                                            Edit <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button wire:click="delete({{ $assignment->id }})" wire:confirm="Are you sure you want to delete this assignment?"
                                            class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-red-500 flex items-center gap-1">
                                            Delete <i class="bi bi-trash3-fill font-bold"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-2 text-center border">No assignments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>