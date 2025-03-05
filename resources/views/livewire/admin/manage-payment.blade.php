<div>
   
    <div class="container mx-auto px-4 sm:px-8 py-8">
        <div class="flex flex-col gap-8">
            <div class="w-full mb-8">
                <div class="bg-white shadow-md rounded-lg p-6">               
                    <div class="flex flex-wrap justify-between items-center py-4">
                        <h2
                            class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 mb-5">
                            Manage Students Payments Students
                        </h2>
    
                    </div>
                    <div class="flex flex-col md:flex-row gap-4 mb-4">
                        <div class="flex-1">
                            <input type="search" wire:model.live="search"
                                class="w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2"
                                placeholder="Search by name...">
                        </div>
                        
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Student Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Course Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Payment Date</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($payments as $payment)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->student?->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->course?->title ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₹{{ number_format($payment->amount ?? 0, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"> {{ $payment->formatted_date ?? $payment->payment_date }}
                                        </td>
                                       
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.payment.view', $payment->id) }}"
                                                class="bg-blue-500 text-white px-4 py-1 rounded-md hover:bg-blue-600 transition-colors duration-200">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">No Payments found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-between items-center px-4 py-3">
                        <div class="text-sm text-gray-500">
                            Showing
                            <b>{{ $payments->firstItem() }}-{{ $payments->lastItem() }}</b>
                            of {{ $payments->total() }}
                        </div>
                        <div class="flex space-x-1">
                            <button wire:click="previousPage" wire:loading.attr="disabled"
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50 hover:border-gray-400 transition duration-200 ease {{ $payments->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                                Prev
                            </button>
                            @foreach($payments->getUrlRange(1, $payments->lastPage()) as $page => $url)
                                <button wire:click="gotoPage({{ $page }})"
                                    class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal {{ $payments->currentPage() === $page ? 'text-white bg-gray-800 border-gray-800 hover:bg-gray-600 hover:border-gray-600' : 'text-gray-500 bg-white border-gray-200 hover:bg-gray-50 hover:border-gray-400' }} border rounded transition duration-200 ease">
                                    {{ $page }}
                                </button>
                            @endforeach
                            <button wire:click="nextPage" wire:loading.attr="disabled"
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50 hover:border-gray-400 transition duration-200 ease {{ $payments->onLastPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>