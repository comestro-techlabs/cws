
<div>
    @if($isEditing)
        <div class="max-w-5xl mx-auto mt-8">
            <h2 class="text-xl font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 mb-5">
                Edit Enquiry
            </h2>

            <form wire:submit="save" class="space-y-4 mb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" wire:model="name" class="mt-1 p-2 block w-full rounded-md border border-gray-300">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Contact</label>
                    <input type="text" wire:model="mobile" class="mt-1 p-2 block w-full rounded-md border border-gray-300">
                    @error('mobile') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" wire:model="email" class="mt-1 p-2 block w-full rounded-md border border-gray-300">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea wire:model="message" class="mt-1 p-2 block w-full rounded-md border border-gray-300"></textarea>
                    @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select wire:model="status" class="mt-1 p-2 block w-full rounded-md border border-gray-300">
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

    
    <div class="container mx-auto px-4 sm:px-8 py-8">
        <div class="flex flex-col gap-8">
            <div class="w-full mb-8">
                <div class="bg-white shadow-md rounded-lg p-6">               
                    <div class="flex flex-wrap justify-between items-center py-4">
                        <h2 class="md:text-xl capitalize text-lg font-semibold text-slate-500 border-s-4 border-s-purple-600 pl-3">
                            {{ $search ? $search : 'Manage all' }} Enquiries ({{ $enquiry->total() }})
                        </h2>
    
                    </div>
                    <div class="flex flex-col md:flex-row gap-4 mb-4">
                        <div class="flex-1">
                            <input type="search" wire:model.live="search"
                                class="w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2"
                                placeholder="Search Enquiry by name...">
                        </div>
                       
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name</th>
                                        <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Contact</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email</th>
                                    
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Message</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($enquiry as $data)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->mobile }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ \Illuminate\Support\Str::limit($data->message, 10, '...') }}
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                           
                                            <button  wire:click="edit({{ $data->id }})" 
                                                class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 ml-2">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">No Enquiries found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-between items-center px-4 py-3">
                        <div class="text-sm text-gray-500">
                            Showing
                            <b>{{ $enquiry->firstItem() }}-{{ $enquiry->lastItem() }}</b>
                            of {{ $enquiry->total() }}
                        </div>
                        <div class="flex space-x-1">
                            <button wire:click="previousPage" wire:loading.attr="disabled"
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50 hover:border-gray-400 transition duration-200 ease {{ $enquiry->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                                Prev
                            </button>
                            @foreach($enquiry->getUrlRange(1, $enquiry->lastPage()) as $page => $url)
                                <button wire:click="gotoPage({{ $page }})"
                                    class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal {{ $enquiry->currentPage() === $page ? 'text-white bg-gray-800 border-gray-800 hover:bg-gray-600 hover:border-gray-600' : 'text-gray-500 bg-white border-gray-200 hover:bg-gray-50 hover:border-gray-400' }} border rounded transition duration-200 ease">
                                    {{ $page }}
                                </button>
                            @endforeach
                            <button wire:click="nextPage" wire:loading.attr="disabled"
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50 hover:border-gray-400 transition duration-200 ease {{ $enquiry->onLastPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        
    </div>
</div>