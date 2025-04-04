<div class="min-h-screen bg-gray-50 py-6">
    <x-loader />
    
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-sm">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Create New Course</h2>
                    <a href="{{ route('admin.course.manage') }}" wire:navigate
                        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back
                    </a>
                </div>
            </div>

            <!-- Simple Form -->
            <form wire:submit.prevent="createCourse" class="p-6">
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Course Name</label>
                        <input type="text" wire:model="title" id="title"
                            class="w-full rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 px-4 py-3"
                            placeholder="Enter course name">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            wire:loading.attr="disabled"
                            class="px-6 py-2.5 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors disabled:opacity-50">
                            <span wire:loading.remove>Create & Continue</span>
                            <span wire:loading>Creating...</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
