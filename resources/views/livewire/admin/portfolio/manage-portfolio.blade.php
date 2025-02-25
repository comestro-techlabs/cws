<div>
    @if($isEditing)
    <div class="max-w-5xl mx-auto mt-8">
        <h2 class="text-xl font-semibold text-slate-500 border-s-4 border-s-orange-400 pl-3 mb-5">
           Edit Portfolio
        </h2>

        <form wire:submit="save" class="space-y-4 mb-8">
            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" wire:model="title" class="mt-1 block w-full rounded-md border-gray-300">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">URL</label>
                <input type="url" wire:model="url" class="mt-1 block w-full rounded-md border-gray-300">
                @error('url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Image</label>
                 @if($isEditing && $existingImage)
                    <div class="mb-2">
                        <p class="text-sm text-gray-600">Current Image:</p>
                        <img src="{{ Storage::url($existingImage) }}" alt="Current image" class="w-32 h-32 object-cover rounded-md">
                    </div>
                @endif
                @if($image)
                    <div class="mb-2">
                        <p class="text-sm text-gray-600">Preview:</p>
                        <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-32 h-32 object-cover rounded-md">
                    </div>
                @endif
                <input type="file" wire:model="image" accept="image/*" class="mt-1 block w-full">
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea wire:model="description" class="mt-1 block w-full rounded-md border-gray-300"></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    {{ $isEditing ? 'Update' : 'Save' }}
                </button>
                @if($isEditing)
                    <button type="button" wire:click="resetForm" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Cancel
                    </button>
                @endif
            </div>

            @if(session('message'))
                <div class="text-green-600 mt-2">{{ session('message') }}</div>
            @endif
        </form>
    </div>
    @endif

    <!-- Portfolio List Section -->
    <div class="max-w-5xl mx-auto">
        <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-orange-400 pl-3 mb-5"> Manage Portfolio</h2>

        @if($portfolios->isEmpty())
            <p class="text-gray-800">No portfolios found.</p>
        @else
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Image</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Link</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($portfolios as $portfolio)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $portfolio->title }}</td>
                                 <td class="border border-gray-300 px-4 py-2">
                                    <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-20 h-20 object-cover rounded-md">
                                </td> 
                              
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ $portfolio->url }}" target="_blank" class="text-indigo-600 hover:underline">View Portfolio</a>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">{{ $portfolio->description }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex flex-wrap gap-2">
                                        <button 
                                            wire:click="edit({{ $portfolio->id }})"
                                            class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                            Edit
                                        </button>
                                        <button 
                                            wire:click="delete({{ $portfolio->id }})" 
                                            wire:confirm="Are you sure you want to delete this portfolio?"
                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>