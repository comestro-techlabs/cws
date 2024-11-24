@extends('admin.base')

@section('title', 'Payment Details | ')

@section('content')
    <div class="flex flex-1 flex-col p-6 bg-gray-100">
        <h1 class="text-3xl font-extrabold mb-6 text-blue-700">Payment Details</h1>
        <div class="bg-white p-8 rounded-lg shadow-lg space-y-10">
            {{-- student information goes here --}}
            <div class="p-6 bg-gray-50 border-l-4 border-blue-400 rounded-md">
                <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a6 6 0 00-6 6v1H3a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2h-1V8a6 6 0 00-6-6z" />
                    </svg>
                    Student Information
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <p><strong>Name:</strong> {{ $payment->student->name }}</p>
                    <p><strong>Email:</strong> {{ $payment->student->email }}</p>
                    <p><strong>Phone:</strong> {{ $payment->student->phone }}</p>
                </div>
            </div>

            {{-- course information goes here --}}
            <div class="p-6 bg-gray-50 border-l-4 border-green-400 rounded-md">
                <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M11 17a1 1 0 01-.894-.553L9 15H7a2 2 0 01-2-2V9a2 2 0 012-2h2l1-1.447A1 1 0 0111 5h6a2 2 0 012 2v6a2 2 0 01-2 2h-6z" />
                    </svg>
                    Course Information
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <p><strong>Course Title:</strong> {{ $payment->course->title }}</p>
                    <p><strong>Course Fee:</strong> ₹{{ number_format($payment->course->fee, 2) }}</p>
                </div>
            </div>

            {{-- payment information goes here --}}
            <div class="p-6 bg-gray-50 border-l-4 border-yellow-400 rounded-md">
                <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 3a1 1 0 011 1v1h3a1 1 0 110 2H11v3a1 1 0 11-2 0V7H6a1 1 0 110-2h3V4a1 1 0 011-1z" />
                    </svg>
                    Payment Information
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <p><strong>Payment ID:</strong> {{ $payment->id }}</p>
                    <p><strong>Order ID:</strong> {{ $payment->order_id }}</p>
                    <p><strong>Amount Paid:</strong> ₹{{ number_format($payment->amount, 2) }}</p>
                    <p><strong>Receipt No:</strong> {{ $payment->receipt_no }}</p>
                    <p><strong>Transaction Fee:</strong> ₹{{ number_format($payment->transaction_fee, 2) }}</p>
                    <p>
                        <strong>Transaction ID:</strong>
                        <span title="{{ $payment->transaction_id }}">{{ Str::limit($payment->transaction_id, 20) }}</span>
                    </p>
                    <p><strong>Transaction Date:</strong> {{ $payment->transaction_date }}</p>
                    <p><strong>Payment Card ID:</strong> {{ $payment->payment_card_id }}</p>
                    <p><strong>Payment Method:</strong> {{ $payment->method }}</p>
                    <p><strong>Wallet:</strong> {{ $payment->wallet }}</p>
                    <p><strong>Payment Date:</strong> {{ $payment->payment_date }}</p>
                    <p><strong>Payment VPA:</strong> {{ $payment->payment_vpa }}</p>
                    <p><strong>IP Address:</strong> {{ $payment->ip_address }}</p>
                    <p><strong>International Payment:</strong> {{ $payment->international_payment ? 'Yes' : 'No' }}</p>
                    <p>
                        <strong>Error Reason:</strong>
                        <span title="{{ $payment->error_reason }}">{{ Str::limit($payment->error_reason, 20) }}</span>
                    </p>
                    <p><strong>Payment Status:</strong> {{ $payment->payment_status }}</p>
                    <p><strong>Status:</strong> {{ $payment->status }}</p>
                    <p><strong>Created At:</strong> {{ $payment->created_at }}</p>
                    <p><strong>Updated At:</strong> {{ $payment->updated_at }}</p>
                </div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.manage-payment') }}"
                    class="inline-flex items-center bg-blue-500 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 3a1 1 0 011 1v6h3a1 1 0 110 2h-4a1 1 0 01-1-1V4a1 1 0 011-1z" />
                    </svg>
                    Back to Payments
                </a>
            </div>
        </div>
    </div>
@endsection
