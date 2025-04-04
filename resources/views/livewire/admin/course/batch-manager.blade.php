<div>
    <x-loader />
    
    <div class="flex flex-col lg:flex-row w-full gap-6">
        <!-- Left Section: Add/Edit Batch Form -->
        <div class="lg:w-4/12 w-full">
            <div class="bg-white rounded-lg shadow p-6">
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

                <form wire:submit="{{ $isEditing ? 'updateBatch' : 'addBatch' }}" class="space-y-6">
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
        </div>

        <!-- Right Section: Batch Cards -->
        <div class="lg:w-8/12 w-full">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">All Batches</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($batches as $batch)
                        <div class="bg-white border rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="p-4">
                                <!-- Batch Header -->
                                <div class="flex justify-between items-start mb-3">
                                    <h4 class="font-semibold text-lg text-purple-600">{{ $batch->batch_name }}</h4>
                                    <div class="flex space-x-2"> <!-- Removed opacity classes -->
                                        <button wire:click="editBatch({{ $batch->id }})" 
                                            class="text-blue-600 hover:text-blue-800 p-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        
                                        @if(!DB::table('course_student')->where('batch_id', $batch->id)->exists())
                                            <button wire:click="deleteBatch({{ $batch->id }})" 
                                                wire:confirm="Are you sure you want to delete this batch?"
                                                class="text-red-600 hover:text-red-800 p-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <!-- Batch Details -->
                                <div class="space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Start Date:</span>
                                        <span class="font-medium">{{ \Carbon\Carbon::parse($batch->start_date)->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">End Date:</span>
                                        <span class="font-medium">{{ \Carbon\Carbon::parse($batch->end_date)->format('M d, Y') }}</span>
                                    </div>                                    
                                </div>

                                @if(DB::table('course_student')->where('batch_id', $batch->id)->exists())
                                    <div class="mt-3 flex items-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Has Enrolled Students
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-8 text-gray-500">
                            No batches found
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
