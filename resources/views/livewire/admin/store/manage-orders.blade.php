<div>
<!-- resources/views/livewire/manage-orders.blade.php -->
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-left text-gray-800">Order Management</h1>
    
    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ session('message') }}</p>
        </div>
    @endif
    
    <!-- Tab Navigation -->
    <div class="flex border-b border-gray-300 mb-6">
        <button 
            wire:click="changeTab('pending')" 
            class="px-4 py-2 font-medium text-gray-700 hover:text-blue-500 focus:outline-none {{ $activeTab === 'pending' ? 'border-b-2 border-blue-500 text-blue-600' : '' }}">
            Pending Orders
        </button>
        <button 
            wire:click="changeTab('confirmed')" 
            class="px-4 py-2 font-medium text-gray-700 hover:text-blue-500 focus:outline-none {{ $activeTab === 'confirmed' ? 'border-b-2 border-blue-500 text-blue-600' : '' }}">
            Confirmed Orders
        </button>
    </div>
    
    <!-- Orders Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if($activeTab === 'pending')
                    @forelse($pendingOrders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $order->product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button 
                                    wire:click="selectOrder({{ $order->id }})"
                                    class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-4 py-2 text-center">
                                    Fulfill Order
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">No pending orders found.</td>
                        </tr>
                    @endforelse
                @else
                    @forelse($confirmedOrders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{  $order->product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button 
                                    wire:click="selectOrder({{ $order->id }})"
                                    class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-4 py-2 text-center">
                                    View Details
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">No confirmed orders found.</td>
                        </tr>
                    @endforelse
                @endif
            </tbody>
        </table>
    </div>
    
    <!-- Order Details Modal -->
    @if($showModal)
    <div 
        class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title" 
        role="dialog" 
        aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">
                        Order Details
                    </h3>
                    <div class="mt-2 space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Product:</span>
                            <span class="text-sm text-gray-900">{{ $selectedOrder->product->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Status:</span>
                            <span class="text-sm text-gray-900">{{ $selectedOrder->status }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Customer:</span>
                            <span class="text-sm text-gray-900">{{ $selectedOrder->user->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Date:</span>
                            <span class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($selectedOrder->created_at)->format('d M Y, h:i A') }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Address:</span>
                            <span class="text-sm text-gray-900">{{ $selectedOrder->shippingDetail->address_line }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Price:</span>
                            <span class="text-sm text-gray-900">{{ $selectedOrder->total_amount }}</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    @if($selectedOrder->status === 'pending')
                        <button 
                            wire:click="fulfillOrder"
                            type="button" 
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Confirm Order
                        </button>
                    @endif
                    <button 
                        wire:click="closeModal"
                        type="button" 
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Back
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
</div>
