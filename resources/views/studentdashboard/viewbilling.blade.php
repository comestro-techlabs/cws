<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-lg rounded-lg p-8">
            <!-- Invoice Header -->
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center justify-between gap-2">
                    <img src="{{ asset('apple-touch-icon.png') }}" alt="Logo" class="h-12">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Invoice</h1>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-gray-600">Date: {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</p>
                    <p class="text-gray-600">Status: <span class="text-green-500">Paid</span></p>
                </div>
            </div>

            <!-- Billing Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Bill To:</h2>
                <p class="text-gray-700"><strong>Name:</strong> {{ $user->name }}</p>
                <p class="text-gray-700"><strong>Order ID:</strong> {{ $payment->order_id }}</p>
                <p class="text-gray-700"><strong>Email:</strong> {{ $user->email }}</p>
                {{-- <p class="text-gray-700"><strong>Address:</strong> {{ $user->address }}</p> --}}
            </div>

            <!-- Invoice Items -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Invoice Details:</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 bg-gray-100 text-left text-gray-600">Description</th>
                                <th class="py-2 px-4 bg-gray-100 text-right text-gray-600">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200 text-gray-700">
                                    @if($payment->course)
                                        {{ $payment->course->title }}
                                        @elseif($payment->workshops)
                                        {{ $payment->workshops->title }}
                                    @else
                                        Membership Payment for {{ \Carbon\Carbon::create((int)$payment->year, (int)$payment->month, 1)->format('M Y') }}
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-right text-gray-700">₹{{ $payment->transaction_fee }}</td>
                            </tr>
                            @if(!$payment->course  && !$payment->workshops)
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-200 text-gray-700">Late Fee</td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-right text-gray-700">₹{{ $payment->late_fee }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Payment Breakdown -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Payment Breakdown:</h2>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-700">Subtotal:</span>
                    <span class="text-gray-700">₹{{ $payment->transaction_fee }}</span>
                </div>
                @if($payment->course )
                <div class="flex justify-between mb-2">
                    <span class="text-gray-700">Course Fees:</span>
                    <span class="text-gray-700">₹{{ $payment->course->fees }}</span>
                </div>
                @php
                    $discount = $payment->course->fees - $payment->course->discounted_fees;
                @endphp
                <div class="flex justify-between mb-2">
                    <span class="text-gray-700">Discount:</span>
                    <span class="text-gray-700">₹{{ $discount }}</span>
                </div>
                  @elseif($payment->workshops)
                <div class="flex justify-between mb-2">
                    <span class="text-gray-700">Workshop Fees:</span>
                    <span class="text-gray-700">₹{{ $payment->workshops->fees }}</span>
                </div>  
                @else
                <div class="flex justify-between mb-2">
                    <span class="text-gray-700">Late Fee:</span>
                    <span class="text-gray-700">₹{{ $payment->late_fee }}</span>
                </div>
                @php
                    $payment->total_amount = $payment->transaction_fee + $payment->late_fee;
                @endphp
                @endif
                <div class="flex justify-between">
                    <span class="text-gray-700 font-semibold">Total:</span>
                    <span class="text-gray-700 font-semibold">₹{{ $payment->total_amount }}</span>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center text-gray-600">
                <p>Thank you for your business!</p>
                <p>If you have any questions, please contact us at <a href="mailto:info@learnsyntax.com" class="text-blue-500">info@learnsyntax.com</a></p>
            </div>

            <!-- Back Button -->
            <div class="mt-6">
                <a href="{{ url()->previous() }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
            </div>
        </div>
    </div>
</body>
</html>
