<div>
    <!-- Add loader component at the top -->
    <x-loader />

    <div class=" mx-auto px-4 sm:px-8">
        <div class="flex flex-col gap-3">
            <div class="w-full">
                <div class="">
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

                    <!-- Filters Section -->
                    <div class="bg-white rounded-lg shadow p-6 mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Search Input -->
                            

                            <!-- Course Type Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Course Type</label>
                                <select wire:model.live="typeFilter" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-white">
                                    <option value="">All Types</option>
                                    <option value="online">Online</option>
                                    <option value="offline">Offline</option>
                                </select>
                            </div>

                            <!-- Status Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select wire:model.live="statusFilter" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-white">
                                    <option value="">All Status</option>
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>

                            <!-- Price Range Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                                <select wire:model.live="priceRangeFilter" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-white">
                                    <option value="">All Prices</option>
                                    <option value="free">Free</option>
                                    <option value="paid">Paid</option>
                                    <option value="low">Low (₹1 - ₹10,000)</option>
                                    <option value="mid">Mid (₹10,001 - ₹25,000)</option>
                                    <option value="high">High (> ₹25,000)</option>
                                </select>
                            </div>

                            <!-- Sort By -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                                <select wire:model.live="sortBy" 
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-white">
                                    <option value="created_at">Date Created</option>
                                    <option value="title">Title</option>
                                    <option value="discounted_fees">Price</option>
                                </select>
                            </div>
                        </div>

                        <!-- Reset Filters Button -->
                        <div class="mt-6 flex justify-end">
                            <button wire:click="resetFilters" 
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors border border-gray-300">
                                Reset Filters
                            </button>
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
                                        Type</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Instructor</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Duration</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span
                                                class="px-2 py-1 rounded-full {{ $course->course_type === 'online' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                                {{ ucfirst($course->course_type) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $course->instructor }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $course->duration }} weeks</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 py-1 rounded-full {{ $course->published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $course->published ? 'Published' : 'Draft' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                           
                                            <a wire:navigate href="{{ route('admin.course.update', $course->id) }}"
                                                class="bg-purple-800 text-white p-2 rounded-lg ">View</a>

                                            <button wire:click="confirmDelete({{ $course->id }})"
                                                wire:loading.attr="disabled"
                                                wire:target="confirmDelete"
                                                class="bg-red-500 text-white p-2 rounded-lg disabled:opacity-50">
                                                <span wire:loading.remove wire:target="confirmDelete">Delete</span>
                                                <span wire:loading wire:target="confirmDelete">Deleting...</span>
                                            </button>
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
