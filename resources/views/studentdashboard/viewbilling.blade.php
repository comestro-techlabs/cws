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

            <!-- Invoice Details -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Bill To:</h2>
                <p class="text-gray-700"><strong>Name:</strong> {{ $user->name }}</p>
                <p class="text-gray-700"><strong>Order ID:</strong> {{ $payment->order_id }}</p>
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
                                        
                                       
                                    @else
                                        Membership Payment for {{ \Carbon\Carbon::create((int)$payment->year, (int)$payment->month, 1)->format('M Y') }}
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-right text-gray-700">₹{{ $payment->transaction_fee }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Total Amount -->
            <div class="flex justify-end mb-8">
                <div class="w-1/3">
                    
                    @if(!$payment->course)
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-700">Subtotal:</span>
                        <span class="text-gray-700">₹{{ $payment->transaction_fee }}</span>
                    </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-700">Late Fee:</span>
                            <span class="text-gray-700">₹{{ $payment->late_fee }}</span>
                        </div>
                    @else
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-700">Fees:</span>
                        <span class="text-gray-700">₹{{ $payment->course->fees }}</span>
                    </div>
                    @php
                        $discount = $payment->course->fees - $payment->course->discounted_fees;
                    @endphp
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-700">Discount:</span>
                            <span class="text-gray-700">₹{{ $discount }}</span>
                        </div>    
                    @endif
                    <div class="flex justify-between">
                        <span class="text-gray-700 font-semibold">Total:</span>
                        <span class="text-gray-700 font-semibold">₹{{ $payment->total_amount }}</span>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center text-gray-600">
                <p>Thank you </p>
                <p>If you have any questions, please contact us at info@learnsyntax.com</p>
            </div>

            <!-- Back Button -->
            <div class="mt-6">
                <a href="{{ url()->previous() }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
            </div>
        </div>
    </div>
</body>
</html>




