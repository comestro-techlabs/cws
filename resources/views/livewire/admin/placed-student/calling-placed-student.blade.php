<div>
    <div class="flex flex-wrap justify-between items-center p-4">
        <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 mb-5">
            Manage Students
        </h2>

        <button 
            wire:click="addNewStudent"
            type="button"
            class="bg-purple-800 text-white px-4 py-2 rounded-md shadow hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-blue-300 flex items-center gap-1"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            New Student
            <i class="bi bi-arrow-down-short font-bold text-xl"></i>
        </button>
    </div>

    <div class="mx-auto p-3">


        <!-- Search Input -->
        <div class="mb-4">
            <input type="text" wire:model.live="search" placeholder="Search by name or position..."
                class="w-full px-4 py-2 border rounded">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border text-sm border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Content</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Position</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Image</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody> 
                    @forelse ($placedStudents as $key => $student)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $key + 1 }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $student->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $student->content }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $student->position }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button wire:click="toggleStatus({{ $student->id }})"
                                class="px-4 py-2 text-white font-bold rounded
                                        {{ $student->status ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }}">
                                {{ $student->status ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if ($student->image)
                            <img src="{{  $student->image }}" alt="{{ $student->name }}"
                                class="w-16 h-16 rounded">
                            @else
                            N/A
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <div class="flex item-center gap-2">
                                <button wire:click="editStudent({{ $student->id }})"
                                    class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</button> |
                                <button wire:click="deleteStudent({{ $student->id }})"
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                                    onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="border border-gray-300 px-4 py-2 text-center">No records found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
    <!-- working on edit and add functionality -->
    @if($isModalOpen)
    <div
        class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-75"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true">
        <!-- Modal Container -->
        <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6">

            <!-- Modal Form -->
            <form wire:submit.prevent="save" enctype="multipart/form-data">

                <!-- Header -->
                <div class="flex justify-between items-center border-b pb-4">
                    <h3 class="text-lg font-medium text-gray-900" id="modal-title">
                    {{ $editMode ? 'Edit Student' : 'Add New Student' }}
                    </h3>
                    <button
                        type="button"
                        wire:click="closeModal"
                        class="text-gray-400 hover:text-gray-600">
                        &times;
                    </button>
                </div>

                <!-- Form Fields -->
                <div class="space-y-4 mt-4">

                    <!-- Student Name -->
                    <div class="flex flex-col">
                        <label for="name" class="text-sm font-medium text-gray-500">Student Name:</label>
                        <input
                            type="text"
                            id="name"
                            wire:model="name"
                            class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" />
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div class="flex flex-col">
                        <label for="content" class="text-sm font-medium text-gray-500">Content:</label>
                        <input
                            type="text"
                            id="content"
                            wire:model="content"
                            class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" />
                        @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Position -->
                    <div class="flex flex-col">
                        <label for="position" class="text-sm font-medium text-gray-500">Position:</label>
                        <input
                            type="text"
                            id="position"
                            wire:model="position"
                            class="w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" />
                        @error('position')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Profile Picture Upload -->
                    <div class="flex flex-col">
                        <label class="text-sm font-medium text-gray-500">Profile Picture:</label>

                        <div class="flex items-center space-x-4">
                            <!-- Image Preview -->
                            <div class="w-24 h-24 border-2 border-dashed border-gray-300 rounded-md overflow-hidden bg-gray-50 flex items-center justify-center">
                             @if ($image)
                                @if (is_string($image))
                                    <img src="{{ $image }}?tr=w-300,h-300,fo-auto" class="h-full w-full object-cover" />
                                @else
                                <img src="{{ $image->temporaryUrl() }}" class="h-full w-full object-cover" />
                                @endif
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-12 h-12 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z" />
                                </svg>
                                @endif
                                
                            </div>

                            <!-- File Input -->
                            <div>
                                <label for="image-upload" class="cursor-pointer inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                    Choose File
                                </label>
                                <input
                                    id="image-upload"
                                    type="file"
                                    wire:model="image"
                                    accept="image/*"
                                    class="hidden" />
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG up to 2MB</p>
                                @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex justify-end space-x-4 mt-6">
                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        {{ $editMode ? 'Update' : 'Save' }}
                        </button>

                    <button
                        type="button"
                        wire:click="closeModal"
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition">
                        Back
                    </button>
                </div>
            </form>

        </div>
    </div>
    @endif

</div>