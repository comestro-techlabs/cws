<div class="bg-gray-50 min-h-screen pt-6 mt-5 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header and Description -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
            <div class="text-center sm:text-left">
                <h1 class="text-2xl font-bold text-gray-900">My Orders</h1>
                <p class="text-gray-600 mt-1">View and track your reward redemptions</p>
            </div>
            <a href="{{ route('v2.student.products') }}" wire:navigate
                class="px-4 py-2 bg-purple-500 text-white rounded-lg font-medium text-sm hover:bg-purple-700 hover:text-white transition duration-200 inline-flex items-center whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                Return to Store
            </a>
        </div>

        <!-- Orders List -->
        <div class="space-y-6">
            @foreach ($orders as $order)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:border-purple-200 hover:shadow-md transition duration-200">
                    <div class="p-5 border-b border-gray-100">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="space-y-1">
                                <div class="flex items-center flex-wrap gap-x-2">
                                    <span class="text-gray-500 text-sm min-w-[60px]">Date:</span>
                                    <span class="text-sm">{{ $order->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="flex items-center flex-wrap gap-x-2">
                                    <span class="text-gray-500 text-sm min-w-[60px]">Order Id:</span>
                                    <span class="text-sm">#{{ $order->order_number }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 flex-wrap justify-start sm:justify-end">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status == 'completed') bg-green-100 text-green-800
                                    @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3.5 h-3.5 mr-1">
                                        <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $order->total_amount }} gems
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5">
                    </div>

                    <div class="bg-gray-50 px-5 py-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                            <span class="text-sm text-gray-500 min-w-[110px]">Delivery Address:</span>
                            <span class="text-sm font-medium">
                                {{ $order->shippingDetail->address_line }},
                                {{ $order->shippingDetail->city }},
                                {{ $order->shippingDetail->state }},
                                {{ $order->shippingDetail->postal_code }}
                            </span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                            <span class="text-sm text-gray-500 min-w-[110px]">Contact Number:</span>
                            <span class="text-sm font-medium">{{ $order->shippingDetail->phone }}</span>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Empty State -->
            <div class="py-16 text-center {{ count($orders) > 0 ? 'hidden' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-400 mb-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0-6.75h-3m3 0h3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No orders found</h3>
                <p class="text-gray-600 max-w-md mx-auto">You haven't placed any orders yet. Start exploring our rewards to redeem your gems.</p>
                {{-- Uncomment if needed
                <a href="{{ route('student.rewards.store') }}" class="mt-4 px-4 py-2 bg-primary text-white font-medium rounded-lg hover:bg-purple-700 transition duration-200 text-sm inline-block">
                    Browse Rewards
                </a>
                --}}
            </div>
        </div>
    </div>
</div>