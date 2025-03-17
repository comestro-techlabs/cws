<div>
    <x-loader />
    
    <div class="flex flex-col lg:flex-row w-full gap-6">
        <!-- Left Section: Add/Edit Batch -->
        <div class="lg:w-6/12 w-full p-4 bg-white rounded-lg shadow">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold">{{ $isEditing ? 'Edit Batch' : 'Add New Batch' }}</h3>
                @if($isEditing)
                    <button wire:click="cancelEdit" class="text-gray-600 hover:text-gray-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                @endif
            </div>

            <form wire:submit="{{ $isEditing ? 'updateBatch' : 'addBatch' }}">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Batch Name</label>
                        <input type="text" wire:model="batchName"
                            class="mt-1 p-2 block w-full rounded-md border border-gray-300 focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                        @error('batchName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" wire:model.live="startDate"
                            class="mt-1 p-2 block w-full rounded-md border border-gray-300 focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                        @error('startDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Course Duration</label>
                        <p class="mt-1 text-sm text-gray-600">{{ $course->duration }} weeks</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">End Date (Auto-calculated)</label>
                        <input type="date" wire:model="endDate"
                            class="mt-1 p-2 block w-full rounded-md border border-gray-300 bg-gray-50"
                            readonly>
                    </div>

                    <button type="submit"
                        class="w-full bg-purple-600 text-white py-2 px-4 rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                        {{ $isEditing ? 'Update Batch' : 'Add Batch' }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Right Section: All Batches -->
        <div class="lg:w-6/12 w-full p-4 bg-white rounded-lg shadow">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold">All Batches</h3>
            </div>
            
            <div class="space-y-4">
                @forelse($batches as $batch)
                    <div class="bg-gray-50 rounded-lg p-4 relative group">
                        <div class="absolute right-2 top-2 opacity-0 group-hover:opacity-100 transition-opacity flex space-x-2">
                            <button wire:click="editBatch({{ $batch->id }})" 
                                class="text-blue-600 hover:text-blue-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            
                            @if(!DB::table('course_student')->where('batch_id', $batch->id)->exists())
                                <button wire:click="deleteBatch({{ $batch->id }})" 
                                    class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                        
                        <h4 class="font-medium text-lg text-purple-600">{{ $batch->batch_name }}</h4>
                        <div class="mt-2 text-sm text-gray-600">
                            <p>Start: {{ \Carbon\Carbon::parse($batch->start_date)->format('M d, Y') }}</p>
                            <p>End: {{ \Carbon\Carbon::parse($batch->end_date)->format('M d, Y') }}</p>
                        </div>
                        
                        @if(DB::table('course_student')->where('batch_id', $batch->id)->exists())
                            <div class="mt-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Has Enrolled Students
                                </span>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center text-gray-500 py-4">
                        No batches found
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
