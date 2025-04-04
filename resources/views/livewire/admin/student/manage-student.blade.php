<div class="container mx-auto px-4 sm:px-8 py-8">
    <div class="flex flex-col gap-8">
        <div class="w-full mb-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex flex-wrap justify-between items-center py-4">
                    <h2 class="md:text-2xl text-xl font-bold text-gray-800 border-s-4 border-s-purple-800 pl-3 mb-5">
                        Manage Students
                    </h2>
                </div>

                <!-- Enhanced Search and Filter Section -->
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                        <!-- Search -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Search Students</label>
                            <div class="relative">
                                <input type="search" wire:model.live="search"
                                    class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2.5 focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                    placeholder="Search by name, email...">
                                <svg class="absolute left-3 top-3 h-5 w-5 text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Subscription Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subscription Plan</label>
                            <select wire:model.live="subscriptionFilter"
                                class="w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 py-2.5 px-3">
                                <option value="">All Plans</option>
                                @foreach($subscriptionPlans as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                @endforeach
                                <option value="none">No Subscription</option>
                            </select>
                        </div>

                        <!-- Course Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                            <select wire:model.live="courseFilter"
                                class="w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 py-2.5 px-3">
                                <option value="">All Courses</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select wire:model.live="statusFilter"
                                class="w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 py-2.5 px-3">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Active Filters -->
                    @if($search || $subscriptionFilter || $courseFilter || $statusFilter)
                        <div class="flex items-center gap-2 mt-4">
                            <span class="text-sm text-gray-600">Active Filters:</span>
                            <button wire:click="resetFilters"
                                class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm hover:bg-red-200">
                                Clear All
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Students Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subscription
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Courses</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($students as $student)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $student->id }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $student->name }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $student->email }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $student->contact }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                        @if($student->subscriptions->isNotEmpty())
                                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                                                                {{ $student->subscriptions->first()->plan->name }}
                                                            </span>
                                                        @else
                                                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">
                                                                No Subscription
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                        <div class="flex flex-wrap gap-1">
                                                            @forelse($student->courses->take(2) as $course)
                                                                <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">
                                                                    {{ Str::limit($course->title, 15) }}
                                                                </span>
                                                            @empty
                                                                <span class="text-gray-500">No courses</span>
                                                            @endforelse
                                                            @if($student->courses->count() > 2)
                                                                <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">
                                                                    +{{ $student->courses->count() - 2 }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                        <button wire:click="status({{ $student->id }})"
                                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium transition-colors duration-200 
                                   {{ $student->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}"
                                                            title="Click to toggle status">
                                                            {{ $student->is_active ? 'Active' : 'Inactive' }}
                                                        </button>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                        <div class="flex gap-2">
                                                            <a href="{{ route('admin.student.view', ['id' => $student->id]) }}"
                                                                class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                                                View Details
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                        No students found matching the criteria.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
</div>