<div class="bg-gray-50 min-h-screen pt-6 mt-5 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header and Description -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Redeem Your Gems</h1>
            <p class="text-gray-600 mt-1">Exchange your hard-earned gems for these exclusive rewards</p>
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
                    <input wire:model.live="search" type="text" placeholder="Search for products..." 
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

                <button wire:loading.attr="disabled" class="px-6 py-2.5 bg-primary text-white rounded-lg hover:bg-primary focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200 whitespace-nowrap">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <span>Search</span>
                    </div>
                </button>
            </div>
        </div>

        <!-- User Gem Balance -->
        <div class="mb-8 bg-gradient-to-r from-purple-700 to-white rounded-lg shadow-md p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 text-white mr-3">
                        <path d="M11.584 2.376a.75.75 0 0 1 .832 0l9 6a.75.75 0 1 1-.832 1.248L12 3.901 3.416 9.624a.75.75 0 0 1-.832-1.248l9-6Z" />
                        <path fill-rule="evenodd" d="M20.25 10.332v9.918H21a.75.75 0 0 1 0 1.5H3a.75.75 0 0 1 0-1.5h.75v-9.918a.75.75 0 0 1 .634-.74A49.109 49.109 0 0 1 12 9c2.59 0 5.134.202 7.616.592a.75.75 0 0 1 .634.74Zm-7.5 2.418a.75.75 0 0 0-1.5 0v6.75a.75.75 0 0 0 1.5 0v-6.75Zm3-.75a.75.75 0 0 1 .75.75v6.75a.75.75 0 0 1-1.5 0v-6.75a.75.75 0 0 1 .75-.75ZM9 12.75a.75.75 0 0 0-1.5 0v6.75a.75.75 0 0 0 1.5 0v-6.75Z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="text-white text-sm font-medium">Your Balance</p>
                        <h2 class="text-white text-2xl font-bold">1,250 Gems</h2>
                    </div>
                </div>
                <a href="#" class="px-4 py-2 bg-white text-primary rounded-lg font-medium text-sm hover:bg-purple-50 transition duration-200">
                    Transaction History
                </a>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Product Card 1 -->
             @foreach ($products as $product)
            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:border-purple-200 hover:shadow-md transition duration-200">
                <div class="relative h-48">
                    <img src="/api/placeholder/400/320" alt="Wireless Earbuds" class="w-full h-full object-cover">
                    <div class="absolute top-2 right-2 bg-primary text-white text-xs font-bold px-2 py-1 rounded-full">
                        Popular
                    </div>
                </div>
                
                <div class="p-5 space-y-3 flex-grow">
                    <h2 class="text-lg font-semibold text-gray-900 leading-tight line-clamp-2 hover:text-primary transition-colors">
                            {{$product->name}}
                     </h2>
                    
                    <p class="text-sm text-gray-600 line-clamp-2">
                    {{$product->description}}
                    </p>
                    
                    <!-- Product details -->
                    <div class="flex flex-wrap gap-2 pt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                            </svg>
                            {{$product->category->name}}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            Limited Stock
                        </span>
                    </div>
                </div>
                
                <div class="px-5 py-4 flex justify-between items-center border-t border-gray-100">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-purple-500 mr-1">
                            <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-lg font-semibold text-gray-900">{{$product->points}}</span>
                        <span class="ml-1 text-sm text-gray-600">gems</span>
                    </div>
                    
                    <button wire:click="redeemProduct()" wire:loading.attr="disabled"
                        class="px-4 py-2 bg-primary text-white font-medium rounded-lg hover:bg-primary focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200 text-sm">
                        Redeem Now
                    </button>
                </div>
            </div>
            @endforeach

           

            <!-- Empty State (hidden by default) -->
            <div class="col-span-full py-16 text-center hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-400 mb-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No products found</h3>
                <p class="text-gray-600 max-w-md mx-auto">Try adjusting your search or filters to find what you're looking for.</p>
                <button wire:click="resetFilters" class="mt-4 px-4 py-2 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition duration-200 text-sm">
                    Reset Filters
                </button>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-10 flex justify-center">
            <nav class="flex items-center space-x-2">
                <a href="#" class="px-3 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">
                    Previous
                </a>
                <a href="#" class="px-3 py-2 rounded-md bg-primary text-white font-medium">
                    1
                </a>
                <a href="#" class="px-3 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">
                    2
                </a>
                <a href="#" class="px-3 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">
                    3
                </a>
                <span class="px-2 text-gray-500">...</span>
                <a href="#" class="px-3 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">
                    8
                </a>
                <a href="#" class="px-3 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">
                    Next
                </a>
            </nav>
        </div>
    </div>
</div>