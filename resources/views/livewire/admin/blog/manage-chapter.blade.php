<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-700">Chapters for: {{ $course->title }}</h2>
            <button wire:click="openModal"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Add Chapter & Topics
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Topics</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white  divide-y divide-gray-200">
                    @if($chapters instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        @forelse($chapters as $chapter)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $chapter->order }}</td>
                                <td class="px-6 py-4">{{ $chapter->chapter_name }}</td>
                                <td class="px-6 py-4">{{ Str::limit($chapter->chapter_description, 50) }}</td>
                                <td class="px-6 py-4"> <button wire:click="openTopic({{ $chapter->id }})" class="text-white bg-purple-500 p-2 rounded-md">Topic</button> </td>
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
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No chapters found</td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-red-500">Error: Chapters data not available</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            @if($chapters instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $chapters->links() }}
            @endif
        </div>

        @if ($isopenTopic)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50 overflow-y-auto" x-data="{ open: true }" x-show="open" x-cloak>
        <div class="relative bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 p-6 sm:p-8" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-900">Topics for {{ $chapter->chapter_name }}</h3>
                <button wire:click="closeTopic" class="text-gray-400 hover:text-gray-600 focus:outline-none" aria-label="Close modal">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Topics List -->
            <div class="space-y-4 max-h-[60vh] overflow-y-auto pr-2">
                @if($chapter && $chapter->topics->isNotEmpty())
                    @foreach($chapter->topics as $index => $topic)
                        <div class="border border-gray-200 rounded-md p-4" x-data="{ expanded: false }">
                            <!-- Topic Header -->
                            <div class="flex justify-between items-center cursor-pointer" @click="expanded = !expanded">
                                <h4 class="text-md font-medium text-gray-800">{{ $topic->topic_name }}</h4>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform" :class="{ 'rotate-180': expanded }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                            <!-- Topic Description -->
                            <div x-show="expanded" x-collapse class="mt-2 text-sm text-gray-600">
                                {{ $topic->topic_description ?: 'No description provided.' }}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-gray-500 py-4">
                        No topics found for this chapter.
                    </div>
                @endif
            </div>

            <!-- Modal Footer -->
            <div class="mt-6 flex justify-end">
                <button wire:click="closeTopic" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Close
                </button>
            </div>
        </div>
    </div>
@endif
        <!-- Chapter Modal with Stepper -->
        @if($isModalOpen)
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 overflow-y-auto h-full w-full flex items-center justify-center">
                <div class="relative bg-white rounded-lg p-8 w-full max-w-lg mx-4">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $chapterId ? 'Edit' : 'Add' }} Chapter</h3>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">×</button>
                    </div>

                    <!-- Stepper -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 text-center">
                                <span class="inline-block w-8 h-8 rounded-full {{ $currentStep >= 1 ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }}">1</span>
                                <p class="mt-2 text-sm font-medium {{ $currentStep >= 1 ? 'text-indigo-600' : 'text-gray-500' }}">Chapter Details</p>
                            </div>
                            <div class="flex-1 text-center">
                                <span class="inline-block w-8 h-8 rounded-full {{ $currentStep == 2 ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }}">2</span>
                                <p class="mt-2 text-sm font-medium {{ $currentStep == 2 ? 'text-indigo-600' : 'text-gray-500' }}">Topics</p>
                            </div>
                        </div>
                    </div>

                    <form wire:submit="{{ $chapterId ? 'update' : 'store' }}">
                        <!-- Step 1: Chapter Details -->
                        @if($currentStep == 1)
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Chapter Name</label>
                                    <input type="text" wire:model.debounce="chapter_name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Enter chapter name">
                                    @error('chapter_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea wire:model.debounce="chapter_description" id="chapter_description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter chapter description"></textarea>
                                    @error('chapter_description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Order</label>
                                    <input type="number" wire:model.debounce="order" min="1"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Enter order number">
                                    @error('order') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end space-x-3">
                                <button type="button" wire:click="closeModal"
                                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    Cancel
                                </button>
                                <button type="button" wire:click="nextStep"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700">
                                    Next
                                </button>
                            </div>
                        @endif

                        <!-- Step 2: Topics -->
                        @if($currentStep == 2)
                            <div class="space-y-4 max-h-96 overflow-y-auto border rounded-md p-4">
                                <label class="block text-sm font-medium text-gray-700">Chapter Topics</label>
                                @foreach($topics as $index => $topic)
                                    <div class="border p-4 rounded-md">
                                        <div class="mb-2">
                                            <label class="block text-sm font-medium text-gray-700">Topic Name</label>
                                            <input type="text" wire:model.debounce="topics.{{ $index }}.topic_name"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                                placeholder="Enter topic name (e.g., Introduction)">
                                            @error('topics.' . $index . '.topic_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Topic Description</label>
                                            <textarea wire:model.debounce="topics.{{ $index }}.topic_description" id="topic_description_{{ $index }}" rows="3" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter topic description"></textarea>
                                            @error('topics.' . $index . '.topic_description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                        </div>
                                        <button type="button" wire:click="removeTopic({{ $index }})"
                                            class="mt-2 text-red-600 hover:text-red-900" {{ count($topics) == 1 ? 'disabled' : '' }}>
                                            Remove Topic
                                        </button>
                                    </div>
                                @endforeach
                                <button type="button" wire:click="addTopic"
                                    class="mt-2 text-indigo-600 hover:text-indigo-900 text-sm">
                                    + Add Another Topic
                                </button>
                            </div>
                            <div class="mt-6 flex justify-end space-x-3">
                                <button type="button" wire:click="previousStep"
                                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    Back
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700">
                                    {{ $chapterId ? 'Update' : 'Create' }}
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        @endif
    </div>
    
</div>
