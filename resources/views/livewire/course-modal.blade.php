@if($viewingCourse)
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm overflow-y-auto h-full w-full z-50"
        wire:click.self="closeView">
        <div class="relative max-w-2xl mx-auto my-12">
            <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
                <div class="px-8 py-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800">Manage Course Batch</h2>
                </div>
                
                <div class="p-8">
                    <div class="bg-gray-50/50 rounded-xl p-6 border border-gray-100 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-base font-medium text-gray-700">Current Batch</h3>
                                @if(!$editingCourseId)
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $selectedCourse->batches->where('id', $selectedBatch[$selectedCourse->id] ?? null)->first()?->batch_name ?? 'No batch assigned to this course' }}
                                    </p>
                                @endif
                            </div>
                            @if(!$editingCourseId)
                                <button wire:click="toggleEdit({{ $selectedCourse->id }})"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-700 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    {{ isset($selectedBatch[$selectedCourse->id]) ? 'Change Batch' : 'Assign Batch' }}
                                </button>
                            @endif
                        </div>

                        @if($editingCourseId)
                            <div class="space-y-5">
                                <div class="relative">
                                    <select wire:model.live="selectedBatch.{{ $selectedCourse->id }}"
                                        class="w-full text-sm border border-gray-200 rounded-lg px-4 py-3 bg-white focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200">
                                        <option value="">Select a batch to assign</option>
                                        @foreach ($selectedCourse->batches as $batch)
                                            <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex items-center justify-end space-x-3 pt-2">
                                    <button wire:click="toggleEdit({{ $selectedCourse->id }})"
                                        class="px-5 py-2.5 text-sm font-medium text-gray-700 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-lg transition-all duration-200">
                                        Cancel
                                    </button>
                                    <button wire:click="updateBatch({{ $selectedCourse->id }})"
                                        wire:loading.attr="disabled"
                                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:hover:bg-blue-600 transition-all duration-200">
                                        <span wire:loading.remove wire:target="updateBatch({{ $selectedCourse->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Save Changes
                                        </span>
                                        <span wire:loading wire:target="updateBatch({{ $selectedCourse->id }})">
                                            <svg class="animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Saving...
                                        </span>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
