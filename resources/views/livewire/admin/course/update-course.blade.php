<div class="min-h-screen bg-gray-50 py-6">
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
                    <div class="bg-white   mb-6">
                        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                                <button wire:click="courseEdit"
                                    class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
                                    Edit
                                </button>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-12 gap-8">
                                <!-- Avatar Section -->
                                <div class="col-span-1 sm:col-span-4 md:col-span-3">
                                    <div
                                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 bg-gray-50 shadow-sm">
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
                                                <img src="{{ $previewImage ?? asset('storage/' . $course->course_image) }}"
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
                                                <button wire:click="handleImageUpload" wire:loading.attr="disabled"
                                                    wire:target="handleImageUpload"
                                                    class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors disabled:opacity-50">
                                                    <span wire:loading.remove wire:target="handleImageUpload">Upload</span>
                                                    <span wire:loading wire:target="handleImageUpload">Saving...</span>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Details Section -->
                                <div class="col-span-1 sm:col-span-8 md:col-span-9">
                                    <div class="bg-white rounded-lg shadow-sm p-6">
                                        <!-- Course Title -->
                                        <div class="flex justify-between items-center mb-6">
                                            <h2 class="text-2xl font-bold text-gray-800 capitalize">
                                                {{ $course->title }}
                                            </h2>
                                            <button wire:click="togglePublish"
                                                class="{{ $isPublished ? 'bg-red-50 text-red-600 hover:bg-red-100' : 'bg-green-50 text-green-600 hover:bg-green-100' }} px-4 py-2 rounded-lg transition-colors">
                                                {{ $isPublished ? 'Unpublish' : 'Publish' }}
                                            </button>
                                        </div>
                                        <!-- Instructor -->
                                        <div class="flex items-center gap-2">
                                            <p class="text-gray-600 text-sm mb-6">Instructor:</p>
                                            <p class="text-gray-900 text-sm mb-6">{{ $course->instructor }}</p>
                                        </div>
                                        <!-- Venue -->
                                        <div class="mb-6">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Venue</h3>
                                            <div class="bg-gray-50 rounded-lg p-4 shadow-sm">
                                                <p class="text-gray-600 text-sm">{{ $course->venue }}</p>
                                            </div>
                                        </div>
                                        <!-- Course Information -->
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Course Information</h3>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                                <!-- Left Column -->
                                                <div>
                                                    <div class="flex items-center justify-between mb-4">
                                                        <p class="text-gray-500 text-sm">Course Fees</p>
                                                        <p class="text-gray-800 text-sm font-medium">
                                                            ₹{{ $course->fees }}</p>
                                                    </div>
                                                    <div class="flex items-center justify-between mb-4">
                                                        <p class="text-gray-500 text-sm">Course Code</p>
                                                        <p class="text-gray-800 text-sm font-medium">
                                                            {{ $course->course_code ?? 'N/A' }}
                                                        </p>
                                                    </div>
                                                    <div class="flex items-center justify-between mb-4">
                                                        <p class="text-gray-500 text-sm">Duration</p>
                                                        <p class="text-gray-800 text-sm font-medium">
                                                            {{ $course->duration }} Weeks
                                                        </p>
                                                    </div>
                                                </div>
                                                <!-- Right Column -->
                                                <div>
                                                    <div class="flex items-center justify-between mb-4">
                                                        <p class="text-gray-500 text-sm">Discount Fees</p>
                                                        <p class="text-gray-800 text-sm font-medium">
                                                            ₹{{ $course->discounted_fees ?? 'N/A' }}</p>
                                                    </div>
                                                    <div class="flex items-center justify-between mb-4">
                                                        <p class="text-gray-500 text-sm">Course Type</p>
                                                        <p class="text-gray-800 text-sm font-medium">
                                                            {{ $course->course_type }}
                                                        </p>
                                                    </div>
                                                    <div class="flex items-center justify-between mb-4">
                                                        <p class="text-gray-500 text-sm">Category Type</p>
                                                        <p class="text-gray-800 text-sm font-medium">
                                                            {{ $course->category->cat_title ?? ''}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            @if($showCourseModal)
                                <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 transition-opacity duration-300"
                                    x-data="{ open: true }" x-show="open" x-transition:enter="ease-out duration-300"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    @keydown.escape.window="open = false; $wire.cancelEdit()">

                                    <div class="bg-white rounded-xl shadow-2xl max-w-3xl w-full mx-4 p-6 transform transition-all duration-300"
                                        x-show="open" x-transition:enter="ease-out duration-300"
                                        x-transition:enter-start="scale-95 opacity-0"
                                        x-transition:enter-end="scale-100 opacity-100"
                                        x-transition:leave="ease-in duration-200"
                                        x-transition:leave-start="scale-100 opacity-100"
                                        x-transition:leave-end="scale-95 opacity-0" role="dialog" aria-modal="true"
                                        aria-labelledby="modal-title">

                                        <!-- Modal Header -->
                                        <div class="flex justify-between items-center mb-4">
                                            <h2 id="modal-title" class="text-xl font-semibold text-gray-800">Edit Course
                                            </h2>
                                            <button wire:click="closeModal"
                                                class="text-gray-500 hover:text-gray-700 transition-colors">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-h-[70vh] overflow-y-auto">
                                            @foreach ([['title', 'Course Title'], ['course_code', 'Course Code'], ['instructor', 'Instructor Name'], ['duration', 'Duration (Weeks)'], ['fees', 'Course Fees'], ['discounted_fees', 'Discounted Fees'], ['course_type', 'Course Type'], ['category_id', 'Category']] as [$field, $label])
                                                <div class="space-y-2">
                                                    @if($field === 'course_type')
                                                        <label class="text-sm font-medium text-gray-700">{{ $label }}</label>
                                                        <div class="flex gap-2 mt-2 relative">
                                                            <select wire:model.defer="{{ $field }}" @if($editingField !== $field)
                                                            disabled @endif
                                                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-purple-500 focus:border-purple-500 {{ $editingField !== $field ? 'bg-gray-50' : 'bg-white' }} transition-colors">
                                                                <option value="online">Online Course</option>
                                                                <option value="offline">Offline Course</option>
                                                            </select>
                                                            @if($editingField !== $field)
                                                                <button wire:click="editField('{{ $field }}')"
                                                                    class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
                                                                    Edit
                                                                </button>
                                                            @else
                                                                <div class="flex gap-2">
                                                                    <button wire:click="saveField('{{ $field }}')"
                                                                        wire:loading.attr="disabled" wire:target="saveField"
                                                                        class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors disabled:opacity-50">
                                                                        <span wire:loading.remove wire:target="saveField">Save</span>
                                                                        <span wire:loading wire:target="saveField">Saving...</span>
                                                                    </button>
                                                                    <button wire:click="cancelEdit"
                                                                        class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                                                                        Cancel
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        @error($field)
                                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    @elseif($field === 'category_id')
                                                        <label class="text-sm font-medium text-gray-700">{{ $label }}</label>
                                                        <div class="flex gap-2 mt-2 relative">
                                                            <select wire:model.defer="category_id" @if($editingField !== 'category_id') disabled @endif
                                                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-purple-500 focus:border-purple-500 {{ $editingField !== 'category_id' ? 'bg-gray-50' : 'bg-white' }} transition-colors">
                                                                <option value="">Select Category</option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}">{{ $category->cat_title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @if($editingField !== 'category_id')
                                                                <button wire:click="editField('category_id')"
                                                                    class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
                                                                    Edit
                                                                </button>
                                                            @else
                                                                <div class="flex gap-2">
                                                                    <button wire:click="saveField('category_id')"
                                                                        wire:loading.attr="disabled" wire:target="saveField"
                                                                        class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors disabled:opacity-50">
                                                                        <span wire:loading.remove wire:target="saveField">Save</span>
                                                                        <span wire:loading wire:target="saveField">Saving...</span>
                                                                    </button>
                                                                    <button wire:click="cancelEdit"
                                                                        class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                                                                        Cancel
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        @error('category_id')
                                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    @else
                                                        <label class="text-sm font-medium text-gray-700">{{ $label }}</label>
                                                        <div class="flex gap-2 mt-2 relative">
                                                            <input type="text" wire:model.defer="{{ $field }}" @if($editingField !== $field) readonly @endif
                                                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-1 focus:ring-purple-500 focus:border-purple-500 {{ $editingField !== $field ? 'bg-gray-50' : 'bg-white' }} transition-colors">
                                                            @if($editingField !== $field)
                                                                <button wire:click="editField('{{ $field }}')"
                                                                    class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
                                                                    Edit
                                                                </button>
                                                            @else
                                                                <div class="flex gap-2">
                                                                    <button wire:click="saveField('{{ $field }}')"
                                                                        wire:loading.attr="disabled" wire:target="saveField"
                                                                        class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors disabled:opacity-50">
                                                                        <span wire:loading.remove wire:target="saveField">Save</span>
                                                                        <span wire:loading wire:target="saveField">Saving...</span>
                                                                    </button>
                                                                    <button wire:click="cancelEdit"
                                                                        class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                                                                        Cancel
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
                                </div>
                            @endif
                        </div>
                        <div class="mb-8 mt-2 border-b border-gray-200">
                            <nav class="-mb-px flex flex-col sm:flex-row sm:space-x-8" aria-label="Tabs">
                                @foreach(['addBatch' => 'Add Batch', 'feature' => 'Feature', 'description' => 'Description & Venue', 'assignment' => 'Assignment'] as $tab => $label)
                                                            <button wire:click="setActiveTab('{{ $tab }}')"
                                                                class="whitespace-nowrap py-4 px-1 sm:px-4 border-b-2 font-medium text-sm transition-colors w-full sm:w-auto text-left
                                                                        {{ $activeTab === $tab
                                    ? 'border-blue-500 text-blue-600'
                                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                                                {{ $label }}
                                                            </button>
                                @endforeach
                            </nav>
                        </div>

                        <!-- Description -->
                        @if ($activeTab === 'description')
                            <div class="pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Course Description</h3>
                                <div class="space-y-2">
                                    <textarea wire:model.defer="description" rows="4" @if($editingField !== 'description')
                                    readonly @endif
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-1 focus:ring-purple-500 focus:border-purple-500 
                                                 {{ $editingField !== 'description' ? 'bg-gray-50' : 'bg-white' }}"></textarea>
                                    @if($editingField !== 'description')
                                        <div class="flex justify-end">
                                            <button wire:click="editField('description')"
                                                class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
                                                Edit
                                            </button>
                                        </div>
                                    @else
                                        <div class="flex justify-end gap-2">
                                            <button wire:click="saveField('description')" wire:loading.attr="disabled"
                                                wire:target="saveField"
                                                class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors disabled:opacity-50">
                                                <span wire:loading.remove wire:target="saveField">Save</span>
                                                <span wire:loading wire:target="saveField">Saving...</span>
                                            </button>
                                            <button wire:click="cancelEdit"
                                                class="px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                                                Cancel
                                            </button>
                                        </div>
                                    @endif
                                    @error('description')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <label class="text-sm font-medium text-gray-700">Venue</label>
                            <div class="flex gap-2 mt-2 relative">
                                <textarea wire:model.defer="venue" rows="3" @if($editingField !== 'venue') readonly @endif
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-1 focus:ring-purple-500 focus:border-purple-500 
                                                     {{ $editingField !== 'venue' ? 'bg-gray-50' : 'bg-white' }}"></textarea>
                                @if($editingField !== 'venue')
                                    <button wire:click="editField('venue')"
                                        class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
                                        Edit
                                    </button>
                                @else
                                    <div class="flex gap-2">
                                        <button wire:click="saveField('venue')" wire:loading.attr="disabled"
                                            wire:target="saveField"
                                            class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors disabled:opacity-50">
                                            <span wire:loading.remove wire:target="saveField">Save</span>
                                            <span wire:loading wire:target="saveField">Saving...</span>
                                        </button>
                                        <button wire:click="cancelEdit"
                                            class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                                            Cancel
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <!-- Category and Image -->


                </form>

                <!-- Course Features Section -->
                @if($activeTab === 'feature')
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
                                    <div class="bg-blue-50 border border-blue-300 rounded-lg p-4">
                                        <p class="text-blue-700 font-medium">{{ $feature->name }}</p>
                                    </div>
                                @empty
                                    <p class="text-gray-500">No features assigned yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endif

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
                @if($activeTab === 'addBatch')
                    <div class="border-t pt-6 mt-8">
                        <div class="w-full gap-6">
                            @livewire('admin.course.batch-manager', ['course' => $course])
                        </div>
                    </div>
                @endif
                @if ($activeTab === 'assignment')
                    @livewire('admin.course.course-assignment', ['course_id' => $course->id])
                @endif
            </div>
        </div>
    </div>
</div>