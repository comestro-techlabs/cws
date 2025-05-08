<div>
    <div class="bg-gray-50 min-h-screen pt-6 mt-5 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header and Description -->
            <div class="mb-8 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Manage Products</h1>
                    <p class="text-gray-600 mt-1">Add, edit, and manage your rewards products</p>
                </div>
                <div class="flex space-x-3"> <!-- Added flex container with space-x-3 for buttons -->
                
                <a href="{{ route('v2.admin.manageCategories') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium text-sm hover:bg-blue-700 transition duration-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6m8-6c0-4.418-3.582-8-8-8S4 7.582 4 12s3.582 8 8 8 8-3.582 8-8z" />
                    </svg> 
                    Manage Category
                </a>
               
                <button wire:click="addNewProduct" id="addProductBtn" class="px-4 py-2 bg-purple-700 text-white rounded-lg font-medium text-sm hover:bg-purple-700 transition duration-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add New Product
                </button>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="bg-white rounded-lg shadow-sm mb-8 p-4 sm:p-6">
                <div class="flex flex-col sm:flex-row gap-4 items-center">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                        <input wire:model.live="search" type="text" placeholder="Search products by name..."
                            class="w-full pl-10 pr-4 py-2.5 text-gray-800 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:outline-none transition duration-200">
                    </div>

                    <!-- Category Filter Dropdown -->
                    <div class="w-full sm:w-auto">
                        <select wire:model.live="selectedCategory" class="w-full py-2.5 px-4 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:outline-none transition duration-200">
                            <option value="">All Categories</option>

                            @foreach($categories as $id => $name)
                            <option value="{{ $id }}">{{ ucfirst($name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>



            <!-- Products Table -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Product
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Gems
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stock
                                </th>

                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($products as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <img class="h-10 w-10 rounded-md object-cover" src="{{ $product->imageUrl }}" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                            <div class="text-sm text-gray-500 truncate w-48">{{ $product->description }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        {{ $product->category->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-purple-500 mr-1">
                                            <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-900">{{ $product->points }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button wire:click="toggleStatus({{ $product->id }})"
                                        class="relative px-3 py-1 rounded-full text-sm {{ $product->status =='active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}"
                                        wire:loading.class="opacity-50 cursor-wait"
                                        wire:target="toggleStatus({{ $product->id }})">
                                        <span wire:loading.remove wire:target="toggleStatus({{ $product->id }})">
                                            {{ $product->status =='active' ? 'Active' : 'Inactive' }}
                                        </span>
                                        <span wire:loading wire:target="toggleStatus({{ $product->id }})" class="flex items-center">
                                            Updating...
                                        </span>
                                    </button>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $product->availableQuantity ?? 'Unlimited' }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <button wire:click="editProduct({{ $product->id }})" class="text-blue-600 hover:text-blue-900 transition duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </button>
                                        <button wire:click="confirmDelete({{ $product->id }})" class="text-red-600 hover:text-red-900 transition duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>


            </div>
        </div>

        <!-- Add/Edit Product Modal -->
        @if($isModalOpen)
        <div id="productModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 ">
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full mx-4">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Add New Product</h3>
                </div>

                <div class="p-6">
                    <form wire:submit.prevent="saveProduct">
                        <div class="space-y-6">
                            <!-- Product Image -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
                                <div class="flex items-center">
                                    <!-- Image Preview Section -->
                                    <div class="h-24 w-24 rounded-md border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden bg-gray-50">
                                         
                                        @if ($product_image)
                                        <!-- Show Existing Image -->
                                            @if(is_string($product_image))
                                                <img src="{{ $product_image }}" class="h-full w-full object-cover" />
                                            @else
                                                <img src="{{ $product_image->temporaryUrl() }}" class="h-full w-full object-cover" />
                                            @endif                                      
                                        @else
                                        <!-- Placeholder Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                        @endif
                                    </div>

                                    <!-- Image Upload Input -->
                                    <div class="ml-4">
                                        <label for="image-upload" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200 text-sm cursor-pointer inline-block">
                                            Choose File
                                        </label>
                                        <input id="image-upload" wire:model="product_image" type="file" class="hidden" accept="image/*" />
                                        <p class="text-xs text-gray-500 mt-1">PNG, JPG up to 2MB</p>

                                        @error('product_image')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Product Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                                    <input type="text" id="name" wire:model="product_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200">
                                    @error('product_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- Product Description -->
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea id="description" wire:model="product_description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"></textarea>
                                    @error('product.description') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- Category and Gems -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                        <select id="category" wire:model="product_category_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $id => $name)
                                            <option value="{{ $id }}">{{ ucfirst($name) }}</option>
                                            @endforeach
                                        </select>
                                        @error('product_category_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Status and Stock -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">


                                    <div>
                                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                                        <input type="number" id="stock" wire:model="product_stock" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200">
                                        @error('product_stock') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label for="gems" class="block text-sm font-medium text-gray-700 mb-1">Gems</label>
                                        <input type="number" id="gems" wire:model="product_gems" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200">
                                        @error('product_gems') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                            </div>
                    </form>
                </div>

                <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3 rounded-b-lg">
                    <button wire:click="closeModalBtn" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                        Cancel
                    </button>
                    <button wire:click="saveProduct" class="px-4 py-2  text-white rounded-lg bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                        Save Product
                    </button>
                </div>
            </div>
        </div>
        @endif

        <!-- Delete Confirmation Modal -->
        @if($deleteModalOpen)
        <div id="deleteModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 ">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 p-6">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto text-red-500 mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Confirm</h3>
                    <p class="text-gray-600 max-w-md mx-auto">Are you sure you want to delete this product?</p>

                    <div class="flex justify-center space-x-4 mt-4">
                        <button wire:click="closeModalBtn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg font-medium text-sm hover:bg-gray-300 transition duration-200">
                            Cancel
                        </button>
                        <button wire:click="deleteProduct" class="px-4 py-2 bg-red-500 text-white rounded-lg font-medium text-sm hover:bg-red-600 transition duration-200">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif