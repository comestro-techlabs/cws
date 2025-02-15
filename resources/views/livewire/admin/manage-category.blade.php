<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="w-full  max-w-md mx-auto px-4 mt-4">
        <div class="bg-slate-100 rounded  p-4 sm:p-6">
            <form wire:submit.prevent='store'>
                <div class="mb-3 flex flex-col gap-2">
                    <label for="" class="text-base sm:text-lg">Category title</label>
                    <input type="text" wire:model="cat_title" id="cat_title" class="border w-full px-3 py-2 rounded">
                    @error('cat_title')
                        <p class="text-xs text-red-600">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3 flex flex-col gap-2">
                    <label for="" class="text-base sm:text-lg">Category description</label>
                    <textarea rows="5" wire:model="cat_description" id="cat_description" class="border w-full px-3 py-2 rounded"></textarea>
                    @error('cat_description')
                        <p class="text-xs text-red-600">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3 flex justify-center items-center">
                    <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold w-full px-8 py-2 rounded">Create</button>
                </div>
            </form>
        </div>
    </div>
            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8">
                    <div class="flex gap-3 flex-col md:flex-row justify-between md:items-center">
                        <h2 class="md:text-xl text-lg font-semibold  text-slate-500 border-s-4 border-s-purple-800 pl-3">Manage Categories</h2>
                    </div>
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
                                            <button wire:click="destroy({{ $category->id }})" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded">Delete</button>
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
