@extends('admin.base')

@section('title', 'Payment Details | ')

@section('content')
    <div class="flex flex-1 flex-col p-6 bg-gray-100">
        <h1 class="text-2xl font-bold mb-4 text-blue-600">Payment Details</h1>
        <div class="bg-white p-6 rounded-lg shadow-md space-y-8">
            <div class="border-b pb-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Student Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <p><span class="font-medium text-gray-600">Name:</span> {{ $payment->student->name }}</p>
                    <p><span class="font-medium text-gray-600">Email:</span> {{ $payment->student->email }}</p>
                    <p><span class="font-medium text-gray-600">Phone:</span> {{ $payment->student->phone }}</p>
                </div>
            </div>

            <div class="border-b pb-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Course Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <p><span class="font-medium text-gray-600">Course Title:</span> {{ $payment->course->title }}</p>
                    <p><span class="font-medium text-gray-600">Course Fee:</span>
                        ₹{{ number_format($payment->course->fee, 2) }}</p>
                </div>
            </div>

            <div class="pb-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Payment Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <p><span class="font-medium text-gray-600">Payment ID:</span> {{ $payment->id }}</p>
                    <p><span class="font-medium text-gray-600">Order ID:</span> {{ $payment->order_id }}</p>
                    <p><span class="font-medium text-gray-600">Amount Paid:</span> ₹{{ number_format($payment->amount, 2) }}
                    </p>
                    <p><span class="font-medium text-gray-600">Receipt No:</span> {{ $payment->receipt_no }}</p>
                    <p><span class="font-medium text-gray-600">Transaction Fee:</span>
                        ₹{{ number_format($payment->transaction_fee, 2) }}</p>
                    <p><span class="font-medium text-gray-600">Transaction ID:</span> {{ $payment->transaction_id }}</p>
                    <p><span class="font-medium text-gray-600">Transaction Date:</span> {{ $payment->transaction_date }}
                    </p>
                    <p><span class="font-medium text-gray-600">Payment Card ID:</span> {{ $payment->payment_card_id }}</p>
                    <p><span class="font-medium text-gray-600">Payment Method:</span> {{ $payment->method }}</p>
                    <p><span class="font-medium text-gray-600">Wallet:</span> {{ $payment->wallet }}</p>
                    <p><span class="font-medium text-gray-600">Payment Date:</span> {{ $payment->payment_date }}</p>
                    <p><span class="font-medium text-gray-600">Payment VPA:</span> {{ $payment->payment_vpa }}</p>
                    <p><span class="font-medium text-gray-600">IP Address:</span> {{ $payment->ip_address }}</p>
                    <p><span class="font-medium text-gray-600">International Payment:</span>
                        {{ $payment->international_payment ? 'Yes' : 'No' }}</p>
                    <p><span class="font-medium text-gray-600">Error Reason:</span> {{ $payment->error_reason }}</p>
                    <p><span class="font-medium text-gray-600">Payment Status:</span> {{ $payment->payment_status }}</p>
                    <p><span class="font-medium text-gray-600">Status:</span> {{ $payment->status }}</p>
                    <p><span class="font-medium text-gray-600">Created At:</span> {{ $payment->created_at }}</p>
                    <p><span class="font-medium text-gray-600">Updated At:</span> {{ $payment->updated_at }}</p>
                </div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.manage-payment') }}"
                    class="inline-block bg-blue-500 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-600 transition">
                    Back to Payments
                </a>
            </div>
        </div>
    </div>
@endsection
