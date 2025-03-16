<div class="min-h-screen bg-gray-50 py-6">
    <!-- Add loader component -->
    <x-loader />
    
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-lg shadow-sm">
            <!-- Header -->
            <div class="border-b border-gray-200">
                <div class="px-6 py-4 flex flex-wrap justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">
                        Update Course
                    </h2>
                    <a href="{{ route('admin.course.manage') }}" wire:navigate
                        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Courses
                    </a>
                </div>
            </div>

            <div class="p-6">
                <form wire:submit.prevent class="space-y-8">
                    <!-- Basic Information -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ([
                            ['title', 'Course Title'],
                            ['course_code', 'Course Code'],
                            ['instructor', 'Instructor Name'],
                            ['duration', 'Duration (Weeks)'],
                            ['fees', 'Course Fees'],
                            ['discounted_fees', 'Discounted Fees'],
                            ['course_type', 'Course Type']
                            ] as [$field, $label])
                            <div class="space-y-2">
                                @if($field === 'course_type')
                                <label class="text-sm font-medium text-gray-700">{{ $label }}</label>
                                <div class="flex gap-2 mt-2 relative">
                                    <select wire:model.defer="{{ $field }}"
                                        @if($editingField !== $field) 
                                            disabled 
                                            wire:click="editField('{{ $field }}')"
                                            wire:keydown.prevent
                                        @endif
                                        class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-purple-500 focus:border-purple-500 
                                            {{ $editingField !== $field ? 'cursor-pointer bg-gray-50' : 'bg-white' }}">
                                        <option value="online">Online Course</option>
                                        <option value="offline">Offline Course</option>
                                    </select>
                                    <button wire:click="saveField('{{ $field }}')"
                                        wire:loading.attr="disabled"
                                        wire:target="saveField"
                                        class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors disabled:opacity-50">
                                        <span wire:loading.remove wire:target="saveField">{{ $editingField === $field ? 'Save' : 'Edit' }}</span>
                                        <span wire:loading wire:target="saveField">Saving...</span>
                                    </button>
                                </div>
                                @else
                                <label class="text-sm font-medium text-gray-700">{{ $label }}</label>
                                <div class="relative group">
                                    <input type="text" 
                                        wire:model.defer="{{ $field }}"
                                        @if($editingField !== $field) 
                                            readonly 
                                            wire:click="editField('{{ $field }}')"
                                            wire:keydown.prevent
                                        @endif
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-1 focus:ring-purple-500 focus:border-purple-500 
                                            {{ $editingField !== $field ? 'cursor-pointer bg-gray-50' : 'bg-white' }}"
                                    >
                                    @if($editingField === $field)
                                        <div class="absolute right-2 top-1/2 -translate-y-1/2 flex items-center gap-1">
                                            <button type="button" wire:click="saveField('{{ $field }}')"
                                                class="p-1 text-green-600 hover:text-green-700">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button type="button" wire:click="cancelEdit"
                                                class="p-1 text-red-600 hover:text-red-700">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                @error($field)
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Online Course Details -->
                    @if($course->course_type === 'online')
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Online Course Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ([
                            ['meeting_link', 'Meeting Link'],
                            ['meeting_id', 'Meeting ID'],
                            ['meeting_password', 'Meeting Password']
                            ] as [$field, $label])
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-700">{{ $label }}</label>
                                <div class="flex gap-2 mt-2 relative">
                                    <input type="text" wire:model.defer="{{ $field }}"
                                        @if($editingField !== $field) 
                                            readonly 
                                            wire:click="editField('{{ $field }}')"
                                            wire:keydown.prevent
                                        @endif
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-1 focus:ring-purple-500 focus:border-purple-500 
                                            {{ $editingField !== $field ? 'cursor-pointer bg-gray-50' : 'bg-white' }}">
                                    <button wire:click="saveField('{{ $field }}')"
                                        wire:loading.attr="disabled"
                                        wire:target="saveField"
                                        class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors disabled:opacity-50">
                                        <span wire:loading.remove wire:target="saveField">{{ $editingField === $field ? 'Save' : 'Edit' }}</span>
                                        <span wire:loading wire:target="saveField">Saving...</span>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Offline Course Details -->
                    @if($course->course_type === 'offline')
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Offline Course Details</h3>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Venue</label>
                            <div class="flex gap-2 mt-2 relative">
                                <textarea wire:model.defer="venue" rows="3"
                                    @if($editingField !== 'venue') 
                                        readonly 
                                        wire:click="editField('venue')"
                                        wire:keydown.prevent
                                    @endif
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-1 focus:ring-purple-500 focus:border-purple-500 
                                        {{ $editingField !== $field ? 'cursor-pointer bg-gray-50' : 'bg-white' }}"></textarea>
                                <button wire:click="saveField('venue')"
                                    wire:loading.attr="disabled"
                                    wire:target="saveField"
                                    class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors disabled:opacity-50">
                                    <span wire:loading.remove wire:target="saveField">{{ $editingField === 'venue' ? 'Save' : 'Edit' }}</span>
                                    <span wire:loading wire:target="saveField">Saving...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Description -->
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Course Description</h3>
                        <div class="space-y-2">
                            <textarea wire:model.defer="description" rows="4"
                                @if($editingField !== 'description') 
                                    readonly 
                                    wire:click="editField('description')"
                                    wire:keydown.prevent
                                @endif
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-1 focus:ring-purple-500 focus:border-purple-500 
                                    {{ $editingField !== 'description' ? 'cursor-pointer bg-gray-50' : 'bg-white' }}"></textarea>
                            <div class="flex justify-end">
                                <button wire:click="saveField('description')"
                                    wire:loading.attr="disabled"
                                    wire:target="saveField"
                                    class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors p-2 disabled:opacity-50">
                                    <span wire:loading.remove wire:target="saveField">{{ $course->$field ? 'Edit Description' : 'Save Description' }}</span>
                                    <span wire:loading wire:target="saveField">Saving...</span>
                                </button>
                            </div>
                            @error('description')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Category and Image -->
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Category & Image</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Category Selection -->
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-700 ">Category</label>
                                <div class="flex gap-2 mt-2">
                                    <select wire:model.defer="category_id"
                                        @if($editingField !== 'category_id') 
                                            disabled 
                                            wire:click="editField('category_id')"
                                            wire:keydown.prevent
                                        @endif
                                        class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-purple-500 focus:border-purple-500 
                                            {{ $editingField !== 'category_id' ? 'cursor-pointer bg-gray-50' : 'bg-white' }}">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->cat_title }}</option>
                                        @endforeach
                                    </select>
                                    <button wire:click="saveField('category_id')"
                                        wire:loading.attr="disabled"
                                        wire:target="saveField"
                                        class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors disabled:opacity-50">
                                        <span wire:loading.remove wire:target="saveField">{{ $category_id ? 'Edit' : 'Save' }}</span>
                                        <span wire:loading wire:target="saveField">Saving...</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div class="space-y-4">
                                <label class="text-sm font-medium text-gray-700">Course Image</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 mt-2">
                                    <!-- Progress Bar -->
                                    <div wire:loading wire:target="tempImage" class="mb-4">
                                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-blue-500 rounded-full transition-all duration-300"
                                                style="width: {{ $progress }}%"></div>
                                        </div>
                                        <p class="text-sm text-gray-600 text-center mt-2">
                                            Uploading... {{ $progress }}%
                                        </p>
                                    </div>

                                    <div class="flex items-center justify-center h-32">
                                        @if ($previewImage || $course->course_image)
                                        <!-- <img src="{{ $previewImage ?? asset('storage/' . $course->course_image) }}"
                                                class="max-h-full object-contain rounded"
                                                alt="Course preview"> -->
                                        <img src="{{ $previewImage ?? asset('storage/course_images/' . $course->course_image) }}"
                                            class="max-h-full object-contain rounded" alt="Course preview">


                                        @else
                                        <span class="text-gray-500">No image selected</span>
                                        @endif
                                    </div>
                                    <div class="mt-4 flex gap-2">
                                        <input type="file" wire:model="tempImage" class="hidden" id="image-upload">
                                        <label for="image-upload"
                                            class="flex-1 text-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 cursor-pointer transition-colors">
                                            Choose File
                                        </label>
                                        @if ($tempImage)
                                        <button wire:click="saveField('tempImage')"
                                            wire:loading.attr="disabled"
                                            wire:target="saveField"
                                            class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors disabled:opacity-50">
                                            <span wire:loading.remove wire:target="saveField">Upload</span>
                                            <span wire:loading wire:target="saveField">Saving...</span>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Publishing Status -->
                    <div class="border-t pt-6">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Publishing Status</h3>
                            <button wire:click="togglePublish"
                                class="{{ $isPublished ? 'bg-red-50 text-red-600 hover:bg-red-100' : 'bg-green-50 text-green-600 hover:bg-green-100' }} px-4 py-2 rounded-lg transition-colors">
                                {{ $isPublished ? 'Unpublish' : 'Publish' }}
                            </button>
                        </div>
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
                    x-data="{ show: @entangle('showFeaturesModal') }" x-show="show" x-cloak>
                    <div class="bg-white rounded-lg p-6 w-full max-w-2xl">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Select Course Features</h3>
                        <form wire:submit.prevent="updateFeatures" class="space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 max-h-64 overflow-y-auto">
                                @foreach($allFeatures as $feature)
                                <div
                                    class="bg-gray-50 border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-center">
                                        <input type="checkbox" wire:model="selectedFeatures" value="{{ $feature->id }}"
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
                                <button type="button" wire:click="closeFeaturesModal"
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
                <div class="border-t pt-6 mt-8 ">
                    <div class="w-full gap-6">
                        @livewire('admin.course.batch-manager', ['course' => $course])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
