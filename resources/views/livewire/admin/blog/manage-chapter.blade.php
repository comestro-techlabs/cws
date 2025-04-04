<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-700">Chapters for: {{ $course->title }}</h2>
            <button wire:click="openModal"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Add Chapter
            </button>
        </div>

        <!-- Chapters Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Chapter Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($chapters as $chapter)
                        <tr> 
                            <td class="px-6 py-4 whitespace-nowrap">{{ $chapter->order }}</td>
                            <td class="px-6 py-4">{{ $chapter->chapter_name }}</td>
                            <td class="px-6 py-4">{{ Str::limit($chapter->chapter_description, 50) }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <button wire:click="edit({{ $chapter->id }})"
                                    class="text-blue-600 hover:text-blue-900">Edit</button>
                                <a href="{{ route('blog.topics', $chapter->id) }}"
                                    class="text-green-600 hover:text-green-900">Topics</a>
                                <button wire:click="delete({{ $chapter->id }})"
                                    wire:confirm="Are you sure you want to delete this chapter?"
                                    class="text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No chapters found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Chapter Modal -->
        @if($isModalOpen)
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 overflow-y-auto h-full w-full flex items-center justify-center">
                <div class="relative bg-white rounded-lg p-8 w-full max-w-md mx-4">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $chapterId ? 'Edit' : 'Add' }} Chapter</h3>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">&times;</button>
                    </div>

                    <form wire:submit="{{ $chapterId ? 'update' : 'store' }}">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Chapter Name</label>
                                <input type="text" wire:model="chapter_name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @error('chapter_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea wire:model="chapter_description" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                                @error('chapter_description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Order</label>
                                <input type="number" wire:model="order"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @error('order') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" wire:click="closeModal"
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700">
                                {{ $chapterId ? 'Update' : 'Create' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
