<div class="max-w-7xl mx-auto p-6 bg-white  rounded-lg">
    <div class="flex flex-wrap justify-between items-center p-4">
        <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 mb-5">
            Update Course
        </h2>

        <a href="{{ route('admin.course.manage') }}" wire:navigate
           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Back to Courses
        </a>

    </div>

    <form wire:submit.prevent class="space-y-6">
        <!-- Form Fields Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach (['title', 'duration', 'instructor', 'fees', 'discounted_fees', 'course_code'] as $field)
                <div class="space-y-2">
                    <label class="block font-semibold text-gray-700">
                        {{ ucfirst(str_replace('_', ' ', $field)) }}
                    </label>
                    <input type="text" 
                           wire:model.defer="{{ $field }}" 
                           class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error($field) 
                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                    @enderror
                    <button wire:click="saveField('{{ $field }}')" 
                            class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Save
                    </button>
                </div>
            @endforeach

            <!-- Description (Full Width) -->
            <div class="space-y-2 md:col-span-2">
                <label class="block font-semibold text-gray-700">Description</label>
                <input type="text" 
                       wire:model.defer="description" 
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('description') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
                <button wire:click="saveField('description')" 
                        class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Save
                </button>
            </div>

            <!-- Category and Image Row -->
            <div class="space-y-2">
                <label class="block font-semibold text-gray-700">Category</label>
                <select wire:model.defer="category_id" 
                        class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->cat_title }}</option>
                    @endforeach
                </select>
                @error('category_id') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
                <button wire:click="saveField('category_id')" 
                        class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Save
                </button>
            </div>

            <!-- Redesigned Course Image Upload -->
            <div class="space-y-2">
                <label class="block font-semibold text-gray-700">Course Image</label>
                <div class="relative">
                    <div class="mb-4 flex items-center justify-center bg-gray-100 rounded-lg p-4 h-40 w-full border border-dashed border-gray-300">
                        @if ($previewImage)
                            <img src="{{ $previewImage }}" class="max-h-full max-w-full object-contain rounded-lg" alt="Preview">
                        @elseif ($course->course_image)
                            <img src="{{ asset('storage/' . $course->course_image) }}" class="max-h-full max-w-full object-contain rounded-lg" alt="Course Image">
                        @else
                            <span class="text-gray-500 text-sm">No image uploaded</span>
                        @endif
                    </div>
                    <div class="relative">
                        <input type="file" 
                               wire:model="tempImage" 
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <button class="w-full px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                            Choose File
                        </button>
                    </div>
                    @error('tempImage') 
                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                    @enderror
                </div>
                <div class="flex space-x-4">
                    <button wire:click="saveField('tempImage')" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Upload
                    </button>
                    @if ($course->course_image)
                        <button wire:click="deleteImage" 
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Remove
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Publish/Unpublish Button -->
        <div class="mt-6">
            @if ($isPublished)
                <button wire:click="togglePublish" 
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Unpublish
                </button>
            @else
                <button wire:click="togglePublish" 
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    Publish
                </button>
            @endif
        </div>
    </form>

    <!-- Course Features Section -->
    <div class="mt-8 space-y-4">
        <h4 class="text-xl font-bold text-gray-800">Course Features</h4>
        <button wire:click="openFeaturesModal" 
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            Edit Features
        </button>
        <div class="mt-4">
            <h5 class="text-lg font-semibold text-gray-800">Current Features:</h5>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                @forelse($course->features as $feature)
                    <div class="bg-blue-50 border border-blue-300 rounded-lg p-4 ">
                        <p class="text-blue-700 font-medium">{{ $feature->name }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">No features assigned yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Features Modal -->
    <div wire:ignore.self 
         class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50"
         x-data="{ show: @entangle('showFeaturesModal') }"
         x-show="show"
         x-cloak>
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Select Course Features</h3>
            <form wire:submit.prevent="updateFeatures" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 max-h-64 overflow-y-auto">
                    @foreach($allFeatures as $feature)
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       wire:model="selectedFeatures" 
                                       value="{{ $feature->id }}" 
                                       id="feature-{{ $feature->id }}" 
                                       class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="feature-{{ $feature->id }}" class="ml-2 text-gray-700 font-medium">
                                    {{ $feature->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('selectedFeatures') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
                <div class="flex justify-end space-x-4">
                    <button type="button" 
                            wire:click="closeFeaturesModal" 
                            class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                            wire:loading.attr="disabled">
                        <span wire:loading.remove>Save Features</span>
                        <span wire:loading>Saving...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Course Content Management -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Manage Course Content</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @livewire('admin.course.batch-manager', ['course' => $course])
            @livewire('admin.course.chapter-manager', ['course' => $course])
        </div>
    </div>
</div>