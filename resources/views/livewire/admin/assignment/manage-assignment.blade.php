<div class="container mx-auto px-4 sm:px-8 py-8 bg-gray-100">
    <div class="flex flex-col gap-8">
        <div class="w-full mb-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex flex-wrap justify-between items-center p-4">
                    <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 mb-5">
                        Manage Assignments
                    </h2>
                    <a wire:navigate href="{{ route('admin.assignment') }}"
                        class="bg-purple-800 text-white px-4 py-2 rounded-md shadow hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-blue-300 sm:mb-0 flex items-center gap-1">
                        Create New Assignment
                        <i class="bi bi-arrow-down-short font-bold text-xl"></i>
                    </a>
                </div>
                <div class="flex flex-col md:flex-row gap-4 mb-4">
                    <div class="flex-1">
                        <input type="search" wire:model.live="search"  class="w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2" placeholder="Search by name...">
                    </div>
                    <div class="flex-1">
                        <select wire:model.live="course_id" id="course_id"
                        class="w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2">
                            <option value="">Select a course</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ $this->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                            
                       
                        </select>
                       
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batch</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Is Published</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($assignments as $assignment)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $assignment->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $assignment->course->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $assignment->batch->batch_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" wire:change="toggleStatus({{ $assignment->id }})"
                                            class="sr-only peer" {{ $assignment->status ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-green-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                    </label>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $assignment->status ? 'Published' : 'Unpublished' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $assignment->created_at->format('Y-m-d') }}</td>
                                   
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                       <div class="flex flex-wrap gap-2">
                                        <a wire:navigate href="{{ route('admin.assignment.view', $assignment->id) }}"
                                            class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-teal-500 transition flex items-center gap-1">
                                            View <i class="bi bi-eye-fill font-bold"></i>
                                        </a>
                                        <a wire:navigate href="{{ route('admin.assignment.edit', $assignment->id) }}"
                                            class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-blue-500 transition flex items-center gap-1">
                                            Edit <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button wire:click="delete({{ $assignment->id }})" wire:confirm="Are you sure you want to delete this assignment?"
                                            class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-red-500 flex items-center gap-1">
                                            Delete <i class="bi bi-trash3-fill font-bold"></i>
                                        </button>
                                    </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">No Assignments found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-between items-center px-4 py-3">
                    <div class="text-sm text-gray-500">
                        Showing
                        <b>{{ $assignments->firstItem() }}-{{ $assignments->lastItem() }}</b>
                        of {{ $assignments->total() }}
                    </div>
                    <div class="flex space-x-1">
                        <button
                            wire:click="previousPage"
                            wire:loading.attr="disabled"
                            class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50 hover:border-gray-400 transition duration-200 ease {{ $assignments->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}"
                        >
                            Prev
                        </button>
                        @foreach($assignments->getUrlRange(1, $assignments->lastPage()) as $page => $url)
                            <button
                                wire:click="gotoPage({{ $page }})"
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal {{ $assignments->currentPage() === $page ? 'text-white bg-gray-800 border-gray-800 hover:bg-gray-600 hover:border-gray-600' : 'text-gray-500 bg-white border-gray-200 hover:bg-gray-50 hover:border-gray-400' }} border rounded transition duration-200 ease"
                            >
                                {{ $page }}
                            </button>
                        @endforeach
                        <button
                            wire:click="nextPage"
                            wire:loading.attr="disabled"
                            class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50 hover:border-gray-400 transition duration-200 ease {{ $assignments->onLastPage() ? 'opacity-50 cursor-not-allowed' : '' }}"
                        >
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
</div>

