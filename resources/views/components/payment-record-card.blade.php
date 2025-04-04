<div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 p-4">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <!-- Payment Details -->
        <div class="flex-1 min-w-[200px]">
            <div class="flex items-center gap-2">
                <h3 class="font-medium text-gray-900">
                    @if($payment->course_id)
                        {{ $payment->course->title ?? 'Course Payment' }}
                        <span class="ml-2 text-xs px-2 py-1 bg-purple-100 text-purple-800 rounded-full">Course</span>
                    @elseif($payment->workshop_id)
                        {{ $payment->workshop_title }}
                        <span class="ml-2 text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full">Workshop</span>
                    @else
                        Subscription Payment
                        <span class="ml-2 text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">Subscription</span>
                    @endif
                </h3>
            </div>
            <p class="text-sm text-gray-500">Order ID: {{ $payment->order_id }}</p>
            @if($payment->due_date)
                <p class="text-sm text-gray-500">Due: {{ \Carbon\Carbon::parse($payment->due_date)->format('d M Y') }}</p>
            @endif
        </div>

        <!-- Amount and Status -->
        <div class="flex items-center gap-6">
            <div class="text-right">
                <p class="text-sm font-medium text-gray-900">₹{{ $payment->total_amount }}</p>
                <p class="text-xs text-gray-500">
                    {{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') : 'Not paid' }}
                </p>
            </div>

            <!-- Payment Method & Status -->
            <div class="flex items-center gap-2">
                @if($payment->method)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                        {{ $payment->method == 'upi' ? 'bg-blue-100 text-blue-800' : 
                           ($payment->method == 'netbanking' ? 'bg-green-100 text-green-800' : 
                           'bg-purple-100 text-purple-800') }}">
                        {{ strtoupper($payment->method) }}
                    </span>
                @endif

                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                    {{ $payment->status == 'captured' ? 'bg-green-100 text-green-800' : 
                       ($payment->status == 'failed' ? 'bg-red-100 text-red-800' : 
                       'bg-yellow-100 text-yellow-800') }}">
                    {{ ucfirst($payment->status) }}
                </span>
            </div>

            <!-- Action Buttons -->
            <div>
                @if($payment->status === 'captured')
                    <a href="{{ route('student.viewbilling', $payment->id) }}" 
                       class="inline-flex items-center px-3 py-2 border border-purple-300 text-sm leading-4 font-medium rounded-md text-purple-700 bg-white hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Invoice
                    </a>
                @elseif(in_array($payment->status, ['unpaid', 'overdue']))
                    <button class="pay-now-button inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                            data-payment-id="{{ $payment->id }}"
                            data-order-id="{{ $payment->order_id }}"
                            data-amount="{{ $payment->total_amount }}"
                            data-student-id="{{ $payment->student_id }}">
                        Pay Now
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
