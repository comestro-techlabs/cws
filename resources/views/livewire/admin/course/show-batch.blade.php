<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Courses</h2>

    @if(!$selectedCourseData)
        <div class="mb-6 flex gap-4">
            <div class="flex-1">
                <input 
                    wire:model.live="search" 
                    type="text" 
                    placeholder="Search courses..." 
                    class="w-full px-4 py-2 border rounded-lg"
                >
            </div>
            <select 
                wire:model.live="courseType" 
                class="px-4 py-2 border rounded-lg bg-white"
            >
                <option value="">All Types</option>
                <option value="online">Online</option>
                <option value="offline">Offline</option>
            </select>
            <select 
                wire:model.live="filterCourse" 
                class="px-4 py-2 border rounded-lg bg-white"
            >
                <option value="">All Courses</option>
                @foreach($allCourses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($courses as $course)
                <div wire:click="selectCourse({{ $course->id }})" class="cursor-pointer bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold">{{ $course->title }}</h3>
                            <span class="px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded-full">
                                {{ $course->batches_count }}
                            </span>
                        </div>
                        <p class="mt-2 text-sm text-gray-600">Duration: {{ $course->duration }} weeks</p>
                        <p class="mt-1 text-sm text-gray-600">Type: {{ ucfirst($course->course_type) }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-8 text-gray-500">
                    No courses found matching your criteria.
                </div>
            @endforelse
        </div>
    @else
        <div class="mb-4 flex justify-between items-center">
            <button wire:click="selectCourse(null)" class="px-4 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded-lg">
                ← Back to Courses
            </button>
        </div>

        <div class="bg-white rounded-lg shadow">
            <div class="p-4 bg-gray-50 rounded-t-lg border-b">
                <h3 class="text-xl font-semibold">{{ $selectedCourseData->title }}</h3>
                <p class="text-sm text-gray-600">Duration: {{ $selectedCourseData->duration }} weeks</p>
            </div>
            
            <div x-data="{ activeTab: 'active' }" class="p-4">
                <!-- Tab Navigation - Switches between active and inactive batch tables -->
                <div class="border-b border-gray-200 mb-4">
                    <div class="flex space-x-4">
                        <button 
                            @click="activeTab = 'active'" 
                            :class="{ 'border-b-2 border-blue-500 text-blue-600': activeTab === 'active' }"
                            class="px-4 py-2 text-sm font-medium hover:text-blue-600 transition-colors">
                            Active Batches
                        </button>
                        <button 
                            @click="activeTab = 'inactive'" 
                            :class="{ 'border-b-2 border-blue-500 text-blue-600': activeTab === 'inactive' }"
                            class="px-4 py-2 text-sm font-medium hover:text-blue-600 transition-colors">
                            Inactive Batches
                        </button>
                    </div>
                </div>

                <!-- Active Batches Table -->
                <div x-show="activeTab === 'active'" class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batch Name</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Seats</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Available</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($selectedCourseData->active_batches as $batch)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $batch->batch_name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $batch->start_date->format('d M, Y') }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $batch->end_date->format('d M, Y') }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $batch->total_seats }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $batch->available_seats > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $batch->available_seats }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                        No active batches available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Inactive Batches Table -->
                <div x-show="activeTab === 'inactive'" class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batch Name</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Seats</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Final Count</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($selectedCourseData->inactive_batches as $batch)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $batch->batch_name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $batch->start_date->format('d M, Y') }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $batch->end_date->format('d M, Y') }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $batch->total_seats }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $batch->total_seats - $batch->available_seats }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                        No inactive batches available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
