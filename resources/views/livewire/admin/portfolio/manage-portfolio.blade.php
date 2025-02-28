<div>
    @if($isEditing)
    <div class="container max-w-5xl mx-auto mt-8 px-4 sm:px-6 lg:px-8">
        <h2 class="text-xl md:text-2xl font-semibold text-slate-600 border-l-4 border-orange-400 pl-4 mb-8">
            Edit Portfolio
        </h2>

        <form wire:submit="save" class="space-y-6 mb-10">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input 
                    type="text" 
                    wire:model="title" 
                    class="mt-1 block w-full rounded-lg border-2 border-gray-300 p-2 sm:text-sm ">
                @error('title') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                <input 
                    type="url" 
                    wire:model="url" 
                    class="mt-1 block w-full rounded-lg border-2 border-gray-300  p-2 sm:text-sm">
                @error('url') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                @if($isEditing && $existingImage)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600">Current Image:</p>
                        <img src="{{ Storage::url($existingImage) }}" alt="Current image" class="w-32 h-32 sm:w-40 sm:h-40 object-cover rounded-lg mt-2 border border-gray-200">
                    </div>
                @endif
                @if($image)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600">Preview:</p>
                        <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-32 h-32 sm:w-40 sm:h-40 object-cover rounded-lg mt-2 border border-gray-200">
                    </div>
                @endif
                <input 
                    type="file" 
                    wire:model="image" 
                    accept="image/*" 
                    class="mt-1 block w-full text-sm text-gray-600 ">
                @error('image') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea 
                    wire:model="description" 
                    class="mt-1 block w-full rounded-lg border-2 border-gray-300 p-2 sm:text-sm h-28 resize-y"></textarea>
                @error('description') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-wrap gap-3">
                <button 
                    type="submit" 
                    class="px-5 py-2.5 bg-blue-500 text-white rounded-lg hover:bg-orange-600 transition-all duration-200 font-medium shadow-md">
                    {{ $isEditing ? 'Update' : 'Save' }}
                </button>
                @if($isEditing)
                    <button 
                        type="button" 
                        wire:click="resetForm" 
                        class="px-5 py-2.5 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all duration-200 font-medium shadow-md">
                        Cancel
                    </button>
                @endif
            </div>

            @if(session('message'))
                <div class="text-green-600 mt-4 font-medium">{{ session('message') }}</div>
            @endif
        </form>
    </div>
@endif
   
    <!-- Portfolio List Section -->
    <div class="max-w-5xl mx-auto">
        <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-orange-400 pl-3 mb-5 mt-7"> Manage Portfolio</h2>

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