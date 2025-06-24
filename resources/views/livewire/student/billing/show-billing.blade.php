<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-lg shadow p-6">
        <!-- Header -->
        <div class="border-b border-gray-200 pb-4 mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Invoice</h1>
                <p class="text-sm text-gray-500">Order ID: {{ $payment->order_id ?? 'N/A' }}</p>
                @if(!empty($payment->transaction_id))
                    <p class="text-sm text-gray-500">Transaction ID: {{ $payment->transaction_id }}</p>
                @endif
            </div>
            <img src="{{ asset('assets/LearnSyntax.png') }}" alt="Logo" class="h-10 mt-4 md:mt-0 md:h-12">
        </div>

        <!-- Customer Info -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Customer Information</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Name</p>
                    <p class="font-medium">{{ $payment->student->name ?? auth()->user()->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="font-medium">{{ $payment->student->email ?? auth()->user()->email ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Phone</p>
                    <p class="font-medium">{{ $payment->student->contact ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Payment Date</p>
                    <p class="font-medium">{{ $payment->created_at ? $payment->created_at->format('M d, Y') : 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Course/Subscription Info -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">
                @if($payment->course_id)
                    Course Details
                @else
                    Subscription Details
                @endif
            </h3>
            <div class="bg-gray-50 rounded-lg p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="font-medium">
                        @if($payment->course_id)
                            {{ $payment->course->title ?? 'N/A' }}
                        @else
                            {{ $payment->subscriptionPlan->name ?? 'Subscription' }}
                            @if(!empty($payment->subscriptionPlan->description))<br><span class="text-xs text-gray-500">{{ $payment->subscriptionPlan->description }}</span>@endif
                        @endif
                    </p>
                </div>
                <div class="mt-2 sm:mt-0">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">
                        @if($payment->course_id)
                            Course
                        @else
                            Subscription
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Billing Details -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Billing Details</h3>
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="flex flex-col gap-1">
                    <div class="flex justify-between">
                        <span>
                            @if($payment->course_id)
                                Course Fee
                            @else
                                Subscription Fee
                            @endif
                        </span>
                        <span>₹{{ number_format($payment->amount ?? 0, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>GST (18%)</span>
                        <span>₹{{ number_format($payment->gst_amount ?? 0, 2) }}</span>
                    </div>
                    @if($payment->transaction_fee > 0)
                        <div class="flex justify-between">
                            <span>Extra Charges</span>
                            <span>₹{{ number_format($payment->transaction_fee ?? 0, 2) }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between font-bold border-t pt-2 mt-2">
                        <span>Total</span>
                        <span>₹{{ number_format(($payment->total_amount ?? 0) + ($payment->transaction_fee ?? 0), 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Info -->
        <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Payment Information</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Payment Status</p>
                    <p class="font-medium capitalize">{{ $payment->status ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Payment Method</p>
                    <p class="font-medium uppercase">{{ $payment->payment_method ?? 'Razorpay' }}</p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 flex justify-between flex-col sm:flex-row">
            <a wire:navigate href= "{{ route('student.billing') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 mb-2 sm:mb-0">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Go Back
            </a>
            <button wire:click="downloadInvoice" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 ml-2">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Download PDF
            </button>
        </div>
    </div>
</div>

