<div class="bg-white p-4 rounded-lg shadow">
    {{-- Back and Title Row --}}
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold">Add New Batch</h3>
       
    </div>

    <form wire:submit="addBatch">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Batch Name</label>
                <input type="text" wire:model="batchName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('batchName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" wire:model.live="startDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('startDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Course Duration</label>
                <p class="mt-1 text-sm text-gray-600">{{ $course->duration }} weeks</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">End Date (Auto-calculated)</label>
                <input type="date" wire:model="endDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" readonly>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Total Seats</label>
                <input type="number" wire:model="totalSeats" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('totalSeats') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Available Seats</label>
                <input type="number" wire:model="availableSeats" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('availableSeats') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Add Batch
            </button>
        </div>
    </form>

    <div class="mt-6">
        <h4 class="font-medium mb-2">Current Batches</h4>
        <div class="space-y-2">
            @foreach($batches as $batch)
            <div class="flex justify-between items-center p-2 bg-gray-50 rounded-md">
                <div>
                    <span class="font-medium">{{ $batch->batch_name }}</span>
                    <div class="text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($batch->start_date)->format('M d, Y') }} - 
                        {{ \Carbon\Carbon::parse($batch->end_date)->format('M d, Y') }}
                    </div>
                    <div class="text-sm text-gray-500">
                        Available: {{ $batch->available_seats }}/{{ $batch->total_seats }}
                    </div>
                </div>
                <button wire:click="deleteBatch({{ $batch->id }})" class="text-red-500 hover:text-red-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
            @endforeach
        </div>
    </div>
</div>
