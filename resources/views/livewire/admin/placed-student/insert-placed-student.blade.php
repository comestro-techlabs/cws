<div> <!-- Single Root Wrapper -->
    <div class="py-10 min-h-screen">
        <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">
                {{ $placedStudent ? 'Edit Placed Student' : 'Create New Placed Student' }}
            </h2>

            <form wire:submit.prevent="save" class="space-y-4">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" wire:model="name" id="name" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea wire:model="content" id="content" rows="4"
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                    @error('content') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Position -->
                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                    <input type="text" wire:model="position" id="position"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    @error('position') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" wire:model="image"
                           class="mt-1 block w-full text-gray-900 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror

                    <div class="mt-4">
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="max-w-[150px] h-auto rounded-md shadow-md">
                        @elseif ($image)
                            <img src="{{ asset('storage/' . $image) }}" class="max-w-[150px] h-auto rounded-md shadow-md">
                        @endif
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        {{ $placedStudent ? 'Update' : 'Submit' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> <!-- End of Single Root Wrapper -->
