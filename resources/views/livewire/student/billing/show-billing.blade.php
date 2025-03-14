<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-lg shadow p-6">
        <!-- Header -->
        <div class="border-b border-gray-200 pb-4 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Invoice</h1>
                    <p class="text-sm text-gray-500">Order ID: {{ $payment->order_id }}</p>
                </div>
                <img src="{{ asset('front_assets/img/logo/logo.png') }}" alt="Logo" class="h-12">
            </div>
        </div>

        <!-- Payment Details -->
        <div class="space-y-6">
            <!-- Customer Info -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Customer Information</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Name</p>
                        <p class="font-medium">{{ auth()->user()->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="font-medium">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Purchase Details -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Purchase Details</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex justify-between items-center mb-2">
                        <div>
                            <p class="font-medium">
                                @if($payment->course_id)
                                    {{ $payment->course->title }}
                                    <span class="text-sm text-gray-500">(Course)</span>
                                @elseif($payment->workshop_id)
                                    {{ $payment->workshop->title }}
                                    <span class="text-sm text-gray-500">(Workshop)</span>
                                @else
                                    Subscription Payment
                                    <span class="text-sm text-gray-500">(Membership)</span>
                                @endif
                            </p>
                        </div>
                        <p class="font-semibold">₹{{ $payment->total_amount }}</p>
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Payment Information</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Payment Status</p>
                        <p class="font-medium capitalize">{{ $payment->status }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Payment Method</p>
                        <p class="font-medium uppercase">{{ $payment->payment_method ?? 'Razorpay' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Transaction ID</p>
                        <p class="font-medium">{{ $payment->transaction_id }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Payment Date</p>
                        <p class="font-medium">{{ $payment->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 flex justify-end">
            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Invoice
            </button>
        </div>
    </div>
</div>
