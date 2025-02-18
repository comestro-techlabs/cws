<div>
    <form wire:submit.prevent="save" class="space-y-6" enctype="multipart/form-data">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Workshop Title</label>
            <input type="text" wire:model="title" id="title"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Enter workshop title">
            @error('title') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="date" class="block text-sm font-medium text-gray-700">Workshop Date</label>
            <input type="date" wire:model="date" id="date"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('date') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="time" class="block text-sm font-medium text-gray-700">Workshop Time</label>
            <input type="time" wire:model="time" id="time"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('time') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Workshop Image</label>
            <input type="file" wire:model="image" id="image" accept="image/*"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('image') <span class="text-sm text-red-500">{{ $message }}</span> @enderror

            @if ($image)
                <div class="mt-4">
                    <img src="{{ $image->temporaryUrl() }}" alt="Image Preview"
                        class="max-w-[150px] h-auto rounded-md shadow-md">
                </div>
            @elseif($workshopId)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . Workshop::find($workshopId)->image) }}" alt="Current Image"
                        class="max-w-[150px] h-auto rounded-md shadow-md">
                </div>
            @endif
        </div>

        <div>
            <label for="fees" class="block text-sm font-medium text-gray-700">Workshop Fees</label>
            <input type="number" wire:model="fees" id="fees"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Enter workshop fees">
            @error('fees') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="active" class="block text-sm font-medium text-gray-700">Is Active?</label>
            <select wire:model="active" id="active"
                class="px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <button type="submit"
            class="w-full bg-blue-400 text-white font-semibold py-2 px-4 rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            {{ $workshopId ? 'Update' : 'Create' }} Workshop
        </button>
    </form>

    @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
            {{ session('message') }}
        </div>
    @endif
</div>
