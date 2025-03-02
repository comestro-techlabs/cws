<div>
    <div class="p-4">
        <!-- Search Input -->
        <div class="flex flex-wrap justify-between items-center p-4">
            <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 mb-5">
                Manage Course
            </h2>

            <a wire:navigate href="{{ route('admin.course') }}"
                class="bg-purple-800 text-white px-4 py-2 rounded-md shadow hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-blue-300 sm:mb-0 flex items-center gap-1">
                Create New Course
                <i class="bi bi-arrow-down-short font-bold text-xl"></i>
            </a>

        </div>
        <input type="text" wire:model.live="search" placeholder="Search courses..."
            class="border border-gray-300 rounded p-2 w-full mb-4">

        <!-- Course Table -->
        <div class="overflow-x-auto">
            <table class="font-sans min-w-full bg-white border border-gray-300 shadow-sm rounded-lg">
                <thead class="bg-gray-200   ">
                    <tr>
                        <th class=" py-2 px-4 text-left">Title</th>
                        <th class="py-2 px-4 text-left">Instructor</th>
                        <th class="py-2 px-4 text-left">Duration</th>
                        <th class="py-2 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                        <tr class="border-t border-gray-300 ">
                            <td class="font-sans px-4 py-5">{{ $course->title }}</td>
                            <td class="font-sans px-4 py-5">{{ $course->instructor }}</td>
                            <td class="font-sans px-4 py-5">{{ $course->duration }}Weeks</td>


                            <td class="py-2 px-4 text-center">
                                <a wire:navigate href="{{ route('admin.course.show', $course->id) }}"
                                    class="bg-blue-500 rounded-lg text-white p-2 ">View</a>
                                <a wire:navigate href="{{ route('admin.course.update', $course->id) }}"
                                    class="bg-purple-800 text-white p-2 rounded-lg ">Edit</a>

                                <button wire:click="confirmDelete({{ $course->id }})"
                                    class="bg-red-500 text-white p-2 rounded-lg ">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-3 px-4 text-center text-gray-500">No courses found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $courses->links() }}
        </div>

        <!-- Delete Confirmation Modal -->
        @if ($confirmingDelete)
            <div class="fixed inset-0 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <p class="text-lg font-semibold">Delete Course?</p>
                    <p class="text-gray-600">Are you sure you want to delete <strong>{{ $courseToDelete->title }}</strong>?
                    </p>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button wire:click="$set('confirmingDelete', false)"
                            class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                        <button wire:click="deleteCourse" class="px-4 py-2 bg-red-500 text-white rounded">Delete</button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>