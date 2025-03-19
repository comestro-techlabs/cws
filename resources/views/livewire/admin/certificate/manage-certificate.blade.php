<div class="p-6  ">
    @if(!$selectedCourse)
        <!-- Course Selection -->
        <div class="mb-6 bg-white rounded-lg shadow p-4">
            <h2 class="text-lg font-semibold mb-4">Select Course</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($courses as $course)
                    <button wire:click="selectCourse({{ $course->id }})" 
                        class="p-4 border rounded-lg text-left hover:bg-gray-50">
                        <h3 class="font-medium">{{ $course->title }}</h3>
                        <p class="text-sm text-gray-500">Eligible Students: {{ $course->students->filter(function($student) use ($course) {
                            return $this->calculatePercentage($student, $course) >= 60;
                        })->count() }}</p>
                    </button>
                @endforeach
            </div>
        </div>
    @else
        <!-- Header with Back Button and Tabs -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 flex items-center justify-between border-b">
                <div class="flex items-center space-x-4">
                    <button wire:click="clearSelection" class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </button>
                    <h2 class="text-lg font-semibold">{{ $courses->find($selectedCourse)->title }}</h2>
                </div>
                <div class="flex space-x-4">
                    <button wire:click="switchTab('eligible')" 
                        class="px-4 py-2 {{ $activeTab === 'eligible' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600' }}">
                        Eligible Students
                    </button>
                    <button wire:click="switchTab('non-eligible')" 
                        class="px-4 py-2 {{ $activeTab === 'non-eligible' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600' }}">
                        Non-Eligible Students
                    </button>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="mb-6">
            <input type="text" wire:model.live="searchTerm" 
                class="w-full md:w-1/3 px-4 py-2 border rounded-lg"
                placeholder="Search students...">
        </div>

        <!-- Tables -->
        <div class="bg-white rounded-lg shadow">
            @if($activeTab === 'eligible')
                <!-- Eligible Students Table -->
                <div class="bg-white rounded-lg shadow mb-6">
                    <div class="p-4 border-b">
                        <h2 class="text-lg font-semibold">Eligible Students</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Exam Score</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Assignment Score</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Overall Score</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($eligibleStudents as $student)
                                    <tr>
                                        <td class="px-6 py-4">{{ $student['name'] }}</td>
                                        <td class="px-6 py-4">{{ number_format($student['exam_percent'], 2) }}%</td>
                                        <td class="px-6 py-4">{{ number_format($student['assignment_percent'], 2) }}%</td>
                                        <td class="px-6 py-4">{{ number_format($student['overall_percent'], 2) }}%</td>
                                        <td class="px-6 py-4">
                                            @if(!$student['certificate'])
                                                <button wire:click="approveCertificate({{ $student['id'] }}, {{ $selectedCourse }})"
                                                    class="bg-blue-500 text-white px-3 py-1 rounded">
                                                    Generate
                                                </button>
                                            @elseif(!$student['certificate']->admin_approve)
                                                <button wire:click="approvePendingCertificate({{ $student['certificate']->id }})"
                                                    class="bg-yellow-500 text-white px-3 py-1 rounded">
                                                    Approve
                                                </button>
                                            @else
                                                <a href="{{ route('certificate.view', ['certificateId' => $student['certificate']->id]) }}"
                                                   
                                                    class="bg-green-500 text-white px-3 py-1 rounded inline-block">
                                                    View
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No eligible students found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 border-t">
                        {{ $eligibleStudents->links() }}
                    </div>
                </div>
            @else
                <!-- Non-Eligible Students Table -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-4 border-b">
                        <h2 class="text-lg font-semibold">Non-Eligible Students</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Exam Score</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Assignment Score</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Overall Score</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($nonEligibleStudents as $student)
                                    <tr>
                                        <td class="px-6 py-4">{{ $student['name'] }}</td>
                                        <td class="px-6 py-4">{{ number_format($student['exam_percent'], 2) }}%</td>
                                        <td class="px-6 py-4">{{ number_format($student['assignment_percent'], 2) }}%</td>
                                        <td class="px-6 py-4">{{ $student['overall_percent'] ? number_format($student['overall_percent'], 2) . '%' : 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">
                                                Not Eligible
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No non-eligible students found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 border-t">
                        {{ $nonEligibleStudents->links() }}
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>