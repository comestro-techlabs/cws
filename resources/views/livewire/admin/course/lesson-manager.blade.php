<div class="bg-white p-4 rounded-lg shadow">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold">Lessons for Chapter: {{ $chapter->title }}</h3>
       
    </div>

    <form wire:submit="addLesson" class="mb-6">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Lesson Title</label>
                <input type="text" wire:model="lessonTitle" class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('lessonTitle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                Add Lesson
            </button>
        </div>
    </form>

    <div class="mt-6">
        <h4 class="font-medium mb-4">Current Lessons</h4>
        <div class="space-y-3">
            @foreach($lessons as $lesson)
            <div class="p-3 bg-gray-50 rounded-md">
                @if($editingLesson && $editingLesson->id === $lesson->id)
                    <form wire:submit="updateLesson" class="flex items-center space-x-2">
                        <input type="text" 
                               wire:model="editedTitle" 
                               class="flex-1 p-2 rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <button type="submit" class="text-green-600 hover:text-green-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                        <button type="button" wire:click="cancelEditing" class="text-gray-600 hover:text-gray-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </form>
                @else
                    <div class="flex items-center justify-between">
                        <span>{{ $lesson->title }}</span>
                        <div class="flex items-center space-x-2">
                            <button wire:click="startEditing({{ $lesson->id }})" class="text-blue-600 hover:text-blue-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button wire:click="deleteLesson({{ $lesson->id }})" class="text-red-600 hover:text-red-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
