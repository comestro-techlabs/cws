
<div>
<script>
     document.addEventListener('livewire:initialized', () => {
        Livewire.on('showAlert', (message) => {
            Swal.fire({
                title: 'Success!',
                text: message,
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#2563EB'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('v2.student.products') }}"; // Livewire way to redirect
                }
            });
        });
    });
</script>
    <div class="bg-gray-50 min-h-screen pt-6 mt-5 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header and Description -->
            <div class="mb-8">
              
                <h1 class="text-2xl font-bold text-gray-900">Checkout</h1>
                <p class="text-gray-600 mt-1">Complete your redemption to receive your reward</p>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Product Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Product Summary -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Product Summary</h2>
                            <div class="flex items-start">
                                <div class="w-24 h-24 flex-shrink-0 rounded-md overflow-hidden">
                                    <img src="`{{ ('storage/'.$productImageUrl) }}` alt="Product image" class="w-full h-full object-cover">
                                </div>

                                <div class="ml-4 flex-grow">
                                    <h3 class="text-base font-medium text-gray-900">{{$title}}</h3>
                                    <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{$description}}</p>

                                    <div class="flex flex-wrap gap-2 mt-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-blue-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5 mr-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                            </svg>
                                            {{$belongToCategory}}
                                        </span>
                                    </div>

                                    <div class="mt-3 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-purple-500 mr-1">
                                            <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-lg font-semibold text-gray-900">{{$gems}}</span>
                                        <span class="ml-1 text-sm text-gray-600">gems</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Details (Expandable) -->
                            <div x-data="{ open: false }" class="mt-6 border-t border-gray-100 pt-4">
                                <button @click="open = !open" class="flex items-center justify-between w-full text-left focus:outline-none">
                                    <span class="text-sm font-medium text-gray-900">View Full Description</span>
                                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                    </svg>
                                </button>

                                <div x-show="open" x-transition class="mt-4">
                                    <p class="text-sm text-gray-600">
                                        This is a comprehensive description of the product. It includes all the details about what the product is, how it works, and what benefits it provides. The description can be quite detailed and provide all the information a user might need before making a decision to redeem their gems for this reward.
                                    </p>
                                    <p class="text-sm text-gray-600 mt-2">
                                        Additional details about the product specifications, usage instructions, and any terms or conditions related to the reward redemption.
                                    </p>
                                    <ul class="mt-2 text-sm text-gray-600 list-disc pl-5">
                                        <li>Feature 1: Detailed explanation</li>
                                        <li>Feature 2: Detailed explanation</li>
                                        <li>Feature 3: Detailed explanation</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                        @if(!$shippingDetailsFilled)
                        <form wire:submit.prevent="saveShippingAddress" class="p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Shipping Information</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="first-name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                    <input type="text" id="first-name" wire:model="first_name" class="w-full px-3 py-2 text-gray-800 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:outline-none transition duration-200">
                                    @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="last-name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                    <input type="text" id="last-name" wire:model="last_name" class="w-full px-3 py-2 text-gray-800 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:outline-none transition duration-200">
                                    @error('last_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                                </div>

                                <div class="md:col-span-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                    <input type="email" id="email" wire:model="email" class="w-full px-3 py-2 text-gray-800 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:outline-none transition duration-200">
                                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                                </div>

                                <div class="md:col-span-2">
                                    <label for="address-line1" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <input type="text" id="address-line" wire:model="address_line" class="w-full px-3 py-2 text-gray-800 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:outline-none transition duration-200">
                                    @error('address_line') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                                </div>

                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                    <input type="text" id="city" wire:model="city" class="w-full px-3 py-2 text-gray-800 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:outline-none transition duration-200">
                                    @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                                </div>

                                <div>
                                    <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                                    <input type="text" id="state" wire:model="state" class="w-full px-3 py-2 text-gray-800 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:outline-none transition duration-200">
                                    @error('state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                                </div>

                                <div>
                                    <label for="postal-code" class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                    <input type="text" id="postal-code" wire:model="postal_code" class="w-full px-3 py-2 text-gray-800 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:outline-none transition duration-200">
                                    @error('postal_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                                </div>

                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                    <select id="country" wire:model="country" class="w-full px-3 py-2 text-gray-800 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:outline-none transition duration-200">
                                        <option value="">Select Country</option>
                                        <option value="india">India</option>
                                        <!-- Add more countries as needed -->
                                    </select>
                                    @error('country') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                                </div>

                                <div class="md:col-span-2">
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="tel" id="phone" wire:model="phone" class="w-full px-3 py-2 text-gray-800 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:outline-none transition duration-200">
                                    @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                                </div>

                                <div class="md:col-span-2 flex justify-end">
                                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                        @else
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Your Shipping Address</h2>
                            <div class="text-gray-700 space-y-1">
                                <p><span class="font-medium">Name:</span> {{ $shippingDetailsFilled->first_name }} {{ $shippingDetailsFilled->last_name }}</p>
                                <p><span class="font-medium">Email:</span> {{ $shippingDetailsFilled->email }}</p>
                                <p><span class="font-medium">Address:</span> {{ $shippingDetailsFilled->address_line }}</p>
                                <p><span class="font-medium">City:</span> {{ $shippingDetailsFilled->city }}, {{ $shippingDetailsFilled->state }}, {{ $shippingDetailsFilled->postal_code }}</p>
                                <p><span class="font-medium">Country:</span> {{ $shippingDetailsFilled->country }}</p>
                                <p><span class="font-medium">Phone:</span> {{ $shippingDetailsFilled->phone }}</p>
                            </div>

                            <!-- Edit Button -->
                            <div class="mt-6 flex justify-end">
                                <button wire:click="editShippingAddress" class="px-4 py-2 bg-primary text-white rounded-lg focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200">
                                    Edit Address
                                </button>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>

                <!-- Right Column - Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 sticky top-6">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>

                            <!-- Gem Balance -->
                            <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-purple-500 mr-2">
                                            <path d="M11.584 2.376a.75.75 0 0 1 .832 0l9 6a.75.75 0 1 1-.832 1.248L12 3.901 3.416 9.624a.75.75 0 0 1-.832-1.248l9-6Z" />
                                            <path fill-rule="evenodd" d="M20.25 10.332v9.918H21a.75.75 0 0 1 0 1.5H3a.75.75 0 0 1 0-1.5h.75v-9.918a.75.75 0 0 1 .634-.74A49.109 49.109 0 0 1 12 9c2.59 0 5.134.202 7.616.592a.75.75 0 0 1 .634.74Zm-7.5 2.418a.75.75 0 0 0-1.5 0v6.75a.75.75 0 0 0 1.5 0v-6.75Zm3-.75a.75.75 0 0 1 .75.75v6.75a.75.75 0 0 1-1.5 0v-6.75a.75.75 0 0 1 .75-.75ZM9 12.75a.75.75 0 0 0-1.5 0v6.75a.75.75 0 0 0 1.5 0v-6.75Z" clip-rule="evenodd" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-600">Current Balance</p>
                                            <p class="text-base font-medium text-gray-900">{{$totalAvailableGems}} Gems</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-gray-100 pt-4 pb-2">
                                <div class="flex justify-between py-2">
                                    <span class="text-sm text-gray-600">Product Cost</span>
                                    <span class="text-sm font-medium text-gray-900">{{$gems}} Gems</span>
                                </div>
                                <div class="flex justify-between py-2">
                                    <span class="text-sm text-gray-600">Shipping Fee</span>
                                    <span class="text-sm font-medium text-gray-900">{{$shipping_charge}} Gems</span>
                                </div>
                            </div>

                            <div class="border-t border-gray-100 pt-4 pb-2">
                                <div class="flex justify-between py-2">
                                    <span class="text-base font-semibold text-gray-900">Total</span>
                                    <span class="text-base font-semibold text-gray-900">{{$totalPriceOfProduct}} Gems</span>
                                </div>
                                <div class="flex justify-between py-2">
                                    <span class="text-sm text-gray-600">Balance After Purchase</span>
                                    <span class="text-sm font-medium text-gray-900">{{$balanceGems}} Gems</span>
                                </div>
                            </div>

                            <!-- Redeem Button -->
                            <button wire:click="completeRedemption"
                                wire:loading.attr="disabled"
                                class="w-full mt-6 px-6 py-3 rounded-lg font-medium 
                                focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200 
                                {{ $shippingDetailsFilled ? 'bg-primary text-white hover:bg-purple-700' : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}"
                                {{ $shippingDetailsFilled ? '' : 'disabled' }}>
                                <span wire:loading.remove>Complete Redemption</span>
                                <span wire:loading>Processing...</span>
                            </button>

                            <p class="text-xs text-gray-500 text-center mt-4">
                                By completing this redemption, you agree to our Terms of Service and Return Policy.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-8">
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-primary transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Back to Rewards
                </a>
            </div>
        </div>
    </div>
</div>