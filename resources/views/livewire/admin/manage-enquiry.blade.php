<div class="container mx-auto px-4 sm:px-8 py-8 bg-gray-100">
    @if($isEditing)
        <div class="max-w-5xl mx-auto mt-8 bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Edit Enquiry</h2>

            <form wire:submit.prevent="save" class="space-y-4 mb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" wire:model="name" class="mt-1 block w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Contact</label>
                    <input type="text" wire:model="mobile" class="mt-1 block w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2">
                    @error('mobile') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" wire:model="email" class="mt-1 block w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea wire:model="message" class="mt-1 block w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2"></textarea>
                    @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select wire:model="status" class="mt-1 block w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2">
                        <option value="0">Pending</option>
                        <option value="1">Approved</option>
                        <option value="2">Closed</option>
                    </select>
                    @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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

    <div class="flex flex-1 flex-col">
        <div class="md:px-[2%] px-5">
            <h2 class="md:text-xl capitalize text-lg font-semibold text-gray-700 border-b pb-2 mb-4">
                {{ $search ? $search : 'Manage all' }} Enquiries ({{ $enquiry->total() }})
            </h2>

            <div class="flex gap-3 flex-col md:flex-row justify-between md:items-center mb-4">
                <div class="inline-flex md:flex-row flex-col md:items-center gap-2" role="group">
                    <div class="md:max-w-xl md:mx-auto">
                        <div class="flex border rounded-lg ps-3">
                            <input
                                wire:model.live="search"
                                type="search"
                                id="default-search"
                                class="border-0 focus:outline-none focus:border-none w-full"
                                placeholder="Search Enquiry by name..."
                                size="30"
                            />
                            <button class="bg-gray-100 px-3">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative overflow-x-auto flex-1 border bg-white shadow-md rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Id</th>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Contact</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Message</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($enquiry as $data)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $data->id }}
                                </th>
                                <td class="px-6 py-4">{{ $data->name }}</td>
                                <td class="px-6 py-4">{{ $data->mobile }}</td>
                                <td class="px-6 py-4">{{ $data->email }}</td>
                                <td class="px-6 py-4">
                                    {{ \Illuminate\Support\Str::limit($data->message, 10, '...') }}
                                </td>
                                <td>
                                    @if ($data->status == 1)
                                        <button type="button" class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-yellow-400">
                                            Approved
                                        </button>
                                    @elseif ($data->status == 2)
                                        <button type="button" class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-blue-400">
                                            Closed
                                        </button>
                                    @else
                                        <button type="button" class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-red-500">
                                            Pending
                                        </button>
                                    @endif
                                </td>
                                <td class="flex gap-2 items-center px-6 py-4">
                                    <button
                                        wire:click="edit({{ $data->id }})"
                                        class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-teal-500 hover:bg-teal-600">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center">No enquiries found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex flex-1 space-x-2 justify-center mt-2">
                {{ $enquiry->links() }}
            </div>
        </div>
    </div>
</div>
