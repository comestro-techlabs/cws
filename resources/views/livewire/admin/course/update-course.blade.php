<div>
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-md">
        {{-- Back Button --}}
        <div class="mb-4 flex justify-between items-center">
            <a href="{{ route('admin.course.manage') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Back to Courses
            </a>
        </div>

        @if (session()->has('message'))
            <div class="p-2 mb-4 text-green-600 bg-green-100 rounded-md">
                {{ session('message') }}
            </div>
        @endif
    
        <form wire:submit.prevent>
            @foreach (['title', 'description', 'duration', 'instructor', 'fees', 'discounted_fees','course_code'] as $field)
                <div class="mb-4">
                    <label class="block font-semibold">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                    <input type="text" wire:model.defer="{{ $field }}" class="w-full p-2 border rounded">
                    @error($field) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    <button wire:click="saveField('{{ $field }}')" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                </div>
            @endforeach
                
            <div class="mb-4">
                <label class="block font-semibold">Category</label>
                <select wire:model.defer="category_id" class="w-full p-2 border rounded">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->cat_title }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                <button wire:click="saveField('category_id')" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">Save</button>
            </div>
            
            {{-- Course Image Upload --}}
            <div class="mb-4">
                <label>Course Image:</label>
        
                {{-- Show Preview --}}
                @if ($previewImage)
                    <img src="{{ $previewImage }}" class="img-preview" alt="Preview" width="150">
                @elseif ($course->course_image)
                    <img src="{{ asset('storage/' . $course->course_image) }}" class="img-preview" alt="Course Image" width="150">
                @endif
        
                {{-- Upload Field --}}
                <input type="file" wire:model="tempImage">
                @error('tempImage') <span class="text-danger">{{ $message }}</span> @enderror
        
                {{-- Buttons --}}
                <button wire:click="saveField('tempImage')" class="btn btn-primary">Upload</button>
        
                @if ($course->course_image)
                    <button wire:click="deleteImage" class="btn btn-danger">Remove</button>
                @endif
            </div>
    
            {{-- Publish / Unpublish Button --}}
            <div class="mt-4">
                @if ($isPublished)
                    <button wire:click="togglePublish" class="px-4 py-2 bg-red-600 text-white rounded">Unpublish</button>
                @else
                    <button wire:click="togglePublish" class="px-4 py-2 bg-green-600 text-white rounded">Publish</button>
                @endif
            </div>
        </form>
    </div>
    <div class="form-group mt-4">
        <h4>Course Features</h4>
        <form wire:submit.prevent="updateFeatures">
            @foreach($allFeatures as $feature)
                <div class="form-check">
                    <input 
                        type="checkbox"
                        class="form-check-input"
                        wire:model="selectedFeatures"
                        value="{{ $feature->id }}"
                        id="feature-{{ $feature->id }}"
                    >
                    <label class="form-check-label" for="feature-{{ $feature->id }}">
                        {{ $feature->name }}
                    </label>
                </div>
            @endforeach
            @error('selectedFeatures') <span class="text-danger">{{ $message }}</span> @enderror
            <button 
                type="submit" 
                class="btn btn-primary mt-2"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove>Update Features</span>
                <span wire:loading>Updating...</span>
            </button>
        </form>

        <div class="mt-3">
            <h5>Current Features:</h5>
            <ul>
                @foreach($course->features as $feature)
                    <li>{{ $feature->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- Course Content Management -->
    <div class="mt-8 max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">Manage Course Content</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @livewire('admin.course.batch-manager', ['course' => $course])
            @livewire('admin.course.chapter-manager', ['course' => $course])
            
        </div>
    </div>
</div>