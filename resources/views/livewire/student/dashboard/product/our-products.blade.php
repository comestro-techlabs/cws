<div class="bg-gray-50 min-h-screen pt-6 mt-5 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header and Description -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
            <div class="text-center sm:text-left">
                <h1 class="text-2xl font-bold text-gray-900">Redeem Your Gems</h1>
                <p class="text-gray-600 mt-1">Exchange your hard-earned gems for these exclusive rewards</p>
            </div>
            <a href="{{ route('student.my-orders') }}" wire:navigate
                class="px-4 py-2 bg-primary text-white rounded-lg font-medium text-sm hover:bg-purple-700 hover:text-white transition duration-200 inline-flex items-center whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                My Orders
            </a>
        </div>

        <!-- Search and Filters -->
        <div class="bg-white rounded-lg shadow-sm mb-8 p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row gap-4 items-center">
                <div class="relative w-full sm:flex-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input wire:model.live="search" type="text" placeholder="Search for products..." 
                        class="w-full pl-10 pr-4 py-2.5 text-gray-800 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:outline-none transition duration-200">
                </div>
                <div class="w-full sm:w-auto">
                    <select wire:model.live="selectedCategory" class="w-full py-2.5 px-4 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:outline-none transition duration-200">
                        <option value="">All Categories</option>
                        @foreach($categories as $id => $name)
                            <option value="{{ $id }}">{{ ucfirst($name) }}</option>
                        @endforeach
                    </select>
                </div>
                <button wire:loading.attr="disabled" class="w-full sm:w-auto px-6 py-2.5 bg-primary text-white rounded-lg hover:bg-purple-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200 whitespace-nowrap">
                    <div class="flex items-center justify-center gap-2">
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
            <div class="flex items-center justify-between flex-col sm:flex-row gap-4">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 text-white mr-3">
                        <path d="M11.584 2.376a.75.75 0 0 1 .832 0l9 6a.75.75 0 1 1-.832 1.248L12 3.901 3.416 9.624a.75.75 0 0 1-.832-1.248l9-6Z" />
                        <path fill-rule="evenodd" d="M20.25 10.332v9.918H21a.75.75 0 0 1 0 1.5H3a.75.75 0 0 1 0-1.5h.75v-9.918a.75.75 0 0 1 .634-.74A49.109 49.109 0 0 1 12 9c2.59 0 5.134.202 7.616.592a.75.75 0 0 1 .634.74Zm-7.5 2.418a.75.75 0 0 0-1.5 0v6.75a.75.75 0 0 0 1.5 0v-6.75Zm3-.75a.75.75 0 0 1 .75.75v6.75a.75.75 0 0 1-1.5 0v-6.75a.75.75 0 0 1 .75-.75ZM9 12.75a.75.75 0 0 0-1.5 0v6.75a.75.75 0 0 0 1.5 0v-6.75Z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="text-white text-sm font-medium">Your Balance</p>
                        <h2 class="text-white text-xl sm:text-2xl font-bold">{{$totalAvailableGems}} Gems</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($products as $product)
                @if($product->status == 'active' && $product->category->isActive)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:border-purple-200 hover:shadow-md transition duration-200 flex flex-col">
                        <div class="relative h-48">
                            <img src="{{ $product->imageUrl }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
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
                            <div class="flex flex-wrap gap-2 pt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                    </svg>
                                    {{$product->category->name}}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium @if($product->availableQuantity <= 0) bg-red-100 text-red-800 @else bg-purple-100 text-blue-800 @endif">
                                    {{$product->availableQuantity}} available
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
                            <button 
                                wire:click="navigateToCheckout({{ $product->id }})"
                                class="px-4 py-2 font-medium rounded-lg focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200 text-sm
                                {{ (!$hasAccess || $totalAvailableGems <= $product->points || $product->availableQuantity <= 0) 
                                    ? 'bg-gray-400 text-gray-200 cursor-not-allowed' 
                                    : 'bg-purple-500 text-white hover:bg-primary' }}"
                                @if(!$hasAccess || $totalAvailableGems < $product->points || $product->availableQuantity <= 0) 
                                    disabled 
                                @endif>
                                @if(!$hasAccess)
                                    Access Required
                                @else
                                    Redeem Now
                                @endif
                            </button>
                        </div>
                    </div>
                @endif
            @endforeach

            <!-- Empty State -->
            <div class="col-span-full py-16 text-center {{ count($products) > 0 ? 'hidden' : '' }}">
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

        <!-- Access Restriction Modal -->
        @include('components.access-restriction-modal')
    </div>
</div>