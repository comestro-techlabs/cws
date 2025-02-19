<div>
    <!-- Search Bar (Optional) -->
    <div class="mb-4">
        <input
            type="text"
            wire:model.live="search"
            placeholder="Search workshops..."
            class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
        />
    </div>

    <!-- Table -->
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Id
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Title
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Date
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Time
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Image
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Fees
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Payment Status
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Action
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($workshops as $workshop)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $workshop->id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $workshop->title }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($workshop->date)->format('F j, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($workshop->time)->format('h:i A') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> 
                        <img src="{{ Storage::url($imagePath) }}" alt="Workshop Image" class="w-16 h-16 object-cover rounded-lg">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $workshop->fees }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <button
                            wire:click="toggleStatus({{ $workshop->id }})"
                            class="px-2 py-1 text-white rounded-md {{ $workshop->active ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }}"
                        >
                            {{ $workshop->active ? 'Active' : 'Inactive' }}
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if ($workshop->payment)
                            @if ($workshop->payment->payment_status == 'captured')
                                <span class="px-2 py-1 text-white bg-green-500 rounded-md hover:bg-green-600">Successful</span>
                            @elseif ($workshop->payment->payment_status == 'pending')
                                <span class="px-2 py-1 text-white bg-yellow-500 rounded-md hover:bg-yellow-600">Pending</span>
                            @elseif ($workshop->payment->payment_status == 'failed')
                                <span class="text-red-500">Failed</span>
                            @else
                                <span class="text-gray-500">Unknown</span>
                            @endif
                        @else
                            <span class="px-2 py-1 text-white bg-yellow-500 rounded-md hover:bg-yellow-600">Pending</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                     <!-- Edit Button -->
                        <button
                            wire:click="editWorkshop({{ $workshop->id }})"
                            class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 mr-2"
                     >
                         Edit
                        </button>

                        <!-- Delete Button -->
                        <button
                            wire:click="deleteWorkshop({{ $workshop->id }})"
                            onclick="return confirm('Are you sure you want to delete this workshop?');"
                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                        >
                            Delete
                        </button>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $workshops->links() }}
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
            {{ session('message') }}
        </div>
    @endif
</div>