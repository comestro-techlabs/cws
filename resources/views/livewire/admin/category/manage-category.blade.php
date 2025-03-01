<<<<<<< HEAD
<div class="container mx-auto px-4 sm:px-8 py-8 bg-gray-100">
    <div class="flex flex-col md:flex-row gap-8">
        <div class="w-full lg:w-1/3 mb-8 lg:mb-0">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Create New Category</h2>
                <form wire:submit.prevent='store'>
                    <div class="mb-4">
                        <label for="cat_title" class="block text-sm font-medium text-gray-700">Category Title</label>
                        <input type="text" wire:model="cat_title" id="cat_title" class="mt-1 block w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2">
                        @error('cat_title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="cat_description" class="block text-sm font-medium text-gray-700">Category Description</label>
                        <textarea rows="4" wire:model="cat_description" id="cat_description" class="mt-1 block w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2"></textarea>
                        @error('cat_description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="w-full lg:w-2/3">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-700">Manage Categories</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($categories as $category)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->cat_title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->cat_description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button wire:click="destroy({{ $category->id }})" class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Delete
                                        </button>
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
=======
<div>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="flex gap-3 flex-col md:flex-row justify-between md:items-center mb-6">
                <h3 class="text-lg font-semibold text-slate-800">Manage Categories</h3>
                <div class="flex gap-3 items-center">
                    {{-- <input
                        type="text"
                        wire:model.live.debounce.500ms="search"
                        placeholder="Search categories..."
                        class="border rounded px-3 py-2 w-full md:w-64"
                    > --}}
                    <button
                        wire:click="openModal"
                        class="bg-gray-800 hover:bg-purple-700 text-white font-bold px-4 py-2 rounded"
                    >
                        Add Category
                    </button>
                </div>
            </div>


            <div class="relative">
                 <!-- Categories Table -->
            <div class=" px-12 relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border {{ $isModalOpen ? 'blur-sm' : '' }}">
                <table class="w-full text-left table-auto min-w-max">
                    <thead>
                    <tr>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                        <p class="text-sm font-normal leading-none text-slate-500">
                            ID
                        </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                        <p class="text-sm font-normal leading-none text-slate-500">
                            Title
                        </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                        <p class="text-sm font-normal leading-none text-slate-500">Description</p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                        <p class="text-sm font-normal leading-none text-slate-500">
                            Action
                        </p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                      @forelse($categories as $category)
                    <tr class="hover:bg-slate-50 border-b border-slate-200">
                        <td class="p-4 py-5">
                        <p class="block font-semibold text-sm text-slate-800">{{ $loop->iteration }}</p>
                        </td>
                        <td class="p-4 py-5">
                        <p class="text-sm text-slate-500">{{ $category->cat_title }}</p>
                        </td>
                        <td class="p-4 py-5">
                        <p class="text-sm text-slate-500">{{ $category->cat_description }}</p>
                        </td>
                        <td class="p-4 py-5">
                         <button wire:click="destroy({{ $category->id }})" wire:confirm="Are you sure you want to delete this category?"
                         class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded">Delete</button>
                        </td>

                    </tr>
                    @empty
                     <tr>
                         <td colspan="4" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                             <p class="text-gray-900">No categories found</p>
                         </td>
                     </tr>
                 @endforelse

                    </tbody>
                </table>
                <div class="flex justify-between items-center px-4 py-3">
                    <div class="text-sm text-slate-500">
                        Showing
                        <b>{{ $categories->firstItem() }}-{{ $categories->lastItem() }}</b>
                        of {{ $categories->total() }}
                    </div>

                    <div class="flex space-x-1">
                        <button
                            wire:click="previousPage"
                            wire:loading.attr="disabled"
                            class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease {{ $categories->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}"
                        >
                            Prev
                        </button>
                        @foreach($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                            <button
                                wire:click="gotoPage({{ $page }})"
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal {{ $categories->currentPage() === $page ? 'text-white bg-slate-800 border-slate-800 hover:bg-slate-600 hover:border-slate-600' : 'text-slate-500 bg-white border-slate-200 hover:bg-slate-50 hover:border-slate-400' }} border rounded transition duration-200 ease"
                            >
                                {{ $page }}
                            </button>
                        @endforeach
                        <button
                            wire:click="nextPage"
                            wire:loading.attr="disabled"
                            class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease {{ $categories->onLastPage() ? 'opacity-50 cursor-not-allowed' : '' }}"
                        >
                            Next
                        </button>
                    </div>
                </div>
                </div>

                <!-- Modal -->
                @if($isModalOpen)
                    <div class="fixed inset-0 bg-gray-800 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center z-50">
                        <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold">Add New Category</h3>
                                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                                    ✕
                                </button>
                            </div>
                            <form wire:submit="store">
                                <div class="mb-3 flex flex-col gap-2">
                                    <label for="cat_title" class="text-base">Category title</label>
                                    <input
                                        type="text"
                                        wire:model="cat_title"
                                        id="cat_title"
                                        class="border border-gray-300 w-full px-3 py-2 rounded"
                                    >
                                    @error('cat_title')
                                        <p class="text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 flex flex-col gap-2">
                                    <label for="cat_description" class="text-base ">Category description</label>
                                    <textarea
                                        rows="5"
                                        wire:model="cat_description"
                                        id="cat_description"
                                        class="border border-gray-300 w-full px-3 py-2 rounded"
                                    ></textarea>
                                    @error('cat_description')
                                        <p class="text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex justify-end gap-2">
                                    <button
                                        type="button"
                                        wire:click="closeModal"
                                        class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded"
                                    >
                                        Cancel
                                    </button>
                                    <button
                                        type="submit"
                                        class="bg-gray-900 hover:bg-gray-700 text-white px-4 py-2 rounded"
                                    >
                                        Create
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
>>>>>>> fe0b633ecfaddd452667714bea840c78e5f2d435
