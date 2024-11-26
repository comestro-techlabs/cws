@extends('admin.base')

@section('title', 'Manage Payments | ')

@section('content')
    <div class="flex flex-1 flex-col p-6 bg-gray-100">
        <h1 class="text-2xl font-bold mb-4">Manage Fully Paid Students</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-3 px-4 text-left text-gray-700 font-semibold border-b">Student Name</th>
                        <th class="py-3 px-4 text-left text-gray-700 font-semibold border-b">Course Name</th>
                        <th class="py-3 px-4 text-right text-gray-700 font-semibold border-b">Amount</th>
                        <th class="py-3 px-4 text-left text-gray-700 font-semibold border-b">Payment Date</th>
                        <th class="py-3 px-4 text-center text-gray-700 font-semibold border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        {{-- {{ dd($payment->course) }} --}}
                        <tr>
                            <td class="py-3 px-4 border-b">
                                {{ $payment->student->name ?? 'N/A' }}
                            </td>
                            <td class="py-3 px-4 border-b">
                                {{ $payment->course->title ?? 'N/A' }}
                            </td>
                            <td class="py-3 px-4 text-right border-b">
                                ₹{{ number_format($payment->amount, 2) }}
                            </td>
                            <td class="py-3 px-4 border-b">
                                {{ $payment->formatted_date }}
                            </td>
                            <td class="py-3 px-4 text-center border-b">
                                <a href="{{ route('admin.payment.view', $payment->id) }}"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-3 px-4 text-gray-500 border-b">
                                No fully paid students found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $payments->links() }}
            </div>
        </div>
    </div>
@endsection
