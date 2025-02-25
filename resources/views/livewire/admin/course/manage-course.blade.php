<div>
    <div class="p-4">
        <!-- Search Input -->
        <input type="text" wire:model.live="search" 
            placeholder="Search courses..." 
            class="border rounded p-2 w-full mb-4">
    
        <!-- Course Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border shadow-sm rounded-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-left">Title</th>
                        <th class="py-2 px-4 text-left">Instructor</th>
                        <th class="py-2 px-4 text-left">Duration</th>
                        <th class="py-2 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                    <tr class="border-t">
                        <td class="py-2 px-4">{{ $course->title }}</td>
                        <td class="py-2 px-4">{{ $course->instructor }}</td>
                        <td class="py-2 px-4">{{ $course->duration }}Weeks</td>
                        

                        <td class="py-2 px-4 text-center">
                            <a href="{{ route('admin.course.update', $course->id) }}" class="text-blue-500 hover:underline">Edit</a>
                            <a href="{{ route('admin.course.show', $course->id) }}" class="text-blue-500 hover:underline">Show</a>
                            <button wire:click="confirmDelete({{ $course->id }})" class="text-red-500 ml-3 hover:underline">Delete</button>
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
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <p class="text-lg font-semibold">Delete Course?</p>
                <p class="text-gray-600">Are you sure you want to delete <strong>{{ $courseToDelete->title }}</strong>?</p>
                <div class="mt-4 flex justify-end space-x-2">
                    <button wire:click="$set('confirmingDelete', false)" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button wire:click="deleteCourse" class="px-4 py-2 bg-red-500 text-white rounded">Delete</button>
                </div>
            </div>
        </div>
        @endif
    </div>
    </div>
