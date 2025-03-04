<div class="container mx-auto px-4 sm:px-8 py-8">
    <div class="flex flex-col gap-8">
        <div class="w-full mb-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex flex-wrap justify-between items-center py-4">
                    <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 mb-5">
                        Manage Workshops
                    </h2>
                </div>
                <div class="mb-6 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                    
            
                    <div class="w-full md:w-1/3">
                        <input wire:model.debounce.500ms="search" type="text" 
                               placeholder="Search workshops by title..." 
                               class="w-full rounded-md border p-2 border-gray-300  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <button wire:click="showCreateForm" 
                            class="bg-purple-800 text-white px-4 py-2 rounded-md hover:bg-purple-600">
                        Create New Workshop
                    </button>
                </div>


                <!-- Loading Indicator -->
                @if ($loading)
                    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
                        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-indigo-600"></div>
                    </div>
                @endif

                <!-- Modal Form -->
                @if ($showForm)
                    <div
                        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center z-50 p-4">
                        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
                            <div class="p-6">
                                <h2 class="text-2xl font-bold mb-4">{{ $editing ? 'Edit Workshop' : 'Create Workshop' }}
                                </h2>

                                <form wire:submit.prevent="{{ $editing ? 'update' : 'create' }}"
                                    enctype="multipart/form-data">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Title</label>
                                            <input wire:model="title" type="text"
                                                class="mt-1 p-2 block w-full rounded-md border-gray-300  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('title')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Date</label>
                                            <input wire:model="date" type="date"
                                                class="mt-1 p-2 block w-full rounded-md border-gray-300  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('date')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Time</label>
                                            <input wire:model="time" type="time"
                                                class="mt-1 p-2 block w-full rounded-md border-gray-300  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('time')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Image</label>
                                            <input wire:model="image" type="file" accept="image/*"
                                                class="mt-1 p-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                            @error('image')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                            <div wire:loading>
                                                <div
                                                    class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
                                                    <div
                                                        class="animate-spin rounded-full h-16 w-16 border-t-4 border-indigo-600">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                @if ($loading)
                                                    <div
                                                        class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
                                                        <div
                                                            class="animate-spin rounded-full h-16 w-16 border-t-4 border-indigo-600">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($imagePreview)
                                                    <p class="text-sm text-gray-600">Preview:</p>
                                                    <img src="{{ $imagePreview }}" alt="Image preview"
                                                        class="mt-2 max-w-full h-auto rounded">
                                                @elseif ($editing && $existingImage)
                                                    <p class="text-sm text-gray-600">Current Image:</p>
                                                    <img src="{{ Storage::url($existingImage) }}"
                                                        alt="Current workshop image"
                                                        class="mt-2 max-w-full h-auto rounded">
                                                @endif
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Fees (0 for
                                                free)</label>
                                            <input wire:model="fees" type="number" min="0" step="0.01"
                                                class="mt-1 p-2 block w-full rounded-md border-gray-300  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('fees')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Status</label>
                                            <select wire:model="status"
                                                class="mt-1 p-2 block w-full rounded-md border-gray-300  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                <option value="pending">Pending</option>
                                                <option value="success">Success</option>
                                                <option value="failed">Failed</option>
                                            </select>
                                            @error('status')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="flex items-center">
                                            <input wire:model="active" type="checkbox"
                                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                            <label class="ml-2 block text-sm text-gray-900">Active</label>
                                        </div>
                                    </div>

                                    <div class="mt-6 flex gap-4 justify-end">
                                        <button type="submit"
                                            class="bg-purple-800 text-white px-4 py-2 rounded-md hover:bg-purple-600">
                                            {{ $editing ? 'Update' : 'Create' }}
                                        </button>
                                        <button type="button" wire:click="cancel"
                                            class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Table -->

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Time</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Image</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fees</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Active</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($workshops as $workshop)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $workshop->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $workshop->date->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $workshop->time }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <img src="{{ Storage::url($workshop->image) }}" alt="{{ $workshop->title }}"
                                            class="h-16 w-16 object-cover rounded">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">

                                        {{ $workshop->fees == 0 ? 'Free' : '₹' . $workshop->fees }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $workshop->status }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $workshop->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $workshop->active ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button wire:click="edit({{ $workshop->id }})"
                                            class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-indigo-600 hover:bg-indigo-800">Edit</button>
                                        <button wire:click="delete({{ $workshop->id }})"
                                            class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-red-500 hover:bg-red-600">Delete</button>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">No Workshop
                                        found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-between items-center px-4 py-3">
                    <div class="text-sm text-gray-500">
                        Showing
                        <b>{{ $workshops->firstItem() }}-{{ $workshops->lastItem() }}</b>
                        of {{ $workshops->total() }}
                    </div>
                    <div class="flex space-x-1">
                        <button wire:click="previousPage" wire:loading.attr="disabled"
                            class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50 hover:border-gray-400 transition duration-200 ease {{ $workshops->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                            Prev
                        </button>
                        @foreach ($workshops->getUrlRange(1, $workshops->lastPage()) as $page => $url)
                            <button wire:click="gotoPage({{ $page }})"
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal {{ $workshops->currentPage() === $page ? 'text-white bg-gray-800 border-gray-800 hover:bg-gray-600 hover:border-gray-600' : 'text-gray-500 bg-white border-gray-200 hover:bg-gray-50 hover:border-gray-400' }} border rounded transition duration-200 ease">
                                {{ $page }}
                            </button>
                        @endforeach
                        <button wire:click="nextPage" wire:loading.attr="disabled"
                            class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50 hover:border-gray-400 transition duration-200 ease {{ $workshops->onLastPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
