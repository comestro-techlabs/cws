<div>
    @if($isEditing)
    <div class="max-w-5xl mx-auto mt-8">
        <h2 class="text-xl font-semibold text-slate-500 border-s-4 border-s-orange-400 pl-3 mb-5">
           Edit Workshop
        </h2>

        <form wire:submit="save" class="space-y-4 mb-8">
            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" wire:model="title" class="mt-1 block w-full rounded-md border-gray-300">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" wire:model="date" class="mt-1 block w-full rounded-md border-gray-300">
                @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Time</label>
                <input type="time" wire:model="time" class="mt-1 block w-full rounded-md border-gray-300">
                @error('time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Fees</label>
                <input type="number" wire:model="fees" step="0.01" class="mt-1 block w-full rounded-md border-gray-300">
                @error('fees') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Image</label>
                @if($isEditing && $existingImage)
                    <div class="mb-2">
                        <p class="text-sm text-gray-600">Current Image:</p>
                        <img src="{{ Storage::url($existingImage) }}" alt="Current image" class="w-32 h-32 object-cover rounded-md">
                    </div>
                @endif
                @if($image)
                    <div class="mb-2">
                        <p class="text-sm text-gray-600">Preview:</p>
                        <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-32 h-32 object-cover rounded-md">
                    </div>
                @endif
                <input type="file" wire:model="image" accept="image/*" class="mt-1 block w-full">
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select wire:model="active" class="mt-1 block w-full rounded-md border-gray-300">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                @error('active') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Update
                </button>
                <button type="button" wire:click="resetForm" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Cancel
                </button>
            </div>

            @if(session('message'))
                <div class="text-green-600 mt-2">{{ session('message') }}</div>
            @endif
        </form>
    </div>
    @endif

    <div class="max-w-5xl mx-auto">
        <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-orange-400 pl-3 mb-5">Manage Workshops</h2>

        @if($workshops->isEmpty())
            <p class="text-gray-800">No workshops found.</p>
        @else
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Time</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Image</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Fees</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Payment Status</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($workshops as $workshop)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $workshop->title }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ \Carbon\Carbon::parse($workshop->date)->format('F j, Y') }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ \Carbon\Carbon::parse($workshop->time)->format('h:i A') }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <img src="{{ asset('storage/' . $workshop->image) }}" alt="{{ $workshop->title }}" class="w-20 h-20 object-cover rounded-md">
                                </td>
                                <td class="border border-gray-300 px-4 py-2">{{ $workshop->fees }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    @if ($workshop->active)
                                        <button wire:click="toggleStatus({{ $workshop->id }})" 
                                                class="px-2 py-1 text-white bg-green-500 rounded-md hover:bg-green-600">
                                            Active
                                        </button>
                                    @else
                                        <button wire:click="toggleStatus({{ $workshop->id }})" 
                                                class="px-2 py-1 text-white bg-red-500 rounded-md hover:bg-red-600">
                                            Inactive
                                        </button>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
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
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex flex-wrap gap-2">
                                        <button wire:click="edit({{ $workshop->id }})"
                                                class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                            Edit
                                        </button>
                                        <button 
                                            wire:click="delete({{ $workshop->id }})" 
                                            wire:confirm="Are you sure you want to delete this portfolio?"
                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>