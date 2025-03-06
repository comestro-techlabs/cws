<div>

    <div class="container mx-auto px-4 sm:px-8 py-8">
        <div class="flex flex-col gap-8">
            <div class="w-full mb-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="flex flex-wrap justify-between items-center py-4">
                        <h2
                            class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 mb-5">
                            Manage Course
                        </h2>

                    </div>
                    <div class="flex flex-col md:flex-row gap-4 mb-4">
                        <div class="flex-1">
                            <input type="search" wire:model.live="search"
                                class="w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2"
                                placeholder="Search by name...">
                        </div>
                        <div class="flex-1">
                            <div class="w-full flex justify-end">
                                <a wire:navigate href="{{ route('admin.course') }}"
                                    class="bg-purple-800 text-white px-4 py-2 rounded-md shadow hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-blue-300 sm:mb-0 flex items-center gap-1">
                                    Create New Course
                                    <i class="bi bi-arrow-down-short font-bold text-xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Search Input -->


                    <!-- Course Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 ">
                            <thead class="bg-gray-50 ">
                                <tr>
                                    <th scope="col"
                                        class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Title</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Instructor</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Duration</th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($courses as $course)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $course->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $course->instructor }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $course->duration }} weeks</td>



                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a wire:navigate href="{{ route('admin.course.show', $course->id) }}"
                                                class="bg-blue-500 rounded-lg text-white p-2 ">View</a>
                                            <a wire:navigate href="{{ route('admin.course.update', $course->id) }}"
                                                class="bg-purple-800 text-white p-2 rounded-lg ">Edit</a>

                                            <button wire:click="confirmDelete({{ $course->id }})"
                                                class="bg-red-500 text-white p-2 rounded-lg ">Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">No Course
                                            found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>


                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $courses->links() }}
                    </div>

                    <!-- Delete Confirmation Modal -->
                    @if ($confirmingDelete)
                        <div class="fixed inset-0 flex items-center justify-center">
                            <div class="bg-white p-6 rounded-lg shadow-lg">
                                <p class="text-lg font-semibold">Delete Course?</p>
                                <p class="text-gray-600">Are you sure you want to delete
                                    <strong>{{ $courseToDelete->title }}</strong>?
                                </p>
                                <div class="mt-4 flex justify-end space-x-2">
                                    <button wire:click="$set('confirmingDelete', false)"
                                        class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                                    <button wire:click="deleteCourse"
                                        class="px-4 py-2 bg-red-500 text-white rounded">Delete</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>



        </div>
    </div>


</div>
