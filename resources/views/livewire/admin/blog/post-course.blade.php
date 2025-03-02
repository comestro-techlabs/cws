<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <!-- Header Section -->
        <div class="flex gap-3 flex-col md:flex-row justify-between md:items-center mb-6">
            <div class="flex flex-wrap justify-between items-center">
                <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3">
                    Manage Courses
                </h2>
            </div>
            <div class="flex gap-3 items-center">
                <input type="text" wire:model.live.debounce.500ms="search"
                    placeholder="Search courses..."
                    class="border rounded px-3 py-2 w-full md:w-64">
                <button wire:click="openModal"
                    class="bg-purple-800 hover:bg-purple-600 text-white font-bold px-4 py-2 rounded">
                    Add Course
                </button>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($courses as $course)
                        <tr>
                            <td class="px-6 py-4">{{ $course->title }}</td>
                            <td class="px-6 py-4">
                                @if($course->image)
                                    <img src="{{ Storage::url($course->image) }}" class="h-10 w-10 object-cover rounded">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="toggleStatus({{ $course->id }})"
                                    class="{{ $course->status ? 'bg-green-500' : 'bg-red-500' }} text-white px-2 py-1 rounded-full text-xs">
                                    {{ $course->status ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <button wire:click="edit({{ $course->id }})"
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                    Edit
                                </button>
                                <a href="{{ route('blog.chapters', $course->id) }}"
                                    class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                    Chapters
                                </a>
                                <button wire:click="delete({{ $course->id }})"
                                    wire:confirm="Are you sure you want to delete this course?"
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No courses found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-3 bg-gray-50 border-t">
                {{ $courses->links() }}
            </div>
        </div>

        <!-- Modal -->
        @if($isModalOpen)
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 overflow-y-auto h-full w-full flex items-center justify-center">
                <div class="relative bg-white rounded-lg p-8 w-full max-w-md mx-4">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $courseId ? 'Edit' : 'Create' }} Course</h3>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">
                            <span class="text-2xl">&times;</span>
                        </button>
                    </div>

                    <form wire:submit="{{ $courseId ? 'update' : 'store' }}">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" wire:model="title"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea wire:model="description" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500"></textarea>
                                @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Image</label>
                                <input type="file" wire:model="image" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                                @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                                @if($existingImage)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($existingImage) }}" class="h-20 w-20 object-cover rounded">
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" wire:model="status" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                <label class="ml-2 block text-sm text-gray-700">Active</label>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" wire:click="closeModal"
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-purple-600 text-white rounded-md text-sm font-medium hover:bg-purple-700">
                                {{ $courseId ? 'Update' : 'Create' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
