<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-sm">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Create New Course</h2>
                    <a href="{{ route('admin.course.manage') }}" wire:navigate
                        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Courses
                    </a>
                </div>
            </div>

            <!-- Form -->
            <form wire:submit.prevent="insertCourse" class="p-6 space-y-6">
                @csrf
                
                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Course Title -->
                    <div class="col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Course Title</label>
                        <input type="text" wire:model="title" id="title"
                            class="w-full rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                            placeholder="Enter course title">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Course Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Course Type</label>
                        <select wire:model="course_type" 
                            class="w-full rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500">
                            <option value="">Select Course Type</option>
                            <option value="online">Online Course</option>
                            <option value="offline">Offline Course</option>
                        </select>
                        @error('course_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Course Category -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select wire:model="category_id" 
                            class="w-full rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price Information -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Regular Price (₹)</label>
                        <input type="number" wire:model="fees"
                            class="w-full rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                            placeholder="Enter regular price">
                        @error('fees')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Discounted Price (₹)</label>
                        <input type="number" wire:model="discounted_fees"
                            class="w-full rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                            placeholder="Enter discounted price">
                        @error('discounted_fees')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Duration (in weeks)</label>
                        <input type="number" wire:model="duration"
                            class="w-full rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                            placeholder="Enter course duration">
                        @error('duration')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Instructor -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instructor Name</label>
                        <input type="text" wire:model="instructor"
                            class="w-full rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                            placeholder="Enter instructor name">
                        @error('instructor')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Course Type Specific Fields -->
                @if($course_type === 'online')
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Online Course Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Meeting Link</label>
                                <input type="url" wire:model="meeting_link"
                                    class="w-full rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                                    placeholder="Enter Zoom/Google Meet link">
                                @error('meeting_link')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Meeting ID (Optional)</label>
                                <input type="text" wire:model="meeting_id"
                                    class="w-full rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                                    placeholder="Enter meeting ID">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Meeting Password (Optional)</label>
                                <input type="text" wire:model="meeting_password"
                                    class="w-full rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                                    placeholder="Enter meeting password">
                            </div>
                        </div>
                    </div>
                @endif

                @if($course_type === 'offline')
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Offline Course Details</h3>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Venue</label>
                            <textarea wire:model="venue" rows="3"
                                class="w-full rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                                placeholder="Enter venue details"></textarea>
                            @error('venue')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @endif

                <!-- Description -->
                <div class="border-t pt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Course Description</label>
                    <textarea wire:model="description" rows="4"
                        class="w-full rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Enter course description"></textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="border-t pt-6 flex justify-end">
                    <button type="submit"
                        class="px-6 py-2.5 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors">
                        Create Course
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
