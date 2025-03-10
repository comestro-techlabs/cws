<div x-data="{ activeTab: 'invoice' }" class="bg-gray-50 min-h-screen pt-6 mt-5 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Tabs -->
        <div class="mb-8">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px">
                    <button @click="activeTab = 'invoice'" :class="{ 'border-purple-500 text-purple-600': activeTab === 'invoice', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'invoice' }" class="w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm">
                        Invoice History
                    </button>
                    <button @click="activeTab = 'membership'" :class="{ 'border-purple-500 text-purple-600': activeTab === 'membership', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'membership' }" class="w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm">
                        Membership
                    </button>
                </nav>
            </div>
        </div>

        <!-- Invoice Tab Content -->
        <div x-show="activeTab === 'invoice'" class="space-y-4">
            @php
                $isPayable = true;
            @endphp
            @foreach ($paymentsWithWorkshops as $item)
                @if($item->course_id || $item->workshop_title)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 p-4">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex-1 min-w-[200px]">
                                <h3 class="font-medium text-gray-900">
                                    @if(!empty($item->workshop_title))
                                        {{ $item->workshop_title }}
                                    @elseif(!empty($item->course->title))
                                        {{ $item->course->title }}
                                    @else
                                        {{ 'Membership Fee' }}
                                    @endif
                                </h3>
                                <p class="text-sm text-gray-500">Order ID: {{ $item->order_id }}</p>
                            </div>

                            <div class="flex items-center gap-6">
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">₹{{ $item->transaction_fee }}</p>
                                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->transaction_date)->format('d M Y') }}</p>
                                </div>

                                <div class="flex items-center gap-2">
                                    @if($item->method == "upi")
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">UPI</span>
                                    @elseif($item->method == "netbanking")
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Net Banking</span>
                                    @elseif($item->method == "card")
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Card</span>
                                    @endif

                                    @if($item->status === "captured")
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Paid</span>
                                    @elseif($item->status === "failed")
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Failed</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </div>

                                <div>
                                    @if($item->status === 'captured')
                                        <a href="{{ route('student.viewbilling', $item->id) }}" class="inline-flex items-center px-3 py-2 border border-purple-300 text-sm leading-4 font-medium rounded-md text-purple-700 bg-white hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            Print Invoice
                                        </a>
                                    @elseif($item->status === 'failed')
                                        <span class="text-red-500 font-medium text-sm">Failed</span>
                                    @elseif($item->status === 'unpaid')
                                        <button class="pay-now-button inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                                            data-payment-id="{{ $item->id }}"
                                            data-order-id="{{ $item->order_id }}"
                                            data-amount="{{ $item->transaction_fee }}"
                                            data-student-id="{{ $item->student_id }}">
                                            Pay Now
                                        </button>
                                    @else
                                        <button class="refresh-payment inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500" 
                                            data-order-id="{{ $item->order_id }}">
                                            Refresh
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Membership Tab Content -->
        <div x-show="activeTab === 'membership'" class="space-y-4">
            @if(Auth::user()->is_member)
                @foreach ($paymentsWithWorkshops as $item)
                    @if(empty($item->course_id) && empty($item->workshop_id))
                        <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 p-4">
                            <div class="flex flex-wrap items-center justify-between gap-4">
                                <div class="flex-1 min-w-[200px]">
                                    <h3 class="font-medium text-gray-900">Membership Payment</h3>
                                    <p class="text-sm text-gray-500">
                                        Due Date: {{ \Carbon\Carbon::parse($item->due_date)->format('d M Y') }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Month: {{ \Carbon\Carbon::create((int)$item->year, (int)$item->month, 1)->format('M Y') }}
                                    </p>
                                </div>

                                <div class="flex items-center gap-6">
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">₹{{ $item->total_amount }}</p>
                                        @if($item->payment_date)
                                            <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->payment_date)->format('d M Y') }}</p>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-2">
                                        @if($item->method)
                                            @if($item->method == "upi")
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">UPI</span>
                                            @elseif($item->method == "netbanking")
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Net Banking</span>
                                            @elseif($item->method == "card")
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Card</span>
                                            @endif
                                        @endif

                                        @if($item->status === "captured")
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Paid</span>
                                        @elseif($item->status === "failed" || $item->status === 'overdue')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">{{ ucfirst($item->status) }}</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">{{ ucfirst($item->status) }}</span>
                                        @endif
                                    </div>

                                    <div>
                                        @if($item->status === 'captured')
                                            <a href="{{ route('student.viewbilling', $item->id) }}" class="inline-flex items-center px-3 py-2 border border-purple-300 text-sm leading-4 font-medium rounded-md text-purple-700 bg-white hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                                Print Invoice
                                            </a>
                                        @elseif($item->status === 'failed')
                                            <span class="text-red-500 font-medium text-sm">Failed</span>
                                        @elseif(($item->status === 'unpaid' || $item->status === 'overdue') && $isPayable)
                                            <button class="pay-now-button inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                                                data-payment-id="{{ $item->id }}"
                                                data-order-id="{{ $item->order_id }}"
                                                data-amount="{{ $item->total_amount }}"
                                                data-student-id="{{ $item->student_id }}">
                                                Pay Now
                                            </button>
                                            @if(!$overdueCount)
                                                @php $isPayable = false; @endphp
                                            @endif
                                        @else
                                            <button class="refresh-payment inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500" 
                                                data-order-id="{{ $item->order_id }}">
                                                Refresh
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>
