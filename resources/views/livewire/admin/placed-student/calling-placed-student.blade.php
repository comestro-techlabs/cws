<div>
    <div class="flex flex-wrap justify-between items-center p-4">
        <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 mb-5">
            Manage Students
        </h2>

        <a wire:navigate href="{{ route('admin.placedstudent.create') }}"
            class="bg-purple-800 text-white px-4 py-2 rounded-md shadow hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-blue-300 sm:mb-0 flex items-center gap-1">
            Add New Student
            <i class="bi bi-arrow-down-short font-bold text-xl"></i>
        </a>

    </div>

    <div class="mx-auto p-3">
       

        <!-- Search Input -->
        <div class="mb-4">
            <input type="text" wire:model.live="search" placeholder="Search by name or position..."
                class="w-full px-4 py-2 border rounded">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border text-sm border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Content</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Position</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Image</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($placedStudents as $key => $student)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $key + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $student->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $student->content }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $student->position }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <button wire:click="toggleStatus({{ $student->id }})"
                                    class="px-4 py-2 text-white font-bold rounded
                                        {{ $student->status ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }}">
                                    {{ $student->status ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if ($student->image)
                                    <img src="{{ asset('storage/' . $student->image) }}" alt="{{ $student->name }}"
                                        class="w-16 h-16 rounded">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <div class="flex item-center gap-2">
                                    <button wire:click="editStudent({{ $student->id }})"
                                        class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</button> |
                                    <button wire:click="deleteStudent({{ $student->id }})"
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                                        onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="border border-gray-300 px-4 py-2 text-center">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $placedStudents->links() }}
        </div>
    </div>
</div>