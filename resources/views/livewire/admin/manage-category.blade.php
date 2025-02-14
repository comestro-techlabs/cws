<div>
    {{-- The Master doesn't talk, he acts. --}}
    
            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8">
                    <h2 class="text-2xl font-semibold leading-tight">Manage Categories</h2>
        
                    <!-- Flash Messages -->
                    @if (session()->has('message'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('message') }}</span>
                        </div>
                    @endif
        
                    <!-- Create Category Form -->
                    
                    <form wire:submit.prevent='store' class="bg-white mb-2">
                        <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                            <input type="text" wire:model="cat_title" id="cat_title" placeholder="Category Title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('cat_title')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                            <input type="text" wire:model="cat_description" id="cat_description" placeholder="Category Description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('cat_description')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Create</button>
                        </div>
                    </form>
                   <!-- Categories Table -->
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $category->cat_title }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $category->cat_description }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <button wire:click="destroy({{ $category->id }})" class="text-red-600 hover:text-red-900">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-5 py-5 bg-gray-50 border-t flex flex-col xs:flex-row items-center xs:justify-between">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
    

                </div>
            </div>
        
    
</div>
