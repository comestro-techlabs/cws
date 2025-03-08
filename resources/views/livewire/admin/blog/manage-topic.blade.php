<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <!-- Breadcrumbs -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                @foreach($breadcrumbs as $index => $breadcrumb)
                    <li class="inline-flex items-center">
                        @if(!$loop->first)
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                        @if($breadcrumb['url'] !== '#')
                            <a href="{{ $breadcrumb['url'] }}" class="text-gray-700 hover:text-indigo-600">{{ $breadcrumb['label'] }}</a>
                        @else
                            <span class="text-gray-500">{{ $breadcrumb['label'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-700">Topics for: {{ $chapter->chapter_name }}</h2>
            <button wire:click="openModal"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Add Topic
            </button>
        </div>

        <!-- Topics Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Topic Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($topics as $topic)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $topic->order }}</td>
                            <td class="px-6 py-4">{{ $topic->topic_name }}</td>
                            <td class="px-6 py-4">{{ Str::limit($topic->topic_description, 50) }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <button wire:click="edit({{ $topic->id }})"
                                    class="text-blue-600 hover:text-blue-900">Edit</button>
                                    <a href="{{ route('blog.posts', $topic->id) }}"
                                    class="text-green-600 hover:text-green-900">Post</a>
                                <button wire:click="delete({{ $topic->id }})"
                                    wire:confirm="Are you sure you want to delete this topic?"
                                    class="text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No topics found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Topic Modal -->
        @if($isModalOpen)
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 overflow-y-auto h-full w-full flex items-center justify-center z-50">
                <div class="relative bg-white rounded-lg p-8 w-full max-w-md mx-4">
                    <!-- Modal Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $topicId ? 'Edit' : 'Add' }} Topic</h3>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">
                            <span class="text-2xl">&times;</span>
                        </button>
                    </div>

                    <!-- Modal Form -->
                    <form wire:submit="{{ $topicId ? 'update' : 'store' }}">
                        <div class="space-y-4">
                            <!-- Topic Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Topic Name</label>
                                <input type="text" wire:model="topic_name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @error('topic_name')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Topic Description with Rich Text Editor -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <div class="mt-2">
                                    <div class="border rounded-lg">
                                        <!-- Editor Toolbar -->
                                        <div class="flex flex-wrap gap-1 p-2 border-b bg-gray-50">
                                            <button type="button" onclick="formatText('bold')"
                                                class="p-2 hover:bg-gray-200 rounded">
                                                <i class="bi bi-type-bold"></i>
                                            </button>
                                            <button type="button" onclick="formatText('italic')"
                                                class="p-2 hover:bg-gray-200 rounded">
                                                <i class="bi bi-type-italic"></i>
                                            </button>
                                            <div class="border-r border-gray-300 mx-1"></div>
                                            <button type="button" onclick="formatText('justifyLeft')"
                                                class="p-2 hover:bg-gray-200 rounded">
                                                <i class="bi bi-text-left"></i>
                                            </button>
                                            <button type="button" onclick="formatText('justifyCenter')"
                                                class="p-2 hover:bg-gray-200 rounded">
                                                <i class="bi bi-text-center"></i>
                                            </button>
                                            <button type="button" onclick="formatText('justifyRight')"
                                                class="p-2 hover:bg-gray-200 rounded">
                                                <i class="bi bi-text-right"></i>
                                            </button>
                                        </div>

                                        <!-- Editor Content Area -->
                                        <div x-data="{ content: @entangle('topic_description').defer }"
                                            x-init="$refs.editor.innerHTML = content"
                                            @input="content = $refs.editor.innerHTML"
                                            class="p-4">
                                            <div x-ref="editor"
                                                contenteditable="true"
                                                class="min-h-[200px] focus:outline-none prose max-w-none">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('topic_description')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Topic Order -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Order</label>
                                <input type="number" wire:model="order"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @error('order')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" wire:click="closeModal"
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700">
                                {{ $topicId ? 'Update' : 'Create' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Rich Text Editor Script -->
<script>
    function formatText(command) {
        document.execCommand(command, false, null);
    }
</script>
