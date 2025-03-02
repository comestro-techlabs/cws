<div>
    <div class="flex flex-1 flex-col p-6 bg-gray-100 mt-8">
        <div class="flex flex-wrap justify-between items-center p-4">
            <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-orange-400 pl-3 mb-5">
                Manage Fully Paid Students
            </h2>
        </div>

        <div class="mb-4">
            <input type="text" wire:model.live="search" placeholder="Search by student name..."
                class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" />
        </div>

        <div class="overflow-x-auto shadow-md rounded-lg">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 text-left text-gray-700 font-semibold border-b">Student Name</th>
                        <th class="py-3 px-4 text-left text-gray-700 font-semibold border-b">Course Name</th>
                        <th class="py-3 px-4 text-right text-gray-700 font-semibold border-b">Amount</th>
                        <th class="py-3 px-4 text-left text-gray-700 font-semibold border-b">Payment Date</th>
                        <th class="py-3 px-4 text-center text-gray-700 font-semibold border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="py-3 px-4 border-b">
                                {{ $payment->student?->name ?? 'N/A' }}
                            </td>
                            <td class="py-3 px-4 border-b">
                                {{ $payment->course?->title ?? 'N/A' }}
                            </td>
                            <td class="py-3 px-4 text-right border-b">
                                ₹{{ number_format($payment->amount ?? 0, 2) }}
                            </td>
                            <td class="py-3 px-4 border-b">
                                {{ $payment->formatted_date ?? $payment->payment_date }}
                            </td>
                            <td class="py-3 px-4 text-center border-b">
                                <a href="{{ route('admin.payment.view', $payment->id) }}"
                                    class="bg-blue-500 text-white px-4 py-1 rounded-md hover:bg-blue-600 transition-colors duration-200">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 px-4 text-gray-500 border-b">
                                No fully paid students found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($payments->hasPages())
            <div class="mt-4">
                {{ $payments->links() }}
            </div>
        @endif
    </div>
</div>