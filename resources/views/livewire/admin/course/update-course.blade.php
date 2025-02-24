<div>
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-md">
        @if (session()->has('message'))
            <div class="p-2 mb-4 text-green-600 bg-green-100 rounded-md">
                {{ session('message') }}
            </div>
        @endif
    
        <form wire:submit.prevent>
            @foreach (['title', 'description', 'duration', 'instructor', 'fees', 'discounted_fees'] as $field)
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
                    <label class="block font-semibold">Course Image</label>
                    <input type="file" wire:model="tempImage" class="w-full p-2 border rounded">
                    @error('tempImage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        
                    {{-- Image Preview --}}
                    <div class="mt-2">
                        @if ($tempImage)
                        <img src="{{ $tempImage->temporaryUrl() }}" class="w-32 h-32 object-cover mt-2" alt="Preview">
                        @elseif ($course->course_image)
                            <img src="{{ asset('storage/' . $course->course_image) }}" class="w-32 h-32 object-cover rounded">
                        @endif
                    </div>
        
                    <button wire:click="saveField('tempImage')" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">Update Image</button>
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
    
</div>
